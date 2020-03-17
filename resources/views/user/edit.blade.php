@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3>Mon profil</h3></div>

                    <div class="card-body">
                        <p class="text-justify">

                            <form method="POST">
                                {{csrf_field()}}
                                <label for="userPseudo">Mon pseudo</label>
                                <input class="form-control" type="text" name="name" @error('name') is-invalid
                                       @enderror value="{{old("name",$user->name)}}" id="userPseudo" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if ($errors->has('name')) <span
                                    class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span> @endif


                                <label for="userEmail">Mon e-mail</label>
                                <input class="form-control" type="text" name="email" @error('email') is-invalid
                                       @enderror value="{{old("email",$user->name)}}" id="userEmail" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if ($errors->has('email')) <span
                                    class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span> @endif


                                <input class="btn btn-primary" type="submit" value="Enregistrer">

                                <label for="deleteAccount" id="deleteAccountLabel">Supprimer mon compte</label>
                        <p>Pour supprimer votre compte, veuillez écrire votre pseudo dans le champ ci-dessous puis
                            cliquer sur le bouton "Supprimer mon compte".</p>
                        <input class="form-control" type="text" id="deleteAccount" name="delete_account"
                               @error('delete_account') is-invalid
                            @enderror>
                        <a class="btn btn-danger" id="deleteAccountConfirm">Supprimer mon compte</a>

                        <a class="btn btn-secondary"
                           href="/index">Retour</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('footer')
@endsection
