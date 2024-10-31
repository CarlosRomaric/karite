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

        <!-- Contenu de la carte -->
        <div class="p-6 space-y-6">
            <!-- Code de l'offre -->

            <div class="flex justify-between items-center">
                <span class="text-gray-600 font-medium">Code de l'offre :</span>
                <span class="text-amber-700 font-semibold text-xl">{{ $offer->code }}</span>
            </div>

            <!-- Prix de vente -->

            <div class="flex justify-between items-center">
                <span class="text-gray-600 font-medium">Prix de vente :</span>
                <span class="text-amber-700 font-semibold text-xl">{{ number_format($offer->selling_price, 0, ',', ' ') }} FCFA</span>
            </div>

            <!-- Quantité et Poids -->
            <div class="flex justify-between items-center">
                <div class="flex flex-col">
                    <span class="text-gray-600 font-medium">Prix Total : {{ number_format(($offer->selling_price * $offer->qte), 0, ',', ' ') }} FCFA</span>
                    
                </div>
                <div class="flex flex-col">
                    <span class="text-gray-600 font-medium">Quantité : {{ $offer->weight }} kg</span>
                    
                </div>
            </div>
            <div class="flex justify-between items-center">
                <!-- Type de paquet -->
                <div class="flex flex-col">
                    <span class="text-gray-600 font-medium">Certification : {{ $offer->certification->name }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-gray-600 font-medium">Conditionnement : {{ $offer->type_package->name }}</span>
                </div>
            </div>

            <!-- Informations sur la Coopérative -->
            <div class="border-t pt-4 mt-4">
                <div class="grid grid-cols-2 gap-4">
                    <!-- Colonne 1 : Informations de la Coopérative -->
                    <div>
                        <div class="flex items-center mb-3">
                            <span class="text-amber-500 font-semibold">Coopérative</span>
                        </div>
                        <div class="text-gray-700">
                            <div class="text-sm">Nom : {{ $offer->agribusiness->denomination }}</div>
                        </div>
                        <div class="flex items-center mb-3">
                            <span class="text-amber-500 font-semibold">Parcs à karité</span>
                        </div>
                        <div class="text-gray-700 space-y-4">
                            @foreach ($parcs as $parc)
                                <div>
                                    <div class="text-sm">Nom du Parc : {{ $parc->name }} </div>
                                    
                                </div>
                                <div>
                                    <div class="text-sm">Photo :</div>
                                    <img class="rounded w-full max-w-xs" src="{{ asset('images/'.$parc?->picture ?? '') }}" alt="Image du parc">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Colonne 2 : Parcs de Karité -->
                    <div>
                       <div id="map" class="rounded"></div>
                    </div>
                </div>
                <div class="border-t pt-4 mt-4">
                    <div class="flex items-center mb-3">
                            <span class="text-amber-500 font-semibold">Scellé de l'offre</span>
                    </div>
                  
                    <table class="min-w-2xl border border-gray-200 rounded-lg shadow-sm">
                        <thead>
                            <tr class="bg-amber-500 text-white">
                                <th class="px-4 py-2 text-left font-semibold">Code du Scellé</th>
                                <th class="px-4 py-2 text-left font-semibold">Quantité(kg)</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($scelles as $scelle)
                                <tr class="hover:bg-gray-100 border-b border-gray-200">
                                    <td class="px-4 py-2 text-gray-800">{{ $scelle->code }}</td>
                                    <td class="px-4 py-2 text-gray-800">{{ number_format($offer->weight / $scelles->count(), 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                   
                </div>
            </div>


        </div>

        <!-- Boutons d'action -->
        <div class="flex justify-between p-6 bg-gray-100">
            <button class="w-full text-gray-600 font-semibold border-r border-gray-300 hover:text-amber-500 transition">Passer Commande</button>
            
        </div>
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