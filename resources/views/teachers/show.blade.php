@extends('layouts.site')
@use('App\Support\Schedule')

@section('title', $teacher->name.' — '.$teacher->instrument.' | آموزشگاه موسیقی باورستان')
@section('meta_description', $teacher->headline ?: ('معرفی و بیوگرافی '.$teacher->name.'، مدرس '.$teacher->instrument.' در آموزشگاه موسیقی باورستان.'))

@section('content')
  <main id="main">
    <section class="section shell teacher-profile">
      <a class="blog-back" href="{{ url('/') }}#classes">→ بازگشت به کلاس‌ها</a>

      <header class="teacher-hero">
        <div class="teacher-hero-photo">
          @if($teacher->photo_url)
            <img src="{{ $teacher->photo_url }}" alt="عکس {{ $teacher->name }}" width="200" height="200" />
          @else
            <span class="teacher-hero-fallback" aria-hidden="true">{{ mb_substr($teacher->name, 0, 1) }}</span>
          @endif
        </div>

        <div class="teacher-hero-info">
          <span class="teacher-hero-badge">{{ $teacher->icon }} {{ $teacher->instrument }}</span>
          <h1>{{ $teacher->name }}</h1>
          @if($teacher->headline)
            <p class="teacher-hero-headline">{{ $teacher->headline }}</p>
          @endif

          <ul class="teacher-hero-meta">
            <li>
              <span class="meta-label">روز کلاس</span>
              <span class="meta-value">{{ $teacher->day_label }} · {{ Schedule::toPersianDigits((string) $slotStart) }} تا {{ Schedule::toPersianDigits((string) $slotEnd) }}</span>
            </li>
            <li>
              <span class="meta-label">ظرفیت</span>
              <span class="meta-value {{ $freeCount ? '' : 'is-full' }}">
                @if($freeCount)
                  {{ Schedule::toPersianDigits((string) $freeCount) }} ساعت خالی
                @else
                  ظرفیت تکمیل است
                @endif
              </span>
            </li>
          </ul>

          <div class="teacher-hero-actions">
            <a class="btn btn-primary" href="{{ url('/') }}#register">ثبت‌نام در کلاس این استاد</a>
          </div>
        </div>
      </header>

      <div class="teacher-bio prose">
        @if(filled($teacher->bio))
          {!! $teacher->bio !!}
        @else
          <p class="teacher-bio-empty">به‌زودی بیوگرافی و معرفی کامل {{ $teacher->name }} در این بخش قرار می‌گیرد.</p>
        @endif
      </div>

      @if($teacher->footer_image_url)
        <figure class="teacher-footer-image">
          <img src="{{ $teacher->footer_image_url }}" alt="تصویری از {{ $teacher->name }}" loading="lazy" />
        </figure>
      @endif
    </section>
  </main>
@endsection
