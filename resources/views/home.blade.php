@extends('layouts.app')

@section('css')
<style>
    .btn-xl {
        flex-grow: 2;
        margin: .2em;
    }
</style>
@stop

@section('content')

    <h3>
        <i class="fas fa-project-diagram"></i> &nbsp;Projetos
    </h3>

    <div class="divide"></div>

    <div class="d-flex row-wrap">

        @foreach($allProjects as $project)
        <button type="button" class="btn btn-xl btn-dark">
            {{ $project->name }}
        </button>
        @endforeach

        <button type="button" class="btn btn-xl btn-dark" onclick="modal.open('newProject')">
            <i class="fas fa-plus"></i> &nbsp;NEW PROJECT
        </button>
    
    </div>

    @component('components.modal')
        @slot('id', 'newProject')
        @slot('title', 'NOVO PROJETO')
        <form method="post" action="{{ route('project.create') }}">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" class="input-control" placeholder="nome do projeto">
                </div>
                <div class="form-group">
                    <textarea class="input-control" name="description" placeholder="digite uma breve descrição sobre o projeto"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-std btn-gray" onclick="modal.close()">Cancelar</button>
                <button type="submit" class="btn btn-std btn-blue">Salvar</button>
            </div>
        </form>
    @endcomponent

@stop

@section('script')
    <script>

        // Modal inicial settings
        const modal = new Modal({
            fadeIn: 100,
            fadeOut: 900,
        });

    </script>
@stop