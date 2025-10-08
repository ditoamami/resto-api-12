<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(){
        Schema::create('orders', function (Blueprint $table){
            $table->id();
            $table->foreignId('table_id')->constrained('book_tables')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status',['open','closed'])->default('open');
            $table->decimal('total', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(){ 
        Schema::dropIfExists('orders'); 
    }
};