@extends('layouts.app')

@section('content')
   <div id="app">
       <app-positions-form position_id = "{{$position->id}}"></app-positions-form>
   </div>
@endsection