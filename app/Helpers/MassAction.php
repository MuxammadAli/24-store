<?php

namespace App\Helpers;

use App\Models\Product;

class MassAction
{
    public function massDelete(array $attributes)
    {
        Product::whereIn('id', $attributes)->delete();
    }

    public function massUnpublish(array $attributes)
    {
        Product::whereIn('id', $attributes)->update([
            'published' => false
        ]);
    }
}
