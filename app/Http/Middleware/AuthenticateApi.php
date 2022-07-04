<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateApi extends Middleware
{
    /**
     * @param $request
     * @param array $guards
     * @return void
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate($request, array $guards)
    {
        $token = $request->query('api_token');

        if (empty($token)) {
            $token = $request->input('api_token');
        }

        if (empty($token)) {
            $token = $request->bearerToken();
        }

        if ($token === config('apitokens')[0]) return;
        $this->unauthenticated($request, $guards);
    }
}
