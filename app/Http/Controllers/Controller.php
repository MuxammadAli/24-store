<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function info(string $text)
    {
        $this->sendAlert('info', $text);
    }

    protected function success(string $text)
    {
        $this->sendAlert('success', $text);
    }

    protected function error(string $text)
    {
        $this->sendAlert('error', $text);
    }

    private function sendAlert(string $type, string $text)
    {
        request()->session()->flash($type, $text);
    }

}
