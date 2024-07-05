@if (session()->has('message'))
    <div class="relative flex flex-col sm:flex-row sm:items-center bg-gray-200 dark:bg-green-700 shadow rounded-md py-5 pl-6 pr-8 sm:pr-6 mb-3 mt-3">
        <div class="flex flex-row items-center border-b sm:border-b-0 w-full sm:w-auto pb-4 sm:pb-0">
            <div class="text-green-500" dark:text-gray-500>
                <svg class="w-6 sm:w-5 h-6 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="text-sm font-medium ml-3">Success!.</div>
        </div>
        <div class="text-sm tracking-wide text-gray-500 dark:text-white mt-4 sm:mt-0 sm:ml-4"> {{ session('message') }}</div>
        <div class="absolute sm:relative sm:top-auto sm:right-auto ml-auto right-4 top-4 text-gray-400 hover:text-gray-800 cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </div>
    </div>
@endif

@if($isOpen)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="relative bg-gray-100 p-8 rounded shadow-lg w-1/2">
                <!-- Modal content goes here -->
                <svg wire:click.prevent="$set('isOpen', false)"
                    class="ml-auto w-6 h-6 text-gray-900 dark:text-gray-900 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                </svg>
                
                <h2 class="text-2xl font-bold mb-4">{{ $agribusinessId ? 'Modification de coopérative' : 'Creation de coopérative' }}</h2>
                <form wire:submit.prevent="{{ $agribusinessId ? 'update':'saveAgribusiness' }} ">
                @if($step === 1)  
                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="denomination">
                                Nom de la coopérative
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('denomination') ? ' border-red-500' : '' }} rounded
                                py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                name="denomination" id="denomination"  wire:model="denomination" type="text" placeholder="Nom de la coopérative" value="{{ old('denomination') }}">
                        
                            @error('denomination')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="sigle" >
                                Sigle de la coopérative
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('sigle') ? ' border-red-500' : '' }} border-gray-200 rounded
                                py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="sigle" id="acronym" wire:model="sigle"  , type="text" placeholder="Sigle de la coopérative" value="{{ old('sigle') }}" maxlength="10">
                        
                            @error('sigle')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                               Addresse
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('address') ? ' border-red-500' : '' }} rounded
                                py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                name="address" id="address"  wire:model="address" type="text" placeholder="Addresse de la coopérative" value="{{ old('address') }}">
                        
                            @error('name')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="region_id" >
                                Region
                            </label>
                            <select
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('region_id') ? ' border-red-500' : '' }} border-gray-200 rounded
                                py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="region_id" id="region_id" wire:model.change="region_id">
                                <option value="">Choississez une region</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        
                            @error('region_id')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                               Addresse
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('address') ? ' border-red-500' : '' }} rounded
                                py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                name="address" id="address"  wire:model="address" type="text" placeholder="Addresse de la coopérative" value="{{ old('address') }}">
                        
                            @error('name')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="departement_id" >
                                Departement
                            </label>
                            <select
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('departement_id') ? ' border-red-500' : '' }} border-gray-200 rounded
                                py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="departement_id" id="departement_id" wire:model="departement_id">
                                <option value="">Choississez un departement</option>
                                @foreach ($departements as $departement)
                                    <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                                @endforeach
                            </select>
                        
                            @error('departement_id')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                               Siège
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('address') ? ' border-red-500' : '' }} rounded
                                py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                name="headquaters" id="headquaters"  wire:model="headquaters" type="text" placeholder="headquaters de la coopérative" value="{{ old('headquaters') }}">
                        
                            @error('headquaters')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="departement_id" >
                                certification
                            </label>
                            <select
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('certification') ? ' border-red-500' : '' }} border-gray-200 rounded
                                py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="certification" id="certification" wire:model="certification">
                               
                                    <option value="">Choississez la certification</option>
                                    <option value="Bio">Bio</option>
                                    <option value="Ordinaire">Ordinaire</option>
                            </select>
                        
                            @error('departement_id')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        
                    </div>
                @else

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                               Nombre de sections
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('number_sections') ? ' border-red-500' : '' }} rounded
                                py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                name="number_sections" id="number_sections"  wire:model="number_sections" type="text" placeholder="Nombre de section de la coopérative" value="{{ old('headquaters') }}">
                        
                            @error('number_sections')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="departement_id" >
                                Banques
                            </label>
                            <select
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('bank') ? ' border-red-500' : '' }} border-gray-200 rounded
                                py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="bank" id="bank" wire:model="bank">
                               
                                <option value="">Choississez votre banque</option>
                                <option value="NSA">NSA</option>
                                <option value="SGBCI">SGBCI</option>
                                <option value="ECOBANK">ECOBANK</option>
                                <option value="UBA">UBA</option>
                                <option value="BNI">BNI</option>
                                <option value="Autres">Autres</option>
                            </select>
                        
                            @error('bank')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                               Nombre d'unités de transformations
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('number_unite_transformations') ? ' border-red-500' : '' }} rounded
                                py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                name="number_unite_transformations" id="number_unite_transformations"  wire:model="number_unite_transformations" type="text" placeholder="Nombre d'unités de transformation de la coopérative" value="{{ old('number_unite_transformations') }}">
                        
                            @error('number_unite_transformations')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="dfe" >
                                DFE :<a href="{{ asset('storage/'.$doc_dfe) }}" target="_blank" class="text-amber-600">Voir</a>
                            </label>
                            <input
                            wire:model="dfe"
                            value="{{ old('dfe') }}"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('dfe') ? ' border-red-500' : '' }} rounded
                                py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            type="file"
                            id="dfe" />
                        
                            @error('dfe')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                       
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="departement_id" >
                                Registre de commerce :<a href="{{ asset('storage/'.$doc_registre_commerce) }}" target="_blank" class="text-amber-600">Voir</a>
                            </label>
                            <input
                            wire:model="registre_commerce"
                            value="{{ old('registre_commerce') }}"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('number_unite_transformations') ? ' border-red-500' : '' }} rounded
                                py-2 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            type="file"
                            id="registre_commerce" />
                        
                            @error('registre_commerce')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        
                    </div>
                
                @endif
                    
                  
                    
                    <div class="flex justify-end mt-5">
                    @if($step > 1)
                    <button type="button"  wire:click="prevStep" class="bg-amber-400 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Précédent</button>
                    @endif
                    
                    @if($step < 2)
                        <button type="button" wire:click="nextStep" class="bg-amber-900 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Suivant</buttion>
                    
                    @else
                        <button type="submit" class="bg-amber-900 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mx-2">Soummettre</button>
                    @endif
                        <!-- <button type="submit" class="btn-amber-karite hover:bg-amber-800 text-white font-bold py-2 px-4 rounded mr-2">Enregistrer</button>
                        <button type="button" class="bg-gray-200 hover:bg-gray-300 text-amber-900 font-bold py-2 px-4 rounded" wire:click="closeModal">Annuler</button> -->
                    </div>
                </form>

            </div>
        </div>
