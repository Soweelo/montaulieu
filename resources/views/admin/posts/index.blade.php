@extends('layouts.cockpit')
@section('content')
    <div class="row">
        <div class="col-12 col-md-8">
            <h1 class="h1_admin">Gestion des articles</h1>
        </div>
        <div class="col-12 col-md-4 text-end">
            <a href="{{ action('App\Http\Controllers\Admin\PostController@create') }}" class="btn btn-primary btn-sm">
                Ajouter un article
            </a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Titre</th>
                    <th>Url</th>
                    <th>Publié</th>
                    <th>Dernière modif</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ ($post->published == 0) ? 'Brouillon' : 'Publiée' }}</td>
                        <td>{{ $post->updated_at }}</td>
                        <td>
                            <a class="blue_action a_icon" href="{{ route('posts.edit', $post) }}" title="Editer l'article'"><i class="bi bi-pencil-square"></i></a>
                            &nbsp;
                            @if($post->published == 0)
                                <a class="green_action a_icon" href="{{ route('posts.activate', $post) }}" title="Publier l'article"><i class="bi bi-eye"></i></a>
                            @else
                                <a class="red_action a_icon" href="{{ route('posts.deactivate', $post) }}" title="Dépublier l'article'"><i class="bi bi-eye-slash"></i></a>
                            @endif
                            &nbsp;
                            <a class="red_action" a_icon title="Supprimer l'article" href="{{ action('App\Http\Controllers\Admin\PostController@destroy', $post) }}"
                               data-method="delete" data-confirm="Voulez-vous vraiment supprimer cet article ?">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
@endsection

