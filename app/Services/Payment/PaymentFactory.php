<?php

namespace App\Services\Payment;

use App\Exceptions\PurchaseException;

class PaymentFactory
{
    public static function create()
    {
        if (session('purchase.payway') == Config('const.PAYWAY_DELIVERY')) {
            $klass = new \App\Services\Payment\Delivery;
        } elseif (session('purchase.payway') == Config('const.PAYWAY_CARD')) {
            $klass = new \App\Services\Payment\CreditCard;
        }
        if (empty($klass)) {
            throw new PurchaseException('nothig class');
        }
        return $klass;
    }
}
