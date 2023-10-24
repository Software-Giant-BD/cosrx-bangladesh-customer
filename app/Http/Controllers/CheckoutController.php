<?php

namespace App\Http\Controllers;

use App\Repositories\Interface\ICartRepository;
use App\Repositories\Interface\IProductRepository;

class CheckoutController extends Controller
{
    private $mainRepo;

    private $productRepo;

    public function __construct(ICartRepository $mainRepo, IProductRepository $productRepo)
    {
        $this->mainRepo = $mainRepo;
        $this->productRepo = $productRepo;
    }

    public function index()
    {
        $user = [
            'name' => session('name', ''),
            'email' => session('email', ''),
            'mobile' => session('mobile', ''),
            'address' => session('address', ''),
        ];
        return view('checkout.index', ['user' => $user]);
    }
}
