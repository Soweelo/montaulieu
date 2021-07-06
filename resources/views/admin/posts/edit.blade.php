@extends('layouts.cockpit')
@section('content')
    <div class="row">
        <div class="col--12 col-md-8">
            <h1 class="h1_admin">Modification de l'article</h1>
        </div>
        <div class="col-12 col-md-4 text-end">
            <a href="{{ route('posts.index') }}" class="btn btn-warning bnt-sm">Retour à la liste des articles</a>
        </div>
    </div>
    <div class="row" style="margin-top: 15px; margin-bottom: 100px">
        <div class="col">
            <form action="{{ route('posts.update', $post) }}" method="POST">
                <input type="hidden" name="_method" value="put">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Titre de l'article</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title" value="{{ $post->title }}">
                    </div>
                </div>
                <div class="form-group row mt-3">
                    <label class="col-sm-2 col-form-label">Châpeau</label>
                    <div class="col-sm-10">
                        <textarea name="excerpt" class="form-control" rows="5">{{ $post->excerpt }}</textarea>
                    </div>
                </div>
                <div class="form-group row mt-3">
                    <label class="col-sm-2 col-form-label">Contenu</label>
                    <div class="col-sm-10">
                        <textarea data-id="{{ $post->id }}" data-type="{{ get_class($post) }}" data-url="{{ route('attachments.store') }}"
                                  name="content" class="form-control editor" rows="15">{{ $post->content }}</textarea>
                    </div>
                </div>
                <button class="btn btn-primary">Enregistrer</button>
            </form>

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h2 class="h2_admin">Visuels</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12 alert alert-info">
            L'article peut être illusté par une photo (format jpg ou png) ou une vidéo avec un code d'intégration provenant de Youtube, Vimeo, ...
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-6">
            <h3 class="h3_admin">
                Image illustrant l'article
            </h3>
            <form action="{{ route('posts.uploadImage', $post) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Fichier image</label>
                    <div class="col-sm-8">
                        <input type="file" name="image">
                    </div>
                </div>
                <div class="mt-1">
                    <button class="btn btn-success">Enregistrer l'image</button>
                </div>
            </form>

        </div>
        <div class="col-6">
            <h3 class="h3_admin">
                Vidéo illustrant l'article
            </h3>
            <div>
                <form action="{{ route('posts.uploadVideo', $post) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Code intégration vidéo</label>
                        <div class="col-sm-8">
                            <textarea name="video" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="text-end mt-1">
                        <button class="btn btn-success">Enregistrer le code d'intégration</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=40cakvroazrt9qmtcvc4jhwddimpi2cj26v8c03jxkfbc499"></script>
    <script src="{{ asset('/js/axios.min.js') }}"></script>
    <script src="{{ asset('/js/editor.js') }}"></script>
@endsection
