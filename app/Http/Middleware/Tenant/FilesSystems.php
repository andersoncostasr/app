<?php

namespace App\Http\Middleware\Tenant;

use App\Tenant\ManagerTenant;
use Closure;
use Illuminate\Http\Request;
use League\Flysystem\Config;

class FilesSystems
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check())
            $this->setFileSystemRoot();

        return $next($request);
    }

    public function setFileSystemRoot()
    {
        $tenant = new ManagerTenant;

        config()->set(
            'filesystem.disks.tenant.root',
            storage_path('app/public/tenants/' . $tenant->getTenant()->uuid)
        );
    }
}
