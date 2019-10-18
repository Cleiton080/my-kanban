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

        <button type="button" class="btn btn-xl btn-dark">
            <i class="fas fa-plus"></i> &nbsp;NEW PROJECT
        </button>
    
    </div>

@stop