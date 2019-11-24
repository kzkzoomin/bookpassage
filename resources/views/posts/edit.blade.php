@extends('layouts.app')

@section('content')

    <h1>投稿の編集</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'put']) !!}
        
                <div class="form-group">
                    {!! Form::label('sentence', '紹介したい一節：') !!}
                    {!! Form::text('sentence', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('book_title', 'タイトル:') !!}
                    {!! Form::text('book_title', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('book_author', '著者:') !!}
                    {!! Form::text('book_author', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('comment', 'コメント:') !!}
                    {!! Form::text('comment', null, ['class' => 'form-control']) !!}
                </div>
        
                {!! Form::submit('編集', ['class' => 'btn btn-primary']) !!}
        
            {!! Form::close() !!}
        </div>
    </div>
@endsection