<?php

namespace App\Http\Controllers\Site;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Repositories\ContactUsRepository;
use App\Http\Requests\Site\ContactUsRequest;

class ContactController extends Controller
{
    public function __construct(protected ContactUsRepository $contactUsRepository)
    {
        $this->contactUsRepository = $contactUsRepository;
    }
    public function index()
    {

        return view('site.contact.index');
    }

    public function store(ContactUsRequest $request)
    {

        $contact = $this->contactUsRepository->store($request->validated());

        $title = 'يريد العميل ' . $contact->name . ' التواصل معك' . ' بخصوص ' . $request->message . ' وهذا ايميله ' . $contact->email;

        AppHelper::sendNotifyAdmin($title, 'عرض الرساله', route('filament.admin.resources.contacts.view', $contact->id));

        return response()->json(['success' => __('تم ارسال الرسالة بنجاح وسوف يتم الرد عليك في اقرب وقت')]);
    }
}
