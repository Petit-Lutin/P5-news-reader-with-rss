@extends('layouts/app')
@section('content')
    <h2>Organiser les catégories</h2>
    <p>Modifier une catégorie</p>
    <form method="POST">
        {{csrf_field()}}
        <label for="new_CategoryLabel" id="newCategoryLabel">Modifier le nom de la catégorie</label>
        <input name="name" type="text" id="new_CategoryLabel"value="{{old("name",$category->name)}}" required>
{{--        <select name="category_id" required>--}}
{{--            <option value="" disabled>Choisir une catégorie</option>--}}

{{--            @foreach($categories as $categorie)--}}
{{--                <option value="{{$categorie->id}}">{{$categorie->name}}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}


        <input type="submit" value="Enregistrer">
    </form>

@endsection
