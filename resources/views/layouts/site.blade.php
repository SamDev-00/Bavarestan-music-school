<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta name="description" content="@yield('meta_description', 'آموزشگاه موسیقی باورستان — کلاس‌های گروهی پیانو، گیتار، گیتار الکتریک، آواز و صداسازی، ویلن، تار و تنبک با مدرسان مجرب در تهران.')" />
  <meta name="theme-color" content="#8b3a2a" />
  <title>@yield('title', 'آموزشگاه موسیقی باورستان')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Markazi+Text:wght@500;600;700&family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="icon" type="image/png" href="{{ asset('images/logo-mark.png') }}" />
  <link rel="apple-touch-icon" href="{{ asset('images/logo-mark.png') }}" />
  <link rel="stylesheet" href="{{ asset('style.css') }}?v=19" />
</head>
<body>
  <a class="skip-link" href="#main">رفتن به محتوا</a>

  <header class="site-header">
    <div class="nav shell">
      <a class="brand" href="{{ url('/') }}" aria-label="آموزشگاه موسیقی باورستان">
        <span class="brand-badge" aria-hidden="true">
          <img src="{{ asset('images/brand-icon.png') }}?v=2" alt="" width="181" height="458" />
        </span>
        <span class="brand-text">
          <span class="brand-name">باورستان</span>
          <span class="brand-sub">آموزشگاه موسیقی</span>
        </span>
      </a>

      <nav class="nav-links" id="nav-links" aria-label="منوی اصلی">
        <a href="{{ route('about') }}">درباره ما</a>
        <a href="{{ url('/') }}#classes">کلاس‌ها</a>
        <a href="{{ route('blog.index') }}">وبلاگ</a>
        <a href="{{ url('/') }}#music">موسیقی</a>
        <a href="{{ route('gallery') }}">گالری</a>
        <a href="{{ route('books.index') }}">کتب آموزشی</a>
        <a href="{{ route('services.create') }}">تعمیرات سازها</a>
        <a href="{{ url('/') }}#register">ثبت‌نام</a>
        <a href="{{ url('/') }}#location">موقعیت</a>
        <a href="{{ url('/') }}#contact">تماس</a>
      </nav>

      <div class="nav-actions">
        <a class="btn btn-ghost hide-sm" href="tel:+982188927458">تماس</a>
        <a class="btn btn-primary hide-sm" href="{{ url('/') }}#register">ثبت‌نام</a>
        <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="nav-links" aria-label="باز کردن منو">
          <span></span>
          <span></span>
        </button>
      </div>
    </div>
  </header>

  @yield('content')

  <footer class="site-footer">
    <div class="shell footer-inner">
      <div class="footer-brand">
        <img class="footer-logo" src="{{ asset('images/logo-footer.png') }}" alt="آموزشگاه موسیقی باورستان" />
        <p>© ۱۴۰۵ آموزشگاه موسیقی باورستان — همه حقوق محفوظ است.</p>
      </div>
      <nav aria-label="پیوندهای پاورقی">
        <a href="{{ route('about') }}">درباره ما</a>
        <a href="{{ url('/') }}#classes">کلاس‌ها</a>
        <a href="{{ route('blog.index') }}">وبلاگ</a>
        <a href="{{ url('/') }}#music">موسیقی</a>
        <a href="{{ route('gallery') }}">گالری</a>
        <a href="{{ route('books.index') }}">کتب آموزشی</a>
        <a href="{{ route('services.create') }}">تعمیرات سازها</a>
        <a href="{{ url('/') }}#register">ثبت‌نام</a>
        <a href="{{ url('/') }}#contact">تماس</a>
        <a href="https://ble.ir/bavarestan_honar" target="_blank" rel="noopener">کانال بله</a>
      </nav>

      <a class="admin-login" href="{{ route('filament.admin.auth.login') }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <rect x="3" y="11" width="18" height="11" rx="2" />
          <path d="M7 11V7a5 5 0 0 1 10 0v4" />
        </svg>
        ورود ادمین
      </a>
    </div>
  </footer>

  <div class="mobile-bar" aria-label="دسترسی سریع موبایل">
    <a class="btn btn-ghost" href="tel:+982188927458">تماس</a>
    <a class="btn btn-primary" href="{{ url('/') }}#register">ثبت‌نام</a>
  </div>

  <script src="{{ asset('script.js') }}?v=2"></script>
  @stack('scripts')
</body>
</html>
