<?php

namespace App\Http\Requests\Dashboard\Agent;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int agent
 */
class AgentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        if (empty($this->agent)) return [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'username' => 'required|unique:agents,username',
            'password' => 'required|min:5',
            'region_id' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif,svg,webp'
        ];
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'username' => 'required|unique:agents,username,' . $this->agent,
            'password' => 'nullable|min:5',
            'region_id' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif,svg,webp'
        ];
    }
}
