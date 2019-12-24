@extends('layouts/app')
@section('content')
    <form method="POST">
        {{csrf_field()}}
        <input name="name" type="text" required>
        <select name="category_id" required>
            <option value="" disabled>Choisir une catégorie</option>

            @foreach($categories as $categorie)
                <option value="{{$categorie->id}}">{{$categorie->name}}</option>
            @endforeach
        </select>
        <input name="url" type="text" required>

        <input type="submit" value="Enregistrer">
    </form>

@endsection
