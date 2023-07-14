@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
                <div class="col-md-5 p-lg-5 mx-auto my-5">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1 class="display-4 fw-normal">{{ __('Administrador') }}</h1>
                    <p class="lead fw-normal">Aprende a manejar tus finanzas para que logres tus objetivos.</p>
                    <a class="btn btn-outline-secondary" href="{{ route('users.create') }}">Crear Usuario</a>
                    {{-- @if (@Auth::user()->hasRole('administrador'))
                        <h2>Eres un cliente</h2>
                    @endif --}}
                </div>
                <div class="product-device shadow-sm d-none d-md-block"></div>
                <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
            </div>
        </div>
    </div>
@endsection
