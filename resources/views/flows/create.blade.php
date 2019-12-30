@extends('layouts/app')
@section('content')
    <form method="POST">
        {{csrf_field()}}
        <input type="text" name="name" @error('name') is-invalid @enderror placeholder="Nom du nouveau flux RSS" required>
        <select name="category_id" required>
            <option value="" disabled>Choisir une catégorie</option>

            @foreach($categories as $categorie)
                <option value="{{$categorie->id}}">{{$categorie->name}}</option>
            @endforeach
        </select>
        <input type="text" name="url" @error('url') is-invalid @enderror  placeholder="URL du nouveau flux RSS" required>

        <input type="submit" value="Enregistrer">
    </form>

@endsection
