@extends('layouts.app')

@section('content')

    <h3>
        <i class="fas fa-star"></i> &nbsp;FAVORITOS
    </h3>

    <div class="divide"></div>

    <div class="d-flex row-wrap" id="favorite">

        <!-- All favorites -->
        @foreach($favorites as $project)
            <a href="{{ route('project.board', ['id' => $project->id]) }}" class="btn btn-xl btn-dark" data-id="{{ $project->id }}">
                {{ $project->name }}
            </a>
        @endforeach
        <!-- .All favorites -->

        <!-- Contextmenu -->
        <div class="contextmenu">
            <ul>
                <li style="border-bottom: 1px solid #363b41;">Abrir</li>
                <li onclick="modal.open('delete')">Deletar</li>
            </ul>
        </div>
        <!-- .Contextmenu -->

    </div>
    
@stop