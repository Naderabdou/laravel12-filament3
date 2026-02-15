<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Repositories\BlogRepository;
use App\Enums\BlogType;

class BlogsController extends Controller
{
    public function __construct(protected BlogRepository $blogRepository) {}
    public function index(int $perPage = 10)
    {
        $query = $this->blogRepository
            ->query()
            ->where('type', BlogType::BLOG);
        $blogs = $query->latest()->paginate($perPage);

        return view('site.blogs.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = $this->blogRepository->query()->where('type', BlogType::BLOG)->findOrFail($id);
        $otherBlogs = $this->blogRepository->query()->where('type', BlogType::BLOG)->where('id', '!=', $id)->latest()->take(4)->get();
        return view('site.blogs.show', compact('blog', 'otherBlogs'));
    }
}
