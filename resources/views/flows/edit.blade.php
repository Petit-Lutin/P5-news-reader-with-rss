@extends('layouts/app')
@section('content')

    <div class="container">
        <div class="row"><h2>Modifier un site</h2>
        </div>

        <div class="row">
            <div class="col">

                <form method="POST">
                    {{csrf_field()}}
                    <label for="flowName">Nom du flux à suivre</label>
                    <input class="form-control" type="text" name="name" @error('name') is-invalid
                           @enderror value="{{old("name",$flow->name)}}" id="flowName" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if ($errors->has('name')) <span
                        class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span> @endif
                    <label>Dans la catégorie</label>

                    <select class="form-control" id="mySelect" name="category_id" required>
                        <option value="" disabled selected>Choisir une
                            catégorie
                        </option>
                        <option value="-1" onclick="displayNewCategory()">Nouvelle catégorie</option>

                        @foreach($categories as $categorie)
                            <option value="{{$categorie->id}}" onclick="displayNewCategory()"
                                    @if (old("category_id",$flow->category_id)==$categorie->id) selected
                                @endif
                            >{{$categorie->name}}</option>
                        @endforeach
                    </select>

                    <label for="newCategory" id="newCategoryLabel">Nom de la nouvelle
                        catégorie</label>
                    <input class="form-control" type="text" id="newCategory" name="category_name"
                           @error('category_name') is-invalid
                           @enderror placeholder="Nom de la nouvelle catégorie" value="{{old("category_name","")}}">

                    <label>URL du flux RSS</label>
                    <input class="form-control" type="text" name="url" @error('url') is-invalid
                           @enderror  placeholder="URL du nouveau flux RSS" value="{{old("url",$flow->url)}}" required>
                    @error('url')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if ($errors->has('url')) <span
                        class="help-block"> <strong>{{ $errors->first('url') }}</strong> </span> @endif

                    <input class="btn btn-primary" type="submit" value="Enregistrer"> <a class="btn btn-secondary"
                                                                                         href="/index">Retour</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('flows/script')
@endsection

@section('footer')
    @include('footer')
@endsection
