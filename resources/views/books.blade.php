@extends('layouts.site')

@section('title', 'کتب آموزشی — آموزشگاه موسیقی باورستان')
@section('meta_description', 'کتاب‌ها و جزوه‌های آموزشی آموزشگاه موسیقی باورستان — دانلود رایگان PDF و تهیهٔ کتب چاپی.')

@section('content')
  <main id="main">
    <section id="books" class="section shell">
      <header class="section-head">
        <h2>کتب آموزشی</h2>
        <p>کتاب‌ها و جزوه‌های آموزشی آموزشگاه باورستان. برای دریافت هر فایل روی دکمهٔ دانلود بزنید.</p>
      </header>

      @if($books->isEmpty())
        <div class="empty-state">
          <span class="empty-icon" aria-hidden="true">📚</span>
          <p class="empty-title">هنوز کتابی بارگذاری نشده است</p>
          <p class="empty-sub">به‌زودی کتاب‌ها و جزوه‌های آموزشی در این بخش قرار می‌گیرد.</p>
        </div>
      @else
        <div class="books-grid">
          @foreach($books as $book)
            <article class="book-card">
              <span class="book-icon" aria-hidden="true">PDF</span>

              <div class="book-body">
                <h3 class="book-title">{{ $book->title }}</h3>

                @if($book->author)
                  <p class="book-author">{{ $book->author }}</p>
                @endif

                @if($book->description)
                  <p class="book-desc">{{ $book->description }}</p>
                @endif

                @if($book->file_size_label)
                  <p class="book-meta">حجم فایل: {{ $book->file_size_label }}</p>
                @endif
              </div>

              <a class="btn btn-outline btn-sm book-download"
                 href="{{ route('books.download', $book) }}">
                دانلود کتاب
              </a>
            </article>
          @endforeach
        </div>
      @endif
    </section>

    <section id="buy-books" class="section section-tint">
      <div class="shell">
        <header class="section-head">
          <h2>تهیه کتب آموزشی</h2>
          <p>کتاب‌های چاپی موجود در آموزشگاه. برای سفارش و هماهنگی با ما تماس بگیرید.</p>
        </header>

        @if($saleBooks->isEmpty())
          <div class="empty-state">
            <span class="empty-icon" aria-hidden="true">🛒</span>
            <p class="empty-title">در حال حاضر کتابی برای فروش موجود نیست</p>
            <p class="empty-sub">به‌زودی فهرست کتاب‌های قابل تهیه در این بخش قرار می‌گیرد.</p>
          </div>
        @else
          <div class="sale-grid">
            @foreach($saleBooks as $saleBook)
              <article class="sale-card">
                <div class="sale-body">
                  <h3 class="sale-title">{{ $saleBook->title }}</h3>

                  @if($saleBook->author)
                    <p class="sale-author">{{ $saleBook->author }}</p>
                  @endif

                  @if($saleBook->description)
                    <p class="sale-desc">{{ $saleBook->description }}</p>
                  @endif
                </div>

                <div class="sale-foot">
                  <span class="sale-price">{{ $saleBook->price_label }}</span>
                  <a class="btn btn-primary btn-sm" href="tel:+982188927458">تماس برای تهیه</a>
                </div>
              </article>
            @endforeach
          </div>

          <p class="sale-note">
            سفارش تلفنی:
            <a class="phone-link phone-inline" href="tel:+982188927458">۰۲۱ ۸۸۹۲ ۷۴۵۸</a>
            یا
            <a class="phone-link phone-inline" href="tel:+989355218250">۰۹۳۵ ۵۲۱ ۸۲۵۰</a>
          </p>
        @endif
      </div>
    </section>
  </main>
@endsection
