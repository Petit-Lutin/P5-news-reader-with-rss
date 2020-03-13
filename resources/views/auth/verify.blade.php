@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Vérification de votre adresse email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un lien de vérification vous a été envoyé par email.') }}
                        </div>
                    @endif

                    {{ __('Pour finaliser votre inscription, un lien de confirmation vous a été envoyé par email." Before proceeding, please check your email for a verification link.') }}
                    {{ __('Si vous ne l\'avez pas reçu,') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('cliquez ici pour en recevoir un nouveau') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
