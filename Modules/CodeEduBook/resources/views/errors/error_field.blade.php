<span class="help-block">
    @if(str_contains($field,'*'))
                    {{$errors->first($field)}}
        @else
        <ul>
        @foreach($errors->get($field) as $fieldErrors)
            <li>{{$fieldErrors[0]}}</li>
        @endforeach
        </ul>
    @endif
                </span>