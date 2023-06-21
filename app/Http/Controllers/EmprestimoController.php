<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Aluno;
use App\Models\Livro;
use Illuminate\Http\Request;

class EmprestimoController extends Controller
{
    public function index(Request $request) {
        return view('emprestimos.index', ['emprestimos' => Emprestimo::orderBy('aluno_id', 'desc')->paginate(5)]);
    }

    public function create(Request $request) {
        $alunos = Aluno::all();
        $livros = Livro::all();
        $emprestimo = Emprestimo::all();

        return view('emprestimos.create', ['alunos'=>$alunos, 'livros'=>$livros, 'emprestimos'=>$emprestimo]);
    }

    public function store(Request $request) {
        //return $request->all();

        $obj                    = new Emprestimo();
        $obj->aluno_id          = $request->aluno_id;
        $obj->livro_id          = $request->livro_id;
        $obj->datahora          = $request->datahora;
        $obj->data_devolucao    = $request->data_devolucao;
        $obj->save();

        return redirect()->route('emprestimos.index');
    }

    public function edit(Request $request, $id) {
        $emprestimo = Emprestimo::findOrFail($id);
        return view('emprestimos.edit', ['emprestimo' => $emprestimo]);
    }

    public function update(Request $request, $aluno_id, $livro_id) {

        $obj = Emprestimo::where('aluno_id', $aluno_id)
                         ->where('livro_id', $livro_id)
                         ->update([
                            'aluno_id' => $request->aluno_id,
                            'livro_id' => $request->livro_id,
                            'datahora' => $request->datahora,
                            'data_devolucao' => $request->data_devolucao
                         ]);

        return redirect()->route('emprestimos.index');
    }

    public function delete(Request $request, $id) {
        $obj = Emprestimo::where('aluno_id', $aluno_id)
                         ->where('livro_id', $livro_id)
                         ->delete();

        return redirect()->route('emprestimos.index');
    }
}
