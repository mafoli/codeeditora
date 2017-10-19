@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h3>Listagem de Livros</h3>

    </div>
    <div class="row">
        {!! Form::model(compact('search'),['class' => 'form-inline','method' => 'GET']) !!}
        {!! Form::label('search','Pesquisa',['class' => 'control-label']) !!}
        {!! Form::text('search',null,['class' => 'form-control']) !!}

        {!! Button::info('Buscar')->submit()!!}
        {!! Form::close() !!}
    </div>

    <div class="row">
        @if($books->count() > 0)
        {!! Table::withContents($books->items())
        ->callback('Ações',function ($field,$book){
        $linkEdit = route('books.edit',['book' => $book->id]);
        $linkRestore = route('books.destroy',['book' => $book->id]);
        $restoreForm ="restore-form-{$book->id}";
        $form = Form::open(['route' => ['trashed.books.update', 'book'=>$book->id],
                                        'method' => 'PUT', 'id' => $restoreForm,'style' =>'display:none']).
                Form:: hidden('redirect_to',URL::previous()).
                Form::close();
                $anchorRestore = Button::link('Restaurar')->asLinkTo($linkRestore)->addAttributes([
                'onclick' => "event.preventDefault();document.getElementById(\"{$restoreForm}\").submit();"
                ]);
        return "<ul class=\"list-inline\">".
                "<li>".Button::link('Editar')->asLinkTo($linkEdit)."</li>".

                 "<li>".$anchorRestore."</li>".
                 "</ul>".
                 $form;
        }) !!}

        @else
            <div class="well well-lg">Lixeira vazia</div>
        @endif



        {{$books->links()}}

    </div>
</div>
@endsection
