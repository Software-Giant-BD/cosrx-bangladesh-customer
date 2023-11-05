<?php

namespace App\Http\Controllers;

use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interface\ICartRepository;
use App\Repositories\Interface\IWishRepository;
use App\Repositories\Interface\IInvoiceRepository;
use App\Repositories\Interface\ICustomerRepository;

class AccountController extends Controller
{
    private $mainRepo;

    private $cartRepo;

    private $wishRepo;

    private $smsService;
    private $invoiceRepo;

    public function __construct(ICustomerRepository $mainRepo, ICartRepository $cartRepo,
        IWishRepository $wishRepo, SmsService $smsService,IInvoiceRepository $invoiceRepo)
    {
        $this->mainRepo = $mainRepo;
        $this->cartRepo = $cartRepo;
        $this->wishRepo = $wishRepo;
        $this->smsService = $smsService;
        $this->invoiceRepo = $invoiceRepo;

    }

    public function index()
    {
        session()->put('active','dashboard');
        $data['my_order'] = $this->invoiceRepo->myOrders(session('id'));
        return view('account.profile.personal-info', compact('data'));
    }

    public function changePasswordUpdate(Request $request)
    {
        try {
            $customer = $this->mainRepo->customerByMobile(session('mobile'));
            if (! $customer || ! Hash::check($request->current_password, $customer->password)) {
                throw new \Exception('Current password is incorrect!');
            }
            if (strlen($request->new_password) < 6) {
                throw new \Exception('Pasword minimum 6 character!');
            }

            $data['password'] = Hash::make($request->new_password, [
                'memory' => 1024,
                'time' => 2,
                'threads' => 2,
            ]);
            $update = $this->mainRepo->update($data, session('id'));
        } catch (\Exception $e) {
            Log::alert($e->getMessage());

            return back()->withInput()->with('warning', $e->getMessage());
        }
        session()->put('active','account');
        return back()->with('success', 'Password update successfully done!');
    }

    public function update(Request $request)
    {
        try {
            if (empty($request->name) || empty($request->mobile)) {
                throw new \Exception("Name or mobile can't be empty!");
            }

            if ($this->mainRepo->customerByMobile($request->mobile) && session('mobile') != $request->mobile) {
                throw new \Exception('Customer Exist with this number!');
            }

            $data = $request->input();
            $data['status'] = 'Active';

            $update = $this->mainRepo->update($data, session('id'));
            session()->put('login', 'True');
            session()->put('id', $update->id);
            session()->put('mobile', $update->mobile);
            session()->put('email', $update->email);
            session()->put('name', $update->name);
            session()->put('address', $update->address);
            session()->put('gender', $update->gender);

            $this->setCartNWishSession($update->id);
        } catch (\Exception $e) {
            Log::alert($e->getMessage());

            return back()->withInput()->with('warning', $e->getMessage());
        }
        session()->put('active','account');
        return back()->with('success', 'Update successfully done!');
    }

    public function registration(Request $request)
    {
        try {
            if (strlen($request->password) < 6) {
                throw new \Exception('Password minimum 6 character!');
            }
            if (empty($request->name) || empty($request->mobile)) {
                throw new \Exception("Name or mobile can't be empty!");
            }

            if (strlen($request->password) != 11) {
                throw new \Exception('Mobile should be 11 digit');
            }

            if ($this->mainRepo->customerByMobile($request->mobile)) {
                throw new \Exception('Customer Exist with this number!');
            }

            $data = $request->input();
            $data['status'] = 'Active';
            $data['customerType'] = 'Online';

            $data['password'] = Hash::make($request->password, [
                'memory' => 1024,
                'time' => 2,
                'threads' => 2,
            ]);

            $store = $this->mainRepo->store($data);
            session()->put('login', 'True');
            session()->put('id', $store->id);
            session()->put('mobile', $store->mobile);
            session()->put('email', $store->email);
            session()->put('name', $store->name);
            session()->put('address', $store->address);
            session()->put('gender', $store->gender);

            $this->setCartNWishSession($store->id);
        } catch (\Exception $e) {
            Log::alert($e->getMessage());

            return back()->withInput()->with('warning', $e->getMessage());
        }

        return redirect(route('home'));
    }

    public function loginRegCreate()
    {
        return view('account.login-reg');
    }

    public function setCartNWishSession($customer_id)
    {
        $data = $this->cartRepo->getUserCart($customer_id);
        if ($data) {
            $cart = session('cart');
            foreach ($data as $item) {
                if (! isset($cart[$item->product_id])) {
                    $cart[$item->product_id]['qty'] = $item->qty;
                    $cart[$item->product_id]['product_id'] = $item->product_id;
                    $cart[$item->product_id]['product_name'] = $item->product->name;
                    $cart[$item->product_id]['product_image'] = $item->product->image;
                    $cart[$item->product_id]['product_price'] = $item->product->price - $item->product->discount;
                }
            }
            session()->put('cart', $cart);
        }

        $wishData = $this->wishRepo->getUserWish($customer_id);
        if ($wishData) {
            $wish = session('wish');
            foreach ($wishData as $item) {
                if (! isset($wish[$item->product_id])) {
                    $wish[$item->product_id]['product_id'] = $item->product_id;
                    $wish[$item->product_id]['product_name'] = $item->product->name;
                    $wish[$item->product_id]['product_image'] = $item->product->image;
                    $wish[$item->product_id]['product_price'] = $item->product->price - $item->product->discount;
                }
            }
            session()->put('wish', $wish);
        }
    }

