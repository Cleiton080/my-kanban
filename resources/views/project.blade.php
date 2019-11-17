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

    </style>
@stop

@section('content')

    <div class="d-flex align-items-center">
        <h3>{{ $project->name }}</h3>
        
        <!-- Favorite -->
        <button type="button" id="favorite" class="btn btn-gray btn-tool" title="Adicionar / Remover dos Favoritos" data-id="{{ $project->id }}">
            <i class="{{ $project->favorite ? 'fas fa-star' : 'far fa-star' }}"></i>
        </button>
        <!-- .Favorite -->

        <!-- New stage -->
        <button type="button" class="btn btn-gray btn-tool" data-target="#add-stage" title="Adicionar novo stage">
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
                        <div class="dropdown">
                            <button type="button" class="btn btn-dark" style="padding: 0 .5em; border-radius: 50%;">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item" data-target="#rename-stage">
                                    Renomear
                                </li>
                                <li class="dropdown-item" data-target="#delete-stage">
                                    Deletar
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="stage-card-body">
                        <ul class="stage-card-tasks">
                            @foreach($stage->tasks as $task)
                                <li class="stage-card-task" data-id="{{ $task->id }}">{{ $task->title }}</li>
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

    <!-- Modal add stage -->
    @component('components.modal', ['id' => 'add-stage', 'title' => 'NOVO STAGE'])
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
                <button type="button" class="btn btn-std btn-gray" data-dismiss="#add-stage">Cancelar</button>
                <button type="submit" class="btn btn-std btn-blue">Salvar</button>
            </div>
        </form>
    @endcomponent
    <!-- .Modal add stage -->

    <!-- Modal delete stage -->
    @component('components.modal', ['id' => 'delete-stage', 'title' => 'DELETAR STAGE'])
        <form action="{{ route('stage.delete') }}" method="post">
            <div class="modal-body">
                <p>
                    <strong>Você realmente deseja deletar o stage selecionado?</strong><br><br>
                    <i>O item irá ser deletado imediatamente, a ação não poderá ser desfeita.</i>
                </p>
                <input type="hidden" name="stage_id">
                @method('delete')
                @csrf
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-std btn-blue" data-dismiss="#delete-stage">Cancelar</button>
                <button type="submit" class="btn btn-std btn-gray">Deletar</button>
            </div>
        </form>
    @endcomponent
    <!-- .Modal delete stage -->

    <!-- Rename stage -->
    @component('components.modal', ['id' => 'rename-stage', 'title' => 'RENOMEAR STAGE'])
        <form action="{{ route('stage.update') }}" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">título</label>
                    <input type="text" id="title" class="input-control" name="title" placeholder="digite o título do stage">
                </div>
                <input type="hidden" name="stage_id">
                @method('put')
                @csrf
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-std btn-blue">Salvar</button>
                <button type="button" class="btn btn-std btn-gray" data-dismiss="#rename-stage">Cancelar</button>
            </div>
        </form>
    @endcomponent
    <!-- .Rename stage -->

@stop

@section('script')
    <script type="module">
        import Modal from '/js/Plugins/Modal.js';

        // Modals
        const deleteStage = new Modal({
            modal: document.getElementById('delete-stage'),
            opening: function(e) {
                this.querySelector('input[name=stage_id]').value = e.closest('.stage-card').getAttribute('data-id');
            }
        });

        const addStage = new Modal({
            modal: document.getElementById('add-stage'),
        });

        const renameStage = new Modal({
            modal: document.getElementById('rename-stage'),
            opening: function(e) {
                let stage = e.closest('.stage-card').getAttribute('data-id');
                $.get(`/project/stage/${stage}`, data => {
                    this.querySelector('#title').value = data.title;
                    this.querySelector('input[name=stage_id]').value = data.id;
                });
            }
        });
    </script>
    <script src="{{ asset('js/project.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script>
        $('.stage-card-tasks').sortable({
            connectWith: '.stage-card-tasks',
            stop: function(e, ui) {
                const o = {
                    stage_id: ui.item.parents('.stage-card')[0].getAttribute('data-id'),
                    task_id: ui.item[0].getAttribute('data-id')
                }

                $.ajax({
                   type: 'PUT',
                   url: '/project/task/update',
                   data: o,
                   headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } 
                }).fail(e => { console.log(e) });
            }
        });
    </script>
@stop