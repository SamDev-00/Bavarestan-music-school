<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Support\Schedule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServiceRequestController extends Controller
{
    public function create()
    {
        return view('services');
    }

    /**
     * ثبت درخواست تعمیر یا خدمات ساز — پیگیری از پنل ادمین انجام می‌شود.
     */
    public function store(Request $request)
    {
        $request->merge([
            'phone' => Schedule::digits($request->input('phone')),
        ]);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'regex:/^0\d{9,10}$/'],
            'instrument' => ['required', Rule::in(ServiceRequest::INSTRUMENTS)],
            'service_type' => ['required', Rule::in(ServiceRequest::SERVICE_TYPES)],
            'description' => ['nullable', 'string', 'max:2000'],
        ], [
            'name.required' => 'نام و نام خانوادگی را وارد کنید.',
            'phone.required' => 'شماره تماس را وارد کنید.',
            'phone.regex' => 'شماره تماس معتبر نیست؛ مثلاً ۰۹۱۲۱۲۳۴۵۶۷.',
            'instrument.required' => 'ساز مورد نظر را انتخاب کنید.',
            'instrument.in' => 'ساز انتخاب‌شده معتبر نیست.',
            'service_type.required' => 'نوع خدمات را انتخاب کنید.',
            'service_type.in' => 'نوع خدمات انتخاب‌شده معتبر نیست.',
        ]);

        ServiceRequest::create($data + ['status' => 'new']);

        return redirect()
            ->route('services.create')
            ->with('service_success', 'درخواست شما ثبت شد. کارشناس ما به‌زودی برای هماهنگی با شما تماس می‌گیرد.');
    }
}
