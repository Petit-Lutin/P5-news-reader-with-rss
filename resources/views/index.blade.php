@extends('layouts/app')
@section('content')
    {{--    <h1>Flux</h1>--}}
    {{--    <ul>--}}
    {{--        @foreach($flows as $flow)--}}
    {{--            <li>{{$flow->name}} <a href="{{$flow->url}}">lien</a></li>--}}
    {{--        @endforeach--}}
    {{--    </ul>--}}

    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Mes abonnements RSS</p>
        </header>
        <div class="card-content">
            <div class="content">
                <table class="table is-hoverable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--                    @foreach($flows as $flow)--}}
                    {{--                        <tr>--}}
                    {{--                            <td>{{$flow->id}}</td>--}}
                    {{--                            <td><strong>{{$flow->name}}</strong></td>--}}
                    {{--                            --}}{{--                            <td><a class="button is-primary" href="{{ route('flows.show', $flow->id) }}">Voir</a></td>--}}
                    {{--                            <td><a class="button is-primary" href="{{ URL::to('flows/'. $flow->id) }}">Voir</a></td>--}}
                    {{--                            --}}{{--                            <td><a class="button is-warning" href="{{ route('flows.edit', $flow->id) }}">Modifier</a></td>--}}
                    {{--                            <td>--}}
                    {{--                                --}}{{--                                <form action="{{ route('flows.destroy', $flow->id) }}" method="post">--}}
                    {{--                                --}}{{--                                    @csrf--}}
                    {{--                                --}}{{--                                    @method('DELETE')--}}
                    {{--                                --}}{{--                                    <button class="button is-danger" type="submit">Supprimer</button>--}}
                    {{--                                --}}{{--                                </form>--}}
                    {{--                            </td>--}}
                    {{--                            <td><strong>{{$category->name}}</strong></td>--}}
                    {{--                        </tr>--}}
                    {{--                    @endforeach--}}


                    </tbody>
                </table>

                @foreach($categories as $category)
                    <h2>{{$category->name}} <small><a href="/categories/edit/{{$category->id}}">Modifier</a></small>
                    </h2>
                    <ul>
                        @foreach($category->flowsOrderBy as $flow)
                            <li>{{$flow->name}} <a href="/flow/show/{{$flow->id}}">Voir</a> <small><a
                                        href="/flows/edit/{{$flow->id}}">Modifier</a></small></li>
                        @endforeach
                    </ul>

                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        //script vue js

        // Make a request for a user with a given ID
        axios.get('/getjson/1')
            .then(function (response) {
                // handle success
                console.log(response);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .finally(function () {
                // always executed
            });
        // </script>
@endsection
