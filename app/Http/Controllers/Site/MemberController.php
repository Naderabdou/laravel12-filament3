<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Repositories\MemberRepository;

class MemberController extends Controller
{
    public function __construct(
        protected MemberRepository $memberRepository
    )
    {
    }
    public function index(int $perPage = 7)
    {
        $query = $this->memberRepository->query();
        $members = $query->latest()->paginate($perPage);
        return view('site.members.index', compact('members'));
    }
}
