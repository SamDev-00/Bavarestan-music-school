<?php

namespace App\Filament\Resources\Teachers\Schemas;

use App\Models\Teacher;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('نام استاد')
                    ->required()
                    ->maxLength(120)
                    ->placeholder('مثلاً مریم صارمی')
                    ->columnSpanFull(),

                FileUpload::make('photo')
                    ->label('عکس استاد (اختیاری)')
                    ->image()
                    ->imageEditor()
                    ->avatar()
                    ->disk('public')
                    ->directory('teachers')
                    ->visibility('public')
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('1:1')
                    ->helperText('عکس هنگام ثبت‌نام کنار نام استاد نمایش داده می‌شود. ترجیحاً مربعی.')
                    ->columnSpanFull(),

                TextInput::make('headline')
                    ->label('معرفی کوتاه (اختیاری)')
                    ->maxLength(160)
                    ->placeholder('مثلاً مدرس ویلن با ۱۰ سال سابقهٔ تدریس و اجرا')
                    ->helperText('یک جملهٔ کوتاه که زیر نام استاد در صفحهٔ اختصاصی‌اش نمایش داده می‌شود.')
                    ->columnSpanFull(),

                RichEditor::make('bio')
                    ->label('بیوگرافی و توضیحات صفحهٔ استاد')
                    ->helperText('هرچه اینجا بنویسید در صفحهٔ اختصاصی استاد نمایش داده می‌شود؛ سوابق، افتخارات، شیوهٔ تدریس و هر چیز دیگر.')
                    ->columnSpanFull(),

                FileUpload::make('footer_image')
                    ->label('عکس انتهای صفحهٔ بیوگرافی (اختیاری)')
                    ->image()
                    ->disk('public')
                    ->directory('teachers')
                    ->visibility('public')
                    ->helperText('این عکس با هر ابعاد و اندازه‌ای که آپلود کنید، بدون برش در انتهای صفحهٔ بیوگرافی نمایش داده می‌شود.')
                    ->columnSpanFull(),

                TextInput::make('instrument')
                    ->label('گروه / ساز')
                    ->required()
                    ->maxLength(120)
                    ->placeholder('مثلاً پیانو')
                    ->helperText('اساتیدِ هم‌گروه با نوشتن دقیقاً یک نام، زیر یک عنوان کنار هم نمایش داده می‌شوند.')
                    ->datalist(fn () => Teacher::query()->distinct()->orderBy('instrument')->pluck('instrument')->all()),

                TextInput::make('icon')
                    ->label('آیکون گروه')
                    ->required()
                    ->maxLength(8)
                    ->default('♪')
                    ->placeholder('♪')
                    ->helperText('یک نماد یا اموجی کوتاه؛ مثلاً ♪ ♬ 🎻 🎤 🥁')
                    ->datalist(['♪', '♬', '♩', '🎤', '🎻', '⚡', '🥁', '🎹', '🎸']),

                Select::make('day')
                    ->label('روز کلاس')
                    ->required()
                    ->options([
                        'شنبه' => 'شنبه',
                        'یکشنبه' => 'یکشنبه',
                        'دوشنبه' => 'دوشنبه',
                        'سه‌شنبه' => 'سه‌شنبه',
                        'چهارشنبه' => 'چهارشنبه',
                        'پنجشنبه' => 'پنجشنبه',
                        'جمعه' => 'جمعه',
                    ])
                    ->helperText('برچسب «...ها» به‌صورت خودکار ساخته می‌شود.'),

                TextInput::make('slug')
                    ->label('شناسهٔ یکتا (انگلیسی)')
                    ->required()
                    ->maxLength(120)
                    ->unique(ignoreRecord: true)
                    ->rules(['regex:/^[a-z0-9-]+$/'])
                    ->placeholder('piano-saremi')
                    ->helperText('فقط حروف کوچک انگلیسی، عدد و خط تیره. پس از ثبت‌نام هنرجویان بهتر است تغییر نکند.'),

                TextInput::make('sort_order')
                    ->label('ترتیب نمایش')
                    ->numeric()
                    ->default(0)
                    ->helperText('عدد کوچک‌تر بالاتر می‌آید. ترتیب گروه‌ها هم بر همین اساس تعیین می‌شود.'),

                Toggle::make('is_active')
                    ->label('فعال (نمایش در سایت)')
                    ->default(true),
            ]);
    }
}
