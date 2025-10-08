<?php
namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\BookTable;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class OrderService
{
    protected $tableService;
    
    public function __construct(TableService $tableService){ 
        $this->tableService = $tableService; 
    }

    public function openOrder(int $tableId, ?int $userId){
        $table = BookTable::findOrFail($tableId);
        
        if($table->status !== 'available') 
            throw new \Exception('Table is not available');

        return DB::transaction(function() use($table,$userId){        
            $order = Order::create([
                'table_id' => $table->id,
                'user_id' => $userId,
                'status' => 'open',
                'total' => 0,
            ]);

            $table->status = 'occupied';

            $table->save();

            return $order->load('items.menu','table');
        });
    }
    
    public function addItem(int $orderId, int $menuId, int $qty = 1){
        $order = Order::findOrFail($orderId);
        if($order->status !== 'open') 
            throw new \Exception('Order is not open');
        
        $menu = Menu::findOrFail($menuId);
        return DB::transaction(function() use($order,$menu,$qty){        
            $sub = bcmul((string)$menu->price, (string)$qty, 2);
            $item = OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $menu->id,
                'quantity' => $qty,
                'price' => $menu->price,
                'sub_total' => $sub,
            ]);

            $order->total = bcadd((string)$order->total, (string)$sub, 2);
            $order->save();

            return $item->load('menu');
        });
    }

    public function closeOrder(int $orderId){
        $order = Order::findOrFail($orderId);

        if($order->status !== 'open') 
            throw new \Exception('Order already closed');

        return DB::transaction(function() use($order){
            $order->status = 'closed';
            $order->save();
            $table = $order->table;
            $table->status = 'open';
            $table->save();

            return $order->load('items.menu','table');
        });
    }

    public function listOrders(){
        return Order::with(['table','items.menu'])->orderBy('created_at','desc')->get();
    }
}