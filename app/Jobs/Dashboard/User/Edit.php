<?php

namespace App\Jobs\Dashboard\User;

use App\User;
use Illuminate\Support\Arr;

use App\Http\Requests\Dashboard\User\Edit as EditRequest;



class Edit
{

    protected $user;
    protected $attr;

    public function __construct(User $user, array $attr = [])
    {
        $this->user = $user;
        $this->attr = Arr::only($attr, ['first_name', 'last_name', 'gender', 'birth_day', 'category_id', 'role_id']);
    }

    /**
     * @param User $user
     * @param EditRequest $request
     * @return static
     */
    public static function fromRequest(User $user, EditRequest $request)
    {
        return new static($user, [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'birth_day' => $request->birth_day,
            'category_id' => $request->category_id,
            'role_id' => $request->role_id
        ]);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->update($this->attr);
    }
}
