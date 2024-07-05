@extends('layouts.app')
@section('title') - Tableau de bord @endsection
@push('stylesheets')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map{
            height: 700px;
        }
    </style>
@endpush
@section('content')
       
        <div class="container py-5 px-20 mx-auto md:px-20  md:container md:mx-auto content">

            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-amber-600 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-3 h-3 text-amber-900 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                            </svg>
                            Tableau de Bord
                        </a>
                    </li>
                    
                    
                </ol>
            </nav>
            <div class="pt-10">
                <label for="" class="text-4xl font-bold">Tableau de Bord</label>


                <div class="flex flex-col md:flex-row">
                    <!-- Partie gauche -->
                    <div class="w-full md:w-full px-4 md:px-0">
                        <div class="bg-amber-100 pl-4  grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 rounded-lg my-5 shadow-lg">
                            @if(auth()->user()->isTraceAgriAdmin() || auth()->user()->isPlateformAdmin())
                            <div class="card-amber">
                                <p class="font-semibold">Nombre de Coopératives</p>
                                <p class="stat">{{ $agribusinesses->count() }}</p>
                            </div>
                            @endif
                            <!-- Cartes de statistiques -->
                            <div class="card-amber">
                                <p class="font-semibold">Quantité d'amande</p>
                                <p class="stat">{{ $farmers->count() }}</p>
                            </div>
                            
                            <div class="card-amber">
                            <p class="font-semibold">Quantités de Beurre de karité Bio</p>
                                <p class="stat">{{ $offers->count() }}</p>
                            </div>
                           
                            <div class="card-amber-final">
                                <p class="font-semibold">Quantités de Beurre de karité Ordinaire</p>
                                <p class="stat">{{ $offers->count() }}</p>
                            </div>
                            <!-- Zone de texte responsive -->
                            <!-- <div class="text-amber-800 py-5 max-w-full col-span-1 md:col-span-2 md:text-base">
                                <p class="font-semibold text-base">Quantités de Beurres de Karités (BIO) </p>
                                <p class="mt-5 text-amber-800">
                                    <span class="font-semibold text-base">Hommes: </span><span class="stat-farmers"></span>
                                   
                                </p>
                            </div> -->
                        </div>
                    </div>

                    <!-- Partie droite -->
                    <!-- <div class="w-full md:w-1/3  px-4 mt-4 md:mt-0">
                        <div class="bg-amber-100 rounded-lg my-5 py-7 px-10 text-amber-800 flex flex-col md:flex-row items-center justify-between shadow-lg">
                            <div class="mb-4 md:mb-0">
                                <p>Utilisateurs créés</p>
                                <p class="stat">{{ $users->count() }}</p>
                            </div>
                            <div class="md:ml-auto">
                                <img src="{{ asset('assets/img/icons/UserP-green.svg') }}" alt="userIcons" class="outline-gray-500">
                            </div>
                        </div>
                    </div> -->
                </div>
              
                
               <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 
                <div class="flex flex-col">
                    <div class="overflow-x-auto  sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full text-left text-sm font-light my-10">
                                    <thead class="border-b bg-amber-800 text-white font-medium dark:border-amber-900">
                                        <tr class="">
                                        <th scope="col" class="rounded-tl-lg px-6 py-4">#</th>
                                        <th scope="col" class="px-6 py-4">Coopératives</th>
                                        <th scope="col" class="px-6 py-4">Total Producteurs</th>
                                        <th scope="col" class="px-6 py-4">Total offres</th>
                                        <th scope="col" class=" px-6 py-4">Total Producteurs Hommes</th>
                                        <th scope="col" class="rounded-tr-lg px-6 py-4">Total Producteurs Femmes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=0;?>
                                    
                                            @forelse($agribusinesses as $key => $agribusiness)
                                        <tr class="border-b border-t-1  border-amber-900 {{ $i % 2 !== 0 ? '' : 'bg-amber-100' }} dark:border-amber-900">
                                            <?php $i++ ?>
                                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $i }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $agribusiness->name }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $farmers->where('agribusiness_id', $agribusiness->id)->count() }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">0</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $farmers->where('agribusiness_id', $agribusiness->id)->whereIn('sexe', ['M', 'H'])->count() }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $farmers->where('agribusiness_id', $agribusiness->id)->where('sexe', 'F')->count() }}</td>
                                        </tr>
                                    
                                        @empty
                                            <tr class="border-b border-t-4 border-amber-900 dark:border-amber-900">
                                                <td colspan="6" class="whitespace-nowrap text-center px-6 py-4 text-2xl font-bold">
                                                    Aucune donnée enregistrée
                                                </td>
                                            </tr>
                                        @endforelse
                                    
                                    
                                    </tbody>
                                </table>
                                <div class="livewire-pagination">{{ $agribusinesses->links('custom-pagination-links') }}</div>
                                
                                <div id="map" class="rounded-lg shadow-xl" wire:ignore></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
      

@endsection
 
@push('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        //convertir le tableau PHO en tableau Javascript
        var regions = @json($regions);

        // Initialiser la carte
        var map = L.map('map').setView([7.539989, -5.547080], 6.5);

        // Couches de base
         var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        });
        var osmHOTLayer = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'});

        var satelliteLayer = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="https://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (CC-BY-SA)',
        });

        var openMapLayer = L.tileLayer('https://{s}.tile.openmaptiles.org/{z}/{x}/{y}.png', {
            attribution: 'Map data: &copy; <a href="https://www.openmaptiles.org/">OpenStreetMap</a> contributors, <a href="https://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (CC-BY-SA)',
        });

        

         // Ajouter la couche OSM par défaut
         satelliteLayer.addTo(map);

        // Créer un LayerGroup pour contenir les marqueurs
        var markerLayer = L.layerGroup();

        // Ajouter des marqueurs pour chaque région
        regions.forEach(function(region) {

            var totalWeight = 0;

            region.agribusinesses.forEach(function(agribusiness) {
                if (agribusiness.offers && agribusiness.offers.length > 0) {
                    totalWeight += agribusiness.offers[0].total_weight || 0;
                }
            });

            var marker = L.marker([region.latitude, region.longitude])
                          .bindPopup(
                            '<b>Region: </b>' + region.name + 
                            '<br> <b>Quantité disponible: </b>'+(totalWeight/1000)+' (T)'
                            ); // supposant que 'name' est une propriété de region
            markerLayer.addLayer(marker);
        });

        // Ajouter la couche de marqueurs à la carte
        markerLayer.addTo(map);


        // Contrôle des couches
        var baseMaps = {
            "Satellite": satelliteLayer,
            "OpenStreetMap": osmLayer,
            'osmHOT': osmHOTLayer,
            'openMap': openMapLayer
        };

        var overlayMaps = {
            "Markers": markerLayer,
        };

        L.control.layers(baseMaps, overlayMaps).addTo(map);
    </script>
@endpush