@extends('layouts/app')
@section('content')
    {{--    @foreach ($errors->all() as $error) {{ $error }}<br/> @endforeach--}}
   <div class="container">
       <div class="card">
           <header class="card-header">
               <p class="card-header-title">{{ $flow->name }}</p>
           </header>
           <div class="card-content">
               <div class="content">
                   mettre derniere publication ?
               </div>
           </div>
       </div>

   </div>
@endsection
