@extends('layouts.site')

@section('title', $post->title.' — وبلاگ باورستان')
@section('meta_description', $post->excerpt ?: 'مطلبی از وبلاگ آموزشگاه موسیقی باورستان.')

@section('content')
  <main id="main">
    <article class="section shell blog-post">
      <a class="blog-back" href="{{ route('blog.index') }}">→ بازگشت به وبلاگ</a>

      <header class="blog-post-head">
        <h1>{{ $post->title }}</h1>
        @if($post->published_at)
          <time class="blog-card-date" datetime="{{ $post->published_at->toDateString() }}">{{ \App\Support\Jalali::numeric($post->published_at) }}</time>
        @endif
      </header>

      <img class="blog-post-cover{{ $post->cover_image ? '' : ' is-default' }}" src="{{ $post->cover_url }}" alt="{{ $post->title }}" />

      <div class="blog-post-body prose">
        {!! $post->body !!}
      </div>
    </article>
  </main>
@endsection
