<?php

namespace App\Observers\Tenant;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Model;

class TenantObserver
{
    public function creating(Model $model)
    {
        $tenant = new ManagerTenant;
        $model->setAttribute('tenant_id', $tenant->getTenantIdentify());
    }
}
