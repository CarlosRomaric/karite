<div>
    @push('stylesheets')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    @endpush
    <div class="max-w-full w-full bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-500 hover:scale-105">
        <!-- <h2 class="text-3xl font-bold text-center mb-6">Détails de l'Achat</h2> -->
        <div class="bg-gradient-to-r from-amber-500 to-amber-700 text-white p-6 flex items-center">
            <h2 class="text-3xl font-semibold flex-grow">Détails de l'achat d'amandes</h2>
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-8 h-8 text-white opacity-75" viewBox="0 0 16 16">
                <path d="M16 1.5a1.5 1.5 0 0 0-3 0 1.5 1.5 0 0 0 3 0zm-2.812 5.375a1 1 0 0 1 .72-.281h3a1 1 0 0 1 1 1V13.5a1 1 0 0 1-1 1H.5a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h5.5V5a1 1 0 0 1 .667-.937l2-1a1 1 0 0 1 1 0l2 1A1 1 0 0 1 12 5v.594l1.406-.719a1 1 0 0 1 .782 1.5zm.656 3.125a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 1 0v-2a.5.5 0 0 0-.5-.5zm1.5 0a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 1 0v-2a.5.5 0 0 0-.5-.5z"/>
            </svg>
        </div>
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-4 bg-gray-100 rounded-lg shadow">
                    <h3 class="font-semibold">Informations Générales</h3>
                    <div class="mt-2">
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Poids :</span>
                            <span class="text-gray-700">{{ $almond->weight }} kg</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Qualité :</span>
                            <span class="text-gray-700">{{ $almond->quality }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Type d'Achat :</span>
                            <span class="text-gray-700">{{ $almond->type_purchase }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="p-4 bg-gray-100 rounded-lg shadow">
                    <h3 class="font-semibold">Prix et Montant</h3>
                    <div class="mt-2">
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Prix de Vente :</span>
                            <span class="text-gray-700">{{ number_format($almond->selling_price, 0, ',', ' ') }} FCFA</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Montant :</span>
                            <span class="text-gray-700">{{ number_format($almond->amount, 0, ',', ' ') }} FCFA</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Mobile Money :</span>
                            <span class="text-gray-700">{{ number_format($almond->mobile_money, 0, ',', ' ') }} FCFA</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Espèce :</span>
                            <span class="text-gray-700">{{ number_format($almond->cash, 0, ',', ' ') }} FCFA</span>
                        </div>
                    </div>
                </div>
                
                <div class="p-4 bg-gray-100 rounded-lg shadow">
                    <h3 class="font-semibold">Informations du Producteur</h3>
                    <div class="mt-2">
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Coopérative :</span>
                            <span class="text-gray-700">{{ $almond->agribusiness->denomination }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Région :</span>
                            <span class="text-gray-700">{{ $almond->agribusiness->region->name}}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Département :</span>
                            <span class="text-gray-700">{{ $almond->agribusiness->departement->name}}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Producteur :</span>
                            <span class="text-gray-700">{{ $almond->farmer->fullname}}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Numéro de Téléphone :</span>
                            <span class="text-gray-700">{{ $almond->farmer->phone}}</span>
                        </div>

                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Née le  :</span>
                            <span class="text-gray-700">{{ date('d/m/Y', strtotime($almond->farmer->born_date))}}</span>
                        </div>
                        
                    </div>
                </div>

                <div class="p-4 bg-gray-100 rounded-lg shadow">
                    <h3 class="font-semibold">Dates</h3>
                    <div class="mt-2">
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Date de Création :</span>
                            <span class="text-gray-700">{{ $almond->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Date de Mise à Jour :</span>
                            <span class="text-gray-700">{{ $almond->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 mt-5">
                <div class="p-4 bg-gray-100 rounded-lg shadow">
                    <h3 class="font-semibold">Lieu de la transaction</h3>
                    <div class="mt-2" wire:ignore>
                        <div id="map" class="w-full h-96 rounded-lg shadow-lg"></div>
                    </div>
                </div>
            </div>
        </div>
       

        <div class="flex justify-center p-6 bg-gray-100">
            <a href="{{ route('almond.index') }}" class="inline-block px-4 py-2 bg-amber-500 text-white rounded hover:bg-amber-600">Retour à la liste des achats</a>
        </div>
    </div>

</div>

@push('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        const latitude = '{{ $almond->latitude }}';
        const longitude = '{{ $almond->longitude }}';
        // Initialiser la carte
        const map = L.map('map').setView([latitude, longitude], 15); // Remplacer par les coordonnées de ton choix

        // Charger les tuiles de la carte
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Ajouter un marqueur
        const marker = L.marker([latitude, longitude]).addTo(map)
            .bindPopup('<strong>Position de l\'achat</strong><br>Poids: {{ $almond->weight }} kg')
            .openPopup();
    </script>
    
@endpush