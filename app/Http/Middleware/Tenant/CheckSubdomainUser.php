<?php

namespace App\Http\Middleware\Tenant;

use App\Tenant\ManagerTenant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckSubdomainUser
{

    public function handle(Request $request, Closure $next)
    {
        $managerT = new ManagerTenant;

        // Foi colocado pra saber se a chamada vem de uma API
        $isRequestApi = Str::contains($request->getRequestUri(),  'api');

        // Quando o subdominio é diferente do subdominio do usuário aborta ou retorna na api o erro!
        if (!$managerT->isSubdomainUser()) {
            if ($isRequestApi)
                return response()->json([
                    'error' => 'Forbidden',
                    'errorCode' => 403,
                    'message' => 'client authenticated but does not have permission to access the requested resource'
                ], 403);

            abort(403);
            return;
        }

        return $next($request);
    }
}
