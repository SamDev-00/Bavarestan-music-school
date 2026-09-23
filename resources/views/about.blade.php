@extends('layouts.site')

@section('title', 'درباره ما — آموزشگاه موسیقی باورستان')
@section('meta_description', 'آموزشگاه موسیقی باورستان با مدیریت امیرمحمد رضایی و مجوز رسمی وزارت ارشاد در قلب تهران؛ تلفیق آموزش موسیقی با دانش روانشناسی برای رشد فردی هنرجویان.')

@section('content')
  <main id="main">
    <section class="section shell">
      <header class="section-head">
        <p class="hero-eyebrow">آموزشگاه موسیقی باورستان</p>
        <h2>درباره باورستان</h2>
        <p>موسیقی را تنها یک مهارت نمی‌دانیم؛ بلکه زبانی برای بیان احساسات و مسیری برای رشد فردی می‌شناسیم.</p>
      </header>

      <div class="about-layout">
        <div class="prose about-intro">
          <p>
            آموزشگاه موسیقی باورستان، با مدیریت <strong>امیرمحمد رضایی</strong> و مجوز رسمی
            <strong>وزارت ارشاد</strong>، در قلب تهران فعالیت می‌کند. ما موسیقی را تنها یک مهارت
            نمی‌دانیم؛ بلکه زبانی برای بیان احساسات و مسیری برای رشد فردی می‌شناسیم.
          </p>
          <p>
            در باورستان، آموزش موسیقی با دانش روانشناسی تلفیق شده تا هر هنرجو در فضایی آرام و پویا،
            ساز و آواز بیاموزد و باور درونی خود را کشف کند. از سازهای ایرانی و کلاسیک تا آواز، فن بیان،
            موسیقی کودک و کلاس‌های تلفیقی روانشناسی هنر، همه با نگاهی نو و تعهدی عمیق به رشد هنرجو
            طراحی شده‌اند.
          </p>
        </div>

        <aside class="about-aside">
          <ul class="about-facts">
            <li>
              <span class="about-fact-icon" aria-hidden="true">🎓</span>
              <span class="about-fact-text"><strong>مدیریت</strong>امیرمحمد رضایی</span>
            </li>
            <li>
              <span class="about-fact-icon" aria-hidden="true">📜</span>
              <span class="about-fact-text"><strong>مجوز رسمی</strong>وزارت فرهنگ و ارشاد اسلامی</span>
            </li>
            <li>
              <span class="about-fact-icon" aria-hidden="true">📍</span>
              <span class="about-fact-text"><strong>موقعیت</strong>قلب تهران — کریمخان</span>
            </li>
          </ul>
        </aside>
      </div>

      <div class="about-values">
        <div class="contact-card">
          <span class="contact-icon" aria-hidden="true">🧠</span>
          <h3>تلفیق با روانشناسی</h3>
          <p>آموزش موسیقی همراه با دانش روانشناسی، برای رشد فردی و کشف باور درونی هنرجو.</p>
        </div>
        <div class="contact-card">
          <span class="contact-icon" aria-hidden="true">🎻</span>
          <h3>سازهای ایرانی و کلاسیک</h3>
          <p>از سازهای اصیل ایرانی تا سازهای کلاسیک، با مدرسان مجرب و دلسوز.</p>
        </div>
        <div class="contact-card">
          <span class="contact-icon" aria-hidden="true">🎤</span>
          <h3>آواز و فن بیان</h3>
          <p>کلاس‌های تخصصی آواز و فن بیان برای بیان درست و رسای احساس.</p>
        </div>
        <div class="contact-card">
          <span class="contact-icon" aria-hidden="true">🧒</span>
          <h3>موسیقی کودک</h3>
          <p>فضایی آرام و پویا برای آشنایی کودکان با دنیای موسیقی و خلاقیت.</p>
        </div>
      </div>

      <blockquote class="about-quote">
        باورستان؛ جایی که نواها از دلِ باور برمی‌خیزند و به آسمانِ امید می‌رسند.
      </blockquote>

      <div class="about-cta">
        <a class="btn btn-primary btn-lg" href="{{ url('/') }}#register">ثبت‌نام در کلاس‌ها</a>
        <a class="btn btn-ghost btn-lg" href="{{ url('/') }}#classes">مشاهده کلاس‌ها</a>
      </div>
    </section>
  </main>
@endsection
