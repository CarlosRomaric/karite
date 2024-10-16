
@extends('layouts.appFront')
@section('title') - Offres des coopératives @endsection
@push('stylesheet')
   <style>
            .web-safe {
                    font-family: 'Avenir-black' ;
                }

            .select2-container--default .select2-selection--single {
                background-color: #fff;
                border: 1px solid #aaa;
                border-radius: 0px;
                padding-top: 10px;
                padding-left: 4px;
                padding-bottom: 30px;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                color: #444;
                line-height: 15px;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                display: none;
            }

            .selectize-input, .selectize-input input {
                color: #303030;
                font-family: inherit;
                font-size: 10px;
                /* line-height: 44px; */
                font-smoothing: inherit;
                border: 1px solid #aaa;
                border-radius: 0px;
               
            }

            .selectize-input.dropdown-active {
                border-radius: 0px;
            }

            .selectize-control.multi .selectize-input [data-value] {
                text-shadow: 0 1px 0 rgba(0,51,83,.3);
                border-radius: 0px;
                background-color: #778801;
                border: 1px solid #778801;
                background-image: linear-gradient(to bottom,#778801,#97a533);
                background-repeat: repeat-x;
                box-shadow: 0 1px 0 rgba(0,0,0,.2),inset 0 1px rgba(255,255,255,.03)
            }

            .selectize-control.multi .selectize-input [data-value].active {
                background-color: #778801;
                border: 1px solid #778801;
                background-image: linear-gradient(to bottom,#778801,#97a533);
                background-repeat: repeat-x;
            }

            .selectize-control.multi .selectize-input>div.active {
                background: #92c836;
                color: #fff;
                border: 1px solid #778801;
            }
    </style>
@endpush
@section('content')
<div class="bg-amber-200/50 py-14">
    <nav class="bg-grey-light w-full rounded-md">
        <ol class="list-reset flex mx-14">
            <li>
            <a
                href="{{ route('pages.acceuil') }}"
                class="text-amber-950 transition duration-150 ease-in-out hover:text-primary-accent-300 focus:text-primary-accent-300 active:text-primary-accent-300 motion-reduce:transition-none dark:text-primary-400"
                >Acceuil</a
            >
            </li>
            <li>
            <span class="mx-2 text-neutral-400">></span>
            </li>
            <li>
            <a
                href="{{ route('pages.createCoop') }}"
                class="text-amber-400 transition duration-150 ease-in-out hover:text-primary-accent-300 focus:text-primary-accent-300 active:text-primary-accent-300 motion-reduce:transition-none dark:text-primary-400"
                >Offres des coopératives</a
            >
            </li>
        
        </ol>
    </nav>
    

</div>
<div class="px-4 md:px-24 pt-24 pb-10  w-full">
        <div class="grid place-items-center">
            <div class="titles-container grid place-items-center">
                <img src="{{ asset('assets/img/circle-icons.png') }}" alt="">
                <h1 class="text-3xl uppercase font-bold text-amber-950">Liste des offres de Beurre de karité des Cooperative</h1>
            </div>

            
        </div>
        <div class="text-lg my-4 ">
           
           @livewire('offer.offer-component')
           
        </div>
</div>
@endSection




