<?php

namespace app\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\UsersHistory;
use App\Libs\Common;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\PurchaseException;
use App\Services\Payment\PaymentFactory;

class PurchaseService
{
    public function addSessionData(): void
    {
        $date = Carbon::now();
        session(['purchase.date' => $date]);
        session(['purchase.user_id' => Auth::id()]);
        session(['purchase.user_name' => Auth::user()->name]);
        session(['purchase.order_id' => Common::randInt(5) . $date->format('-Ymd-His')]);
    }

    public function saveSession(): void
    {
        session()->regenerateToken();
        session()->forget('cart');
        session()->forget('purchase');
    }

    public function purchase()
    {
        return DB::transaction(function () {
            if ($this->quantityCheck() == false) {
                DB::rollBack();
                throw new PurchaseException('quantity err');
            };
            $this->decrementQuantity();
            $payment = PaymentFactory::create();
            if ($payment->execute() == false) {
                DB::rollBack();
                throw new PurchaseException("err payment id:" . Auth::id());
            };
        });
    }

    public function addOrderHistory(): void
    {
        foreach (session('cart.items') as $k => $v) {
            $tmp['user_id'] = session('purchase.user_id');
            $tmp['order_id'] = session('purchase.order_id');
            $tmp['title'] = $v['title'];
            $tmp['price'] = $v['price'];
            $tmp['quantity'] = $v['quantity'];
            $tmp['updated_at'] = session('purchase.date');
            $tmp['created_at'] = session('purchase.date');
            $data[] = $tmp;
        }
        UsersHistory::insert($data);
    }

    private function quantityCheck(): bool
    {
        $cart_items = session('cart');
        foreach ($cart_items['items'] as $k => $v) {
            $tmp[] = $v['id'];
        }
        $db_items = Product::lockForUpdate()
            ->whereIn('id', $tmp)
            ->get()
            ->toArray();
        foreach ($db_items as $k => $v) {
            $quantity = $cart_items['items'][$v['id']]['quantity'];
            if ($v['num'] < $quantity) {
                return false;
            }
        }
        return true;
    }

    private function decrementQuantity(): void
    {
        foreach (session('cart.items') as $k => $v) {
            Product::lockForUpdate()
                ->where('id', $k)
                ->decrement('num', $v['quantity']);
        }
    }
}
