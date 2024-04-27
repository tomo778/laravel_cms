<?php

namespace App\Http\Controllers;

use App\Services\PurchaseService;
use App\Services\UsersAddressService;
use App\Http\Requests\PurchaseRequest;
use App\Mail\PurchaseMail;
use Illuminate\Support\Facades\Auth;
//use App\Exceptions\PurchaseException;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PurchaseController extends Controller
{
    private $purchaseService;
    private $usersAddressService;

    public function __construct(PurchaseService $purchaseService, UsersAddressService $usersAddressService)
    {
        $this->purchaseService = $purchaseService;
        $this->usersAddressService = $usersAddressService;
    }

    public function index(): \Illuminate\View\View
    {
        session()->forget('purchase');
        $address_list = $this->usersAddressService->list();
        return view('purchase.contact', compact('address_list'));
    }

    public function back(): \Illuminate\View\View
    {
        $address_list = $this->usersAddressService->list();
        return view('purchase.contact', compact('address_list'));
    }

    public function confirm(PurchaseRequest $request): \Illuminate\View\View
    {
        session(['purchase.payway' => $request->payway]);
        session(['purchase.address' => $request->address]);
        session(['purchase.address_detail' => $this->usersAddressService->detail($request->address)]);
        return view('purchase.confirm');
    }

    public function finish(): \Illuminate\View\View
    {
        $this->purchaseService->addSessionData();
        $this->purchaseService->purchase();
        $this->sendMail();
        $this->purchaseService->addOrderHistory();
        $this->purchaseService->saveSession();
        return view('purchase.finish');
    }

    private function sendMail(): void
    {
        $bcc = 'bcc@mail.com';
        $cc = 'cc@mail.com';
        Mail::to(Auth::user()->email)
            ->cc($cc)
            ->bcc($bcc)
            ->send(new PurchaseMail());
    }
}
