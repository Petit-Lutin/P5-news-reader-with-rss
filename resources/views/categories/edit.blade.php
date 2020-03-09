@extends('layouts/app')
@section('content')
    <div class="container">
        <h2>Organiser les catégories</h2>
        <p>Modifier une catégorie</p>
        <div class="row">
            <div class="col">
                <form method="POST">
                    {{csrf_field()}}
                    <label for="new_CategoryLabel" id="newCategoryLabel">Modifier le nom de la catégorie</label>
                    <input name="name" type="text" id="new_CategoryLabel" class="form-control"
                           value="{{old("name",$category->name)}}" required>
                    <br>
                    <input type="submit" class="btn btn-primary" value="Enregistrer"> <a class="btn btn-secondary"
                                                                                         href="/index">Retour</a>
                </form>
            </div>
        </div>
    </div>
@endsection
