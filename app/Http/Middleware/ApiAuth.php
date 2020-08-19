<?php

namespace App\Http\Middleware;

use App\Models\Admins;
use App\Models\Assistants;
use Closure;

class ApiAuth
{
    private $unauthorizedResponse =  [
        'status' => false,
        'message' => 'access denied',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->headers->has('x-access-token')) {
            return response()->json($this->unauthorizedResponse, 401);
        }

        $api_token = $request->header('x-access-token');

        $user = Admins::where('api_token', $api_token)->firstor(function ($api_token) {
            $user = Assistants::where('api_token', $api_token)->firstor(function () {
                return response()->json($this->unauthorizedResponse, 401);
            });

            return $user;
        });

        $request->merge([
            'request_user_id' => $user->_id,
            'request_user_role' => $user->local['user_role'],
        ]);

        return $next($request);
    }
}
