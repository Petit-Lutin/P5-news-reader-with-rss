@extends('layouts/app')
@section('content')
    {{--    @foreach ($errors->all() as $error) {{ $error }}<br/> @endforeach--}}
    <div class="container">
        <div class="row"><h2>Modifier un site</h2>
        </div>
        <div class="row">
            <div class="col">


                <form method="POST">
                    {{csrf_field()}}
                    <input class="form-control" type="text" name="name" @error('name') is-invalid
                           @enderror value="{{old("name",$flow->name)}}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if ($errors->has('name')) <span
                        class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span> @endif

                    <select class="form-control" id="mySelect" name="category_id" required>
                        <option value="{{old("category_id", $flow->category_id)}}" disabled selected>Choisir une
                            catégorie
                        </option>
                        <option value="-1" onclick="displayNewCategory()">Nouvelle catégorie</option>

                        @foreach($categories as $categorie)
                            <option value="{{$categorie->id}}"
                                    @if (old("category_id",$categorie->id)==$categorie->id) selected
                                    onclick="displayNewCategory()" @endif
                            >{{$categorie->name}}</option>
                        @endforeach
                    </select>
                    <input class="form-control" type="text" id="newCategory" name="category_name"
                           @error('category_name') is-invalid
                           @enderror placeholder="Nom de la nouvelle catégorie" value="{{old("category_name","")}}">


                    <input class="form-control" type="text" name="url" @error('url') is-invalid
                           @enderror  placeholder="URL du nouveau flux RSS" value="{{old("url",$flow->url)}}" required>
                    @error('url')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if ($errors->has('url')) <span
                        class="help-block"> <strong>{{ $errors->first('url') }}</strong> </span> @endif

                    <input class="btn btn-primary" type="submit" value="Enregistrer"> <a class="btn btn-primary"
                                                                                         href="/index">Retour</a>
                </form>
            </div>
        </div>
    </div>
@endsection
<style>
    #newCategory {
        display: none;
    }
</style>
@section('scripts')
    <script>
        function displayNewCategory() {
            var isSelected = document.getElementById("mySelect").selectedIndex;
            var valueOption = document.getElementsByTagName("option")[isSelected].value;
            console.log(document.getElementsByTagName("option")[isSelected].value);
            if (valueOption == "-1") {// si "Nouvelle catégorie" est sélectionné dans la liste déroulante
                document.getElementById("newCategory").style.display = "inline-block"; //on affiche une zone de texte pour saisir cette nouvelle catégorie
            } else {
                document.getElementById("newCategory").style.display = "none"; // et si on clique finalement sur le nom d'une catégorie, la zone de texte est masquée
            }
        }
    </script>
@endsection
