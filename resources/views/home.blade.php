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

        <button type="button" class="btn btn-xl btn-dark">
            PPROJECT 1
        </button>

        <button type="button" class="btn btn-xl btn-dark">
            PPROJECT 2
        </button>

        <button type="button" class="btn btn-xl btn-dark">
            PPROJECT 3
        </button>

        <button type="button" class="btn btn-xl btn-dark">
            PPROJECT 4
        </button>

        <button type="button" class="btn btn-xl btn-dark">
            PPROJECT 5
        </button>

        <button type="button" class="btn btn-xl btn-dark">
            <i class="fas fa-plus"></i> &nbsp;NEW PROJECT
        </button>
    
    </div>

@stop