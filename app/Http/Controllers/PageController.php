<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Photo;
use App\Models\Post;
use App\Models\SaleBook;
use App\Models\SiteStat;
use App\Models\Teacher;
use App\Models\Track;
use App\Support\Schedule;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PageController extends Controller
{
    public function home()
    {
        $latestPosts = Post::published()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        return view('home', [
            'latestPosts' => $latestPosts,
            'groups' => Schedule::groups(),
            'teachers' => Schedule::teachers(),
            'slots' => Schedule::slots(),
            'booked' => Schedule::bookedSlots(),
            'slotStart' => config('school.slots.start'),
            'slotEnd' => config('school.slots.end'),
            'tracks' => Track::published()->orderBy('sort_order')->orderByDesc('created_at')->get(),
            'stats' => SiteStat::visible()->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function about()
    {
        return view('about');
    }

    public function teacherShow(Teacher $teacher)
    {
        // استاد غیرفعال فقط برای کاربر واردشده به پنل قابل مشاهده است.
        abort_unless($teacher->is_active || auth()->check(), 404);

        return view('teachers.show', [
            'teacher' => $teacher,
            'freeCount' => count(Schedule::slots())
                - count(Schedule::bookedSlots()[$teacher->slug] ?? []),
            'slotStart' => config('school.slots.start'),
            'slotEnd' => config('school.slots.end'),
        ]);
    }

    public function blogIndex()
    {
        $posts = Post::published()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(9);

        return view('blog.index', compact('posts'));
    }

    public function blogShow(string $slug)
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();

        return view('blog.show', compact('post'));
    }

    public function books()
    {
        $books = Book::published()
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        $saleBooks = SaleBook::available()
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        return view('books', compact('books', 'saleBooks'));
    }

    /**
     * فایل PDF از طریق PHP ارائه می‌شود، نه لینک مستقیم — این‌طور
     * نیازی به symlink بودن پوشهٔ storage روی هاست نیست.
     */
    public function downloadBook(Book $book): StreamedResponse
    {
        // کتاب منتشرنشده فقط برای کاربر واردشده به پنل قابل دریافت است.
        abort_unless($book->is_published || auth()->check(), 404);
        abort_unless(Storage::disk('public')->exists($book->file), 404);

        return Storage::disk('public')->download($book->file, $book->download_name);
    }

    /**
     * پخش فایل صوتی به صورت inline. از response()->file استفاده می‌شود چون
     * BinaryFileResponse هدر Range را پشتیبانی می‌کند و جلو/عقب بردن آهنگ کار می‌کند.
     */
    public function streamTrack(Track $track): BinaryFileResponse
    {
        abort_unless($track->is_published || auth()->check(), 404);

        $path = Storage::disk('public')->path($track->file);

        abort_unless(is_file($path), 404);

        $mimes = [
            'mp3' => 'audio/mpeg',
            'm4a' => 'audio/mp4',
            'wav' => 'audio/wav',
            'ogg' => 'audio/ogg',
        ];

        $extension = strtolower(pathinfo($track->file, PATHINFO_EXTENSION));

        return response()->file($path, [
            'Content-Type' => $mimes[$extension] ?? 'application/octet-stream',
            'Accept-Ranges' => 'bytes',
        ]);
    }

    public function gallery()
    {
        $photos = Photo::orderBy('sort_order')->orderByDesc('created_at')->get();

        return view('gallery', compact('photos'));
    }
}
