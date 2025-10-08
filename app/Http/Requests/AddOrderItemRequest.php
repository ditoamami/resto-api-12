<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddOrderItemRequest extends FormRequest
{
    public function authorize(){ 
        return true; 
    }

    public function rules(){ 
        return [
            'order_id' => 'required|exists:orders,id',
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'sometimes|integer|min:1'
        ]; 
    }
}