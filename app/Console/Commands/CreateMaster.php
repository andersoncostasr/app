<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateMaster extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:master';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create master user in db';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tenant = Tenant::where('subdomain', env('TENANT_SUBDOMAIN'))->first();
        if ($tenant === null) {
            $master_tenant = new Tenant;
            $master_tenant->subdomain = env('TENANT_SUBDOMAIN');
            $master_tenant->name = env('TENANT_NAME');
            $master_tenant->cnpj = env('TENANT_CNPJ');
            $master_tenant->save();
            $this->info("tenant master criado com sucesso: {$master_tenant->subdomain}");

            $tenant_user = Tenant::where('subdomain', env('TENANT_SUBDOMAIN'))->first();

            $user = new User;
            $user->tenant_id =  $tenant_user->id;
            $user->name = env('TENANT_NAME');
            $user->email = env('TENANT_EMAIL');
            $user->password = Hash::make(env('TENANT_PASSWORD'));
            $user->isAdmin = 1;
            $user->save();

            $this->info("user master criado com sucesso: {$user->email}");
        } else {
            $this->info("o tenant master já existe na base de dados: {$tenant->subdomain}");
        }
    }
}
