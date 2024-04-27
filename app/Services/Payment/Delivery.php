<?php

namespace App\Services\Payment;

use App\Services\Payment;

class Delivery implements PayWay
{
    public function execute()
    {
        // 代引きの場合の決済処理を書いていく
        return true;
    }
}
