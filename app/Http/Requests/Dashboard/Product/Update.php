<?php

namespace App\Http\Requests\Dashboard\Product;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

use App\Api\ImageResize;

class Update extends FormRequest
{
    public function rules()
    {
        if ($this->isMethod('get')) {
            return [];
        }

        return [
            'name' => 'array',
            'name.*' => 'required',
            'body' => 'array',
            'body.*' => 'required',
            'short_body' => 'array',
            'short_body.*' => 'required|max:300',
            'price' => 'required|numeric',
            'price_discount' => 'nullable',
            //'poster' => 'nullable|mimes:jpeg,png,jpg',

            'brand_id' => 'required',

            'category_id' => 'required',

//            'colors' => 'array|required',
//            'colors.*.color_id' => 'nullable',
//            'colors.*.sizes' => 'nullable|array',
//            'colors.*.sizes.*.name' => 'required',
//            'colors.*.sizes.*.count' => 'required',

            'screens' => 'array',
//            'colors.*.screens' => 'array',
            //'colors.*.screens.*.image' => 'nullable|mimes:jpeg,png,jpg',

            'popular' => 'nullable',
            'leader_of_sales' => 'nullable',
            'article_number' => 'required|unique:products,article_number,'.$this->product->id.',id,deleted_at,NULL'
        ];
    }

    protected function getValidatorInstance() {
        $validator = parent::getValidatorInstance();

        if ($this->isMethod('post')) {

            $validator->sometimes('price', 'gt:price_discount', function($input) {
                return $input->price_discount > 0;
            });

        }

        return $validator;
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
        if ($this->hasFile('poster')) {

            if (is_file($this->get('poster'))) {
                unlink($this->get("poster"));
            }

            $folder = "uploads/posters/" . Carbon::now()->format('Y/m/d');
            return (string) $this->file('poster')->store($folder);
        }

        return $this->get('poster');
    }

    /**
     * @return string
     */
    public function getPosterThumb(): string
    {
        if ($this->hasFile('poster')) {

            if (is_file($this->get('poster_thumb'))) {
                unlink($this->get("poster_thumb"));
            }

            $image = new ImageResize();
            $url = $image->resize($this->getPoster(), 322, 'posters');
            return $url;
        }

        return $this->get('poster_thumb');
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
        if ($this->get('price_discount')) {
            return $this->get('price_discount');
        }

        return null;
    }

    /**
     * @return int
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
        if ($this->get('slug')) {
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
        if ($this->get('brand_id') == 'null') {
            return null;
        }

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
