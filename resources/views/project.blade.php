@extends('layouts.app')

@section('css')
    <style>

        li:hover { background-color: rgba(44, 48, 54, 1); }

        .btn-stage {
            border-radius: 0!important;
            font-size: 10pt;
            padding: .5em;
        }

        .btn-tool {
            margin-left: 1em;
            color: #fff;
            border-radius: 50%;
        }

        .favorite-noactive { color: #fff; }

    </style>
@stop

@section('content')

    <div class="d-flex align-items-center">
        <h3>{{ $project->name }}</h3>
        
        <!-- Favorites -->
        <button type="button" id="favorite" class="btn btn-gray btn-tool" title="Adicionar / Remover Favoritos" data-id="{{ $project->id }}">
            <i class="fas fa-star {{ $project->favorite ? 'favorite-active' : 'favorite-noactive' }}"></i>
        </button>
        <!-- .Favorites -->

        <!-- New stage -->
        <button type="button" class="btn btn-gray btn-tool" onclick="modal.open('stage')" title="Adicionar novo stage">
            <i class="fas fa-plus-circle"></i>
        </button>
        <!-- .New Stage -->
    </div>

    <div class="divide"></div>

    <!-- Stages -->
    <div class="d-flex row-wrap">

        @foreach($project->stages as $stage)
            <div class="stage-card-wrapper">
                <div class="stage-card" style="flex-grow: 2; margin: 1em;" data-id="{{ $stage->id }}">
                    <div class="stage-card-head d-flex justify-content-between">
                        <h4>{{ $stage->title }}</h4>
                        <button type="button" class="btn btn-dark" style="padding: 0 .5em; border-radius: 50%;">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                    <div class="stage-card-body">
                        <ul class="stage-card-tasks">
                            @foreach($stage->tasks as $task)
                                <li class="stage-card-task">{{ $task->title }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn btn-block btn-dark" style="font-size: .8em; padding: .5em;">
                            <i class="fas fa-plus"></i> &nbsp;ADICIONAR NOVA TAREFA
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <!-- .Stages -->

    <!-- Modal stage -->
    @component('components.modal', ['id' => 'stage', 'title' => 'NOVO STAGE'])
        <form action="{{ route('stage.create') }}" method="post">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" name="title" id="title" class="input-control" placeholder="digite o título do novo stage">
                </div>
                <input type="hidden" name="project_id" value="{{ $project->id }}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-std btn-gray" onclick="modal.close()">Cancelar</button>
                <button type="submit" class="btn btn-std btn-blue">Salvar</button>
            </div>
        </form>
    @endcomponent
    <!-- .Modal stage -->

@stop

@section('script')
    <script src="{{ asset('js/project.js') }}"></script>
@stop