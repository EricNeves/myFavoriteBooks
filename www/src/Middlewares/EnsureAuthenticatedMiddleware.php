<?php

namespace App\Middlewares;

use App\Http\Request;
use App\Http\Response;

class EnsureAuthenticatedMiddleware
{
    public function handle(Request $request, Response $respose)
    {
        $request->setUser(['id' => 1, 'name' => 'John Doe']);
    }
}
