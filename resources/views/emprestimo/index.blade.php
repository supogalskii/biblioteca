@extends('layout.app')
@section('title','Emprestimos')
@section('content')
    <h1>Emprestimos</h1>
    @if(Session::has('mensagem'))
        <div class="alert alert-info">
            {{Session::get('mensagem')}}
        </div>
    @endif
    {{Form::open(['url'=>'emprestimos/buscar','method'=>'GET'])}}
        <div class="row">
            <div class="col-sm-3">
                <a class="btn btn-success" href="{{url('emprestimos/create')}}">Criar</a>
            </div>
            <div class="col-sm-9">
                <div class="input-group ml-5">
                    @if($busca !== null)
                        &nbsp;<a class="btn btn-info" href="{{url('emprestimos/')}}">Todos</a>&nbsp;
                    @endif
                    {{Form::text('busca',$busca,['class'=>'form-control','required','placeholder'=>'buscar'])}}
                    &nbsp;
                    <span class="input-group-btn">
                        {{Form::submit('Buscar',['class'=>'btn btn-secondary'])}}
                    </span>
                </div>
            </div>
        </div>
    {{Form::close()}}
    <br />
    <table class="table table-striped">
        @foreach ($emprestimos as $emprestimo)
            <tr>
                <td>
                    <a href="{{url('emprestimos/'.$emprestimo->id)}}">{{$emprestimo->id}}</a>
                </td>
                <td>
                    {{$emprestimo->contato_id}} - {{$emprestimo->contato->nome}}
                </td>
                <td>
                    {{$emprestimo->livros_id}} - {{$emprestimo->livro->titulo}}
                </td>
                <td>
                    {{$emprestimo->datahora}}
                </td>
            </tr>
        @endforeach
    </table>
    {{ $emprestimos->links() }}
@endsection