    public function login(Request $request)
    {
        try {
            if (empty($request->password) || empty($request->mobile)) {
                throw new \Exception('Password and mobile required!');
            }
            $customer = $this->mainRepo->customerByMobile($request->mobile);
            if (! $customer || ! Hash::check($request->password, $customer->password)) {
                throw new \Exception('These credentials do not match our records');
            }

            session()->put('login', 'True');
            session()->put('id', $customer->id);
            session()->put('mobile', $customer->mobile);
            session()->put('email', $customer->email);
            session()->put('name', $customer->name);
            session()->put('address', $customer->address);
            session()->put('gender', $customer->gender);

            $this->setCartNWishSession($customer->id);

            return redirect(route('home'));
        } catch (\Exception $e) {
            Log::alert($e->getMessage());

            return back()->withInput()->with('warning', $e->getMessage());
        }
    }

    public function logOut()
    {
        session()->forget('login');
        session()->forget('id');
        session()->forget('mobile');
        session()->forget('email');
        session()->forget('name');

        return redirect(route('login.reg.create'));
    }

    public function otpCreate()
    {
        return view('account.password-otp-get');
    }

    public function otpSend(Request $request)
    {
        try {
            if (empty($request->mobile)) {
                throw new \Exception('Mobile number required!');
            }
            if (strlen($request->mobile) != 11) {
                throw new \Exception('Provide 11 digit mobile number!');
            }
            $customer = $this->mainRepo->customerByMobile($request->mobile);
            if (! $customer) {
                throw new \Exception('Mobile number not found!');
            }
            $otp = rand(100000, 999999);
            $mobile = $request->mobile;

            session()->put('forgetOtp', $otp);
            session()->put('forgetMobile', $mobile);
            $text = 'Please use '.$otp.' this otp for change password -The Mart Bangladesh';
            $this->smsService->sendNonMaskinSms($mobile, $text);
        } catch (\Exception $e) {
            Log::alert($e->getMessage());

            return back()->withInput()->with('warning', $e->getMessage());
        }

        return redirect(route('password.otp.submit.page'));
    }

    public function otpSubmitPage()
    {
        $mobile = session('forgetMobile');

        return view('account.password-otp-submit', compact('mobile'));
    }

    public function forgetPasswordUpdate(Request $request)
    {
        try {
            if (empty($request->code)) {
                throw new \Exception("Code can't be empty!");
            }
            if ($request->code != session('forgetOtp')) {
                throw new \Exception('Code does not match!');
            }
            if (strlen($request->passowrd) < 6) {
                throw new \Exception('Pasword minimum 6 character!');
            }

            $customer = $this->mainRepo->customerByMobile(session('forgetMobile'));
            if (! $customer) {
                throw new \Exception('Customer not found!');
            }

            $data['password'] = Hash::make($request->passowrd, [
                'memory' => 1024,
                'time' => 2,
                'threads' => 2,
            ]);
            $update = $this->mainRepo->update($data, $customer->id);
        } catch (\Exception $e) {
            Log::alert($e->getMessage());

            return back()->with('warning', $e->getMessage());
        }

        return redirect(route('home'))->with('success', 'Password update successfully done!');
    }

    ///google auth
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $userData = [
                'name' => $user->getName(),
                'email' => $user->getEmail(),
            ];
            $existingUser = $this->mainRepo->customerByEmail($userData['email']);
            if ($existingUser) {
                session()->put('login', 'True');
                session()->put('id', $existingUser->id);
                session()->put('mobile', $existingUser->mobile);
                session()->put('email', $existingUser->email);
                session()->put('name', $existingUser->name);
                session()->put('address', $existingUser->address);
                session()->put('gender', $existingUser->gender);
                $this->setCartNWishSession($existingUser->id);
            } else {
                $userData['status'] = 'Active';
                $userData['customerType'] = 'Online';
                $userData['mobile'] = uniqid();
                $userData['password'] = Hash::make('12345678', [
                    'memory' => 1024,
                    'time' => 2,
                    'threads' => 2,
                ]);

                $register = $this->mainRepo->store($userData);
                session()->put('login', 'True');
                session()->put('id', $register->id);
                session()->put('mobile', $register->mobile);
                session()->put('email', $register->email);
                session()->put('name', $register->name);
                session()->put('address', $register->address);
                session()->put('gender', $register->gender);
                $this->setCartNWishSession($register->id);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return redirect(route('home'))->with('warning', $e->getMessage());
        }

        return redirect(route('home'))->with('success', 'Login successfully done!');
    }
}
