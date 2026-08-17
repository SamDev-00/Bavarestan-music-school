@extends('layouts.site')

@section('title', 'وبلاگ — آموزشگاه موسیقی باورستان')
@section('meta_description', 'مطالب آموزشی، اخبار و رویدادهای آموزشگاه موسیقی باورستان.')

@section('content')
  <main id="main">
    <section class="section shell">
      <header class="section-head">
        <h2>وبلاگ باورستان</h2>
        <p>مقالات آموزشی، اخبار و رویدادهای آموزشگاه موسیقی باورستان.</p>
      </header>

      @if($posts->isEmpty())
        <div class="empty-state">
          <span class="empty-icon" aria-hidden="true">📝</span>
          <p class="empty-title">هنوز مطلبی منتشر نشده است</p>
          <p class="empty-sub">به‌زودی اولین مطالب وبلاگ در این بخش قرار می‌گیرد.</p>
        </div>
      @else
        <div class="blog-grid">
          @foreach($posts as $post)
            <article class="blog-card">
              <a class="blog-card-media" href="{{ route('blog.show', $post->slug) }}">
                @if($post->cover_image)
                  <img src="{{ asset('storage/'.$post->cover_image) }}" alt="{{ $post->title }}" loading="lazy" />
                @else
                  <span class="blog-card-placeholder" aria-hidden="true">♪</span>
                @endif
              </a>
              <div class="blog-card-body">
                @if($post->published_at)
                  <time class="blog-card-date" datetime="{{ $post->published_at->toDateString() }}">{{ $post->published_at->format('Y/m/d') }}</time>
                @endif
                <h3><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h3>
                @if($post->excerpt)
                  <p>{{ $post->excerpt }}</p>
                @endif
                <a class="blog-card-more" href="{{ route('blog.show', $post->slug) }}">ادامه مطلب ←</a>
              </div>
            </article>
          @endforeach
        </div>

        <div class="blog-pagination">
          {{ $posts->links() }}
        </div>
      @endif
    </section>
  </main>
@endsection
