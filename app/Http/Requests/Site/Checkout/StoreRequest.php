<?php

namespace App\Http\Requests\Site\Checkout;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            return [
//                'delivery_type' => 'required',
                'order.payment_type' => 'required|in:cash,payme,apelsin,click,uzcard,humo,transfer',
                'order.first_name' => 'required',
                'products' => 'array|required',
                'products.*' => 'required|exists:carts,id',

            ];
        }

        return [];
    }

    protected function getValidatorInstance() {
        $validator = parent::getValidatorInstance();

        if ($this->isMethod('post')) {
//
//            $validator->sometimes('address.region_id', 'required', function($input) {
//                return $input->delivery_type == 'delivery';
//            });
//
//            $validator->sometimes('address.city_id', 'required', function($input) {
//                return $input->delivery_type == 'delivery';
//            });

//            $validator->sometimes('address.address', 'required', function($input) {
//                return $input->delivery_type == 'delivery';
//            });
//
//            $validator->sometimes('address.first_name', 'required', function($input) {
//                return $input->delivery_type == 'delivery';
//            });
        }

        return $validator;
    }

    /**
     * @return int
     */
    public function getPaymentStatus()
    {
        if ($this->get('order.payment_type') === 'cash') {
            return 'cash';
        }

        return 'waiting';
    }


    /**
     * @return mixed|null
     */
    public function getShipmentDate()
    {
        if ($this->get('shipment_date')) {
            return  $this->get('shipment_date');
        }

        return null;
    }


    /**
     * @return mixed|null
     */
    public function getBranchID()
    {
        if ($this->get('branch_id')) {
            return $this->get('branch_id');
        }

        return null;
    }
}
