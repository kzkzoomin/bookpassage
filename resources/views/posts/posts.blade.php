<ul class="list-unstyled">
    @foreach ($posts as $post)
        <li class="media mb-3">
            <img class="mr-2 rounded" src="{{ Gravatar::src($post->user->email, 50) }}" alt="">
            <div class="media-body">
                <div>
                    {!! link_to_route('users.show', $post->user->name, ['id' => $post->user->id]) !!} <span class="text-muted">posted at {{ $post->created_at }}</span>
                </div>
                <div>
                    <h2 class="mb-0">{!! nl2br(e($post->sentence)) !!}</h2>
                    <p class="mb-0">著者：{!! nl2br(e($post->book_author)) !!}</p>
                    <p class="mb-0">タイトル：{!! nl2br(e($post->book_title)) !!}</p>
                    <p class="mb-0">コメント：{!! nl2br(e($post->comment)) !!}</p>
                </div>
                <div>
                    @if (Auth::id() == $post->user_id)
                        {!! link_to_route('posts.edit', 'このメッセージを編集', ['id' => $post->id], ['class' => 'btn btn-light']) !!}
                        {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
            
        </li>
    @endforeach
</ul>
{{ $posts->links('pagination::bootstrap-4') }}