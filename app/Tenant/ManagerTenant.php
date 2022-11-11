<?php

namespace App\Tenant;

use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

class ManagerTenant
{
    public function getTenantIdentify()
    {
        return auth()->user()->tenant->id;
    }


    public function getTenant(): Tenant
    {
        return auth()->user()->tenant;
    }


    public function tenant()
    {
        $subdomain = $this->subdomain();

        $tenant = Tenant::where('subdomain', $subdomain)->first();
        return $tenant;
    }


    public function subdomain()
    {
        $piecesHost = explode('.', request()->getHost());
        return $piecesHost['0'];
    }


    public function isSubdomainMain()
    {
        $subdomain = $this->subdomain();
        $subdomainMain = config('tenant.subdomain_main');

        return $subdomain == $subdomainMain;
    }


    public function isSubdomainUser()
    {
        $subdomain = $this->subdomain();
        $userSubdomain = Auth::user()->tenant->subdomain;

        return $subdomain == $userSubdomain;
    }

    public function isNotSubdomain()
    {
        $piecesHost = explode('.', request()->getHost());
        $count = count($piecesHost);
        if ($count == 2)
            return true;
        return false;
    }
}
