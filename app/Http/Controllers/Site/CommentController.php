<?php


namespace App\Http\Controllers\Site;


use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests\Comment\StoreRequest;

class CommentController extends Controller
{

    /**
     * @param Product $product
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Product $product, StoreRequest $request)
    {
        Comment::create([
//            'first_name' => $request->first_name,
//            'star' => $request->star,
            'user_id' => auth()->user()->id,
            'body' => $request->body,
            'product_id' => $product->id
        ]);

        return response()->json([
            'status' => true
        ]);
    }

}
