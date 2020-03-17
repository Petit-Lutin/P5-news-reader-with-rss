@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3>Mentions légales</h3></div>

                    <div class="card-body">
                        <p class="text-justify">
                        <h4>Développement du site internet</h4>

                        Laurence Platzer.
                        <hr>


                        <h4>Hébergeur</h4>

                        O2Switch, SARL au capital de 100 000 euros<br>
                        SIRET 510 909 80700024<br>
                        RCS Clermont-Ferrand<br>
                        Marque déposée INPI<br>
                        222-224 Boulevard Gustave Flaubert<br>
                        63000 Clermont-Ferrand<br>
                        04 44 44 60 40<br>
                        </p>
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
