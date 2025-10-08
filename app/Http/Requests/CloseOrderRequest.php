<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CloseOrderRequest extends FormRequest
{
    public function authorize(){ 
        return true; 
    }

    public function rules(){ 
        return [
            'order_id' => 'required|exists:orders,id'
        ]; 
    }
}