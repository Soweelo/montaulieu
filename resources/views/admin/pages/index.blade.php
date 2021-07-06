@extends('layouts.cockpit')
@section('content')
    <div class="row">
        <div class="col-12 col-md-8">
            <h1 class="h1_admin">Gestion des pages</h1>
        </div>
        <div class="col-12 col-md-4 text-end">
            <a href="{{ action('App\Http\Controllers\Admin\PageController@create') }}" class="btn btn-primary btn-sm">
                Ajouter une page
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
                @foreach($pages as $page)
                    <tr>
                        <td>{{ $page->title }}</td>
                        <td>{{ $page->slug }}</td>
                        <td>{{ ($page->published == 0) ? 'Brouillon' : 'Publiée' }}</td>
                        <td>{{ $page->updated_at }}</td>
                        <td>
                            <a class="blue_action a_icon" href="{{ route('pages.edit', $page) }}" title="Editer la page'"><i class="bi bi-pencil-square"></i></a>
                            &nbsp;
                            @if($page->published == 0)
                                <a class="green_action a_icon" href="{{ route('pages.activate', $page) }}" title="Publier la page"><i class="bi bi-eye"></i></a>
                            @else
                                <a class="red_action a_icon" href="{{ route('pages.deactivate', $page) }}" title="Dépublier la page"><i class="bi bi-eye-slash"></i></a>
                            @endif
                            &nbsp;
                            <a class="red_action" a_icon title="Supprimer la page" href="{{ action('App\Http\Controllers\Admin\PageController@destroy', $page) }}"
                               data-method="delete" data-confirm="Voulez-vous vraiment supprimer cette page ?">
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

