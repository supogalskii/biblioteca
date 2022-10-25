<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Emprestimo;
use App\Models\Contato;
use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class EmprestimosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emprestimos = Emprestimo::simplepaginate(5);
        return view('emprestimo.index',array('emprestimos' => $emprestimos,'busca'=>null));
        return redirect('login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buscar(Request $request) {
        $emprestimos = Emprestimo::join('contatos','contatos.id','=','emprestimos.contato_id')
                    ->join('livros','livros.id','=','emprestimos.livros_id')
                    ->select('emprestimos.*','contatos.nome','livros.titulo')
                    ->where('contato_id','=',$request->input('busca'))
                    ->orwhere('livros_id','=',$request->input('busca'))
                    ->orwhere('obs','LIKE','%'.$request->input('busca').'%')->orwhere('contatos.nome','LIKE','%'.$request->input('busca').'%')
                    ->orwhere('livros.titulo','LIKE','%'.$request->input('busca').'%')
                    ->simplepaginate(5);
        return view('emprestimo.index',array('emprestimos' => $emprestimos,'busca'=>$request->input('busca')));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(((Auth::check())&&(Auth::user()->isAdmin))) {
            $contatos = Contato::all();
            $livros = Livro::all();
            return view('emprestimo.create',['contatos'=>$contatos,'livros'=>$livros]);
        } else {
            return redirect('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(((Auth::check())&&(Auth::user()->isAdmin))) {
            $this->validate($request,[
                'contato_id' => 'required',
                'livros_id' => 'required',
                'datahora' => 'required'
            ]);
            $emprestimo = new Emprestimo();
            $emprestimo->contato_id = $request->input('contato_id');
            $emprestimo->livros_id = $request->input('livros_id');
            $emprestimo->datahora = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $request->input('datahora'));
            $emprestimo->obs = $request->input('obs');
            $emprestimo->datadevolucao = null;

            if($emprestimo->save()) {
                return redirect('emprestimos');
            }
        } else {
            return redirect('login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param  \App\Models\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emprestimo = Emprestimo::find($id);
        return view('emprestimo.show',array('emprestimo' => $emprestimo,'busca'=>null));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function edit(Emprestimo $emprestimo)
    {
        //
    }

/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
    *  @return \Illuminate\Http\Response
     */
    public function devolver(Request $request, $id)
    {
        if(((Auth::check())&&(Auth::user()->isAdmin))) {
            $emprestimo = Emprestimo::find($id);
            $emprestimo->datadevolucao = \Carbon\Carbon::now();
            $emprestimo->save();

            if($emprestimo->save()) {
                Session::flash('mensagem','Empréstimo Devolvido');
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emprestimo $emprestimo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if(((Auth::check())&&(Auth::user()->isAdmin))) {
            $emprestimo = Emprestimo::find($id);

            $emprestimo->delete();
            Session::flash('mensagem','Empréstimo Excluído com Sucesso');
            return redirect(url('emprestimos/'));
        } else {
            return redirect('login');
        }
    }
}
