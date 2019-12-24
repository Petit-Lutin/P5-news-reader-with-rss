@extends('layouts/app')
@section('content')
    <h1>Flux</h1>
    <ul>
        @foreach($flows as $flow)
            <li>{{$flow->name}} <a href="{{$flow->url}}">lien</a></li>
        @endforeach
    </ul>
@endsection
