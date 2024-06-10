<?php

namespace App\Jobs\Api\User;


use App\User;
use Illuminate\Support\Arr;

use App\Http\Requests\Api\User\Update as UpdateRequest;

class Update
{

    protected $attr;
    protected $user;

    public function __construct(User $user, array $attr = [])
    {
        $this->user = $user;
        $this->attr = Arr::only($attr, ['last_name', 'first_name', 'avatar', 'category_id', 'language', 'notification', 'gender', 'ip', 'birth_day']);
    }

    /**
     * @param UpdateRequest $request
     * @param User $user
     * @param $path
     * @return Update
     */
    public static function fromRequest(UpdateRequest $request, User $user, $path)
    {
        return new static($user, [
            'first_name' => $request->getFirstName(),
            'last_name' => $request->getLastName(),
            'avatar' => $path,
            'category_id' => $request->getCategory(),
            'birth_day' => $request->getBirthDay(),
            'language' => $request->getLanguages(),
            'notification' => $request->getNotification(),
            'gender' => $request->getGender(),
            'ip' => $request->ip()
        ]);
    }

    /**
     * @return bool
     */
    public function handle()
    {
        return $this->user->update($this->attr);
    }
}
