@if (Auth::id() != $post->id)
    @if (Auth::user()->liked($post->id))
        {!! Form::open(['route' => ['favorites.unlike', $post->id], 'method' => 'delete']) !!}
            {!! Form::submit('お気に入り解除', ['class' => "btn btn-success btn-sm"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['favorites.like', $post->id]]) !!}
            {!! Form::submit('お気に入り', ['class' => "btn btn-secondary btn-sm"]) !!}
        {!! Form::close() !!}
    @endif
@endif