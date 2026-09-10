<?php

namespace App\Filament\Resources\Registrations\Schemas;

use App\Models\Registration;
use App\Support\Schedule;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('کلاس')
                    ->description('با تغییر استاد یا ساعت، بازهٔ قبلی دوباره آزاد می‌شود.')
                    ->schema([
                        Select::make('teacher_slug')
                            ->label('استاد')
                            ->options(fn () => collect(Schedule::teachers())
                                ->mapWithKeys(fn ($teacher, $slug) => [
                                    $slug => $teacher['name'].' — '.$teacher['instrument'].' ('.$teacher['day_label'].')',
                                ])
                                ->all())
                            ->required()
                            ->live()
                            // نام استاد، ساز و روز از روی شناسه هم‌زمان به‌روز می‌شوند.
                            ->afterStateUpdated(function (?string $state, callable $set) {
                                $teacher = $state ? Schedule::teacher($state) : null;

                                $set('teacher_name', $teacher['name'] ?? null);
                                $set('instrument', $teacher['instrument'] ?? null);
                                $set('day', $teacher['day'] ?? null);
                            }),

                        Select::make('slot')
                            ->label('ساعت کلاس')
                            ->options(fn () => collect(Schedule::slots())
                                ->mapWithKeys(fn (string $slot) => [$slot => Schedule::toPersianDigits($slot)])
                                ->all())
                            ->required()
                            ->rules([
                                fn (?Registration $record, callable $get) => function (string $attribute, $value, callable $fail) use ($record, $get) {
                                    $taken = Registration::query()
                                        ->where('teacher_slug', $get('teacher_slug'))
                                        ->where('slot', $value)
                                        ->when($record, fn ($q) => $q->whereKeyNot($record->getKey()))
                                        ->exists();

                                    if ($taken) {
                                        $fail('این ساعت برای استاد انتخاب‌شده قبلاً رزرو شده است.');
                                    }
                                },
                            ]),

                        TextInput::make('teacher_name')->label('نام استاد')->required()->readOnly(),
                        TextInput::make('instrument')->label('گروه')->required()->readOnly(),
                        TextInput::make('day')->label('روز')->required()->readOnly(),
                    ])
                    ->columns(2),

                Section::make('هنرجو')
                    ->schema([
                        TextInput::make('name')
                            ->label('نام و نام خانوادگی')
                            ->required()
                            ->maxLength(120),

                        TextInput::make('national_id')
                            ->label('شماره ملی')
                            ->required()
                            ->maxLength(10)
                            ->rules(['regex:/^\d{10}$/'])
                            ->validationMessages(['regex' => 'شماره ملی باید دقیقاً ۱۰ رقم باشد.'])
                            ->dehydrateStateUsing(fn (?string $state) => Schedule::digits($state)),

                        TextInput::make('phone')
                            ->label('شماره تماس')
                            ->required()
                            ->maxLength(20)
                            ->dehydrateStateUsing(fn (?string $state) => Schedule::digits($state)),

                        Select::make('education')
                            ->label('سطح تحصیلات')
                            ->options(self::listOptions(['زیر دیپلم', 'دیپلم', 'کاردانی', 'کارشناسی', 'کارشناسی ارشد', 'دکتری'])),

                        Select::make('level')
                            ->label('سطح تقریبی')
                            ->options(self::listOptions(['مبتدی (از صفر)', 'متوسط', 'پیشرفته'])),

                        Select::make('mode')
                            ->label('نوع کلاس')
                            ->options(self::listOptions(['خصوصی', 'گروهی', 'فرقی ندارد'])),

                        Select::make('referral_source')
                            ->label('از چه طریق آشنا شده')
                            ->options(self::listOptions([
                                'اینستاگرام', 'جست‌وجو در گوگل', 'معرفی دوستان و آشنایان',
                                'عبور از مقابل آموزشگاه', 'بنر و تبلیغات محیطی', 'سایر',
                            ])),

                        TextInput::make('referrer')
                            ->label('معرف')
                            ->maxLength(120),

                        Textarea::make('message')
                            ->label('توضیحات')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    /**
     * @param  list<string>  $values
     * @return array<string, string>
     */
    private static function listOptions(array $values): array
    {
        return array_combine($values, $values);
    }
}
