<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\File;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\UserShowResource;
use App\Models\Order;
use App\Models\Supplier;
use App\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    /**
     * @param Request $req
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $req)
    {
        return $req->has('users') ? User::whereIn('id', $req->input('users'))->get() : User::all();
    }

    public function shops($supplier)
    {
        $supplier = Supplier::where('supplier_id', $supplier)->firstOrFail();
        $users = $supplier->users;
        $users->map(function (User $user) {
            $user->image = $user->getImage();
        });
        return response()->json($users);
    }

    public function shop_view($supplier, User $user)
    {
        return response()->json(new UserShowResource($user));
    }

    /**
     * @param User $user
     * @return User
     */
    public function view(User $user): User
    {
        return $user;
    }

    public function upload(Request $req, User $user)
    {
        $images = [];
        foreach ($req->file('images') as $image) {
            $images[] = File::upload($image, 'user');
        }
        $user->update([
            'images' => $images
        ]);
        return response('', 204);
    }
}
