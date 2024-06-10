<?php

namespace App\Http\Requests\Api\Recovery;

use Illuminate\Foundation\Http\FormRequest;

class RecoveryStatusRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'recovery_id' => 'required|exists:recoveries,id',
            'status' => 'required|string|in:processing,closed,cancelled'
        ];
    }
}
