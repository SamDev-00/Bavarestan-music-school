<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Post;

class PageController extends Controller
{
    public function home()
    {
        $latestPosts = Post::published()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        return view('home', compact('latestPosts'));
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

    public function gallery()
    {
        $photos = Photo::orderBy('sort_order')->orderByDesc('created_at')->get();

        return view('gallery', compact('photos'));
    }
}
