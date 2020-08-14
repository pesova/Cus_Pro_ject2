<?php

namespace App\Http\Middleware;

use App\Http\Controllers\redirect;
use Closure;

class BackendAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $expires = $request->cookie('expires');
        $expires = intval($expires);

        if ($request->cookie('api_token') && $expires > time()) {

            // Uncomment below when sms verification is working
            if (!$request->cookie('is_active') && $request->path() != 'admin/activate') {
                return redirect()->route('activate.index');
            }

            // makes sure a store admin selects a store before seeing the dashboard
            if (is_store_admin() && !has_selected_store() && $request->url() !== route('store.index') && $request->url() !== route('store.select')) {
                return redirect()->route('store.index');
            }
            return $next($request);
        }
        return redirect()->route('logout')->with('message', 'Permission Denied!!! You need to login first.');
    }
}
