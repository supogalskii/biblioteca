<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $numLivros = Livro::all()->count();
        $numContatos= Contato::all()->count();
        $numEmprestimos = Emprestimo::all()->count();
        return view('home',['numLivros'=>$numLivros,'numContatos',$numContatos,'numEmprestimos',$numEmprestimos]);
    }
}
