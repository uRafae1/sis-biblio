<?php

namespace App\Http\Controllers;

use App\Models\Telefone;
use App\Models\Aluno;
use Illuminate\Http\Request;

class TelefoneController extends Controller
{
    public function index(Request $request) {
        return view('telefones.index', ['telefones' => Telefone::orderBy('id', 'desc')->paginate(5)]);
    }

    public function create(Request $request) {
        $alunos = Aluno::all();
        return view('telefones.create', ['alunos'=>$alunos]);
    }

    public function store(Request $request) {
        //return $request->all();

        $obj            = new Telefone();
        $obj->nome      = $request->nome;
        $obj->numero    = $request->numero;
        $obj->aluno_id  = $request->aluno_id;
        $obj->save();

        return redirect()->route('telefones.index');
    }

    public function edit(Request $request, $id) {
        $telefone = Telefone::findOrFail($id);
        return view('telefones.edit', ['telefone' => $telefone]);
    }

    public function update(Request $request, $id) {

        $obj            = Telefone::findOrFail($id);
        $obj->nome      = $request->nome;
        $obj->numero    = $request->numero;
        $obj->aluno_id  = $request->aluno_id;
        $obj->save();

        return redirect()->route('telefones.index');
    }

    public function delete(Request $request, $id) {
        $obj = Telefone::findOrFail($id);
        $obj->delete();

        return redirect()->route('telefones.index');
    }
}
