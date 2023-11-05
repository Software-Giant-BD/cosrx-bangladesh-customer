<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interface\IAboutRepository;
use App\Repositories\Interface\ITermsRepository;

class AboutController extends Controller
{
    private $mainRepo;

    private $termsRepo;

    public function __construct(IAboutRepository $mainRepo, ITermsRepository $termsRepo)
    {
        $this->mainRepo = $mainRepo;
        $this->termsRepo = $termsRepo;
    }

    public function index()
    {
        $data = $this->mainRepo->all();

        return view('about.index', compact('data'));
    }

    public function termsAndCondition()
    {
        $data = $this->termsRepo->first();

        return view('terms-condition.index', compact('data'));
    }
}

