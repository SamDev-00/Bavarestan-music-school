<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use App\Support\SiteSettings;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

/**
 * @property-read Schema $form
 */
class ContactSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhone;

    protected static ?string $navigationLabel = 'تماس و موقعیت';

    protected static ?string $title = 'تنظیمات تماس و موقعیت';

    protected static ?int $navigationSort = 90;

    protected string $view = 'filament.pages.contact-settings';

    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(SiteSettings::all());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('اطلاعات تماس')
                    ->description('این اطلاعات در بخش «تماس با ما»، پاورقی و نوار موبایل نمایش داده می‌شود.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('contact_phone_primary')
                            ->label('تلفن اول')
                            ->maxLength(40)
                            ->placeholder('۰۹۳۵ ۵۲۱ ۸۲۵۰'),

                        TextInput::make('contact_phone_secondary')
                            ->label('تلفن دوم')
                            ->maxLength(40)
                            ->placeholder('۰۲۱ ۸۸۹۲ ۷۴۵۸'),

                        TextInput::make('contact_hours')
                            ->label('ساعات پاسخگویی')
                            ->maxLength(80)
                            ->placeholder('همه‌روزه، ۱۰ تا ۲۰'),

                        TextInput::make('instagram_url')
                            ->label('آدرس پیج اینستاگرام')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://instagram.com/username')
                            ->helperText('اگر خالی باشد، کارت اینستاگرام در سایت نمایش داده نمی‌شود.'),

                        TextInput::make('bale_url')
                            ->label('لینک کانال بله')
                            ->url()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('contact_address')
                            ->label('آدرس')
                            ->rows(2)
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ]),

                Section::make('موقعیت آموزشگاه')
                    ->description('نقشه و لینک‌های مسیریابی در بخش «موقعیت آموزشگاه» استفاده می‌شوند.')
                    ->columns(2)
                    ->schema([
                        Textarea::make('location_access')
                            ->label('توضیح دسترسی')
                            ->rows(2)
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('neshan_url')
                            ->label('لینک نشان (مشاهده روی نقشه)')
                            ->url()
                            ->maxLength(255),

                        TextInput::make('google_maps_url')
                            ->label('لینک گوگل مپ (مسیریابی)')
                            ->url()
                            ->maxLength(255),

                        Textarea::make('map_embed_url')
                            ->label('لینک نقشهٔ جاسازی‌شده (iframe)')
                            ->rows(2)
                            ->maxLength(1000)
                            ->columnSpanFull()
                            ->helperText('آدرس src نقشه‌ای که داخل صفحه نمایش داده می‌شود. از OpenStreetMap یا Google Maps بخش Embed/اشتراک‌گذاری قابل دریافت است.'),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            SiteSetting::query()->updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );
        }

        SiteSettings::forget();

        Notification::make()
            ->success()
            ->title('تنظیمات ذخیره شد')
            ->send();
    }
}
