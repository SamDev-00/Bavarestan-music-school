<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Support\Schedule;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegistrationController extends Controller
{
    /**
     * ثبت‌نام هنرجو در یک بازهٔ زمانی مشخص از یک استاد.
     */
    public function store(Request $request)
    {
        $request->merge([
            'national_id' => Schedule::digits($request->input('national_id')),
            'phone' => Schedule::digits($request->input('phone')),
        ]);

        $data = $request->validate([
            'teacher' => ['required', Rule::in(array_keys(Schedule::teachers()))],
            'slot' => ['required', Rule::in(Schedule::slots())],
            'national_id' => ['required', 'regex:/^\d{10}$/'],
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'regex:/^0\d{9,10}$/'],
            'education' => ['nullable', 'string', 'max:60'],
            'level' => ['nullable', 'string', 'max:60'],
            'mode' => ['nullable', 'string', 'max:60'],
            'referral_source' => ['nullable', 'string', 'max:60'],
            'referrer' => ['nullable', 'string', 'max:120'],
            'message' => ['nullable', 'string', 'max:2000'],
        ], [
            'teacher.required' => 'لطفاً استاد و گروه مورد نظر را انتخاب کنید.',
            'teacher.in' => 'استاد انتخاب‌شده معتبر نیست.',
            'slot.required' => 'لطفاً یکی از ساعت‌های خالی را انتخاب کنید.',
            'slot.in' => 'ساعت انتخاب‌شده معتبر نیست.',
            'national_id.required' => 'وارد کردن شماره ملی الزامی است.',
            'national_id.regex' => 'شماره ملی باید دقیقاً ۱۰ رقم باشد.',
            'name.required' => 'نام و نام خانوادگی را وارد کنید.',
            'phone.required' => 'شماره تماس را وارد کنید.',
            'phone.regex' => 'شماره تماس معتبر نیست؛ مثلاً ۰۹۱۲۱۲۳۴۵۶۷.',
        ]);

        $teacher = Schedule::teacher($data['teacher']);

        // همان کد ملی برای همان استاد فقط یک بار.
        $alreadyBooked = Registration::where('national_id', $data['national_id'])
            ->where('teacher_slug', $teacher['slug'])
            ->first();

        if ($alreadyBooked) {
            return back()
                ->withInput()
                ->withErrors([
                    'national_id' => 'با این شماره ملی قبلاً برای «'.$teacher['name'].'» ثبت‌نام شده است ('
                        .$alreadyBooked->schedule_label.'). برای تغییر ساعت، ابتدا رزرو قبلی را لغو کنید.',
                ], 'register');
        }

        try {
            $registration = Registration::create([
                'teacher_slug' => $teacher['slug'],
                'teacher_name' => $teacher['name'],
                'instrument' => $teacher['instrument'],
                'day' => $teacher['day'],
                'slot' => $data['slot'],
                'national_id' => $data['national_id'],
                'name' => $data['name'],
                'phone' => $data['phone'],
                'education' => $data['education'] ?? null,
                'level' => $data['level'] ?? null,
                'mode' => $data['mode'] ?? null,
                'referral_source' => $data['referral_source'] ?? null,
                'referrer' => $data['referrer'] ?? null,
                'message' => $data['message'] ?? null,
            ]);
        } catch (QueryException $exception) {
            // دو نفر هم‌زمان یک بازه را انتخاب کرده‌اند.
            return back()
                ->withInput()
                ->withErrors([
                    'slot' => 'این ساعت هم‌اکنون توسط هنرجوی دیگری رزرو شد. لطفاً ساعت دیگری انتخاب کنید.',
                ], 'register');
        }

        return redirect()
            ->to(route('home').'#register')
            ->with('register_success', 'ثبت‌نام شما برای «'.$teacher['name'].'» در '
                .$registration->schedule_label.' ثبت شد. برای هماهنگی با شما تماس می‌گیریم.');
    }

    /**
     * نمایش رزروهای هنرجو پس از تأیید کد ملی و شمارهٔ تماس.
     */
    public function manage(Request $request)
    {
        $request->merge([
            'national_id' => Schedule::digits($request->input('national_id')),
            'phone' => Schedule::digits($request->input('phone')),
        ]);

        $data = $request->validate([
            'national_id' => ['required', 'regex:/^\d{10}$/'],
            'phone' => ['required', 'regex:/^0\d{9,10}$/'],
        ], [
            'national_id.required' => 'شماره ملی را وارد کنید.',
            'national_id.regex' => 'شماره ملی باید دقیقاً ۱۰ رقم باشد.',
            'phone.required' => 'شماره تماس را وارد کنید.',
            'phone.regex' => 'شماره تماس معتبر نیست.',
        ]);

        $found = Registration::ownedBy($data['national_id'], $data['phone'])
            ->orderBy('day')
            ->orderBy('slot')
            ->get();

        if ($found->isEmpty()) {
            return back()
                ->withErrors([
                    'national_id' => 'رزروی با این شماره ملی و شماره تماس پیدا نشد.',
                ], 'manage');
        }

        return redirect()
            ->to(route('home').'#manage')
            ->with([
                'manage_results' => $found->map(fn (Registration $r) => [
                    'id' => $r->id,
                    'teacher_name' => $r->teacher_name,
                    'instrument' => $r->instrument,
                    'schedule_label' => $r->schedule_label,
                    'name' => $r->name,
                ])->all(),
                'manage_national_id' => $data['national_id'],
                'manage_phone' => $data['phone'],
            ]);
    }

    /**
     * لغو رزرو توسط خود هنرجو — بازهٔ آزادشده بلافاصله قابل رزرو دوباره است.
     */
    public function cancel(Request $request)
    {
        $request->merge([
            'national_id' => Schedule::digits($request->input('national_id')),
            'phone' => Schedule::digits($request->input('phone')),
        ]);

        $data = $request->validate([
            'registration' => ['required', 'integer'],
            'national_id' => ['required', 'regex:/^\d{10}$/'],
            'phone' => ['required', 'regex:/^0\d{9,10}$/'],
        ]);

        // کد ملی و شمارهٔ تماس هر دو باید با همان رزرو بخوانند.
        $registration = Registration::ownedBy($data['national_id'], $data['phone'])
            ->whereKey($data['registration'])
            ->first();

        if (! $registration) {
            return back()->withErrors([
                'national_id' => 'این رزرو پیدا نشد یا متعلق به این شماره ملی نیست.',
            ], 'manage');
        }

        $label = $registration->teacher_name.' — '.$registration->schedule_label;
        $registration->delete();

        return redirect()
            ->to(route('home').'#register')
            ->with('cancel_success', 'رزرو «'.$label.'» لغو شد. این ساعت دوباره برای ثبت‌نام آزاد است.');
    }
}
