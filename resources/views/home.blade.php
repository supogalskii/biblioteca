@extends('layouts.app')
@section('title','Biblioteca')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-11 bg-secondary text-light">
            <div class="fluid px-3 my-2 h4">{{ __('Dashboard') }}</div>
            <div class="row text-center h5">
                <div class="col m-3 bg-info text-light">
                    <div class="card-header p-2">Livros</div>
                    <div class="card-body h3 p-5">
                        {{$numLivros}}
                    </div>
                </div>
                <div class="col m-3 bg-white text-black">
                    <div class="card-header p-2">Contatos</div>
                    <div class="card-body h3 p-5">
                        {{$numContatos}}
                    </div>
                </div>
                <div class="col m-3 bg-warning text-black">
                    <div class="card-header p-2">Empréstimos</div>
                    <div class="card-body h3 p-5">
                        {{$numEmprestimos}}
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col m-3 bg-light text-black">
                    <div class="card-header p-2 h5">Empréstimos a devolver</div>
                    <div class="card-body ">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>Id</th>
                                <th>Contato</th>
                                <th>Livro</th>
                                <th>Data</th>
                                <th>Devolução</th>
                            </tr>
                            @foreach ($emprestimosadevolver as $emprestimo)
                            <tr>
                                <td>
                                   {{$emprestimo->id}}
                                </td>
                                <td>
                                    {{$emprestimo->contato_id}} - {{$emprestimo->contato->nome}}
                                </td>
                                <td>
                                    {{$emprestimo->livros_id}} - {{$emprestimo->livro->titulo}}
                                </td>
                                <td>
                                    {{\Carbon\Carbon::create($emprestimo->datahora)->format('d/m/Y H:i:s')}}
                                </td>
                                <td>{!!$emprestimo->devolvido!!}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
        </div>
    </div>
@endsection