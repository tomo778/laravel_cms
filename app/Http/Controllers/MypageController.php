<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UsersAddressService;
use App\Services\UsersHistoryService;
use App\Http\Requests\MypageAddressRequest;

class MypageController extends Controller
{
    private $usersAddressService;
    private $usersHistoryService;

    public function __construct(
        UsersAddressService $usersAddressService,
        UsersHistoryService $usersHistoryService
    ) {
        $this->usersAddressService = $usersAddressService;
        $this->usersHistoryService = $usersHistoryService;
    }

    public function index(): \Illuminate\View\View
    {
        return view('mypage.index');
    }

    public function address(): \Illuminate\View\View
    {
        $data = $this->usersAddressService->list();
        return view('mypage.address', compact('data'));
    }

    public function history(): \Illuminate\View\View
    {
        $data = $this->usersHistoryService->list();
        return view('mypage.history', compact('data'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('mypage.address_form');
    }

    public function createExecute(MypageAddressRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->usersAddressService->create($request);
        return redirect('mypage/address');
    }

    public function update(int $id = null): \Illuminate\View\View
    {
        $data = $this->usersAddressService->detail($id);
        return view('mypage.address_form', compact('data'));
    }

    public function updateExecute(MypageAddressRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->usersAddressService->update($request);
        return redirect('mypage/address');
    }
}
