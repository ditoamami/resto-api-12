<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(){
        Schema::create('book_tables', function (Blueprint $table){
            $table->id();
            $table->string('name')->unique();
            $table->enum('status', ['available','occupied','inactive','reserved'])->default('available');
            $table->integer('capacity')->default(4);
            $table->string('floor')->nullable();
            $table->timestamps();
        });
    }

    public function down(){ 
        Schema::dropIfExists('book_tables'); 
    }
};