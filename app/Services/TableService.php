<?php
namespace App\Services;

use App\Models\BookTable;
class TableService
{
    public function listTables(){ 
        return BookTable::orderBy('name')->get(); 
    }

    public function updateStatus(int $id, string $status){
        $table = BookTable::findOrFail($id);

        if(!in_array($status, ['open','occupied'])) 
            throw new \InvalidArgumentException('Invalid status');
        
        $table->status = $status;
        $table = BookTable::findOrFail($id);
        
        if(!in_array($status, ['open','occupied'])) 
            throw new \InvalidArgumentException('Invalid status');

        $table->status = $status;
        $table->save();
        
        return $table;
    }

    public function isOpen(int $id){
        $t = BookTable::findOrFail($id);
        return $t->status === 'open';
    }
}