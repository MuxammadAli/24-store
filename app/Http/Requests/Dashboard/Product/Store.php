<?php

namespace App\Http\Requests\Dashboard\Product;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

use App\Api\ImageResize;

class Store extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('get')) {
            return [];
        }

        return [
            'name' => 'array',
            'name.*' => 'required',
            'body' => 'array',
            'body.*' => 'nullable',
            'short_body' => 'array',
            'short_body.*' => 'max:300',
            'price' => 'required|numeric|gt:price_discount',
            'price_discount' => 'nullable',
            'brand_id' => 'required',
            'category_id' => 'required',
            'screens' => 'array',
            'screens.*.image' => 'required|mimes:jpeg,png,jpg',
            'article_number' => 'required|unique:products,article_number'
        ];
    }


    /**
     * @return mixed
     */
    public function getColors()
    {
        return $this->get('colors');
    }

    /**
     * @return string
     */
    public function getPoster(): string
    {
        $folder = "uploads/posters/" . Carbon::now()->format('Y/m/d');
        return (string) $this->file('poster')->store($folder);
    }

    /**
     * @return string
     */
    public function getPosterThumb()
    {
        $image = new ImageResize();
        $url = $image->resize($this->getPoster(), 322, 'posters');

        return $url;
    }

    /**
     * @return array
     */
    public function getName(): array
    {
        return $this->get('name');
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->get('body');
    }


    public function getPrice()
    {
        return $this->get('price');
    }


    public function getPriceDiscount()
    {
        if ($this->get('price_discount') > 0) {
            return $this->get('price_discount');
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getCategoryID()
    {
        return $this->get('category_id');
    }


    /**
     * @return string
     */
    public function getSlug(): string
    {
        if ($this->get('slug') != 'null') {
            return (string) str_slug($this->get('slug'));
        }

        return (string) str_slug($this->get('name')['ru']);
    }


    /**
     * @return bool
     */
    public function getPublished()
    {
        if ($this->get('published') == 'true') {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function getAvailable()
    {
        if ($this->get('available') == 'true') {
            return true;
        }

        return false;
    }


    /**
     * @return int|null
     */
    public function getBrandID()
    {
        if ($this->get('brand_id') != 0) {
            return (int) $this->get('brand_id');
        }

        return null;
    }

    public function getPopular(): bool
    {
        return $this->get('popular');
    }

    public function getLeaderOfSales(): bool
    {
        return $this->get('leader_of_sales');
    }
}
