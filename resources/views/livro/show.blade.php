@extends('layout.app')
@section('title','Livro - '.$livro->titulo)
@section('content')
    <div class="card w-50">
        @php
            $nomeimagem = "";
            if(file_exists("./img/livros/".md5($livro->id).".jpg")) {
                $nomeimagem = "./img/livros/".md5($livro->id).".jpg";
            } elseif (file_exists("./img/livros/".md5($livro->id).".png")) {
                $nomeimagem = "./img/livros/".md5($livro->id).".png";
            } elseif (file_exists("./img/livros/".md5($livro->id).".gif")) {
                $nomeimagem =  "./img/livros/".md5($livro->id).".gif";
            } elseif (file_exists("./img/livros/".md5($livro->id).".webp")) {
                $nomeimagem = "./img/livros/".md5($livro->id).".webp";
            } elseif (file_exists("./img/livros/".md5($livro->id).".jpeg")) {
                $nomeimagem = "./img/livros/".md5($livro->id).".jpeg";
            } else {
                $nomeimagem = "./img/livros/livrosemfoto.webp";
            }
            //echo $nomeimagem;
        @endphp

        {{Html::image(asset($nomeimagem),'Foto de '.$livro->titulo,["class"=>"img-thumbnail w-75 mx-auto d-block"])}}

        <div class="card-header">
            <h1>Livro - {{$livro->titulo}}</h1>
        </div>
        <div class="card-body">
                <h3 class="card-title">ID: {{$livro->id}}</h3>
                <p class="text">Descrição: {{$livro->descricao}}</p>
                Autor: {{$livro->autor}}<br/>
                Aditora: {{$livro->editora}}<br/>
                Ano: {{$livro->ano}}</p>
        </div>
        <div class="card-footer">
            {{Form::open(['route' => ['livros.destroy',$livro->id],'method' => 'DELETE'])}}
            @if ($nomeimagem !== "./img/livros/livrosemfoto.webp")
               {{Form::hidden('foto',$nomeimagem)}}
            @endif
            <a href="{{url('livros/'.$livro->id.'/edit')}}" class="btn btn-success">Alterar</a>
            {{Form::submit('Excluir',['class'=>'btn btn-danger','onclick'=>'return confirm("Confirma exclusão?")'])}}
            <a href="{{url('livros/')}}" class="btn btn-secondary">Voltar</a>
            {{Form::close()}}
        </div>
    </div>
@endsection