@endif

@if($isOpenShow)
    <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="relative bg-gray-100 p-8 rounded shadow-lg w-1/2 ">
               
                <svg wire:click.prevent="$set('isOpenShow', false)"
                class="ml-auto w-6 h-6 text-gray-900 dark:text-gray-900 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                </svg>
                @if($step === 1)
                    <h2 class="text-xl font-bold mb-4 uppercase">cooperative</h2><br/>
                    <h4 class="text-s font-bold mb-4 uppercase">Matricule: <span class="text-amber-600">{{ $matricule }}</span></h4>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Nom de la coopérative : <span class="text-amber-600">{{ $denomination }}</span>
                            </label>
                            
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                Sigle de la coopérative :<span class="text-amber-600">{{ $sigle }}</span>
                            </label>
                            
                        </div>
                        
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Addresse : <span class="text-amber-600">{{ $address }}</span>
                            </label>

                            
                            
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                Region :<span class="text-amber-600">{{ $region_id }}</span>
                            </label>
                            
                        </div>
                        
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Departement : <span class="text-amber-600">{{ $departement_id }}</span>
                            </label>

                            
                            
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                Siège :<span class="text-amber-600">{{ $headquaters }}</span>
                            </label>
                            
                        </div>
                        
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Certification : <span class="text-amber-600">{{ $certification }}</span>
                            </label>

                            
                            
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                Banque :<span class="text-amber-600">{{ $bank }}</span>
                            </label>
                            
                        </div>
                        
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Nombre de sections : <span class="text-amber-600">{{ $number_sections }}</span>
                            </label>
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                Unité de transformations :<span class="text-amber-600">{{ $number_unite_transformations }}</span>
                            </label>
                            
                        </div>
                        
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Registre de commerce : <a href="{{ asset('storage/'.$registre_commerce) }}" target="_blank" class="text-amber-600">Voir</a>
                            </label>

                            
                            
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                DFE : <a href="{{ asset('storage/'.$dfe) }}" target="_blank" class="text-amber-600">Voir</a>
                            </label>
                            
                        </div>
                        
                    </div>
                @else

                    <h2 class="text-xl font-bold mb-4 uppercase">PCA</h2><br/>
                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                            Nom & prénoms : <span class="text-amber-600">{{ $pca->fullname }}</span>
                            </label>

                            
                            
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                Contact : <span class="text-amber-600">{{ $pca->phone }}</span>
                            </label>
                            
                        </div>
                        
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                            Email : <span class="text-amber-600">{{ $pca->email }}</span>
                            </label>

                            
                            
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                Photo : <a href="{{ asset('storage/'.$photo_pca) }}" target="_blank" class="text-amber-600">Voir</a>
                            </label>
                            
                        </div>
                        
                    </div>

                    <h2 class="text-xl font-bold mb-4 uppercase">Superviseur</h2><br/>
                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                            Nom & prénoms : <span class="text-amber-600">{{ $sup->fullname }}</span>
                            </label>

                            
                            
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                Contact : <span class="text-amber-600">{{ $sup->phone }}</span>
                            </label>
                            
                        </div>
                        
                    </div>

                    <div class="flex gray-400 mb-6">
                        
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                            Email : <span class="text-amber-600">{{ $sup->email }}</span>
                            </label>

                            
                            
                            
                        </div>
                    
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                Photo : <a href="{{ asset('storage/'.$photo_sup) }}" class="text-amber-600" target="_blank">Voir</a>
                            </label>
                            
                        </div>

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
                        
                    </div>
                @endif

                    <div class="flex justify-between">
                        @if($step > 1)
                        <div class="flex justify-end mt-5">
                            <button type="button"  wire:click="prevStep" class="bg-amber-400 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Précédent</button>
                        </div>
                            
                        @endif
                        
                        @if($step < 2)
                            <button type="button" wire:click="nextStep" class="bg-amber-900 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Suivant</buttion>
                        
                        @else
                        <div class="flex justify-end mt-5">
                            <button type="button" wire:click='rejetCoop("{{$agribusinessId}}")' class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 mx-1 rounded focus:outline-none focus:shadow-outline ">Rejeter</button>
                             @if($statusCoop <> 1)<button type="button" wire:click='valideCoop("{{$agribusinessId}}")' class="bg-amber-900 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded mr-2" >Valider</button>@endif
                        </div>
                            
                        @endif
                    </div>
                

            </div>
    </div>
@endif

@if($isOpenDelete)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="relative bg-gray-100 p-8 rounded shadow-lg w-1/2">
                <!-- Modal content goes here -->
                <svg wire:click.prevent="$set('isOpenDelete', false)"
                class="ml-auto w-6 h-6 text-gray-900 dark:text-gray-900 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                </svg>
                <h2 class="text-2xl font-bold mb-4">Voulez vous supprimer cette coopérative ?</h2>
                <div class="flex justify-end mt-5">

                        <button type="button" class="btn-amber-karite hover:bg-amber-800 text-white font-bold py-2 px-4 rounded mr-2" wire:click='delete("{{$agribusinessId}}")'>Valider</button>
                        <button type="button" class="bg-gray-200 hover:bg-gray-300 text-amber-900 font-bold py-2 px-4 rounded" wire:click="closeModalDelete">Annuler</button>
                </div>
            </div>
        </div>
@endif