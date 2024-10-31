
<div>
    <!-- Carte de détails de l'offre -->
    <div class="max-w-full w-full bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-500 hover:scale-105">
        <!-- Image d'en-tête -->
        <div class="bg-gradient-to-r from-amber-500 to-amber-700 text-white p-6 flex items-center">
            <h2 class="text-3xl font-semibold flex-grow">Détails de l'Offre</h2>
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-8 h-8 text-white opacity-75" viewBox="0 0 16 16">
                <path d="M16 1.5a1.5 1.5 0 0 0-3 0 1.5 1.5 0 0 0 3 0zm-2.812 5.375a1 1 0 0 1 .72-.281h3a1 1 0 0 1 1 1V13.5a1 1 0 0 1-1 1H.5a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h5.5V5a1 1 0 0 1 .667-.937l2-1a1 1 0 0 1 1 0l2 1A1 1 0 0 1 12 5v.594l1.406-.719a1 1 0 0 1 .782 1.5zm.656 3.125a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 1 0v-2a.5.5 0 0 0-.5-.5zm1.5 0a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 1 0v-2a.5.5 0 0 0-.5-.5z"/>
            </svg>
        </div>
    
        <div class="p-6 space-y-6 bg-white rounded-lg shadow-lg">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    
                <!-- Tuile : Code de l'offre -->
                <div class="bg-gray-100 shadow-lg rounded-lg p-6">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500 font-medium">Code de l'offre :</span>
                        <span class="text-amber-700 font-bold text-l">{{ $offer->code }}</span>
                    </div>
                </div>

                <!-- Tuile : Prix de vente & Quantité et Prix Total -->
                <div class="bg-gray-100 shadow-lg rounded-lg p-6">
                    <div class="space-y-2">
                        @if(auth()->check() && (auth()->user()->isPlateformAdmin() || auth()->user()->isAgribusinessAdmin))
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">Prix de vente :</span>
                            <span class="text-amber-700 font-semibold text-l">{{ number_format($offer->selling_price, 0, ',', ' ') }} FCFA</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">Prix Total :</span>
                            <span class="text-amber-700 font-semibold">{{ number_format(($offer->selling_price * $offer->qte), 0, ',', ' ') }} FCFA</span>
                        </div>
                        @endif
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">Quantité :</span>
                            <span class="text-amber-700">{{ $offer->weight }} kg</span>
                        </div>
                    </div>
                </div>

                <!-- Tuile : Certification et Conditionnement -->
                <div class="bg-gray-100 shadow-lg rounded-lg p-6">
                    <div class="space-y-2">
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">Certification :</span>
                            <span class="text-amber-700 font-semibold">{{ $offer->certification->name }}</span>
                        </div>
                     
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">Conditionnement :</span>
                            <span class="text-amber-700">{{ $offer->type_package->name }}</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Scellé de l'offre -->
            @if(auth()->check() && (auth()->user()->isPlateformAdmin() || auth()->user()->isAgribusinessAdmin ))
                <div class="border-t pt-4 mt-4">
                    <div class="text-amber-600 font-semibold mb-2">Scellé de l'offre</div>
                    <div class="border border-gray-300 rounded-lg overflow-hidden">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="bg-amber-500 text-white">
                                    <th class="px-4 py-2 font-semibold">Code du Scellé</th>
                                    <th class="px-4 py-2 font-semibold">Quantité (kg)</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($scelles as $scelle)
                                    <tr class="hover:bg-gray-50 border-b">
                                        <td class="px-4 py-2 text-gray-700">{{ $scelle->code }}</td>
                                        <td class="px-4 py-2 text-gray-700">{{ number_format($offer->weight / $scelles->count(), 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

          


            <!-- Informations sur la Coopérative et les Parcs à Karité -->
            <div class="border-t pt-4 mt-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informations de la Coopérative -->
                    <div>
                        <div class="text-amber-600 font-semibold mb-2">Coopérative</div>
                        <div class="text-gray-700 text-sm">
                            <div class="mb-4">Nom : <span class="font-semibold">{{ $offer->agribusiness->denomination }}</span></div>
                        </div>
                        <div class="text-amber-600 font-semibold mb-2">Parcs à Karité</div>
                        <div class="text-gray-700 space-y-4">
                            @foreach ($parcs as $parc)
                                <div class="mb-2">
                                    <div class="text-sm">Nom du Parc : <span class="font-semibold">{{ $parc->name }}</span></div>
                                    <div class="mt-2">
                                        <img class="rounded w-full max-w-xs shadow-lg" src="{{ asset('images/'.$parc?->picture ?? '') }}" alt="Image du parc">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Carte des Parcs -->
                     
                    <div class="rounded overflow-hidden shadow-lg ">
                        
                        <div id="map" class="w-full h-full"></div>
                    </div>
                </div>
            </div>
        </div>

        @if(auth()->guest())
            <!-- Boutons d'action pour les invités -->
            <div class="flex justify-center p-6 bg-gray-100">
                
                <a href="{{ route('pages.order',['offerId'=>$offer->id]) }}" class="inline-block px-4 py-2 bg-amber-500 text-white rounded hover:bg-amber-600">Passer Commande</a>
            </div>
        @endif
    </div>
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

@push('javascript')
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