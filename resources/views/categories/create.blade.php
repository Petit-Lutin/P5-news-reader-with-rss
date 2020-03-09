@extends('layouts/app')
@section('content')
    <h2>Organiser les catégories</h2>
    <p>Nouvelle catégorie</p>
    <form method="POST">
        {{csrf_field()}}
        <label for="new_Category">Nom de la nouvelle
            catégorie</label>
        <input name="name" type="text" id="new_Category" required>

        <input type="submit" value="Enregistrer">
    </form>

@endsection
