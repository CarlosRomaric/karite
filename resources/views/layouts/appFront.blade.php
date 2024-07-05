<?php
/**
 * User: Carlos Romaric
 * Date: 20/03/2020
 * Time: 07:55
 */
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} @yield('title')</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/logo-karite-white.png') }}" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=MaPolice:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
    integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    />
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
    data-spa="auto" defer
    ></script>

    @vite(['resources/scss/style.scss','resources/js/app.js'])
    @livewireStyles
    @stack('stylesheets')
</head>
<body>
        
        <nav class="relative flex w-full  flex-nowrap items-center justify-between bg-zinc-50 py-2 shadow-dark-mild dark:bg-neutral-700 lg:flex-wrap lg:justify-start lg:py-4 shadow-xl" data-twe-navbar-ref>
    
            <div class="flex w-full flex-wrap items-center justify-between px-12">
                <!-- Logo à l'extrême gauche -->
                <div class="flex items-center mr-auto">
                    <a href="{{ route('pages.acceuil') }}" class=""><img src="{{ asset('assets/img/logo-karite-2.png') }}" alt="Logo" class=" mr-2" style="height:70px"></a>
                </div>
                
                <!-- Boutons à l'extrême droite -->
                

                <!-- Hamburger button for mobile view -->
                <button class="block border-0 bg-transparent px-2 text-black hover:no-underline hover:shadow-none focus:no-underline focus:shadow-none focus:outline-none focus:ring-0 dark:text-neutral-200 lg:hidden" type="button" data-twe-collapse-init data-twe-target="#navbarSupportedContent8" aria-controls="navbarSupportedContent8" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="[&>svg]:w-7 [&>svg]:stroke-black/50 dark:[&>svg]:stroke-neutral-200">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
                
                <!-- Collapsible navbar container -->
                <div class="!visible mt-2 hidden flex-grow basis-[100%] items-center justify-center lg:mt-0 lg:!flex lg:basis-auto" id="navbarSupportedContent8" data-twe-collapse-item>
                    <!-- Left links -->
                    <ul class="list-style-none flex flex-col ps-0 lg:mt-1 lg:flex-row" data-twe-navbar-nav-ref>
                        <!-- Link -->
                        <li class="mb-4 ps-2 lg:mb-0 lg:pe-1 lg:ps-0" data-twe-nav-item-ref>
                            <a class="p-0 text-black/60 transition duration-200 hover:text-amber-300 hover:ease-in-out focus:text-black/80 active:text-amber-200 motion-reduce:transition-none dark:text-white/60 dark:hover:text-white/80 dark:focus:text-white/80 dark:active:text-white/80 lg:px-2" href="/" data-twe-nav-link-ref>Acceuil</a>
                        </li>
                        
                        <!-- Disabled link -->
                        <li class="mb-4 ps-2 lg:mb-0 lg:pe-1 lg:ps-0" data-twe-nav-link-ref>
                            <a class="p-0 text-black transition duration-200 hover:text-amber-300 hover:ease-in-out focus:text-black/80 active:text-amber-200 motion-reduce:transition-none dark:text-white/60 dark:hover:text-white/80 dark:focus:text-white/80 dark:active:text-white/80 lg:px-2" href="{{ route('pages.acceuil') }}#about">À Propos</a>
                        </li>

                        <li class="mb-4 ps-2 lg:mb-0 lg:pe-1 lg:ps-0" data-twe-nav-link-ref>
                            <a class="p-0 text-black transition duration-200 hover:text-amber-300 hover:ease-in-out focus:text-black/80 active:text-amber-200 motion-reduce:transition-none dark:text-white/60 dark:hover:text-white/80 dark:focus:text-white/80 dark:active:text-white/80 lg:px-2" href="{{ route('pages.acceuil') }}#advantage">Avantages</a>
                        </li>
                    </ul>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('auth.showLoginForm') }}" class="px-4 py-2 bg-amber-300 font-semibold text-gray-800 rounded-full">Se connecter</a>
                    <a href="{{ route('pages.createCoop') }}" class="px-8 py-2 bg-amber-950 font-semibold text-gray-100 rounded-full">S'inscrire</a>
                    <a href="https://storekarite.com" target="_blank" class="px-8 py-2 bg-amber-300 font-semibold text-gray-800 rounded-full">Acheter</a>
                </div>

            </div>

        </nav>
            
        
        
        @yield('content')

        <div class="footer bg-black text-white border-t py-4 px-10">
            <div class="container mx-auto px-4">
                <div class="md:flex justify-between items-center text-sm">
                    <div class="flex-1 text-center md:text-left mx-3 mb-4 md:mb-0">
                        <a href="{{ route('pages.acceuil') }}" class="">
                            <img src="{{ asset('assets/img/logo-karite-white.png') }}" alt="black logo" class="h-24 mb-4">
                        </a>
                        
                        <p class="text-gray-200/50">
                        Le projet Karité 2.0 est une initiative développée par la Startup <a href="https://ict4dev.ci/" target="_blank" class=""></a>ICT4DEV dans l’objectif de soutenir les acteurs de la filière Karité, notamment les femmes en zone rurale,  en la dotant d’une plateforme digitale pour identifier les acteurs et capter les flux de production tout en assurant une commercialisation efficace du beurre de Karité brut et de ses produits dérivés.
                        </p>
                        <div class="titles-container my-4">
                            <a href="#" class="">
                                <svg id="Groupe_325" data-name="Groupe 325" xmlns="http://www.w3.org/2000/svg" width="27.604" height="27.605" viewBox="0 0 27.604 27.605">
                                    <path id="Tracé_314" data-name="Tracé 314" d="M4303.332,6822.279a13.8,13.8,0,1,0,13.8,13.8,13.818,13.818,0,0,0-13.8-13.8Zm3.435,14.287h-2.245v8.006h-3.328v-8.006h-1.582v-2.828h1.582v-1.83a3.121,3.121,0,0,1,3.357-3.358l2.465.01v2.747h-1.788a.678.678,0,0,0-.706.77v1.664h2.535Zm0,0" transform="translate(-4289.532 -6822.279)" fill="#fff"/>
                                </svg>
                            </a>
                            <a href="#">
                                <svg class="mx-2" id="Groupe_326" data-name="Groupe 326" xmlns="http://www.w3.org/2000/svg" width="27.871" height="27.872" viewBox="0 0 27.871 27.872">
                                    <path id="Tracé_315" data-name="Tracé 315" d="M4357.5,6840.931a2.787,2.787,0,1,0-2.787-2.79,2.792,2.792,0,0,0,2.787,2.79Zm0,0" transform="translate(-4343.564 -6824.207)" fill="#fff"/>
                                    <path id="Tracé_316" data-name="Tracé 316" d="M4364.748,6834.11v-2.686h-.35l-2.338.008.012,2.686Zm0,0" transform="translate(-4344.721 -6823.587)" fill="#fff"/>
                                    <path id="Tracé_317" data-name="Tracé 317" d="M4355.413,6822.122a13.936,13.936,0,1,0,13.937,13.935,13.952,13.952,0,0,0-13.937-13.935Zm7.926,12.309v6.491a3.064,3.064,0,0,1-3.064,3.061h-9.724a3.064,3.064,0,0,1-3.062-3.061V6831.2a3.065,3.065,0,0,1,3.062-3.064h9.724a3.066,3.066,0,0,1,3.064,3.064Zm0,0" transform="translate(-4341.479 -6822.122)" fill="#fff"/>
                                    <path id="Tracé_318" data-name="Tracé 318" d="M4361.162,6838.359a4.334,4.334,0,1,1-8.352-1.626h-2.364v6.491a1.515,1.515,0,0,0,1.518,1.516h9.724a1.518,1.518,0,0,0,1.519-1.516v-6.491h-2.367a4.254,4.254,0,0,1,.323,1.626Zm0,0" transform="translate(-4342.892 -6824.423)" fill="#fff"/>
                                </svg>
                            </a>
                            <a href="#">
                                <svg class="" id="Groupe_327" data-name="Groupe 327" xmlns="http://www.w3.org/2000/svg" width="27.251" height="27.251" viewBox="0 0 27.251 27.251">
                                    <path id="Tracé_319" data-name="Tracé 319" d="M4407.779,6822.49a13.625,13.625,0,1,0,13.627,13.625,13.642,13.642,0,0,0-13.627-13.625Zm6.082,10.507c0,.135.007.271.007.408a8.919,8.919,0,0,1-13.731,7.511,6.214,6.214,0,0,0,.748.046,6.294,6.294,0,0,0,3.9-1.343,3.141,3.141,0,0,1-2.929-2.179,3.274,3.274,0,0,0,.59.057,3.061,3.061,0,0,0,.826-.111,3.135,3.135,0,0,1-2.517-3.073.223.223,0,0,1,0-.04,3.1,3.1,0,0,0,1.42.391,3.137,3.137,0,0,1-.972-4.186,8.9,8.9,0,0,0,6.463,3.277,3.138,3.138,0,0,1,5.343-2.862,6.239,6.239,0,0,0,1.995-.76,3.146,3.146,0,0,1-1.38,1.736,6.215,6.215,0,0,0,1.8-.492,6.4,6.4,0,0,1-1.562,1.62Zm0,0" transform="translate(-4394.155 -6822.49)" fill="#fff"/>
                                </svg>
                            </a>
                            <a href="#">
                                <svg class="mx-2" id="Groupe_328" data-name="Groupe 328" xmlns="http://www.w3.org/2000/svg" width="27.87" height="27.872" viewBox="0 0 27.87 27.872">
                                    <path id="Tracé_320" data-name="Tracé 320" d="M4453.47,6841.638v2.991a5.4,5.4,0,0,1,0,.725c-.086.231-.473.479-.625.025a6.171,6.171,0,0,1,0-.73l0-3.011h-1.052l0,2.963c0,.455-.011.794,0,.947.025.272.016.59.271.771a1.288,1.288,0,0,0,1.618-.534l0,.617h.85v-4.765Z" transform="translate(-4441.225 -6825.197)" fill="#fff"/>
                                    <path id="Tracé_321" data-name="Tracé 321" d="M4455.482,6834.684a.492.492,0,0,0,.469-.509v-2.637a.471.471,0,1,0-.938,0v2.637A.493.493,0,0,0,4455.482,6834.684Z" transform="translate(-4441.733 -6823.525)" fill="#fff"/>
                                    <path id="Tracé_322" data-name="Tracé 322" d="M4451.4,6839.663l-3.385,0v.815l1.056,0v5.615h1.059v-5.6h1.27Z" transform="translate(-4440.63 -6824.885)" fill="#fff"/>
                                    <path id="Tracé_323" data-name="Tracé 323" d="M4456.848,6841.514l0-1.852-1.057,0,0,6.387.87-.013.079-.4c1.111,1,1.809.315,1.808-.89l0-2.49C4458.542,6841.313,4457.823,6840.746,4456.848,6841.514Zm.912,3.418a.474.474,0,0,1-.926,0v-2.794a.473.473,0,0,1,.926,0Z" transform="translate(-4441.856 -6824.885)" fill="#fff"/>
                                    <path id="Tracé_324" data-name="Tracé 324" d="M4461.7,6844.685c0,.03,0,.066,0,.1v.438a.431.431,0,0,1-.433.425h-.156a.431.431,0,0,1-.434-.425v-1.149h1.817v-.675a10.265,10.265,0,0,0-.055-1.269c-.13-.892-1.4-1.034-2.039-.577a1.184,1.184,0,0,0-.444.59,3.284,3.284,0,0,0-.135,1.052v1.485c0,2.467,3.037,2.118,2.676,0Zm-1.006-2.007a.471.471,0,0,1,.472-.466h.064a.471.471,0,0,1,.473.466l-.012.573h-1Z" transform="translate(-4442.49 -6825.144)" fill="#fff"/>
                                    <path id="Tracé_325" data-name="Tracé 325" d="M4453.186,6822.122a13.936,13.936,0,1,0,13.935,13.936A13.935,13.935,0,0,0,4453.186,6822.122Zm1.874,6.875h.969v3.853a.387.387,0,0,0,.773,0V6829h.93v4.951h-1.181l.02-.41a.953.953,0,0,1-.3.374.676.676,0,0,1-.405.125.749.749,0,0,1-.433-.119.726.726,0,0,1-.254-.317,1.422,1.422,0,0,1-.1-.413c-.013-.143-.021-.427-.021-.853Zm-2.9.051a1.266,1.266,0,0,1,.8-.243,1.482,1.482,0,0,1,.7.156,1.155,1.155,0,0,1,.454.407,1.585,1.585,0,0,1,.218.514,4.069,4.069,0,0,1,.06.812v1.252a6.619,6.619,0,0,1-.056,1.011,1.6,1.6,0,0,1-.232.6,1.076,1.076,0,0,1-.454.412,1.445,1.445,0,0,1-.64.133,1.786,1.786,0,0,1-.682-.113.93.93,0,0,1-.436-.344,1.5,1.5,0,0,1-.221-.554,5.232,5.232,0,0,1-.066-.976V6830.8a4.1,4.1,0,0,1,.12-1.114A1.244,1.244,0,0,1,4452.16,6829.047Zm-3.091-2,.709,2.422.7-2.415h1.217l-1.315,3.253v3.8h-1.113l0-3.8-1.4-3.261Zm11.728,15.707a2.415,2.415,0,0,1-2.49,2.318h-10.242a2.415,2.415,0,0,1-2.49-2.318v-5.316a2.416,2.416,0,0,1,2.49-2.319h10.242a2.416,2.416,0,0,1,2.49,2.319Z" transform="translate(-4439.25 -6822.122)" fill="#fff"/>
                                </svg>
                            </a>
                           
                        </div>
                    </div>

                    <div class="flex-1 text-center md:text-left mx-3 mb-4 md:mb-0 mx">
                       <p>
                            <h1 class="font-bold text-xl py-5">Liens Utiles</h1>
                            <ul>
                                <li class="py-2 text-gray-200/50"><a href="{{ route('pages.acceuil') }}" class=""></a>Acceuil</li>
                                <li class="py-2 text-gray-200/50"><a href="#" class=""></a>A propos</li>
                                <li class="py-2 text-gray-200/50"><a href="#" class=""></a>Avantages</li>
                            </ul>
                       </p>
                    </div>
                    <div class="flex-1 text-center md:text-left mx-3 mb-4 md:mb-0">
                            <h1 class="font-bold text-xl py-5">Contact</h1>
                            <ul>
                                <li class="py-2 text-gray-200/50 titles-container">
                                    <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="15.33" height="15.332" viewBox="0 0 15.33 15.332">
                                        <path id="paper-plane" d="M14.77.564A1.9,1.9,0,0,0,12.982.053L2.76,2.205A3.191,3.191,0,0,0,.937,7.624l1.1,1.1a.639.639,0,0,1,.187.452V11.2a1.894,1.894,0,0,0,.192.821l-.005,0,.017.017a1.917,1.917,0,0,0,.87.866l.017.017,0-.005a1.894,1.894,0,0,0,.821.192H6.161a.639.639,0,0,1,.452.187l1.1,1.1a3.171,3.171,0,0,0,2.249.941,3.226,3.226,0,0,0,1.025-.169,3.151,3.151,0,0,0,2.136-2.546L15.276,2.374A1.9,1.9,0,0,0,14.77.564ZM2.94,7.818l-1.1-1.1A1.878,1.878,0,0,1,1.38,4.758a1.9,1.9,0,0,1,1.6-1.294L13.1,1.333l-9.6,9.6V9.173A1.9,1.9,0,0,0,2.94,7.818ZM11.865,12.4a1.917,1.917,0,0,1-3.251,1.094l-1.1-1.1a1.9,1.9,0,0,0-1.354-.561H4.4l9.6-9.6Z" transform="translate(-0.003 0)" fill="#fff"/>
                                    </svg>
                                    karite@karite2point0.com
                                    </li>
                                <li class="py-2 text-gray-200/50 titles-container">
                                <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18.045" height="14.868" viewBox="0 0 18.045 14.868">
                                    <defs>
                                        <clipPath id="clip-path">
                                        <rect id="Rectangle_162" data-name="Rectangle 162" width="18.045" height="14.868" fill="#fff"/>
                                        </clipPath>
                                    </defs>
                                    <g id="Groupe_331" data-name="Groupe 331" transform="translate(0 0)">
                                        <g id="Groupe_330" data-name="Groupe 330" transform="translate(0 0)" clip-path="url(#clip-path)">
                                        <path id="Tracé_6888" data-name="Tracé 6888" d="M9.115,2.717c3.042.03,4.949-.158,5.2,3.213h3.713C18.033.707,13.476,0,9.018,0S.006.707.006,5.93H3.688C3.971,2.494,6.1,2.686,9.115,2.717" transform="translate(0.012 0.001)" fill="#fff"/>
                                        <path id="Tracé_6889" data-name="Tracé 6889" d="M1.858,3.339c.9,0,1.657.055,1.824-.834l.034-.417H0C0,3.409.831,3.339,1.858,3.339" transform="translate(0 4.27)" fill="#fff"/>
                                        <path id="Tracé_6890" data-name="Tracé 6890" d="M11.669,2.312V1.788c0-.238-.271-.25-.606-.25h-.545c-.335,0-.606.012-.606.25v.8H6.05v-.8c0-.238-.271-.25-.606-.25H4.9c-.335,0-.606.012-.606.25v.984A39,39,0,0,0,.428,8.049l0,3.146a.527.527,0,0,0,.527.527H15a.527.527,0,0,0,.527-.527V8.034a39.618,39.618,0,0,0-3.862-5.263ZM5.858,8.473a.512.512,0,1,1,.512-.512.511.511,0,0,1-.512.512m0-1.757A.512.512,0,1,1,6.37,6.2a.511.511,0,0,1-.512.512m0-1.754A.512.512,0,1,1,6.37,4.45a.511.511,0,0,1-.512.512M7.966,8.473a.512.512,0,1,1,.512-.512.511.511,0,0,1-.512.512m0-1.757A.512.512,0,1,1,8.477,6.2a.511.511,0,0,1-.512.512m0-1.754a.512.512,0,1,1,.512-.512.511.511,0,0,1-.512.512m2.108,3.512a.512.512,0,1,1,.512-.512.511.511,0,0,1-.512.512m0-1.757a.512.512,0,1,1,.512-.512.511.511,0,0,1-.512.512m0-1.754a.512.512,0,1,1,.512-.512.511.511,0,0,1-.512.512" transform="translate(0.875 3.147)" fill="#fff"/>
                                        </g>
                                    </g>
                                </svg>

                                    (+225) 05 55 55 12 12</li>
                                <li class="py-2 text-gray-200/50  titles-container">
                                <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="13.575" height="18.566" viewBox="0 0 13.575 18.566">
                                    <g id="placeholder" transform="translate(-68.817)">
                                        <g id="Groupe_332" data-name="Groupe 332" transform="translate(68.817)">
                                        <path id="Tracé_6891" data-name="Tracé 6891" d="M75.6,0a6.857,6.857,0,0,0-6.788,6.909c0,2.131,1.078,4.718,3.2,7.688a33.877,33.877,0,0,0,3.153,3.789.607.607,0,0,0,.852.009,30.578,30.578,0,0,0,3.16-3.694c2.128-2.926,3.206-5.548,3.206-7.793A6.857,6.857,0,0,0,75.6,0Zm0,9.892a3.318,3.318,0,1,1,3.318-3.318A3.322,3.322,0,0,1,75.6,9.892Z" transform="translate(-68.817)" fill="#fff"/>
                                        </g>
                                    </g>
                                </svg>
                                    1600 Amphitheatre Parkway Mountain View, CA 94043 US</li>
                            </ul>
                    </div>
                    <div class="flex-1 text-center md:text-left">
                            <h1 class="font-bold text-xl py-5">Newsletter</h1>
                            <ul>
                                <li class="py-2 text-gray-200/50">
                                    <p class="w-full">Souscrivez a notre newsletter.</p>
                                   
                                </li>
                                <li class="py-2 text-gray-200/50">
                                    <form  wire:submit.prevent="subscribe">
                                        <input type="text" placeholder="Email" class="bg-black border-b-2 border-amber-300 border-x-0 border-t-0 w-full focus:bg-black focus:border-amber-300 focus:border-x-0 focus:border-t-0 ">
                                        <button type="submit" class="px-8 py-2 bg-amber-200 font-semibold text-amber-950 my-4 rounded-full">Envoyer</button>    
                                    </form>
                                   
                                    
                                </li>
                               
                            </ul>
                    </div>
                </div>
            </div>
        </div>

@livewireScriptConfig
@stack('javascript')
<script type="text/javascript" src="{{ asset('js/tw-elements.umd.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script>
    const { Tooltip, initTWE } = await import("tw-elements");

    window.iniTWE = initTWE;
    window.Tooltip = Tooltip;

    initTWE({ Tooltip });
    import {
    Collapse,
    Dropdown,
    initTWE,
    } from "tw-elements";

initTWE({ Collapse, Dropdown });
</script>


</body>