@extends('layouts.site')
@use('App\Support\Schedule')

@section('title', 'آموزشگاه موسیقی باورستان')

@section('content')
  <main id="main">
    <section id="hero" class="hero">
      <div class="hero-art" aria-hidden="true">
        <div class="hero-keys"></div>
        <div class="hero-glow"></div>
      </div>
      <div class="hero-content shell">
        <p class="hero-eyebrow reveal">آموزش تعهد محور</p>
        <h1 class="hero-title reveal">مسیر روشن از تمرین تا اجرا</h1>
        <p class="hero-lead reveal">
          کلاس‌های گروهی و خصوصی با مدرسان مجرب؛ از پیانو و گیتار تا آواز، ویلن، تار و تنبک — در قلب تهران.
        </p>
        <div class="hero-actions reveal">
          <a class="btn btn-primary btn-lg" href="#classes">مشاهده کلاس‌ها</a>
          <a class="btn btn-light btn-lg" href="#register">ثبت‌نام آنلاین</a>
        </div>
      </div>
    </section>

    @if($stats->isNotEmpty())
    <section class="trust shell" aria-label="نکات کلیدی">
      @foreach($stats as $stat)
      <div class="trust-item">
        <strong>{{ $stat->value }}</strong>
        <span>{{ $stat->caption }}</span>
      </div>
      @endforeach
    </section>
    @endif

    <section id="classes" class="section shell">
      <header class="section-head">
        <h2>کلاس‌ها و گروه‌های آموزشی</h2>
        <p>هر گروه با استاد مربوط و روزهای کلاس مشخص شده است. برای هر استاد می‌توانید مستقیم ثبت‌نام کنید.</p>
      </header>

      <div class="groups">
        @foreach($groups as $group)
        <article class="group">
          <div class="group-head">
            <h3>{{ $group['instrument'] }}</h3>
            <span class="group-icon" aria-hidden="true">{{ $group['icon'] }}</span>
          </div>
          <ul class="teacher-list">
            @foreach($group['teachers'] as $teacher)
            @php
              $freeCount = count($slots) - count($booked[$teacher['slug']] ?? []);
            @endphp
            <li class="teacher">
              <div class="teacher-info">
                <span class="teacher-name">{{ $teacher['name'] }}</span>
                <span class="teacher-day">{{ $teacher['day_label'] }} · {{ Schedule::toPersianDigits((string) $slotStart) }} تا {{ Schedule::toPersianDigits((string) $slotEnd) }}</span>
                <span class="teacher-free {{ $freeCount ? '' : 'is-full' }}">
                  @if($freeCount)
                    {{ Schedule::toPersianDigits((string) $freeCount) }} ساعت خالی
                  @else
                    ظرفیت تکمیل است
                  @endif
                </span>
              </div>
              <button class="btn btn-outline btn-sm register-btn" type="button"
                      data-teacher="{{ $teacher['slug'] }}" @disabled($freeCount === 0)>
                {{ $freeCount ? 'ثبت‌نام' : 'تکمیل' }}
              </button>
            </li>
            @endforeach
          </ul>
        </article>
        @endforeach
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

    <section id="music" class="section shell">
      <header class="section-head">
        <h2>موسیقی</h2>
        <p>قطعاتی از اجراهای هنرجویان و مدرسان آموزشگاه باورستان.</p>
      </header>

      @if($tracks->isEmpty())
        <div class="empty-state">
          <span class="empty-icon" aria-hidden="true">🎵</span>
          <p class="empty-title">هنوز قطعه‌ای بارگذاری نشده است</p>
          <p class="empty-sub">به‌زودی اجراهای هنرجویان و مدرسان در این بخش قرار می‌گیرد.</p>
        </div>
      @else
        <div class="tracks">
          @foreach($tracks as $track)
            <article class="track">
              <div class="track-head">
                <span class="track-icon" aria-hidden="true">♫</span>
                <div class="track-info">
                  <h3 class="track-title">{{ $track->title }}</h3>
                  @if($track->artist)
                    <p class="track-artist">{{ $track->artist }}</p>
                  @endif
                </div>
                @if($track->file_size_label)
                  <span class="track-size">{{ $track->file_size_label }}</span>
                @endif
              </div>

              @if($track->description)
                <p class="track-desc">{{ $track->description }}</p>
              @endif

              <audio class="track-player" controls preload="none"
                     src="{{ route('music.stream', $track) }}">
                مرورگر شما از پخش صدا پشتیبانی نمی‌کند.
              </audio>
            </article>
          @endforeach
        </div>
      @endif
    </section>
    <section id="register" class="section {{ $latestPosts->isNotEmpty() ? '' : 'section-tint' }}">
      <div class="shell">
        <header class="section-head">
          <h2>ثبت‌نام در کلاس‌ها</h2>
          <p>استاد و ساعت مورد نظر خود را انتخاب کنید و اطلاعات تماس را وارد کنید تا برای هماهنگی با شما تماس بگیریم.</p>
        </header>

        @if(session('register_success'))
          <p class="form-flash is-success" role="status">{{ session('register_success') }}</p>
        @endif

        @if(session('cancel_success'))
          <p class="form-flash is-info" role="status">{{ session('cancel_success') }}</p>
        @endif

        <div class="register-layout">
          <form class="register-form" id="register-form" method="POST" action="{{ route('register.store') }}">
            @csrf
            <div class="form-grid">
              <div class="field field-full">
                <label for="teacher">استاد / گروه انتخابی</label>
                <select id="teacher" name="teacher" required>
                  <option value="">انتخاب استاد...</option>
                  @foreach($groups as $group)
                  <optgroup label="{{ $group['instrument'] }}">
                    @foreach($group['teachers'] as $teacher)
                    @php
                      $isFull = count($booked[$teacher['slug']] ?? []) >= count($slots);
                    @endphp
                    <option value="{{ $teacher['slug'] }}"
                            @selected(old('teacher') === $teacher['slug'])
                            @disabled($isFull)>
                      {{ $teacher['name'] }} — {{ $teacher['day_label'] }}{{ $isFull ? ' (تکمیل)' : '' }}
                    </option>
                    @endforeach
                  </optgroup>
                  @endforeach
                </select>
              </div>

              <div class="field field-full slot-field">
                <label id="slot-label">ساعت کلاس</label>
                <p class="slot-hint" data-slot-hint>ابتدا استاد را انتخاب کنید تا ساعت‌های خالی نمایش داده شود.</p>

                @foreach($teachers as $slug => $teacher)
                <div class="slot-group" data-slot-group="{{ $slug }}" hidden>
                  <p class="slot-day">
                    کلاس‌های {{ $teacher['day_label'] }} — هر جلسه ۳۰ دقیقه
                  </p>
                  <div class="slot-options" role="radiogroup" aria-labelledby="slot-label">
                    @foreach($slots as $slot)
                    @php
                      $isTaken = in_array($slot, $booked[$slug] ?? [], true);
                    @endphp
                    <label class="slot{{ $isTaken ? ' is-taken' : '' }}">
                      <input type="radio" name="slot" value="{{ $slot }}"
                             @disabled($isTaken)
                             @checked(old('teacher') === $slug && old('slot') === $slot) />
                      <span>{{ Schedule::toPersianDigits($slot) }}</span>
                    </label>
                    @endforeach
                  </div>
                  <p class="slot-legend">ساعت‌های کم‌رنگ قبلاً رزرو شده‌اند.</p>
                </div>
                @endforeach
              </div>

              <div class="field">
                <label for="name">نام و نام خانوادگی</label>
                <input id="name" name="name" type="text" autocomplete="name" required value="{{ old('name') }}" placeholder="مثلاً علی محمدی" />
              </div>
              <div class="field">
                <label for="phone">شماره تماس</label>
                <input id="phone" name="phone" type="tel" autocomplete="tel" required value="{{ old('phone') }}" placeholder="۰۹۱۲..." inputmode="tel" />
              </div>
              <div class="field">
                <label for="national-id">شماره ملی</label>
                <input id="national-id" name="national_id" type="text" inputmode="numeric" maxlength="10" required value="{{ old('national_id') }}" placeholder="۱۰ رقم، بدون خط تیره" />
              </div>
              <div class="field">
                <label for="education">سطح تحصیلات</label>
                <select id="education" name="education">
                  <option value="">انتخاب کنید...</option>
                  @foreach(['زیر دیپلم', 'دیپلم', 'کاردانی', 'کارشناسی', 'کارشناسی ارشد', 'دکتری'] as $option)
                    <option @selected(old('education') === $option)>{{ $option }}</option>
                  @endforeach
                </select>
              </div>
              <div class="field">
                <label for="level">سطح تقریبی</label>
                <select id="level" name="level">
                  @foreach(['مبتدی (از صفر)', 'متوسط', 'پیشرفته'] as $option)
                    <option @selected(old('level') === $option)>{{ $option }}</option>
                  @endforeach
                </select>
              </div>
              <div class="field">
                <label for="mode">نوع کلاس</label>
                <select id="mode" name="mode">
                  @foreach(['خصوصی', 'گروهی', 'فرقی ندارد'] as $option)
                    <option @selected(old('mode') === $option)>{{ $option }}</option>
                  @endforeach
                </select>
              </div>
              <div class="field">
                <label for="referral-source">از چه طریق با ما آشنا شدید؟</label>
                <select id="referral-source" name="referral_source">
                  <option value="">انتخاب کنید...</option>
                  @foreach(['اینستاگرام', 'جست‌وجو در گوگل', 'معرفی دوستان و آشنایان', 'عبور از مقابل آموزشگاه', 'بنر و تبلیغات محیطی', 'سایر'] as $option)
                    <option @selected(old('referral_source') === $option)>{{ $option }}</option>
                  @endforeach
                </select>
              </div>
              <div class="field">
                <label for="referrer">معرف</label>
                <input id="referrer" name="referrer" type="text" value="{{ old('referrer') }}" placeholder="نام معرف (اختیاری)" />
              </div>
              <div class="field field-full">
                <label for="message">توضیحات (اختیاری)</label>
                <textarea id="message" name="message" rows="3" placeholder="مثلاً ترجیح می‌دهم آخر هفته‌ها کلاس داشته باشم...">{{ old('message') }}</textarea>
              </div>
            </div>

            @if($errors->register->any())
              <ul class="form-errors" role="alert">
                @foreach($errors->register->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            @endif

            <button type="submit" class="btn btn-primary btn-lg form-submit">ارسال درخواست ثبت‌نام</button>
            <p class="form-status" id="form-status" role="status" aria-live="polite"></p>
          </form>

          <aside class="register-aside">
            <h3>راهنمای ثبت‌نام</h3>
            <ol class="steps">
              <li>روی «ثبت‌نام» استاد مورد نظر بزنید تا این‌جا انتخاب شود.</li>
              <li>یکی از ساعت‌های خالی را انتخاب کنید.</li>
              <li>نام، شماره تماس و شماره ملی خود را وارد کنید.</li>
              <li>ما برای هماهنگی نهایی با شما تماس می‌گیریم.</li>
            </ol>
            <p class="aside-note">
              هر شماره ملی برای هر استاد فقط یک بار قابل ثبت است.
              برای تغییر ساعت، ابتدا <a href="#manage">رزرو قبلی را لغو کنید</a>.
            </p>
            <div class="aside-contact">
              <p>ثبت‌نام تلفنی:</p>
              <a class="phone-link" href="tel:+989355218250">۰۹۳۵ ۵۲۱ ۸۲۵۰</a>
              <a class="phone-link" href="tel:+982188927458">۰۲۱ ۸۸۹۲ ۷۴۵۸</a>
            </div>
          </aside>
        </div>
      </div>
    </section>

    <section id="manage" class="section shell">
      <header class="section-head">
        <h2>لغو یا تغییر رزرو</h2>
        <p>شماره ملی و شماره تماسی که با آن ثبت‌نام کرده‌اید را وارد کنید. ساعتی که لغو شود بلافاصله برای دیگران آزاد می‌شود و می‌توانید دوباره ثبت‌نام کنید.</p>
      </header>

      <div class="manage-layout">
        <form class="register-form manage-form" method="POST" action="{{ route('register.manage') }}">
          @csrf
          <div class="form-grid">
            <div class="field">
              <label for="manage-national-id">شماره ملی</label>
              <input id="manage-national-id" name="national_id" type="text" inputmode="numeric" maxlength="10" required placeholder="۱۰ رقم، بدون خط تیره" />
            </div>
            <div class="field">
              <label for="manage-phone">شماره تماس</label>
              <input id="manage-phone" name="phone" type="tel" required placeholder="۰۹۱۲..." inputmode="tel" />
            </div>
          </div>

          @if($errors->manage->any())
            <ul class="form-errors" role="alert">
              @foreach($errors->manage->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          @endif

          <button type="submit" class="btn btn-primary form-submit">مشاهده رزرو من</button>
        </form>

        @if(session('manage_results'))
        <div class="manage-results">
          <h3>رزروهای شما</h3>
          @foreach(session('manage_results') as $result)
          <div class="manage-card">
            <div class="manage-card-info">
              <span class="manage-card-teacher">{{ $result['teacher_name'] }}</span>
              <span class="manage-card-instrument">{{ $result['instrument'] }}</span>
              <span class="manage-card-time">{{ $result['schedule_label'] }}</span>
            </div>
            <form method="POST" action="{{ route('register.cancel') }}"
                  onsubmit="return confirm('این رزرو لغو شود؟ پس از لغو، ساعت برای دیگران آزاد می‌شود.');">
              @csrf
              <input type="hidden" name="registration" value="{{ $result['id'] }}" />
              <input type="hidden" name="national_id" value="{{ session('manage_national_id') }}" />
              <input type="hidden" name="phone" value="{{ session('manage_phone') }}" />
              <button type="submit" class="btn btn-outline btn-sm is-danger">لغو رزرو</button>
            </form>
          </div>
          @endforeach
        </div>
        @endif
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
          <p>تهران، کریمخان، نجات‌اللهی، خیابان اراک، پلاک ۶۴، واحد ۵</p>
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
          <p>تهران، کریمخان، نجات‌اللهی، خیابان اراک، پلاک ۶۴، واحد ۵</p>
        </div>
        <div class="contact-card">
          <span class="contact-icon" aria-hidden="true">⏰</span>
          <h3>ساعات پاسخگویی</h3>
          <p>همه‌روزه، ۱۰ تا ۲۰</p>
        </div>
        <div class="contact-card">
          <span class="contact-icon" aria-hidden="true">💬</span>
          <h3>کانال بله</h3>
          <p>اخبار، اطلاعیه‌ها و نمونه اجراها را در بله دنبال کنید.</p>
          <a class="btn btn-primary btn-sm" href="https://ble.ir/bavarestan_honar"
             target="_blank" rel="noopener">عضویت در کانال بله</a>
        </div>
      </div>
    </section>
  </main>
@endsection
