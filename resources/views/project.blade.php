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

    <h3>
        <i class="fas fa-project-diagram"></i> &nbsp;{{ $project->name }}
    </h3>

    <div class="divide"></div>

    <!-- Stages -->
    <div class="d-flex row-wrap">
        
        @foreach($project->stages as $stage)
            <div class="stage-card" style="flex-grow: 2; margin: 1em;">
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
                    <button type="button" class="btn btn-block btn-dark" style="font-size: .8em; padding: .5em;" onclick="newTask(this)">
                        <i class="fas fa-plus"></i> &nbsp;ADICIONAR NOVA TAREFA
                    </button>
                </div>
            </div>
        @endforeach

    </div>
    <!-- .Stages -->

@stop

@section('script')
    <script>

        function addTask(tasks, input) {

            if(!input.value) { input.remove(); return ; }

            const li = document.createElement('li');

            li.classList.add('stage-card-task');
            li.innerHTML = input.value;
            li.setAttribute('draggable', true);

            $.ajax({
                type: 'POST',
                url: '/project/task/add',
                data: {title: input.value, stage_id: 1},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(err) {
                    console.log(err);
                }
            });

            tasks.appendChild(li);

            input.remove();
        }

        function newTask(o) {
            const tasks = o.parentElement.querySelector('.stage-card-tasks');
            const input = document.createElement('input');
            
            input.type = 'text';
            input.classList.add('input-control');

            tasks.appendChild(input);
            input.focus();

            input.addEventListener('focusout', () => { addTask(tasks, input) });
        }
    </script>
@stop