@extends('layouts.app')

@section('css')
    <style>

        .btn-stage {
            border-radius: 0!important;
            font-size: 10pt;
            padding: .5em;
        }

        li:hover { background-color: rgba(44, 48, 54, 1); }
    </style>
@stop

@section('content')

    <div class="d-flex align-items-center">
        <h3>{{ $project->name }}</h3>
        <button type="button" class="btn btn-gray" style="margin-left: 1em;" onclick="modal.open('stage')">
            <i class="fas fa-plus-circle"></i>
        </button>
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
    <script>
        // Tasks
        function createTask(e) {
            const tasks = e.originalTarget.parentElement.querySelector('.stage-card-tasks');
            const input = document.createElement('input');
            const li = document.createElement('li');

            // input
            input.setAttribute('class', 'input-control');
            tasks.appendChild(input);
            input.focus();
            
            // li
            li.setAttribute('class', 'stage-card-task');

            // Add li and remove input
            input.addEventListener('focusout', function(e) {

                if(!input.value) { input.remove(); return; }

                li.appendChild(document.createTextNode(input.value));
                tasks.appendChild(li);
                saveOnDatabase({
                    title: input.value,
                    stage_id: tasks.parentElement.parentElement.getAttribute('data-id')
                });
                input.remove();
            });
        }

        // Save on database
        function saveOnDatabase(data) {
            $.ajax({
                    type: 'POST',
                    url: '/project/task/add',
                    data: data,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                }).fail(err => { console.log(err) });
        }

        const stageCardBtn = Array.from(document.querySelectorAll('.stage-card-body button'));

        // add click event on tasks
        stageCardBtn.forEach(function(btn) { 
            btn.addEventListener('click', createTask);
        });
 
    </script>
@stop