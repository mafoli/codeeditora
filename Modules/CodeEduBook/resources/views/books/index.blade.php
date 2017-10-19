@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h3>Listagem de Livros</h3>
        {!! Button::primary('Novo Livro')->asLinkTo(route('books.create')) !!}
    </div>
    <div class="row">
        {!! Form::model(compact('search'),['class' => 'form-inline','method' => 'GET']) !!}
        {!! Form::label('search','Pesquisa',['class' => 'control-label']) !!}
        {!! Form::text('search',null,['class' => 'form-control']) !!}

        {!! Button::info('Buscar')->submit()!!}
        {!! Form::close() !!}
    </div>

    <div class="row">
        {!! Table::withContents($books->items())
        ->callback('Ações',function ($field,$book){
        $linkEdit = route('books.edit',['book' => $book->id]);
        $linkDestroy = route('books.destroy',['book' => $book->id]);
        $deleteForm ="delete-form-{$book->id}";
        $form = Form::open(['route' => ['books.destroy', 'book'=>$book->id],
                                        'method' => 'DELETE', 'id' => $deleteForm,'style' =>'display:none']).
                Form::close();
                $anchorDestroy = Button::link('Deletar')->asLinkTo($linkDestroy)->addAttributes([
                'onclick' => "event.preventDefault();document.getElementById(\"{$deleteForm}\").submit();"
                ]);
        return "<ul class=\"list-inline\">".
                "<li>".Button::link('Editar')->asLinkTo($linkEdit)."</li>".

                 "<li>".$anchorDestroy."</li>".
                 "</ul>".
                 $form;
        }) !!}


        {{$books->links()}}

    </div>
</div>
@endsection
