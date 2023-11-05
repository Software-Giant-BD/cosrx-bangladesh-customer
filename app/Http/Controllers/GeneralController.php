<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Repositories\Interface\ISubscribeRepository;

class GeneralController extends Controller
{
    private $subscriberRepo;

    public function __construct(ISubscribeRepository $subscriberRepo)
    {
        $this->subscriberRepo = $subscriberRepo;
    }

    public function subscriberStore(Request $request)
    {
        try {
            $data = $request->input();
            $update = $this->subscriberRepo->updateOrCreate($data, 'email', $data['email']);
        } catch(Exception $e) {
            return back()->with('warning', $e->getMessage())->withInput();
        }

        return back()->with('success', 'Subscribe done!');
    }
}