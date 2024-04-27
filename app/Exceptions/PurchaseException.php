<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class PurchaseException extends Exception
{
    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    private $log_name = 'PurchaseController';
    private $log_path = '/logs/purchase.log';

    public function report()
    {
        Log::build([
            'driver' => 'single',
            'path' => storage_path($this->log_path),
        ])->emergency($this->log_name . ':' . $this->message);
    }

    public function render()
    {
        return response()->view('errors.payment');
    }
}
