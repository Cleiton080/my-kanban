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
            <button type="button" class="btn btn-xl btn-dark" data-id="{{ $project->id }}">
                {{ $project->name }}
            </button>
        @endforeach
        <!-- .All projects -->

        <!-- Contextmenu -->
        <div class="contextmenu">
            <ul>
                <li style="border-bottom: 1px solid #363b41;">Abrir</li>
                <li onclick="modal.open('delete')">Deletar</li>
                <li onclick="modal.open('addToFavorites')">Adicionar aos favoritos</li>
            </ul>
        </div>
        <!-- .Contextmenu -->
    
    </div>

    <hr>

    <!-- New project button -->
    <div class="">
        <button type="button" class="btn btn-block btn-xl btn-dark" onclick="modal.open('newProject')">
            <i class="fas fa-plus"></i> &nbsp;NOVO PROJETO
        </button>
    </div>
    <!-- .New project button -->

    @component('components.modal', ['id' => 'newProject', 'title' => 'NOVO PROJETO'])
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

    @component('components.modal', ['id' => 'delete', 'title' => 'DELETAR PROJETO'])
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
                <button type="button" class="btn btn-std btn-blue" onclick="modal.close()">Cancelar</button>
                <button type="submit" class="btn btn-std btn-gray">Deletar</button>
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

        // Contextmenu
        const ctx = Array.from(document.querySelectorAll('#projects button'));
        const ctxMenuProject = new ContextMenu({
            menu: document.querySelector('.contextmenu'),
            display: {
                show: 'block',
                hidden: 'none'
            }
        });
        const ctxClickRight = e => {
            ctxMenuProject.clickRight(e);
            bindId(ctxMenuProject.parentElement.getAttribute('data-id'), 'input[name=id-project]');
        }
        
        ctx.forEach(e => { e.addEventListener('contextmenu', ctxClickRight) })
        window.addEventListener('click', e => { ctxMenuProject.clickLeft(e) });

    </script>
@stop