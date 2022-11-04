<?php

namespace App\Tenant;

use App\Models\Tenant;

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

    public function subdomain()
    {
        //http://kd.subdomain-multi-tenancy.test
        $piecesHost = explode('.', request()->getHost());
        return $piecesHost['0'];
    }

    public function tenant()
    {
        $subdomain = $this->subdomain();

        $tenant = Tenant::where('subdomain', $subdomain)->first();
        return $tenant;
    }

    public function isSubdomainMain()
    {
        $subdomain = $this->subdomain();
        $subdomainMain = config('tenant.subdomain_main');

        return $subdomain == $subdomainMain;
    }
}
