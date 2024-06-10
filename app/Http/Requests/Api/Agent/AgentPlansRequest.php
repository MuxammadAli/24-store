<?php

namespace App\Http\Requests\Api\Agent;

use Illuminate\Foundation\Http\FormRequest;

class AgentPlansRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array|string[]
     */
    public function rules(): array
    {
        if ($this->isMethod('get')) return [];
        return [
//            'plans' => 'required|array',
//            'plans.*.id' => 'required|int',
//            'plans.*.count' => 'required|int'
        ];
    }
}
