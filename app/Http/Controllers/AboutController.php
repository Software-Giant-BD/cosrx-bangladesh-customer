<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use App\Models\Reward;
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
        $title = "Terms and condition";
        return view('terms-condition.index', compact('data','title'));
    }

    public function reward()
    {
        $data = Reward::first();
        $title = "You can get Rewards";
        return view('terms-condition.index', compact('data','title'));
    }

    public function guide()
    {
        $data = Guide::first();
        $title = "Follow our Guide";

        return view('terms-condition.index', compact('data','title'));
    }
}

