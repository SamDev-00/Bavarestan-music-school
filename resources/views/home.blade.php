@extends('layouts.site')

@section('title', 'آموزشگاه موسیقی باورستان')

@section('content')
  <main id="main">
    <section id="hero" class="hero">
      <div class="hero-art" aria-hidden="true">
        <div class="hero-keys"></div>
        <div class="hero-glow"></div>
      </div>
      <div class="hero-content shell">
        <h1 class="hero-title reveal">مسیر روشن از تمرین تا اجرا</h1>
        <p class="hero-lead reveal">
          کلاس‌های گروهی و خصوصی با اساتید مجرب؛ از پیانو و گیتار تا آواز، ویلن، تار و تنبک — در قلب تهران.
        </p>
        <div class="hero-actions reveal">
          <a class="btn btn-primary btn-lg" href="#classes">مشاهده کلاس‌ها</a>
          <a class="btn btn-light btn-lg" href="#register">ثبت‌نام آنلاین</a>
        </div>
      </div>
    </section>

    <section class="trust shell" aria-label="نکات کلیدی">
      <div class="trust-item">
        <strong>۸ گروه</strong>
        <span>ساز و رشته آموزشی</span>
      </div>
      <div class="trust-item">
        <strong>۹ استاد</strong>
        <span>مدرسین حرفه‌ای</span>
      </div>
      <div class="trust-item">
        <strong>گروهی و خصوصی</strong>
        <span>مناسب هر سطح</span>
      </div>
      <div class="trust-item">
        <strong>تهران مرکز</strong>
        <span>کریمخان، خیابان اراک</span>
      </div>
    </section>

    <section id="classes" class="section shell">
      <header class="section-head">
        <h2>کلاس‌ها و گروه‌های آموزشی</h2>
        <p>هر گروه با استاد مربوط و روزهای کلاس مشخص شده است. برای هر استاد می‌توانید مستقیم ثبت‌نام کنید.</p>
      </header>

      <div class="groups">
        <article class="group">
          <div class="group-head">
            <h3>پیانو</h3>
            <span class="group-icon" aria-hidden="true">♪</span>
          </div>
          <ul class="teacher-list">
            <li class="teacher">
              <div class="teacher-info">
                <span class="teacher-name">الهام جمالی‌پویا</span>
                <span class="teacher-day">دوشنبه‌ها</span>
              </div>
              <button class="btn btn-outline btn-sm register-btn" type="button" data-teacher="piano-jamalipouya">ثبت‌نام</button>
            </li>
            <li class="teacher">
              <div class="teacher-info">
                <span class="teacher-name">مریم صارمی</span>
                <span class="teacher-day">یکشنبه‌ها</span>
              </div>
              <button class="btn btn-outline btn-sm register-btn" type="button" data-teacher="piano-saremi">ثبت‌نام</button>
            </li>
          </ul>
        </article>

        <article class="group">
          <div class="group-head">
            <h3>گیتار</h3>
            <span class="group-icon" aria-hidden="true">♬</span>
          </div>
          <ul class="teacher-list">
            <li class="teacher">
              <div class="teacher-info">
                <span class="teacher-name">مهرزاد اسکندری</span>
                <span class="teacher-day">یکشنبه‌ها</span>
              </div>
              <button class="btn btn-outline btn-sm register-btn" type="button" data-teacher="guitar-eskandari">ثبت‌نام</button>
            </li>
            <li class="teacher">
              <div class="teacher-info">
                <span class="teacher-name">آرزو حسینی</span>
                <span class="teacher-day">چهارشنبه‌ها</span>
              </div>
              <button class="btn btn-outline btn-sm register-btn" type="button" data-teacher="guitar-hosseini">ثبت‌نام</button>
            </li>
          </ul>
        </article>

        <article class="group">
          <div class="group-head">
            <h3>گیتار الکتریک</h3>
            <span class="group-icon" aria-hidden="true">⚡</span>
          </div>
          <ul class="teacher-list">
            <li class="teacher">
              <div class="teacher-info">
                <span class="teacher-name">میثم طاهری</span>
                <span class="teacher-day">دوشنبه‌ها</span>
              </div>
              <button class="btn btn-outline btn-sm register-btn" type="button" data-teacher="eguitar-taheri">ثبت‌نام</button>
            </li>
          </ul>
        </article>

        <article class="group">
          <div class="group-head">
            <h3>آواز و صداسازی</h3>
            <span class="group-icon" aria-hidden="true">🎤</span>
          </div>
          <ul class="teacher-list">
            <li class="teacher">
              <div class="teacher-info">
                <span class="teacher-name">امیر اکبری</span>
                <span class="teacher-day">چهارشنبه‌ها</span>
              </div>
              <button class="btn btn-outline btn-sm register-btn" type="button" data-teacher="vocal-akbari">ثبت‌نام</button>
            </li>
          </ul>
        </article>

        <article class="group">
          <div class="group-head">
            <h3>ویلن</h3>
            <span class="group-icon" aria-hidden="true">🎻</span>
          </div>
          <ul class="teacher-list">
            <li class="teacher">
              <div class="teacher-info">
                <span class="teacher-name">نرگس خجسته</span>
                <span class="teacher-day">سه‌شنبه‌ها</span>
              </div>
              <button class="btn btn-outline btn-sm register-btn" type="button" data-teacher="violin-khojasteh">ثبت‌نام</button>
            </li>
          </ul>
        </article>

        <article class="group">
          <div class="group-head">
            <h3>تار</h3>
            <span class="group-icon" aria-hidden="true">♩</span>
          </div>
          <ul class="teacher-list">
            <li class="teacher">
              <div class="teacher-info">
                <span class="teacher-name">امین اکبرپور</span>
                <span class="teacher-day">چهارشنبه‌ها</span>
              </div>
              <button class="btn btn-outline btn-sm register-btn" type="button" data-teacher="tar-akbarpour">ثبت‌نام</button>
            </li>
          </ul>
        </article>

        <article class="group">
          <div class="group-head">
            <h3>تنبک</h3>
            <span class="group-icon" aria-hidden="true">🥁</span>
          </div>
          <ul class="teacher-list">
            <li class="teacher">
              <div class="teacher-info">
                <span class="teacher-name">محمدحسین میراج</span>
                <span class="teacher-day">یکشنبه‌ها</span>
              </div>
              <button class="btn btn-outline btn-sm register-btn" type="button" data-teacher="tonbak-miraj">ثبت‌نام</button>
            </li>
          </ul>
        </article>
      </div>
    </section>

    @if($latestPosts->isNotEmpty())
    <section id="blog" class="section section-tint">
      <div class="shell">
        <header class="section-head">
          <h2>تازه‌ترین مطالب وبلاگ</h2>
          <p>اخبار، مقالات آموزشی و رویدادهای آموزشگاه باورستان.</p>
        </header>
        <div class="blog-grid">
          @foreach($latestPosts as $post)
            <article class="blog-card">
              <a class="blog-card-media" href="{{ route('blog.show', $post->slug) }}">
                @if($post->cover_image)
                  <img src="{{ asset('storage/'.$post->cover_image) }}" alt="{{ $post->title }}" loading="lazy" />
                @else
                  <span class="blog-card-placeholder" aria-hidden="true">♪</span>
                @endif
              </a>
              <div class="blog-card-body">
                <h3><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h3>
                @if($post->excerpt)
                  <p>{{ $post->excerpt }}</p>
                @endif
                <a class="blog-card-more" href="{{ route('blog.show', $post->slug) }}">ادامه مطلب ←</a>
              </div>
            </article>
          @endforeach
        </div>
        <div style="margin-top:1.5rem">
          <a class="btn btn-ghost" href="{{ route('blog.index') }}">مشاهده همه مطالب</a>
        </div>
      </div>
    </section>
    @endif

    <section id="register" class="section {{ $latestPosts->isNotEmpty() ? '' : 'section-tint' }}">
      <div class="shell">
        <header class="section-head">
          <h2>ثبت‌نام در کلاس‌ها</h2>
          <p>استاد و گروه مورد نظر خود را انتخاب کنید و اطلاعات تماس را وارد کنید تا برای هماهنگی با شما تماس بگیریم.</p>
        </header>

        <div class="register-layout">
          <form class="register-form" id="register-form" novalidate>
            <div class="form-grid">
              <div class="field field-full">
                <label for="teacher">استاد / گروه انتخابی</label>
                <select id="teacher" name="teacher" required>
                  <option value="">انتخاب استاد...</option>
                  <optgroup label="پیانو">
                    <option value="piano-jamalipouya">الهام جمالی‌پویا — دوشنبه‌ها</option>
                    <option value="piano-saremi">مریم صارمی — یکشنبه‌ها</option>
                  </optgroup>
                  <optgroup label="گیتار">
                    <option value="guitar-eskandari">مهرزاد اسکندری — یکشنبه‌ها</option>
                    <option value="guitar-hosseini">آرزو حسینی — چهارشنبه‌ها</option>
                  </optgroup>
                  <optgroup label="گیتار الکتریک">
                    <option value="eguitar-taheri">میثم طاهری — دوشنبه‌ها</option>
                  </optgroup>
                  <optgroup label="آواز و صداسازی">
                    <option value="vocal-akbari">امیر اکبری — چهارشنبه‌ها</option>
                  </optgroup>
                  <optgroup label="ویلن">
                    <option value="violin-khojasteh">نرگس خجسته — سه‌شنبه‌ها</option>
                  </optgroup>
                  <optgroup label="تار">
                    <option value="tar-akbarpour">امین اکبرپور — چهارشنبه‌ها</option>
                  </optgroup>
                  <optgroup label="تنبک">
                    <option value="tonbak-miraj">محمدحسین میراج — یکشنبه‌ها</option>
                  </optgroup>
                </select>
              </div>
              <div class="field">
                <label for="name">نام و نام خانوادگی</label>
                <input id="name" name="name" type="text" autocomplete="name" required placeholder="مثلاً علی محمدی" />
              </div>
              <div class="field">
                <label for="phone">شماره تماس</label>
                <input id="phone" name="phone" type="tel" autocomplete="tel" required placeholder="۰۹۱۲..." inputmode="tel" />
              </div>
              <div class="field">
                <label for="level">سطح تقریبی</label>
                <select id="level" name="level">
                  <option>مبتدی (از صفر)</option>
                  <option>متوسط</option>
                  <option>پیشرفته</option>
                </select>
              </div>
              <div class="field">
                <label for="mode">نوع کلاس</label>
                <select id="mode" name="mode">
                  <option>خصوصی</option>
                  <option>گروهی</option>
                  <option>فرقی ندارد</option>
                </select>
              </div>
              <div class="field field-full">
                <label for="message">توضیحات (اختیاری)</label>
                <textarea id="message" name="message" rows="3" placeholder="مثلاً ترجیح می‌دهم آخر هفته‌ها کلاس داشته باشم..."></textarea>
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg form-submit">ارسال درخواست ثبت‌نام</button>
            <p class="form-status" id="form-status" role="status" aria-live="polite"></p>
          </form>

          <aside class="register-aside">
            <h3>راهنمای ثبت‌نام</h3>
            <ol class="steps">
              <li>روی «ثبت‌نام» استاد مورد نظر بزنید تا این‌جا انتخاب شود.</li>
              <li>نام و شماره تماس خود را وارد کنید.</li>
              <li>ما برای هماهنگی روز و ساعت با شما تماس می‌گیریم.</li>
            </ol>
            <div class="aside-contact">
              <p>ثبت‌نام تلفنی:</p>
              <a class="phone-link" href="tel:+989355218250">۰۹۳۵ ۵۲۱ ۸۲۵۰</a>
              <a class="phone-link" href="tel:+982188927458">۰۲۱ ۸۸۹۲ ۷۴۵۸</a>
            </div>
          </aside>
        </div>
      </div>
    </section>

    <section id="packages" class="section shell">
      <header class="section-head">
        <h2>پکیج‌ها و فروشگاه</h2>
        <p>پکیج‌های آموزشی و سایر محصولات به‌زودی در این بخش ارائه می‌شوند.</p>
      </header>
      <div class="empty-state">
        <span class="empty-icon" aria-hidden="true">🛍️</span>
        <p class="empty-title">فعلاً موردی برای فروش در دسترس نیست</p>
        <p class="empty-sub">به‌محض آماده شدن پکیج‌ها، همین‌جا اطلاع‌رسانی می‌شود.</p>
      </div>
    </section>

    <section id="location" class="section section-tint">
      <div class="shell">
        <header class="section-head">
          <h2>موقعیت آموزشگاه</h2>
          <p>تهران، کریمخان، نجات‌اللهی، خیابان اراک، پلاک ۶۴</p>
        </header>
        <div class="location-layout">
          <div class="map-frame">
            <iframe
              title="نقشه موقعیت آموزشگاه باورستان"
              src="https://www.openstreetmap.org/export/embed.html?bbox=51.4131910%2C35.7055845%2C51.4191910%2C35.7115845&layer=mapnik&marker=35.7085845%2C51.4161910"
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
          <aside class="location-aside">
            <h3>دسترسی</h3>
            <p>محدوده کریمخان و خیابان نجات‌اللهی؛ نزدیک ایستگاه‌های حمل‌ونقل عمومی.</p>
            <a class="btn btn-primary" href="https://neshan.org/maps/share/35.7085845126421,51.41619097441435" target="_blank" rel="noopener">مشاهده در نشان</a>
            <a class="btn btn-ghost" href="https://www.google.com/maps/search/?api=1&query=35.7085845,51.41619097" target="_blank" rel="noopener">مسیریابی گوگل</a>
          </aside>
        </div>
      </div>
    </section>

    <section id="contact" class="section shell">
      <header class="section-head">
        <h2>تماس با ما</h2>
        <p>برای مشاوره و هماهنگی کلاس‌ها با ما در ارتباط باشید.</p>
      </header>
      <div class="contact-grid">
        <div class="contact-card">
          <span class="contact-icon" aria-hidden="true">📞</span>
          <h3>تلفن</h3>
          <a class="phone-link" href="tel:+989355218250">۰۹۳۵ ۵۲۱ ۸۲۵۰</a>
          <a class="phone-link" href="tel:+982188927458">۰۲۱ ۸۸۹۲ ۷۴۵۸</a>
        </div>
        <div class="contact-card">
          <span class="contact-icon" aria-hidden="true">📍</span>
          <h3>آدرس</h3>
          <p>تهران، کریمخان، نجات‌اللهی، خیابان اراک، پلاک ۶۴</p>
        </div>
        <div class="contact-card">
          <span class="contact-icon" aria-hidden="true">⏰</span>
          <h3>ساعات پاسخگویی</h3>
          <p>همه‌روزه، ۱۰ تا ۲۰</p>
        </div>
      </div>
    </section>
  </main>
@endsection
