<?php

namespace App\Http\Middleware\Tenant;

use App\Tenant\ManagerTenant;
use Closure;
use Illuminate\Http\Request;

class TenantMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $managerT = \app(ManagerTenant::class);
        $isNotSubdomain = $managerT->isNotSubdomain();

        // Se isNotSubdomain retornar falso, ele verifica se o tenant existe e se não existe redireciona pra 404
        if (!$isNotSubdomain) {
            $tenant = $managerT->tenant();

            if (!$tenant && $request->url() != route('tenant.404')) {
                return redirect()->route('tenant.404');
            }

            return $next($request);
        }

        //Obviamente o isNotSubdomain retornou true, e nós estamos no dominio principal (carrega a home welcome)
        return $next($request);
    }
}
