<?php

namespace App\Http\Controllers;

use App\Models\Attacchment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttacchemntController extends Controller
{
    public function store(Request $request, $lesson)
    {
        $request->validate([
            'name' => 'required|min:3|max:20',
            'attacchment' => 'required|mimes:pdf,doc,docx'
        ]);


        $file = $request->file('attacchment');
        $filename = date('YmdHi') . '_' . $file->getClientOriginalName();

        $path = $file->storeAs(
            Auth::user()->tenant->subdomain . '/attacchments',
            $filename
        );

        $request->attacchment = $path;


        $attacchement = new Attacchment;
        $attacchement->lesson_id = $lesson;
        $attacchement->name = $request->name;
        $attacchement->path = $path;
        $attacchement->save();

        return redirect()->back()->withSuccess('Anexo enviado com sucesso!');
    }

    public function destroy($id)
    {

        $attacchement = Attacchment::find($id);
        $attacchement->delete();

        return redirect()->back()->withSuccess('Anexo deletado com sucesso!');
    }
}
