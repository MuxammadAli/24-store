<?php

namespace App\Http\Requests\Site\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CartStoreRequest extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'count' => 'required|numeric'
        ];
    }


    /**
     * @return mixed
     */
    public function getSize()
    {
        if ($this->get('size')) {
            return $this->get('size');
        }

        return $this->get('size');
    }
}
