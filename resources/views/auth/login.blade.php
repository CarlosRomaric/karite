<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Connexion</title>

    
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/logo-karite-white.png') }}" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    @vite(['resources/scss/style.scss','resources/js/app.js'])
    @livewireStyles
</head>
<body>


<div id="app" class="font-sans bg-gray-200 flex flex-col min-h-screen">
    <div class="flex justify-between min-h-screen ">
        <!-- Left section -->
        <div class="w-2/5 flex items-center justify-center karite-background">
            <!-- Contenu pour la section de gauche -->
        </div>

        <!-- Right section -->
        <div class="w-3/5 bg-amber-100/50 shadow-md min-h-screen">
            <div class="flex flex-col justify-center items-start min-h-screen pt-10 px-8 md:px-16 lg:px-24">
                <div class="flex flex-col items-center">
                    <a href="{{ route('pages.acceuil') }}" class=""><img src="{{ asset('assets/img/logo-karite.png') }}" alt="Logo CNRA" class="img-logo mx-auto"></a>
                    <h1 class="text-sm font-bold text-center text-amber-800 py-4"> POUR SOUTENIR ET ACCOMPAGNER CES MILLIERS DE FEMMES EN ZONE RURALE </h1>
                </div>

                <div class="container mx-auto px-4 md:px-10 lg:px-20 w-full">
                    <form method="post" action="{{ route('auth.login') }}" class="pt-6 pb-8 m-2 px-20">
                        
                        @if(session()->has('message') && session()->get('status'))
                            <div class="bg-red-400 text-white px-5 py-3 rounded shadow my-5 items-center">
                                {{ session()->get('message') }}
                            </div>
                        @endif

                        @csrf

                        

                        <h1 class="text-4xl font-bold text-center pb-2">Bienvenue</h1>
                        <h1 class="text-base font-semibold text-center pb-4">Merci de vous identifier pour accéder a la plateforme</h1>

                        <div class="relative flex flex-wrap items-stretch  ">
                            <span
                                class="flex items-center whitespace-nowrap rounded-l-lg  bg-amber-800 border border-r-0 border-solid border-neutral-300 px-6 py-[0.45rem] text-center text-xl font-normal text-gray-100 dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200"
                                id="inputGroup-sizing-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="15px" viewBox="0 0 36.979 36.979">
                                    <path id="UserP" d="M18.49,18.494a7.394,7.394,0,1,1,7.4-7.394A7.4,7.4,0,0,1,18.49,18.494Zm6.948,1.244a11.095,11.095,0,1,0-13.9,0C4.776,22.279,0,28.559,0,36.979H3.7c0-9.243,6.636-14.788,14.792-14.788s14.792,5.546,14.792,14.788h3.7C36.979,28.559,32.2,22.279,25.438,19.738Z" fill="#f9f9f9" fill-rule="evenodd"/>
                                </svg>

                                </span>
                            <input
                                type="text"
                                placeholder="login"
                                name="username"
                                id="username"
                                value="{{ old('username') }}"
                                class=" m-0 block w-[1px] min-w-0 flex-auto rounded-r-lg border {{ $errors->has('username') ? ' border-red-500' : ' focus:shadow-outline' }} border-solid border-neutral-300 bg-gray-100 bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-gray-100 focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-gray-100"
                                aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-lg" />
                               
                        </div>

                        <div class="aligns-center my-[20px]">
                                @if($errors->has('username'))
                                    <p class="text-red-500 text-sm text-center">{{ $errors->first('username') }}</p>
                                @endif
                        </div>


                        <div class="relative flex flex-wrap items-stretch w-50">
                            <span
                                class="flex items-center whitespace-nowrap rounded-l-lg bg-amber-800 border border-r-0 border-solid border-neutral-300 px-4 py-[0.45rem] text-center text-xl font-normal text-gray-100 dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200"
                                id="inputGroup-sizing-lg">
                                <svg id="Groupe_6" data-name="Groupe 6" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 59 54">
                                    
                                    <g id="motDePasse" transform="translate(19 13)">
                                        <path id="Tracé_1" data-name="Tracé 1" d="M8.286,20A2.287,2.287,0,0,0,6,22.286v3.429A2.287,2.287,0,0,0,8.286,28H19.714A2.287,2.287,0,0,0,22,25.714V22.286A2.287,2.287,0,0,0,19.714,20Zm.571,2.621a.57.57,0,0,1,.4.167l.4.4.4-.4a.571.571,0,0,1,.808.808l-.4.4.4.4a.571.571,0,0,1-.808.808l-.4-.4-.4.4a.571.571,0,0,1-.808-.808l.4-.4-.4-.4a.571.571,0,0,1,.4-.975Zm4.335,0a.57.57,0,0,1,.4.167l.4.4.4-.4a.571.571,0,0,1,.808.808l-.4.4.4.4a.571.571,0,0,1-.808.808l-.4-.4-.4.4a.571.571,0,0,1-.808-.808l.4-.4-.4-.4a.571.571,0,0,1,.4-.975Zm4.335,0a.57.57,0,0,1,.4.167l.4.4.4-.4a.571.571,0,0,1,.808.808l-.4.4.4.4a.571.571,0,0,1-.808.808l-.4-.4-.4.4a.571.571,0,0,1-.808-.808l.4-.4-.4-.4a.571.571,0,0,1,.4-.975Z" fill="#fff" fill-rule="evenodd"/>
                                        <path id="Tracé_2" data-name="Tracé 2" d="M8.575,13.509A1.8,1.8,0,0,1,10.8,16.332V18a1.2,1.2,0,0,1-2.4,0V16.332a1.788,1.788,0,0,1,.175-2.823ZM15.6,6V8.4A3.6,3.6,0,0,1,19.2,12v8.034l-2.4.017V12a1.2,1.2,0,0,0-1.2-1.2H3.6A1.2,1.2,0,0,0,2.4,12v8.4a1.2,1.2,0,0,0,1.2,1.2H6.8L6.814,24H3.6A3.6,3.6,0,0,1,0,20.4V12A3.6,3.6,0,0,1,3.6,8.4V6a6,6,0,0,1,12,0ZM7.054,3.454A3.6,3.6,0,0,0,6,6V8.4h7.2V6A3.6,3.6,0,0,0,7.054,3.454Z" fill="#fff" fill-rule="evenodd"/>
                                    </g>
                                </svg>



                            </span>
                            
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Mot de passe"
                                class="relative m-0 block w-[1px] pe-10 min-w-0 flex-auto rounded-r-lg border {{ $errors->has('password') ? ' border-red-500' : ' focus:shadow-outline' }}  border-solid border-neutral-300 bg-gray-100 bg-clip-padding px-4 py-[0.45rem] text-xl font-normal text-neutral-700 outline-none transition duration-200 ease-in-out  focus:border-gray-200 focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-gray-100"
                                />

                            <button type="button" class="show text-white absolute end-2.5 bottom-2.5">
                                <svg id="eyeP" xmlns="http://www.w3.org/2000/svg" width="20.367" height="16.969" viewBox="0 0 20.367 16.969">
                                    <path id="Tracé_3" data-name="Tracé 3" d="M20.366,8.938a11.17,11.17,0,0,1-1.2,4.909,6,6,0,0,1-2.245,2.542,3.851,3.851,0,0,1-4.715-.517,8.1,8.1,0,0,1-2.22-3.754A12.638,12.638,0,0,1,9.5,7.684a10.893,10.893,0,0,1,1.41-4.991A5.866,5.866,0,0,1,12.886.588a3.87,3.87,0,0,1,4.6.374,7.659,7.659,0,0,1,2.245,3.5,13.238,13.238,0,0,1,.629,4.479M18.8,6.841a.82.82,0,0,0,0-.133,11.026,11.026,0,0,0-.349-1.516,6.7,6.7,0,0,0-1.715-2.946A2.5,2.5,0,0,0,13.2,2.161a4.72,4.72,0,0,0-.866,1,9.328,9.328,0,0,0-1.412,4.681,10.641,10.641,0,0,0,.659,4.487,5.68,5.68,0,0,0,1.815,2.632,2.349,2.349,0,0,0,2.8.179,3.776,3.776,0,0,0,1.054-.961,7.858,7.858,0,0,0,1.4-3.08,6.851,6.851,0,0,0,.179-.974c-1.163.474-1.962.321-2.564-.476a2,2,0,0,1-.012-2.324c.586-.8,1.4-.956,2.568-.489" transform="translate(-9.469 0)"/>
                                    <path id="Tracé_4" data-name="Tracé 4" d="M.67,13.536a3.67,3.67,0,0,0,1.056,1.3,3.132,3.132,0,0,0,1.689.669,2.291,2.291,0,0,0,1.505-.511,5.462,5.462,0,0,0,1.7-2.284A10.393,10.393,0,0,0,7.3,10.379a2.172,2.172,0,0,0,.015-.261,1.9,1.9,0,0,1-1.757.163,1.867,1.867,0,0,1-.884-.761,1.976,1.976,0,0,1,.16-2.3,1.913,1.913,0,0,1,1.175-.659,1.888,1.888,0,0,1,1.31.286,4.138,4.138,0,0,0-.144-.864A7.675,7.675,0,0,0,5.622,2.618,3.175,3.175,0,0,0,4,1.527a2.563,2.563,0,0,0-1.064.005,2.593,2.593,0,0,0-.975.438A3.464,3.464,0,0,0,.677,3.413C.51,3.043.358,2.7.194,2.353c-.236-.494-.246-.5.119-.893A4.328,4.328,0,0,1,1.734.4,4.235,4.235,0,0,1,3.45,0,3.859,3.859,0,0,1,6.13,1.077,7.746,7.746,0,0,1,8.287,4.584a12.878,12.878,0,0,1,.541,5.028,11.023,11.023,0,0,1-1.14,4.222A6.133,6.133,0,0,1,5.54,16.327a3.807,3.807,0,0,1-4.287-.037A4.4,4.4,0,0,1,.093,15.248.283.283,0,0,1,0,15.067a.286.286,0,0,1,.052-.2,10.818,10.818,0,0,0,.611-1.334" transform="translate(11.486 0)"/>
                                </svg>
                            </button>

                            <button type="button" class="hide hidden text-white absolute end-2.5 bottom-2.5">
                                <svg id="eyeP-1" xmlns="http://www.w3.org/2000/svg" width="20.367" height="16.969" viewBox="0 0 20.367 16.969">
                                    <path id="Tracé_3" data-name="Tracé 3" d="M9.47,8.938a11.17,11.17,0,0,0,1.2,4.909,6,6,0,0,0,2.245,2.542,3.851,3.851,0,0,0,4.715-.517,8.1,8.1,0,0,0,2.22-3.754,12.638,12.638,0,0,0,.488-4.434,10.893,10.893,0,0,0-1.41-4.991A5.866,5.866,0,0,0,16.95.588a3.87,3.87,0,0,0-4.6.374,7.659,7.659,0,0,0-2.245,3.5,13.238,13.238,0,0,0-.629,4.479m1.562-2.1a.82.82,0,0,1,0-.133,11.026,11.026,0,0,1,.349-1.516A6.7,6.7,0,0,1,13.1,2.246a2.5,2.5,0,0,1,3.538-.085,4.72,4.72,0,0,1,.866,1,9.328,9.328,0,0,1,1.412,4.681,10.641,10.641,0,0,1-.659,4.487,5.68,5.68,0,0,1-1.815,2.632,2.349,2.349,0,0,1-2.8.179,3.776,3.776,0,0,1-1.054-.961,7.858,7.858,0,0,1-1.4-3.08,6.851,6.851,0,0,1-.179-.974c1.163.474,1.962.321,2.564-.476a2,2,0,0,0,.012-2.324c-.586-.8-1.4-.956-2.568-.489" transform="translate(0 0)"/>
                                    <path id="Tracé_4" data-name="Tracé 4" d="M8.211,13.536a3.67,3.67,0,0,1-1.056,1.3,3.132,3.132,0,0,1-1.689.669,2.291,2.291,0,0,1-1.505-.511,5.462,5.462,0,0,1-1.7-2.284,10.393,10.393,0,0,1-.683-2.331,2.172,2.172,0,0,1-.015-.261,1.9,1.9,0,0,0,1.757.163A1.867,1.867,0,0,0,4.2,9.52a1.976,1.976,0,0,0-.16-2.3A1.913,1.913,0,0,0,2.87,6.561a1.888,1.888,0,0,0-1.31.286A4.138,4.138,0,0,1,1.7,5.983,7.675,7.675,0,0,1,3.259,2.618,3.175,3.175,0,0,1,4.881,1.527a2.563,2.563,0,0,1,1.064.005,2.593,2.593,0,0,1,.975.438A3.464,3.464,0,0,1,8.2,3.413c.167-.37.318-.718.482-1.06.236-.494.246-.5-.119-.893A4.328,4.328,0,0,0,7.147.4,4.235,4.235,0,0,0,5.431,0a3.859,3.859,0,0,0-2.68,1.077A7.746,7.746,0,0,0,.593,4.584,12.879,12.879,0,0,0,.053,9.612a11.023,11.023,0,0,0,1.14,4.222,6.133,6.133,0,0,0,2.148,2.493,3.807,3.807,0,0,0,4.287-.037,4.4,4.4,0,0,0,1.161-1.042.283.283,0,0,0,.091-.181.286.286,0,0,0-.052-.2,10.818,10.818,0,0,1-.611-1.334" transform="translate(0 0)"/>
                                </svg>
                            </button>
                               
                        </div>
                        <div class="my-[20px]">
                                @if($errors->has('password'))
                                    <p class="text-red-500 text-sm text-center">{{ $errors->first('password') }}</p>
                                @endif
                        </div>


                     

                        <div class="relative flex flex-wrap items-stretch w-50 mt-10">
                            <label class="custom-checkbox-label flex mx-auto">

                                <div class="bg-gray-300 shadow-lg rounded-lg border-solid border-amber-800 w-6 h-6 p-1 flex justify-center items-center mr-2">
                                    <input type="checkbox" name="remember_me" class="hidden">
                                    <svg class="hidden w-4 h-4 text-amber-800 pointer-events-none" viewBox="0 0 172 172">
                                        <g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal">
                                            <path d="M0 172V0h172v172z"/>
                                            <path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="2"/>
                                        </g>
                                    </svg>
                                </div>

                                <span class="select-none text-md text-amber-800 font-semibold">Se rappeler de moi ?</span>
                            </label>
                        </div>

                        <div class="flex justify-center">
                            
                            <button class="py-[10px] mt-10 w-full rounded-full px-auto bg-amber-800 text-white" type="submit">Se connecter</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    <script src="{{ asset('js/app.js') }}"></script>
    @livewireScriptConfig
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script>
        $('.show').on('click',()=> {
            $('.show').addClass('hidden');
            $('.hide').removeClass('hidden');
            $('#password').attr('type','text');
        });
        $('.hide').on('click',() => {
            $('.hide').addClass('hidden');
            $('.show').removeClass('hidden');
            $('#password').attr('type','password');
        });
    </script>
</body>
</html>
