<?php
namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    protected $service;
    public function __construct(PaymentService $s)
    {
        $this->service = $s;
        $this->middleware('auth:sanctum');
    }

    public function pay(PaymentRequest $req)
    {
        $d = $req->validated();
        return $this->service->pay($d['order_id'], $d['amount'], $d['method']);
    }
    
    public function receiptPdf($orderId)
    {
        return $this->service->generateReceiptPdf((int)$orderId);
    }
}