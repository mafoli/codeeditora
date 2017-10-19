@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h3>Listagem de Categorias</h3>
        {!! Button::primary('Nova Categoria')->asLinkTo(route('categories.create')) !!}


    </div>
    <div class="row">
        {!! Table::withContents($categories->items())
        ->callback('Ações',function ($field,$category){
        $linkEdit = route('categories.edit',['category' => $category->id]);
        $linkDestroy = route('categories.destroy',['category' => $category->id]);
        $deleteForm ="delete-form-{$category->id}";
        $form = Form::open(['route' => ['categories.destroy', 'category'=>$category->id],
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


        {{$categories->links()}}

    </div>
</div>
@endsection
