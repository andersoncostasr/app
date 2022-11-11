<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubdomainVerification;
use App\Models\Tenant;
use App\Tenant\ManagerTenant;
use Illuminate\Support\Facades\Redirect;

class SubdomainController extends Controller
{
    public function index()
    {
        $managerT = new ManagerTenant;
        $subdomain = $managerT->isNotSubdomain();
        // dd($subdomain);

        if (!$subdomain) {
            return redirect()->route('login');
        }

        return view('subdomain_login');
    }

    public function verification(SubdomainVerification $request)
    {
        $subdomain = strtolower($request->subdomain);
        $tenant = Tenant::where('subdomain', $subdomain)->first();

        if ($tenant) {
            $url = 'http://' . $tenant->subdomain . '.' . env('CLEAR_APP_URL') . '/login';
            return Redirect::to($url);
        }


        return redirect()
            ->route('sub.login')
            ->withErrors('Empresa não encontrada!');
    }
}
