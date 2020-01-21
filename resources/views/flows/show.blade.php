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

{{--    <script !src="">--}}
{{--        //        récupération des news contenues dans les flux--}}
{{--        loadNews() {--}}
{{--            ajaxGet('https://api.jcdecaux.com/vls/v1/stations?contract=lyon&apiKey=1a65ebf23b0482781cbddeaa74a7c535179df94a', (response) => {--}}
{{--                var newsJs = JSON.parse(response)--}}
{{--            }--}}
{{--        };--}}
{{--    </script>--}}
@endsection
