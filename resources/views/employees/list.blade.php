@extends('layouts.app')

@section('content')
    <a href="{{route('employee_add')}}" class="btn btn-info">Добавать работника</a>
    <div id="app">
        <app-employees></app-employees>
    </div>

@endsection