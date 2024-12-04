<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Services\UserService;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
}
