@extends('layouts.app')

@section('content')
    <div id="app">
        <app-employee-form employee_id = "{{$employee->id}}"></app-employee-form>
    </div>
@endsection