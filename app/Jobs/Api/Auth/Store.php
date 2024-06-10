<?php

namespace App\Jobs\Api\Auth;

use App\User;
use Illuminate\Support\Arr;
use App\Http\Requests\Api\Auth\Login as LoginRequest;
use Illuminate\Support\Facades\Http;

class Store
{

    protected $attr;

    /**
     * Store constructor.
     * @param array $attr
     */
    public function __construct(array $attr = [])
    {
        $this->attr = Arr::only($attr, ['phone', 'verify_code', 'step']);
    }

    /**
     * @param LoginRequest $request
     * @param int $code
     * @return Store
     */
    public static function fromRequest(LoginRequest $request, int $code)
    {
        return new static([
            'phone' => $request->getPhone(),
            'verify_code' => $code,
            'step' => 3,
        ]);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user =  User::create($this->attr);
        Http::withBasicAuth(env('API_USERNAME'), env('API_PASSWORD'))
            ->post(env('WAREHOUSE_URL').'api/cart/create/'.$user->id);
        return $user;
    }
}
