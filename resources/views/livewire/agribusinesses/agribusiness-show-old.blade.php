@push('stylesheets')
    <style>
        /* CSS pour les onglets */
            .tab-list {
                @apply flex justify-between space-x-1;
            }

            .tab-item {
                @apply flex-1 text-center;
            }

            .tab-link {
                @apply block px-4 py-2 rounded-t-lg text-sm font-medium text-gray-600 hover:text-yellow-700 transition-colors duration-200 ease-in-out;
                border-bottom: 2px solid transparent;
            }

            .tab-link.active-tab {
                @apply text-yellow-700 border-yellow-700;
            }

            /* Contenu des Onglets */
            .tab-content {
                @apply mt-4 space-y-6;
            }

            .tab-pane {
                @apply bg-white shadow-lg rounded-lg p-6 transition-opacity duration-200 ease-in-out;
            }

            .tab-pane.active {
                @apply opacity-100;
            }

    </style>
@endpush

<div>


                    <div class="flex  place-items-center mb-5">
                        <h4 class="text-2xl w-1/5 text-amber-950 uppercase font-bold">Coopérative</h4>
                        <hr class="w-4/5 h-1 bg-amber-400">
                    </div>

                    

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Nom de la coopérative : <span class="text-amber-600">{{ $agribusiness->denomination }}</span>
                            </label>
                                                     
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                Sigle de la coopérative :<span class="text-amber-600">{{ $agribusiness->sigle }}</span>
                            </label>
                            
                        </div>
                        
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Addresse : <span class="text-amber-600">{{ $agribusiness->address }}</span>
                            </label> 
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                Region :<span class="text-amber-600">{{ $agribusiness->region_id }}</span>
                            </label>
                            
                        </div>
                        
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Departement : <span class="text-amber-600">{{ $agribusiness->departement_id }}</span>
                            </label>                  
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                Siège :<span class="text-amber-600">{{ $agribusiness->headquaters }}</span>
                            </label>
                            
                        </div>
                        
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Certification : <span class="text-amber-600">{{ $agribusiness->certification->name }}</span>
                            </label>
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                Banque :<span class="text-amber-600">{{ $agribusiness->bank }}</span>
                            </label>
                            
                        </div>
                        
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Nombre de sections : <span class="text-amber-600">{{ $agribusiness->number_sections }}</span>
                            </label>
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                Unité de transformations :<span class="text-amber-600">{{ $agribusiness->number_unite_transformations }}</span>
                            </label>
                            
                        </div>
                        
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Registre de commerce : <a href="{{ asset($registre_commerce) }}" target="_blank" class="text-amber-600">Voir</a>
                            </label>  
                        </div>   
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label for="" class="block uppercase tracking-wide text-gray-700 text-xs font-blod mb-2">
                                <h4 class="text-s font-bold mb-4 uppercase">Numéro du Registre de Commerce: <span class="text-amber-600">{{ $agribusiness->numRegistreCommerce }}</span></h4>
                            </label>
                        </div>
                        
                    </div>

                    <div class="flex  place-items-center mb-5">
                        <h4 class="text-2xl w-1/5 text-amber-950 uppercase font-bold">PCA</h4>
                        <hr class="w-4/5 h-1 bg-amber-400">
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                            Nom & prénoms : <span class="text-amber-600">{{ $pca?->fullname ??''  }}</span>
                            </label>
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                Contact : <span class="text-amber-600">{{ $pca?->phone ??'' }}</span>
                            </label>
                            
                        </div>
                        
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                            Email : <span class="text-amber-600">{{ $pca?->email ??'' }}</span>
                            </label>

                            
                            
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                Photo : 
                                @if(!empty($photo_pca))
                                    <a href="{{ asset($photo_pca) }}" target="_blank" class="text-amber-600">Voir</a>
                                @else
                                    Aucune photo
                                @endif
                            </label>
                            
                        </div>
                        
                    </div>

                    <div class="flex  place-items-center mb-6">
                        <h4 class="text-2xl w-1/5 text-amber-950 uppercase font-bold">Superviseur</h4>
                        <hr class="w-4/5 h-1 bg-amber-400">
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                            Nom & prénoms : <span class="text-amber-600">{{ $sup?->fullname ?? '' }}</span>
                            </label>

                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                Contact : <span class="text-amber-600">{{ $sup?->phone ?? '' }}</span>
                            </label>
                            
                        </div>
                        
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                            Email : <span class="text-amber-600">{{ $sup?->email ??'' }}</span>
                            </label>

                            
                            
                            
                        </div>
                        
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="photo_sup" >
                                Photo :
                                 @if(!empty($photo_sup))
                                 <a href="{{ asset($photo_sup) }}" class="text-amber-600" target="_blank">Voir</a>
                                 @else 
                                    Aucune photo 
                                 @endif
                            </label>
                            
                        </div>
                        
                        @if($statusCoop <> 1)
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                Motif
                            </label>

                            <textarea
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border {{  (!empty(session('errorMotif'))) ? ' border-red-500' : '' }} border-gray-200 rounded
                                    py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    name="motif" wire:model="motif"  id="motif" type="text" placeholder="Motif"></textarea>
                            @if(!empty(session('errorMotif')))
                                    <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                            <strong>{{ session('errorMotif') }}</strong>
                                    </div>
                            @endif
                        </div>
                        @endif
                        
                    </div>

                    <div class="flex  place-items-center mb-6">
                            <h4 class="text-2xl w-1/5 text-amber-950 uppercase font-bold">PARCS A KARITE</h4>
                            <hr class="w-4/5 h-1 bg-amber-400">
                    </div>

                    @foreach ($parcs as $parc)
                    <div class="flex gray-400 mb-6">

                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Nom du parc : <span class="text-amber-600">{{ $parc?->name ??'' }}</span>
                            </label>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                               Discription :
                            </label>
                            
                            <p class="text-amber-600">{{ $parc?->description ??'' }}</p>
                        </div>

                        
                       
                    </div>

                    <div class="flex gray-400">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                               Photo : <img class="rounded w-16" src="{{ asset('images/'.$parc?->picture ??'') }}">
                            </label>
                        </div>
                        
                    </div>
                    @endforeach
                        <div class="w-full px-3 mb-6 md:mb-0" wire:ignore>
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                               Localisation
                            </label>
                            <div id="map" style="height: 500px; width: 100%; margin-top: 20px;"></div>
                        </div>
                    

                    @if($statusCoop <> 1)
                    <div class="flex justify-between">
                       
                        <div class="flex justify-end mt-5">
                            <button type="button" wire:click='rejetCoop("{{$agribusinessId}}")' class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 mx-1 rounded focus:outline-none focus:shadow-outline ">Rejeter</button>
                            <button type="button" wire:click='valideCoop("{{$agribusinessId}}")' class="bg-amber-900 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded mr-2" >Valider</button>
                        </div>
                            
                       
                    </div>
                    @endif

</div>
@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        console.log('test');
        // Initialiser la carte avec un zoom par défaut et un point central
        var map = L.map('map').setView([7.539989, -5.547080], 7); // Par exemple, centré sur la Côte d'Ivoire

        // Ajouter un fond de carte OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Points des parcs (remplacez `@json($parcs)` par les données des parcs avec coordonnées GPS)
        const parcs = @json($parcs);

        // Ajouter un marqueur pour chaque parc
        parcs.forEach(parc => {
            if (parc.latitude && parc.longitude) {
                L.marker([parc.latitude, parc.longitude])
                .addTo(map)
                .bindPopup(`<strong>${parc.name}</strong><br>Coordonnées: ${parc.latitude}, ${parc.longitude}`);
            }
        });
    });
    </script>
@endpush