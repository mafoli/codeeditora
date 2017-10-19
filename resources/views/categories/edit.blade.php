@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Categoria</h3>

            {!! Form::model($category,['route' =>[ 'categories.update','category' => $category -> id
            ],'class' => 'form','method' => 'PUT']) !!}

            @include('categories._form')

            {!! Html::openFormGroup() !!}
            {!! Button::info('Salvar Categoria')->submit()!!}
            {!! Html::closeFormGroup() !!}

        </div>
        {!! Form::close() !!}

    </div>
@endsection