<?php

namespace App\Jobs\Dashboard\Agent;

use App\Helpers\File;
use App\Http\Requests\Dashboard\Agent\AgentRequest;
use App\Models\Agent;
use App\Models\Supplier;

class AgentStoreJob
{

    /**
     * @var array
     */
    private $attr;
    /**
     * @var mixed
     */
    private $categories;

    /**
     * Create a new job instance.
     *
     * @param AgentRequest $req
     */
    public function __construct(AgentRequest $req)
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
        $this->attr['supplier_id'] = Supplier::where('supplier_id', $req->input('supplier_id'))->first()->id;
        $this->attr['password'] = bcrypt($req->input('password'));
        if ($req->hasFile('image'))
            $this->attr['image'] = File::upload($req->file('image'), 'agents', 200);
        if ($req->has('categories'))
            $this->categories = json_decode($req->input('categories'));
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $agent = Agent::create($this->attr);
        if (isset($this->categories))
            $agent->categories()->attach($this->categories);
    }
}
