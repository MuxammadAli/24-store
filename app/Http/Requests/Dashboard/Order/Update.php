<?php

namespace App\Http\Requests\Dashboard\Order;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('get')) {
            return [
                //
            ];
        }

        return [
            'products' => 'array|required',
        ];
    }

   // protected function getValidatorInstance() {
//        $validator = parent::getValidatorInstance();

//        if ($this->isMethod('post')) {
//
//            $validator->sometimes('orders.branch_id', 'required', function($input) {
//                return $input->orders['type_delivery'] == 2;
//            });
//
//            $validator->sometimes('orders.shipment_date', 'required', function($input) {
//                return $input->orders['type_delivery'] == 2;
//            });
//
//            $validator->sometimes('orders.address.city', 'required', function($input) {
//                return $input->orders['type_delivery'] == 1;
//            });
//
//            $validator->sometimes('orders.address.region', 'required', function($input) {
//                return $input->orders['type_delivery'] == 1;
//            });
//
//            $validator->sometimes('orders.address.street', 'required', function($input) {
//                return $input->orders['type_delivery'] == 1;
//            });
//        }

//        return $validator;
   // }

    public function getPhone(): int
    {
        return $this->get('orders')['address']['phone'];
    }

    public function getFirstName(): string
    {
        return $this->get('orders')['address']['first_name'];
    }

    /**
     * @return mixed|null
     */
    public function getCity()
    {
        return $this->get('orders')['address']['city'] ? $this->get('orders')['address']['city'] : null;
    }

    public function getRegion()
    {
        return $this->get('orders')['address']['region'] ? $this->get('orders')['address']['region'] : null;
    }

    public function getStreet()
    {
        return $this->get('orders')['address']['street'] ? $this->get('orders')['address']['street'] : null;
    }

    public function getApartment()
    {
        return $this->get('orders')['address']['apartment'] ? $this->get('orders')['address']['apartment'] : null;
    }

    public function getFloor()
    {
        return $this->get('orders')['address']['floor'] ? $this->get('orders')['address']['floor'] : null;
    }

    public function getEntrance()
    {
        return $this->get('orders')['address']['entrance'] ? $this->get('orders')['address']['entrance'] : null;
    }

    public function getProductTotal(): int
    {
        return (int) $this->get('product_total');
    }

    public function getTotal(): int
    {
        return $this->get('total');
    }

    public function getDeliveryPrice()
    {
        return $this->get('orders')['price_delivery'];
    }

    /**
     * @return mixed|null
     */
    public function shipment_date()
    {
        return $this->get('orders')['shipment_date'] ? $this->get('orders')['shipment_date'] : null;
    }

    public function getTypeDelivery(): int
    {
        return $this->get('orders')['type_delivery'];
    }

    public function getPaymentType(): string
    {
        return $this->get('orders')['payment_type'];
    }

    /**
     * @return mixed|null
     */
    public function getBranchID()
    {
        return $this->get('orders')['branch_id'] ? $this->get('orders')['branch_id'] : null;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->get('products');
    }


    public function getDiscount()
    {
        return $this->get('orders')['discount'] ? $this->get('orders')['discount'] : null;
    }
}
