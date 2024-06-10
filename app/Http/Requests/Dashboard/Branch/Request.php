<?php

namespace App\Http\Requests\Dashboard\Branch;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('get'))
        {
            return [];
        }

        return [
            'name' => 'required|array',
            'name.*' => 'required|string',
            'address' => 'required|array',
            'address.*' => 'required|string',
            'schedule' => 'required|array',
            'schedule.*' => 'required|string',
            'map' => 'required|array',
            'map.*' => 'required|string',
            'phone' => 'required|string',
            'orientation' => 'required|array',
        ];
    }

    public function getName(): array
    {
        return (array) $this->get('name');
    }

    public function getAddress(): array
    {
        return (array) $this->get('address');
    }

    public function getSchedule(): array
    {
        return (array) $this->get('schedule');
    }

    public function getMap(): array
    {
        return (array) $this->get('map');
    }

    public function getPhone(): string
    {
        return (string) $this->get('phone');
    }

    public function getOrientation(): array
    {
        return $this->get('orientation');
    }
}
