<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Models\Webhook;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function index()
    {
        $webhooks = Webhook::all();
        return view('webhooks.index', compact('webhooks'));
    }

    public function create(Request $request)
    {
        $type = $request->query('type');

        switch ($type) {
            case 'guru':
                $name = "Guru";
        }

        return view('webhooks.create', compact('name'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data['available'] = (!isset($data['available'])) ? 0 : 1;

        $webhook = new Webhook;
        $webhook->type = $data['type'];
        $webhook->name = $data['name'];
        $webhook->token = $data['token'];
        $webhook->offer = $data['offer'];
        $webhook->available = $data['available'];

        $webhook->save();

        return redirect()
            ->route('webhooks.index')
            ->withSuccess('Webhook Cadastrado com Sucesso!');
    }


    public function show($id)
    {
        $webhook = Webhook::find($id);
        return view('webhooks.show', compact('webhook'));
    }
}
