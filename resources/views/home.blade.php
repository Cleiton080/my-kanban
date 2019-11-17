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
        <i class="fas fa-project-diagram"></i> &nbsp;PROJETOS
    </h3>

    <div class="divide"></div>

    <div class="d-flex row-wrap" id="projects">

        <!-- All projects -->
        @foreach($allProjects as $project)
            <a href="{{ route('project.board', ['id' => $project->id]) }}" class="btn btn-xl btn-dark" data-id="{{ $project->id }}">
                {{ $project->name }}
            </a>
        @endforeach
        <!-- .All projects -->

        <!-- Contextmenu -->
        <div class="contextmenu">
            <ul>
                <li style="border-bottom: 1px solid #363b41;">Abrir</li>
                <li data-target="#delete-project">Deletar</li>
            </ul>
        </div>
        <!-- .Contextmenu -->
    
    </div>

    <hr>

    <!-- New project button -->
    <div class="">
        <button type="button" class="btn btn-block btn-xl btn-dark" data-target="#add-project">
            <i class="fas fa-plus"></i> &nbsp;NOVO PROJETO
        </button>
    </div>
    <!-- .New project button -->

    @component('components.modal', ['id' => 'add-project', 'title' => 'NOVO PROJETO'])
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
                <button type="button" class="btn btn-std btn-gray" data-dismiss="#add-project">Cancelar</button>
                <button type="submit" class="btn btn-std btn-blue">Salvar</button>
            </div>
        </form>
    @endcomponent

    @component('components.modal', ['id' => 'delete-project', 'title' => 'DELETAR PROJETO'])
        <form action="{{ route('project.delete') }}" method="post">
            <div class="modal-body">
                <p>
                    <strong>Você realmente deseja deletar o projeto selecionado?</strong><br><br>
                    <i>O item irá ser deletado imediatamente, a ação não poderá ser desfeita.</i>
                </p>
                @method('delete')
                @csrf
                <input type="hidden" name="id-project">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-std btn-blue" data-dismiss="#delete-project">Cancelar</button>
                <button type="submit" class="btn btn-std btn-gray">Deletar</button>
            </div>
        </form>
    @endcomponent

@stop

@section('script')
    <script type="module">
        import Modal from '/js/Plugins/Modal.js';

        const addModal = new Modal({ modal: document.getElementById('add-project') });
        const deleteModal = new Modal({ modal: document.getElementById('delete-project') });

    </script>

    <script>

        // Contextmenu
        const ctx = Array.from(document.querySelectorAll('#projects a'));
        const ctxMenuProject = new ContextMenu({
            menu: document.querySelector('.contextmenu'),
            display: {
                show: 'block',
                hidden: 'none'
            }
        });

        // ...
        const ctxClickRight = e => {
            ctxMenuProject.clickRight(e);
            bindId(ctxMenuProject.parentElement.getAttribute('data-id'), 'input[name=id-project]');
        }
        
        // Event's contextmenu
        ctx.forEach(e => { e.addEventListener('contextmenu', ctxClickRight) })
        window.addEventListener('click', e => { ctxMenuProject.clickLeft(e) });

    </script>
@stop