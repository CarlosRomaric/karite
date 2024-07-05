<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Connexion</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/icon-traceagri-white.png') }}" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @vite(['resources/scss/style.scss','resources/js/app.js'])
</head>
<body>
<div id="app" class="font-sans bg-gray-200 flex flex-col min-h-screen">
    <div class="w-full min-h-screen flex justify-between align-items-stretch">
        <div class="w-2/3 flex flex-col justify-center align-items-center trace-agri-background">
            <h1 class="uppercase text-center mb-6 font-bold text-5xl text-white px-20 pt-10">
                TraceAgri, pour une collecte inclusive des données agricoles
            </h1>
            <div class="absolute top-0 left-0 mt-3 ml-3">
                <img src="{{ asset('images/logo-traceagri-white.png') }}" alt="Logo INVESTIV" class="w-75 h-32 mr-6">
                <!-- <img src="{{ asset('assets/img/logo-trace-agri.png') }}" alt="Logo INVESTIV" class="w-75 h-32 mr-6"> -->
            </div>
        </div>
        <div class="w-1/3 bg-white shadow-md min-h-screen">
            <div class="w-full flex flex-col justify-center align-items-start min-h-screen px-24">
                
                <form method="post" action="{{ route('auth.login') }}" class="pt-6 pb-8 m-2">
                    
                    @if(session()->has('message') && session()->get('status'))
                        <div class="bg-red-400 text-white px-5 py-3 rounded shadow my-5 items-center">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    @csrf
                    <h1 class="text-3xl font-bold text-center pb-4">CONNECTEZ-VOUS</h1>
{{--                    <div class="flex justify-center">--}}
{{--                        <img src="{{ asset('images/logo-traceagri.jpg') }}" alt="Logo INVESTIV" class="w-50 h-40 mr-6">--}}
{{--                    </div>--}}
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            Nom d'utilisateur
                        </label>
                        <input class="shadow appearance-none focus:outline-none border{{ $errors->has('username') ? ' border-red-500' : ' focus:shadow-outline' }} rounded w-full py-2 px-3 text-gray-700 leading-tight  "
                               id="username" name="username" type="text" value="{{ old('username') }}" placeholder="Nom d'utilisateur">
                        @if($errors->has('username'))
                            <p class="text-red-500 text-sm">{{ $errors->first('username') }}</p>
                        @endif
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Mot de passe
                        </label>
                        <input class="shadow appearance-none focus:outline-none border{{ $errors->has('password') ? ' border-red-500' : ' focus:shadow-outline' }} rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight "
                               id="password" name="password" type="password" placeholder="******************">
                        @if($errors->has('password'))
                            <p class="text-red-500 text-sm">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div class="mb-6">
                        <label class="custom-checkbox-label flex">
                            <div class="bg-gray-300 shadow border-green-900 w-6 h-6 p-1 flex justify-center items-center mr-2">
                                <input type="checkbox" name="remember_me" class="hidden">
                                <svg class="hidden w-4 h-4 text-green-900 pointer-events-none" viewBox="0 0 172 172">
                                    <g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal">
                                        <path d="M0 172V0h172v172z"/>
                                        <path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="2"/>
                                    </g>
                                </svg>
                            </div>
                            <span class="select-none text-md text-black">Se rappeler de moi ?</span>
                        </label>
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="btn-green focus:outline-none w-full" type="submit">Se connecter</button>
                    </div>
                </form>
                <p class="block text-center text-gray-500 text-xs">
                    &copy; Copyright INVESTIV {{ date('Y') }}. Tous droits réservés.
                </p>
                <p class="block text-center text-gray-500 text-xs mt-10">
                    Plateforme développée par INVESTIV et ICT4DEV.
                </p>
            </div>
        </div>
    </div>
</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
