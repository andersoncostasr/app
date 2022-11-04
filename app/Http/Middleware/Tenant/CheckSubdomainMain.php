<?php

namespace App\Http\Middleware\Tenant;

use App\Tenant\ManagerTenant;
use Closure;
use Illuminate\Http\Request;

class CheckSubdomainMain
{

    public function handle(Request $request, Closure $next)
    {
        $managerT = new ManagerTenant;

        if (!$managerT->isSubdomainMain()) {
            abort(401);

            return;
        }

        return $next($request);
    }
}
