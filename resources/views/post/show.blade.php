@extends('base')

@section('body')
    <div class="container">
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
                </div>

                @foreach($post->comments as $comment)
                    <div class="card my-2">
                        <div class="card-header">
                            Par {{ $comment->author }}
                        </div>
                        <div class="card-body">
                            {{ $comment->content }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection