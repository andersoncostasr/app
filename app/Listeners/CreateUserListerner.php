<?php

namespace App\Listeners;

use App\Events\CreateUserEvent;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateUserListerner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CreateUserEvent  $event
     * @return void
     */
    public function handle(CreateUserEvent $event)
    {
        $dataUser = $event->data;

        $user = User::where('email', $dataUser['email'])->first();
        if (!$user && $dataUser['status'] == 'approved') {
            $user = new User;
            $user->tenant_id = $dataUser['tenant_id'];
            $user->name = $dataUser['name'];
            $user->email = $dataUser['email'];
            $user->password = $dataUser['password'];
            $user->isAdmin = $dataUser['isAdmin'];
            $user->save();

            return $user;
        }
        if ($user && $dataUser['status'] == 'chargeback' || $dataUser['status'] == 'refunded') {
            $user->isActive = false;
            $user->save();
            return $user;
        }
        return response()->json([
            'error' => 400,
            'message' => 'Usuário ja cadastrado ou status da venda não encontrado'
        ]);
    }
}
