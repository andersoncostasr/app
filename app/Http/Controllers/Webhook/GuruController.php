<?php

namespace App\Http\Controllers\Webhook;

use App\Events\CreateUserEvent;
use App\Http\Controllers\Controller;
use App\Models\Payload;
use App\Tenant\ManagerTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index(Request $request)
    {

        $data = $request->all();

        $token = $data['payload']['api_token'];

        $webhook = DB::table('webhooks')
            ->where('token', $token)
            // ->where('available', true)
            ->first();

        //Webhook enviado diferente do cadastrado!
        if ($webhook == null) {
            return response()->json([
                'error' => 400,
                'message' => 'Token enviado diferente do token cadastrado.'
            ]);
        }

        // Verificar se o webhook está ativo no Guru
        if (!$webhook->available) {
            return response()->json([
                'error' => 400,
                'message' => 'Webhook desativado.'
            ]);
        }


        //Vamos pegar o Tenant
        $managerT = new ManagerTenant;
        $subdomain = $managerT->subdomain();
        $tenant = DB::table('tenants')
            ->where('subdomain', $subdomain)->first();


        // Vamos Salvar o Payload
        $payload = new Payload;
        $payload->tenant_id = $tenant->id;
        $payload->webhook_id = $webhook->id;
        $payload->type = 'Guru';
        $payload->data = json_encode($data['payload']);
        $payload->save();



        //Vamos pegar os dados do usuário
        $doc = $data['payload']['contact']['doc'];
        $email = $data['payload']['contact']['email'];
        $name = $data['payload']['contact']['name'];
        $phone_local_code = $data['payload']['contact']['phone_local_code'];
        $phone_number = $data['payload']['contact']['phone_number'];


        //Vamos pegar o status da venda
        $status = $data['payload']['status'];

        $data = [];
        $data['status'] = $status;
        $data['tenant_id'] = $tenant->id;
        $data['name'] = $name;
        $data['email'] = $email;
        $data['password'] = Hash::make($tenant->default_password);
        $data['isAdmin'] = false;

        // return response()->json($data);
        $user = CreateUserEvent::dispatch($data);
        return response()->json($user);
    }
}
