@extends('layouts.site')

@section('title', 'گالری تصاویر — آموزشگاه موسیقی باورستان')
@section('meta_description', 'تصاویری از کلاس‌ها، اجراها و فضای آموزشگاه موسیقی باورستان.')

@section('content')
  <main id="main">
    <section class="section shell">
      <header class="section-head">
        <h2>گالری تصاویر</h2>
        <p>لحظاتی از کلاس‌ها، اجراها و فضای آموزشگاه باورستان.</p>
      </header>

      @if($photos->isEmpty())
        <div class="empty-state">
          <span class="empty-icon" aria-hidden="true">📷</span>
          <p class="empty-title">هنوز تصویری بارگذاری نشده است</p>
          <p class="empty-sub">به‌زودی تصاویر آموزشگاه در این بخش قرار می‌گیرد.</p>
        </div>
      @else
        <div class="gallery-grid">
          @foreach($photos as $photo)
            <figure class="gallery-item">
              <img src="{{ asset('storage/'.$photo->image) }}" alt="{{ $photo->title ?? 'تصویر آموزشگاه باورستان' }}" loading="lazy" />
              @if($photo->title)
                <figcaption>{{ $photo->title }}</figcaption>
              @endif
            </figure>
          @endforeach
        </div>
      @endif
    </section>
  </main>
@endsection
