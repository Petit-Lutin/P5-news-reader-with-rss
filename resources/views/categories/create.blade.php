@extends('layouts/app')
@section('content')
    <h2>Organiser les catégories</h2>
    <p>Nouvelle catégorie</p>
    <form method="POST">
        {{csrf_field()}}
        <input name="name" type="text" required>
{{--        <select name="category_id" required>--}}
{{--            <option value="" disabled>Choisir une catégorie</option>--}}

{{--            @foreach($categories as $categorie)--}}
{{--                <option value="{{$categorie->id}}">{{$categorie->name}}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}


        <input type="submit" value="Enregistrer">
    </form>

@endsection
