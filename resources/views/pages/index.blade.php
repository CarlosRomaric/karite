@extends('layouts.appFront')
@section('title') - Acceuil @endsection
@push('stylesheets')
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
    data-spa="auto" defer
/>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
    data-spa="auto" defer
></script>

   <style>
    .web-safe {
			font-family: 'Avenir-black' ;
		}
   </style>
@endpush
@section('content')
  
    <div class="flex flex-col lg:flex-row px-4 bg-karite-front">
        <div class="w-1/2 lg:w-1/2  py-7">
            <div class="py-16"></div>
            <div class="px-24 mt-6 titles-container">
              <img src="{{ asset('assets/img/karite.png') }}" alt="">
            </div>

            <h2 class="text-amber-950 uppercase font-extrabold text-3xl px-24 mt-4">POUR ACCOMPAGNER LES FEMMES ET LES ACTEURS DE LA FILIERE </h2>
            <div class="py-16">
                 <lottie-player src="Animation - 1707896142745.json" background="transparent" speed="1" style="width: 90px; height: 92px;" loop autoplay></lottie-player>
            </div>
            
        </div>
        
        <div class="w-full lg:w-1/2 items-center justify-center shadow-md">
            <img src="{{ asset('images/bg_karite_2.png') }}" alt="image">
        </div>
        
    </div>

    <div class="px-4 md:px-24 pt-24 pb-10  text-center" id="about">
        <div class="titles-container">
            <img src="{{ asset('assets/img/circle-icons.png') }}" alt="" class="h-auto">
            <h1 class="text-3xl uppercase font-bold text-amber-950">KARITÉ 2.0 POUR SOUTENIR LA PRODUCTION ET LA COMMERCIALISATION DU BEURRE DE KARITÉ AVEC SES PRODUITS DÉRIVÉS</h1>
        </div>
        <div class="text-lg text-center text-gray-500/50 my-4">Le beurre de karité est un excellent hydratant et émollient, et grâce à sa teneur élevée en diverses graisses et vitamines, il vous aide à maintenir la santé et l’élasticité de la peau. Il peut aussi être utilisé pour prévenir et atténuer les vergetures. Il existe plusieurs produits dérivés du karité autre que le beurre :</div>
    </div>

    <div class="px-4 md:px-24 py-14">
        <div class="flex">
            <div class="w-1/2 grid place-items-center">
                <img src="{{ asset('images/karite.png') }}" alt="image" class="h-auto lg:h-400">
            </div>
            <div class="w-1/2 grid place-items-center font-semibold text-amber-950 text-3xl">
                <ul class="uppercase">
                    <li class="my-5">- Beurre de karité</li>
                    <li class="my-5">- Huile de karité</li>
                    <li class="my-5">- Lotion de karité</li>
                    <li class="my-5">- Pommade de karité</li>
                    <li class="my-5">- Et bien d'autres</li>
                </ul>
            </div>
        </div>  
    </div>

    <div class="px-4  md:px-24 py-14 bg-amber-100/50" id="advantage">

        <div class="grid place-items-center">
            <div class="titles-container grid place-items-center">
                <img src="{{ asset('assets/img/circle-icons.png') }}" alt="" class="h-auto lg:h-400">
                <h1 class="text-3xl uppercase font-bold text-amber-950">AVANTAGES DE KARITÉ 2.0</h1>
            </div>
        </div>

            
        <div class="flex-wrap ">

            <!-- <div class="flex">
               
                <div class="w-5/6">
                    <div class="stepper">
                        <div class="step first-step completed">
                            <div class="step-label">#</div>
                            <div class="step-description w-56">Commercialisation plus large</div>
                        </div>
                        <div class="step ">
                            <div class="step-label">#</div>
                            <div class="step-description w-56">Vente et achat aux meilleurs prix</div>
                        </div>
                        <div class="step end-step">
                            <div class="step-label">#</div>
                            <div class="step-description w-40">Traçabilité des Flux</div>
                        </div>
                        
                    </div>
                    <div class="w-1/6"></div>
                </div>
            </div>

            <div class="flex">
                <div class="w-1/6"></div>
                <div class="w-5/6">
                    <div class="stepper">
                        <div class="step first-step completed">
                            <div class="step-label">#</div>
                            <div class="step-description w-56 ">Inclusion financière</div>
                        </div>
                        <div class="step ">
                            <div class="step-label">#</div>
                            <div class="step-description w-40">Accès aux financements</div>
                        </div>
                        <div class="step end-step">
                            <div class="step-label">#</div>
                            <div class="step-description w-44">Valorisation et labelisation</div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="flex flex-wrap">
                <div class="w-full md:w-5/6">
                    <div class="stepper">
                        <div class="step first-step completed md:flex-row flex-col">
                            <div class="step-label">#</div>
                            <div class="step-description md:w-56 sm:text-base text-sm">Commercialisation plus large</div>
                        </div>
                        <div class="step md:flex-row flex-col">
                            <div class="step-label">#</div>
                            <div class="step-description md:w-56 sm:text-base text-sm">Vente et achat aux meilleurs prix</div>
                        </div>
                        <div class="step end-step md:flex-row flex-col">
                            <div class="step-label">#</div>
                            <div class="step-description md:w-40 sm:text-base text-sm">Traçabilité des Flux</div>
                        </div>
                    </div>
                </div>
                <div class="w-1/6"></div>
            </div>

            <div class="flex">
                <div class="w-1/6"></div>
                <div class="w-full md:w-5/6">
                    <div class="stepper">
                        <div class="step first-step completed md:flex-row flex-col">
                            <div class="step-label">#</div>
                            <div class="step-description md:w-56 sm:text-base text-sm">Inclusion financière</div>
                        </div>
                        <div class="step md:flex-row flex-col">
                            <div class="step-label">#</div>
                            <div class="step-description md:w-40 sm:text-base text-sm">Accès aux financements</div>
                        </div>
                        <div class="step end-step md:flex-row flex-col">
                            <div class="step-label">#</div>
                            <div class="step-description md:w-44 sm:text-base text-sm">Valorisation et labelisation</div>
                        </div>
                    </div>
                </div>
            </div>


           
        </div>
    
       


       
       
    </div>
    


    

    
@endsection
   

@section('script')
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

@endsection