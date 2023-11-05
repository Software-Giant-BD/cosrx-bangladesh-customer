<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Repositories\Interface\IContactRepository;

class Header extends Component
{
    private $contactRepo;
    public function __construct(  IContactRepository $contactRepo)
    {
        $this->contactRepo = $contactRepo;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        
        $contactData = cache()->remember('contact-data', 60 * 10, function () 
        {
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
            return $contactData;
        });
        return view('components.header',compact("contactData"));
    }
}
