<?php
/**
 * Created by PhpStorm.
 * User: salioudiabate
 * Date: 24/03/2020
 * Time: 17:39
 */
?>
@extends('layouts.refonte.app')
@section('title') - Fiche producteur @endsection
@push('stylesheets')
    <!-- Leaflet (JS/CSS) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
@endpush
@section('content')
    <div class="w-full overflow-hidden px-4 py-8 md:p-12">
        <h1 class="mb-8 font-bold text-3xl">
            <a href="{{ route('farmers') }}" class="text-green-600 hover:text-teal-600">Producteurs</a>
            <span class="text-green-600 font-medium"> /</span> Fiche producteur
        </h1>
        <alert-component
            message="{{ session()->get('message') }}" type="{{ session()->get('status') }}"
            visible="{{ session()->has('message') && session()->get('status') }}"></alert-component>
        <farmer-show-component inline-template>
            <div class="bg-white p-10 w-full rounded shadow flex justify-center">
                <div class="w-1/3">
                    <div class="py-6">
                        <h1 class="font-semibold uppercase text-gray-700 text-2xl border-b-2 border-gray-700">1. Coordonnées</h1>
                    </div>
                    @if($farmer->picture)
                    <div class="flex gray-400 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="picture">
                                Photo du producteur
                            </label>
                            <img src="{{ asset("storage/{$farmer->picture}") }}" width="100" height="200" />
                        </div>
                    </div>
                    @endif
                    <div class="flex gray-400 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="agribusiness">
                                Coopérative du producteur
                            </label>
                            {{ $farmer->agribusiness ? $farmer->agribusiness->name : '' }}
                        </div>
                    </div>
                    <div class="flex gray-400 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="site">
                                Site
                            </label>
                            {{ $farmer->locality }}
                        </div>
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="identifier">
                                Identifiant
                            </label>
                            {{ $farmer->identifier }}
                        </div>
                    </div>
                    <div class="flex gray-400 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="agribusiness">
                                Code GPS
                            </label>
                            {{ $farmer->gps_code }}
                        </div>
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="fullname">
                                Nom & prénoms
                            </label>
                            {{ $farmer->fullname }}
                        </div>
                    </div>
                    <div class="flex gray-400 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="fullname">
                                Sexe du producteur
                            </label>
                            @if($farmer->sexe == 'H' || $farmer->sexe == 'M')
                                {{ 'Homme' }}
                            @elseif($farmer->sexe == 'F')
                                {{ 'Femme' }}
                            @else
                                {{ $farmer->sexe }}
                            @endif
                        </div>
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                                Numéro de téléphone
                            </label>
                            {{ $farmer->phone }}
                        </div>
                    </div>
                    <div class="flex gray-400 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="born_date">
                                Date de naissance
                            </label>
                            {{ $farmer->born_date ? $farmer->born_date : '' }}
                        </div>
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="born_place">
                                Lieu de naissance
                            </label>
                            {{ $farmer->born_place }}
                        </div>
                    </div>
                    <div class="flex gray-400 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="manager_fullname">
                                Nom & prénoms (Gestionnaire)
                            </label>
                            {{ $farmer->manager_fullname }}
                        </div>
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="manager_phone">
                                Sexe (Gestionnaire)
                            </label>
                            {{ $farmer->manager_sexe }}
                        </div>
                    </div>
                    <div class="flex gray-400 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="manager_fullname">
                                Numéro de téléphone (Gestionnaire)
                            </label>
                            {{ $farmer->manager_phone }}
                        </div>
                    </div>
                    <div class="py-6">
                        <h1 class="font-semibold uppercase text-gray-700 text-2xl border-b-2 border-gray-700">2. Données sociales</h1>
                    </div>
                    <div class="flex gray-400 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="marital_status">
                                Etat matrimonial
                            </label>
                            {{ $farmer->marital_status }}
                        </div>
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="number_of_children">
                                Nombre d'enfants
                            </label>
                            {{ $farmer->number_of_children }}
                        </div>
                    </div>
                    <div class="flex gray-400 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="number_of_women">
                                Nombre de Femme
                            </label>
                            {{ $farmer->number_of_women }}
                        </div>
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="number_of_dependants">
                                Nombre de personne à charge
                            </label>
                            {{ $farmer->number_of_dependants }}
                        </div>
                    </div>
                    <div class="flex gray-400 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="number_of_plots">
                                Nombre de parcelles
                            </label>
                            {{ $farmer->number_of_plots }}
                        </div>
                    </div>
                </div>
                <div class="w-2/3 pl-4">
                    <div class="flex flex-col h-full">
                        <div class="py-6">
                            <h1 class="font-semibold uppercase text-gray-700 text-2xl border-b-2 border-gray-700">3. Parcelles</h1>
                        </div>
                        <div></div>
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                            <tr class="text-left font-bold">
                                <th class="px-6 pt-5 pb-4">Parcelles</th>
                                <th class="px-6 pt-5 pb-4 text-center">Code GPS</th>
                                <th class="px-6 pt-5 pb-4 text-center">Superficie totale de <br> l'exploitation (ha)</th>
                                <th class="px-6 pt-5 pb-4">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($farmer->plots as $key => $plot)
                                <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
                                    <td class="border-t w-full px-6 py-4">{{ "Parcelle ".($key + 1) }}</td>
                                    <td class="border-t w-full px-6 py-4 text-center">{{ $plot->gps_code }}</td>
                                    <td class="border-t w-full px-6 py-4 text-center">{{ $plot->total_area }}</td>
                                    <td class="border-t w-full px-6 py-4">
                                        <a href="#" data-plot="{{ json_encode($plot) }}" @click.prevent="showGPSTrack($event)" class="text-red-500 pr-5">Voir le tracé</a>
                                        <delete-component destroy_url="{{ route('plots.delete', ['plot' => $plot->id]) }}" list_url="{{ route('farmers.show', ['farmer' => $farmer->id]) }}"></delete-component>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-8" style="height: 700px">
                            <map-component></map-component>
                        </div>
                    </div>
                </div>
            </div>
        </farmer-show-component>
    </div>
@endsection
