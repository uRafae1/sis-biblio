<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Emprestimo;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index(Request $request) {
        return view('livros.index', ['livros' => Livro::orderBy('id', 'desc')->paginate(5)]);
    }

    public function create(Request $request) {
        return view('livros.create');
    }

    public function store(Request $request) {
        //return $request->all();

        $obj            = new Livro();
        $obj->nome      = $request->nome;
        $obj->autor     = $request->autor;
        $obj->isbn      = $request->isbn;
        $obj->save();

        return redirect()->route('livros.index');
    }

    public function edit(Request $request, $id) {
        $livro = Livro::findOrFail($id);
        return view('livros.edit', ['livro' => $livro]);
    }

    public function update(Request $request, $id) {

        $obj            = Livro::findOrFail($id);
        $obj->nome      = $request->nome;
        $obj->autor     = $request->autor;
        $obj->isbn      = $request->isbn;
        $obj->save();

        return redirect()->route('livros.index');
    }

    public function delete(Request $request, $id) {
        $obj = Livro::findOrFail($id);

        $emprestimo = Emprestimo::where('livro_id', $obj->id)->delete();

        $obj->delete();

        return redirect()->route('livros.index');
    }
}
