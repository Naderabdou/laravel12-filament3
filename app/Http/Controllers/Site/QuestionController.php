<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Repositories\QuestionRepository;

class QuestionController extends Controller
{
    public function __construct(protected QuestionRepository $questionRepository) {}

    public function index()
    {
        $section1Faqs = $this->questionRepository->query()->latest()->take(4)->get();
        $section2Faqs = $this->questionRepository->query()->latest()->skip(4)->take(4)->get();
        return view('site.questions.index', compact('section1Faqs', 'section2Faqs'));
    }

}
