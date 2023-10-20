<?php

namespace App\Services;

use App\Repositories\Interface\IAboutRepository;
use App\Repositories\Interface\ICategoryRepository;
use App\Repositories\Interface\IContactRepository;
use App\Repositories\Interface\ISessionRepository;

class DefaultSessionService
{
    private $catRepo;

    private $sessionRepo;

    private $cartRepo;

    private $dateService;

    private $aboutRepo;

    private $contactRepo;

    public function __construct(DateTimeService $dateService, ICategoryRepository $catRepo,
        ISessionRepository $sessionRepo, IAboutRepository $aboutRepo, IContactRepository $contactRepo)
    {
        $this->catRepo = $catRepo;
        $this->sessionRepo = $sessionRepo;
        $this->aboutRepo = $aboutRepo;
        $this->contactRepo = $contactRepo;
        $this->dateService = $dateService;
    }

    public function setAboutAndContactSession()
    {
        $about = $this->aboutRepo->first();
        if ($about) {
            session()->put('about', $about->about_mart);
        } else {
            $defaultAbout = 'The Mart Bangladesh is the online platform, one of the largest retail supermarket in Bangladesh. The Mart Bangladesh is a concern of Sojib Warehouse, a business entity that’s defining the standards in innovation and service quality in the nation';
            session()->put('about', $defaultAbout);
        }

        $contact = $this->contactRepo->first();
        $contactData['hotline'] = '01644*****';
        $contactData['email'] = 'mart@gmail.com';
        $contactData['address'] = 'Dhanmondi,Dhaka';
        $contactData['fb_page'] = 'https://www.facebook.com/';
        $contactData['instagram'] = 'https://www.instagram.com/';
        $contactData['twitter'] = 'https://twitter.com/';
        $contactData['youtube'] = 'https://www.youtube.com/';
        if ($contact) {
            $contactData['hotline'] = $contact->hotline;
            $contactData['email'] = $contact->email;
            $contactData['address'] = $contact->address;
            $contactData['fb_page'] = $contact->fb_page;
            $contactData['instagram'] = $contact->instagram;
            $contactData['twitter'] = $contact->twitter;
            $contactData['youtube'] = $contact->youtube;
        }
        session()->put('contact', $contactData);
    }

    public function isSessionUpdateAble()
    {
        // cache()->forget("default-session");
        //60*10 maybe 10 minute
        $parentCat = cache()->remember('default-session', 60 * 10, function () {
            return $this->catRepo->withChildren();
        });
        session()->put('category', $parentCat);
    }
}
