@extends('layout.app')
@section('title','Criar novo Emprestimo')
@section('content')
    <h1>Realizar Empréstimo</h1>
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <br />
    {{Form::open(['route' => 'emprestimos.store', 'method' => 'POST','enctype'=>'multipart/form-data'])}}
        {{Form::label('contato_id', 'Contato')}}
        {{Form::text('contato_id','',['class'=>'form-control','required','placeholder'=>'Contato'])}}
        {{Form::label('livro_id', 'Livro')}}
        {{Form::text('livro_id','',['class'=>'form-control','required','placeholder'=>'Livro'])}}
        {{Form::label('datahora', 'Data')}}
        {{Form::textarea('datahora',\Carbon\Carbon::now()->format('d/m/Y H:i:s'),['class'=>'form-control','required','placeholder'=>'Data','rows'=>'8'])}}
        {{Form::label('obs', 'obs')}}
        {{Form::text('obs','',['class'=>'form-control','required','placeholder'=>'Observação'])}}
        <br />
        {{Form::submit('Salvar',['class'=>'btn btn-success'])}}
        {!!Form::button('Cancelar',['onclick'=>'javascript:history.go(-1)', 'class'=>'btn btn-secondary'])!!}
    {{Form::close()}}
@endsection
