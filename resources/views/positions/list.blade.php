@extends('layouts.app')

@section('content')
    <a href="{{route('position_add')}}" class="btn btn-info">Добавать должность</a>

    <div id="app">
        <app-positions></app-positions>
    </div>
@endsection