@extends('layouts.site')
@use('App\Models\ServiceRequest')

@section('title', 'تعمیرات و خدمات سازها — آموزشگاه موسیقی باورستان')
@section('meta_description', 'ثبت درخواست تعمیر، کوک، سیم‌کشی و سرویس سازهای موسیقی در آموزشگاه موسیقی باورستان.')

@section('content')
  <main id="main">
    <section id="services" class="section shell">
      <header class="section-head">
        <h2>تعمیرات و خدمات سازها</h2>
        <p>ساز شما نیاز به تعمیر، کوک یا سرویس دارد؟ فرم زیر را پر کنید تا کارشناس ما برای بررسی و اعلام هزینه با شما تماس بگیرد.</p>
      </header>

      @if(session('service_success'))
        <p class="form-flash is-success" role="status">{{ session('service_success') }}</p>
      @endif

      <div class="register-layout">
        <form class="register-form" method="POST" action="{{ route('services.store') }}">
          @csrf
          <div class="form-grid">
            <div class="field">
              <label for="service-name">نام و نام خانوادگی</label>
              <input id="service-name" name="name" type="text" autocomplete="name" required
                     value="{{ old('name') }}" placeholder="مثلاً علی محمدی" />
            </div>

            <div class="field">
              <label for="service-phone">شماره تماس</label>
              <input id="service-phone" name="phone" type="tel" autocomplete="tel" required inputmode="tel"
                     value="{{ old('phone') }}" placeholder="۰۹۱۲..." />
            </div>

            <div class="field">
              <label for="service-instrument">ساز</label>
              <select id="service-instrument" name="instrument" required>
                <option value="">انتخاب کنید...</option>
                @foreach(ServiceRequest::INSTRUMENTS as $instrument)
                  <option @selected(old('instrument') === $instrument)>{{ $instrument }}</option>
                @endforeach
              </select>
            </div>

            <div class="field">
              <label for="service-type">نوع خدمات</label>
              <select id="service-type" name="service_type" required>
                <option value="">انتخاب کنید...</option>
                @foreach(ServiceRequest::SERVICE_TYPES as $type)
                  <option @selected(old('service_type') === $type)>{{ $type }}</option>
                @endforeach
              </select>
            </div>

            <div class="field field-full">
              <label for="service-description">توضیح مشکل (اختیاری)</label>
              <textarea id="service-description" name="description" rows="4"
                        placeholder="مثلاً سیم چهارم تار صدای اضافه می‌دهد و کوک نمی‌ماند...">{{ old('description') }}</textarea>
            </div>
          </div>

          @if($errors->any())
            <ul class="form-errors" role="alert">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          @endif

          <button type="submit" class="btn btn-primary btn-lg form-submit">ثبت درخواست</button>
        </form>

        <aside class="register-aside">
          <h3>چه خدماتی ارائه می‌دهیم؟</h3>
          <ul class="service-list">
            <li>تعمیر سازهای زهی، کوبه‌ای و کلاویه‌ای</li>
            <li>کوک تخصصی پیانو و سازهای ایرانی</li>
            <li>تعویض سیم و سرویس دوره‌ای</li>
            <li>مشاوره پیش از خرید ساز</li>
          </ul>

          <p class="aside-note">
            پس از ثبت درخواست، برای بررسی ساز و اعلام هزینه با شما تماس می‌گیریم.
            هزینه پیش از شروع کار به اطلاع شما می‌رسد.
          </p>

          <div class="aside-contact">
            <p>هماهنگی تلفنی:</p>
            <a class="phone-link" href="tel:+989355218250">۰۹۳۵ ۵۲۱ ۸۲۵۰</a>
            <a class="phone-link" href="tel:+982188927458">۰۲۱ ۸۸۹۲ ۷۴۵۸</a>
          </div>
        </aside>
      </div>
    </section>
  </main>
@endsection
