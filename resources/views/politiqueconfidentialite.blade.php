@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3>Politique de confidentialité</h3></div>

                    <div class="card-body">
                        <p class="text-justify">
                        <h4>Les données que vous transmettez</h4>

                        En créant un compte sur ce site, vous transmettez :
                        <ul>
                            <li>- une adresse e-mail pour vérifier que vous n'êtes pas un robot ;</li>
                            <li>- un pseudo ;</li>
                            <li>- un mot de passe (chiffré donc je n'y ai pas accès).</li>
                        </ul>
                        Et c'est tout ! Je n'utilise pas de services tiers (Google Analytics, Facebook...) pour vous pister.
                        <hr>


                        <p class="text-center">
                            <a class="btn btn-primary btn-lg" href="/index" role="button">Retour au site</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('footer')
@endsection
