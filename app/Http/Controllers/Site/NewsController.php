<?php

namespace App\Http\Controllers\Site;

use App\Enums\BlogType;
use App\Http\Controllers\Controller;
use App\Repositories\BlogRepository;

class NewsController extends Controller
{
    public function __construct(protected BlogRepository $blogRepository)
    {

    }
    public function index()
    {
        $news = $this->blogRepository->query()->where('type', BlogType::NEWS)->latest()->get();
        return view('site.news.index', compact('news'));
    }

    public function show($id)
    {
        $news = $this->blogRepository->query()->findOrFail($id);
        $relatedNews = $this->blogRepository->query()->where('type', BlogType::NEWS)->where('id', '!=', $id)->latest()->take(3)->get();
        return view('site.news.show', compact('news', 'relatedNews'));
    }

}
