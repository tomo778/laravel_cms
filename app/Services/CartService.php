<?php

namespace app\Services;

use App\Models\Product;

class CartService
{
    private $cartItems;

    public function set($items): void
    {
        $this->cartItems = $items;
    }

    public function cartCheck(object $Request): bool
    {
        $this->set(session('cart'));
        if (empty($this->cartItems)) {
            $this->addItem($Request);
            return false;
        }
        if (array_key_exists($Request->item_id, $this->cartItems['items'])) {
            return true;
        } else {
            $this->addItem($Request);
            return false;
        }
    }

    private function addItem(object $Request): bool
    {
        $item_data = Product::StatusCheck()
            ->where('id', $Request->item_id)
            ->first()->toArray();
        $item_data['quantity'] = $Request->quantity;
        $this->cartItems['items'][$item_data['id']] = $item_data;
        $this->cartItems['price'] = $this->totalAmount();
        session(['cart' => $this->cartItems]);
        return false;
    }

    public function removeItem($id): void
    {
        $this->set(session('cart'));
        unset($this->cartItems['items'][$id]);
        $this->cartItems['price'] = $this->totalAmount();
        session(['cart' => $this->cartItems]);
    }

    public function quantityChange(object $Request)
    {
        $this->set(session('cart'));
        $this->cartItems['items'][$Request->id]['quantity'] = $Request->quantity;
        $this->cartItems['price'] = $this->totalAmount();
        session(['cart' => $this->cartItems]);
    }

    private function totalAmount(): int
    {
        return array_reduce(
            $this->cartItems['items'],
            function ($total, $cartItem) {
                return $total + $cartItem['price'] * $cartItem['quantity'];
            },
            0
        );
    }
}
