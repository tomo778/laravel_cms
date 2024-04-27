<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;

class CartController extends Controller
{
    private $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(): \Illuminate\View\View
    {
        return view('cart');
    }

    public function addItem(Request $request): \Illuminate\View\View
    {
        $message = $this->cartService->cartCheck($request);
        return view('cart', compact('message'));
    }

    public function removeItem(Request $request): string
    {
        //$request->session()->put('cart', $this->cartService->removeItem($request->id));
        $this->cartService->removeItem($request->id);
        return json_encode(['success' => true]);
    }

    public function quantityChange(Request $request): string
    {
        //$request->session()->put('cart', $this->cartService->quantityChange($request));
        $this->cartService->quantityChange($request);
        return json_encode(['success' => true]);
    }
}
