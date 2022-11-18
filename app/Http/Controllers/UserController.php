<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        // $users = User::where('tenant_id', auth()->user()->tenant->id)->orderBy('isAdmin', 'desc')->withTrashed()->get();
        $users = User::where('tenant_id', auth()->user()->tenant->id)->orderBy('isAdmin', 'desc')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->all();

        $data['isAdmin'] = (!isset($data['isAdmin'])) ? 0 : 1;
        $data['password'] = Hash::make($data['password']);

        $user = new User;
        $user->tenant_id = Auth::user()->tenant_id;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->isAdmin = $data['isAdmin'];
        $user->save();

        return redirect()->route('users.index')->withSuccess('Usuário criado com sucesso!');
    }

    public function edit($id)
    {
        $user = User::find($id);
        if ($user)
            return view('users.edit', compact('user'));

        return redirect()
            ->route('users.index')
            ->withMessage('Usuário não encontrado para editar');
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        $data = $request->all();

        $data['isAdmin'] = (!isset($data['isAdmin'])) ? 0 : 1;
        $data['password'] = Hash::make($data['password']);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->isAdmin = $data['isAdmin'];

        $user->update();
        return redirect()
            ->route('users.index')
            ->withSuccess('Usuário editado com sucesso!');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->id == Auth::user()->id) {
            return redirect()
                ->route('users.index')
                ->withMessage('Você não pode deletar o próprio acesso!');
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->withSuccess('Usuário desativado com sucesso!');
    }
}
