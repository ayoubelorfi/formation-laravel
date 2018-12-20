@extends('base')

@section('body')
    <div class="container mb-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{ $post->title }}
                        <a href="{{ route("post_update", ["post" => $post]) }}" class="btn btn-sm btn-primary mx-2 float-right">Modifier</a>
                        <a href="{{ route("post_delete", ["post" => $post]) }}" class="btn btn-sm btn-primary mx-2 float-right">Supprimer</a>
                    </div>
                    <div class="card-body">
                        {{ $post->content }}
                    </div>
                    <div class="list-group">
                        @foreach($post->comments as $comment)
                            <div class="list-group-item flex-column align-items-start rounded-0 border-left-0 border-right-0 border-bottom-0">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $comment->author }}</h5>
                                    <small>{{ $comment->created_at }}</small>
                                </div>
                                <p class="mb-1">{{ $comment->content }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-body border-top">
                        {!! Form::open(['route' => ['post_comment', $post]]) !!}
                        <div class="form-group {!! $errors->has('author') ? 'has-error' : '' !!}">
                            {!! Form::text('author', null, ['class' => 'form-control', 'placeholder' => 'Votre pseudo']) !!}
                            {!! $errors->first('author', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="form-group {!! $errors->has('content') ? 'has-error' : '' !!}">
                            {!! Form::textarea ('content', null, ['class' => 'form-control', 'placeholder' => 'Votre commentaire']) !!}
                            {!! $errors->first('content', '<small class="help-block">:message</small>') !!}
                        </div>
                        {!! Form::submit('Poster !', ['class' => 'btn btn-info pull-right']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection