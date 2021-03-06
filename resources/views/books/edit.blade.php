@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Livro</h3>

            {!! Form::model($book,['route' =>[ 'books.update','book' => $book -> id
            ],'class' => 'form','method' => 'PUT']) !!}

            @include('books._form')

            {!! Html::openFormGroup() !!}
            {!! Button::info('Salvar Categoria')->submit()!!}
            {!! Html::closeFormGroup() !!}

        </div>
        {!! Form::close() !!}

    </div>
@endsection