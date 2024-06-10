<?php

namespace App\Http\Requests\Site\Comment;

use Illuminate\Foundation\Http\FormRequest;

class CommentCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'    => 'required|string',
            'body'          => 'required|string',
            'star'          => 'required|numeric',
            'product_id'    => 'required|numeric|exists:products,id'
        ];
    }
}
