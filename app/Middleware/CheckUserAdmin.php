<?php

namespace App\Middleware;

use App\Core\Auth;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Middleware\Middleware;
use App\Core\Routing\Router;

class CheckUserAdmin extends Middleware
{
    public function handle(Request $request, Response $response, callable $handler)
    {
        if (! Auth::getUser()->isAdmin())
            Router::redirect('home');

        return $handler($request, $response);
    }
}