<?php

namespace App\Http\Requests\Api\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class ProductStoreRequest extends FormRequest
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
        return [
            'name' => 'array',
            'name.*' => 'required',
            'body' => 'array',
            'body.*' => 'nullable',
            'short_body' => 'array',
            'short_body.*' => 'max:300',
            'category_id' => 'required',
            'images' => 'required|array',
            'images.*.path' => 'required',
            'images.*.path_thumb' => 'required',
            'regions' => 'array|nullable',
            'count' => 'nullable|integer',
            'available' => 'required|boolean',
        ];
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


    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->get('price', 0);
    }


    /**
     * @return mixed|null
     */
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
        if ($this->has('slug')) {
            return (string) Str::slug($this->get('slug'));
        }

        return (string) Str::slug($this->get('name')['ru']);
    }


    /**
     * @return bool
     */
    public function getPublished(): bool
    {
        return $this->get('published');
    }

    /**
     * @return bool
     */
    public function getAvailable(): bool
    {
        if ($this->get('available') == 'true') {
            return true;
        }

        return false;
    }


    /**
     * @return int|null
     */
    public function getBrandID(): ?int
    {
        if ($this->get('brand_id') != 0) {
            return (int) $this->get('brand_id');
        }

        return null;
    }

}
