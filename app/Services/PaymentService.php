<?php
namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Payment;
use App\Models\Order;

class PaymentService
{
    public function pay(int $orderId, float $amount, string $method){
        $order = Order::findOrFail($orderId);
        if($order->status !== 'closed') throw new \Exception('Order must be closed before payment');

        $payment = Payment::create([
            'order_id' => $order->id,
            'amount' => $amount,
            'method' => $method,
            'paid_at' => now()
        ]);

        $order->status = 'paid';
        $order->save();
        
        return $payment;
    }
    
    public function generateReceiptPdf(int $orderId){
        $order = Order::with(['items.menu', 'table', 'user'])->findOrFail($orderId);

        $pdf = Pdf::loadView('receipt', ['order' => $order]);
        return $pdf->download("receipt_order_{$order->id}.pdf");
    }
}
