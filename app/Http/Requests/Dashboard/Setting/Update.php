<?php

namespace App\Http\Requests\Dashboard\Setting;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'array',
            'title.*' => 'required',
            'keywords' => 'array',
            'keywords.*' => 'required',
            'description' => 'array',
            'description.*' => 'required',
            'phone' => 'array',
            'email' => 'required',
            'address' => 'array',
            'address.*' => 'required',
            'socials' => 'array',
            'socials.*' => 'required',
            'landmark' => 'array',
            'landmark.*' => 'required',
//            'links' => 'array',
//            'links.*' => 'required',
            //'price_delivery' => 'required|numeric',
            //'day_delivery' => 'required|numeric',
            //'on_credit' => 'required'
        ];
    }


    /**
     * @return mixed\
     */
    public function getLandmark()
    {
        return $this->get('landmark');
    }

    /**
     * @return mixed
     */
    public function getPriceDelivery()
    {
        return $this->get('price_delivery');
    }

    public function getDayDelivery()
    {
        return $this->get('day_delivery');
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->get('title');
    }

    /**
     * @return mixed
     */
    public function getKeywords()
    {
        return $this->get('keywords');
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->get("description");
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->get('phone');
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->get('email');
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->get('address');
    }

    public function getLinks()
    {
        return $this->get('links');
    }

    /**
     * @return mixed
     */
    public function getSocials()
    {
        return $this->get('socials');
    }

    /**
     * @return bool
     */
    public function getOnCredit()
    {
        if ($this->get('on_credit') == 1) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function getByOneClick()
    {
        if ($this->get('buy_one') == 1) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function getNewsBlock()
    {
        if (!empty($this->get('permissions')['news']) && $this->get('permissions')['news'] == 1) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function getBrandsBlock()
    {
        if (!empty($this->get('permissions')['brands']) && $this->get('permissions')['brands'] == 1) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function getSpecialBlock()
    {
        if (!empty($this->get('permissions')['special_block']) && $this->get('permissions')['special_block'] == 1) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function getMiddleBannerBlock()
    {
        if (!empty($this->get('permissions')['middle_banner']) && $this->get('permissions')['middle_banner'] == 1) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function getLiderProductsBlock()
    {
        if (!empty($this->get('permissions')['lider_products']) && $this->get('permissions')['lider_products'] == 1) {
            return true;
        }

        return false;
    }
    /**
     * @return bool
     */
    public function getNewProductsBlock()
    {
        if (!empty($this->get('permissions')['new_products']) && $this->get('permissions')['new_products'] == 1) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function getPopularProductsBlock()
    {
        if (!empty($this->get('permissions')['popular_products']) && $this->get('permissions')['popular_products'] == 1) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function getPopularCategoriesBlock()
    {
        if (!empty($this->get('permissions')['popular_categories']) && $this->get('permissions')['popular_categories'] == 1) {
            return true;
        }

        return false;
    }

}
