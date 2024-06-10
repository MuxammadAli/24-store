<?php

namespace App\Http\Requests\Site\Feedback;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class Create extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'phone' => [
                'required',
                'string',
                'regex:/(\+998) (90|91|92|93|94|95|96|97|98|99|33|88) [0-9]{3} [0-9]{2} [0-9]{2}/',
            ],
            'message' => 'required|string'
        ];
    }
}
