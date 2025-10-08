<?php
namespace App\Http\Controllers;

use App\Http\Requests\OpenOrderRequest;
use App\Http\Requests\AddOrderItemRequest;
use App\Http\Requests\CloseOrderRequest;
use App\Models\Order;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $service;
    public function __construct(OrderService $s)
    {
        $this->service = $s;
    }
    public function index()
    {
        return $this->service->listOrders();
    }
    public function show(Order $order)
    {
        return $order->load('items.menu', 'table');
    }
    public function open(OpenOrderRequest $req)
    {
        $userId = auth()->id();
        return $this->service->openOrder($req->validated()['table_id'], $userId);
    }
    public function addItem(AddOrderItemRequest $req)
    {
        $data = $req->validated();
        return $this->service->addItem($data['order_id'], $data['menu_id'], $data['quantity'] ?? 1);
    }
    public function close(CloseOrderRequest $req)
    {
        return $this->service->closeOrder($req->validated()['order_id']);
}
}