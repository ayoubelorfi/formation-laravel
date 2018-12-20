@extends('base')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Liste des articles
                        <a href="{{ route("post_add") }}" class="btn btn-sm btn-primary float-right">Ajouter</a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td>
                                        <a href="{{ route("post_show", ["post" => $post]) }}" class="btn btn-sm btn-primary mx-2">Voir</a>
                                        <a href="{{ route("post_update", ["post" => $post]) }}" class="btn btn-sm btn-primary mx-2">Modifier</a>
                                        <a href="{{ route("post_delete", ["post" => $post]) }}" class="btn btn-sm btn-primary mx-2">Supprimer</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection