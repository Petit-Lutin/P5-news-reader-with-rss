@extends('layouts/app')
@section('content')
    {{--    @foreach ($errors->all() as $error) {{ $error }}<br/> @endforeach--}}
   <div class="container">
    <div class="row">
        <div class="col">


            <form method="POST">
                {{csrf_field()}}
                <input class="form-control" type="text" name="name" @error('name') is-invalid
                       @enderror placeholder="Nom du nouveau flux RSS" value="{{old("name","")}}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if ($errors->has('name')) <span
                    class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span> @endif
                <select class="form-control" name="category_id" required>
                    <option value="" disabled selected>Choisir une catégorie</option>

                    @foreach($categories as $categorie)
                        <option value="{{$categorie->id}}"
                                @if (old("category_id","")==$categorie->id) selected @endif
                        >{{$categorie->name}}</option>
                    @endforeach
                </select>
                <input class="form-control" type="text" name="url" @error('url') is-invalid
                       @enderror  placeholder="URL du nouveau flux RSS" value="{{old("url","")}}" required>
                @error('url')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if ($errors->has('url')) <span
                    class="help-block"> <strong>{{ $errors->first('url') }}</strong> </span> @endif

                <input class="btn btn-primary" type="submit" value="Enregistrer">
            </form>
        </div>
    </div>
   </div>
@endsection
