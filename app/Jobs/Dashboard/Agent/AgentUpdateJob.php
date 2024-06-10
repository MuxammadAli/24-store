<?php

namespace App\Jobs\Dashboard\Agent;

use App\Helpers\File;
use App\Http\Requests\Dashboard\Agent\AgentRequest;
use App\Models\Agent;

class AgentUpdateJob
{
    /**
     * @var array
     */
    private $attr;
    /**
     * @var Agent
     */
    private $agent;
    /**
     * @var mixed
     */
    private $categories;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(AgentRequest $req, Agent $agent)
    {
        $this->attr = $req->only(
            'first_name',
            'last_name',
            'patronymic',
            'birth_day',
            'gender',
            'address',
            'phone',
            'email',
            'username',
            'region_id'
        );
        if ($req->has('password'))
            $this->attr['password'] = bcrypt($req->input('password'));
        if ($req->hasFile('image')) {
            $this->attr['image'] = File::upload($req->file('image'), 'agents', 200);
            File::delete($agent->image);
        }

        if ($req->has('categories'))
            $this->categories = json_decode($req->input('categories'));

        $this->agent = $agent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->agent->update($this->attr);
        if (isset($this->categories)) {
            $this->agent->categories()->detach();
            $this->agent->categories()->attach($this->categories);
        }
    }
}
