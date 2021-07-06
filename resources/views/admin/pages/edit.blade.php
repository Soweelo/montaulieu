@extends('layouts.cockpit')
@section('content')
    <div class="row">
        <div class="col--12 col-md-8">
            <h1 class="h1_admin">Modification de la page</h1>
        </div>
        <div class="col-12 col-md-4 text-end">
            <a href="{{ route('pages.index') }}" class="btn btn-warning bnt-sm">Retour à la liste des pages</a>
        </div>
    </div>
    <div class="row" style="margin-top: 15px; margin-bottom: 100px">
        <div class="col">
            <form action="{{ route('pages.update', $page) }}" method="POST">
                <input type="hidden" name="_method" value="put">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Titre de la page</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title" value="{{ $page->title }}">
                    </div>
                </div>
                <div class="form-group row mt-3">
                    <label class="col-sm-2 col-form-label">Contenu</label>
                    <div class="col-sm-10">
                        <textarea data-id="{{ $page->id }}" data-type="{{ get_class($page) }}" data-url="{{ route('attachments.store') }}"
                                  name="content" class="form-control editor" rows="20">{{ $page->content }}</textarea>
                    </div>
                </div>
                <button class="btn btn-primary">Enregistrer</button>
            </form>

        </div>
    </div>
@endsection

@section('js')
    <script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=40cakvroazrt9qmtcvc4jhwddimpi2cj26v8c03jxkfbc499"></script>
    <script src="{{ asset('/js/axios.min.js') }}"></script>
    <script src="{{ asset('/js/editor.js') }}"></script>
@endsection
