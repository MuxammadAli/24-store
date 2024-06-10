<?php

namespace App\Jobs\Api\Auth;

use Illuminate\Support\Arr;
use App\Http\Requests\Api\Auth\Register as RegisterRequest;

use App\User;

class Register
{

    protected $user;
    protected $attr;

    public function __construct(User $user, array $attr = [])
    {
        $this->user = $user;
        $this->attr = Arr::only($attr, ['first_name', 'last_name', 'step', 'gender', 'avatar', 'birth_day']);
    }

    public static function fromRequest(RegisterRequest $request, User $user)
    {
        return new static($user, [
            'first_name' => $request->getFirstName(),
            'last_name' => $request->getLastName(),
            'step' => 3,
            'gender' => $request->getGender(),
            'avatar' => $request->getAvatar(),
            'birth_day' => $request->getBirthDay()
        ]);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return $this->user->update($this->attr);
    }
}
