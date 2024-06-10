<?php

namespace App\Http\Controllers\Api\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @param $product
     * @return mixed
     */
    public function index($product)
    {
        $product_id = Product::where('productable_id', $product)->first()->id;
        $comments = Comment::where('product_id', $product_id)->select(
            'id', 'body', 'publish', 'created_at', 'product_id', 'user_id'
        )->with('product:id,name', 'user:id,first_name,last_name')->get();
        return response()->json([
            'status' => true,
            'comments' => $comments
        ]);
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Comment $comment): \Illuminate\Http\JsonResponse
    {
        $comment->loadMissing('product:id,name', 'user:id,first_name,last_name');
        return response()->json([
            'status' => true,
            'comment' => $comment
        ]);
    }

    /**
     * @param Request $req
     * @param Comment $comment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(Request $req, Comment $comment)
    {
        $comment->update([
            'publish' => (bool)$req->input('publish')
        ]);
        return response([
            'status' => true
        ]);
    }
}
