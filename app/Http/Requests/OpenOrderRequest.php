<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OpenOrderRequest extends FormRequest
{
    public function authorize(){ 
        return true; 
    }

    public function rules(){ 
        return [
            'table_id' => 'required|exists:tables,id'
        ]; 
    }
}