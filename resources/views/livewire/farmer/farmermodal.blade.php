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
        <div class="fixed inset-0 flex items-center justify-center z-50 scroll-smooth">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="relative bg-gray-100 p-8 rounded shadow-lg w-1/2 ">
                <!-- Modal content goes here -->
                <svg wire:click.prevent="$set('isOpen', false)"
                    class="ml-auto w-6 h-6 text-gray-900 dark:text-gray-900 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                </svg>
               
                 
                <h2 class="text-2xl font-bold mb-4">{{ $farmerId ? 'Modification des informations du fournisseur': 'Ajout de fournisseur' }}</h2>

                <form  wire:submit.prevent="{{ $farmerId ? 'update':'saveFarmer' }} "  enctype="multipart/form-data">
                    @csrf
                  
                        @if(($errors->any()))
            
                            <div class="py-5 px-4 mb-2 bg-red-200 text-red-900 text-center rounded">
                                <!-- <svg wire:click.prevent="$set('isClose', false)"
                                class="ml-auto w-6 h-6 text-gray-900 dark:text-gray-900 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                                </svg> -->
                                Tous les champs du formulaire n'ont pas bien été renseigner verifier sur chaque partie du formulaire pour le cooriger
                            </div>
                        @endif
                   
                    @if($step === 1)
                        <div class="flex gray-400 mb-3">
                            <div class="w-full px-3 mb-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="picture">
                                    Ajouter la photo du fournisseur
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('picture') ? ' border-red-500' : '' }} rounded
                                 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    name="picture" wire:model="picture" id="picture" type="file" placeholder="Ajouter la photo du fournisseur" >
                                @if($errors->has('picture'))
                                    <p class="text-red-500 text-sm">{{ $errors->first('picture') }}</p>
                                @endif
                            </div>

                            <div class="w-full px-3 mb-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="agribusiness_id">
                                    coopérative / indépendant
                                </label>
                                <div class="relative">
                                    <select class="block appearance-none w-full bg-gray-200 border{{ $errors->has('agribusiness_id') ? ' border-red-500' : '' }}text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white" id="agribusiness_id" name="agribusiness_id" wire:model="agribusiness_id">
                                                <option value="">Sélectionner la coopérative</option>
                                                @foreach($agribusinesses as $agribusiness)
                                                    <option value="{{ $agribusiness->id }}" @if(old('agribusiness_id') === $agribusiness->id) selected @endif>{{ $agribusiness->denomination }}</option>
                                                @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                        </svg>
                                    </div>
                                </div>
                                @if($errors->has('agribusiness_id'))
                                    <p class="text-red-500 text-sm">{{ $errors->first('agribusiness_id') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex gray-400 mb-3">                         
                            {{-- 
                            <div class="w-full px-3 mb-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="identifier">
                                    Identifiant
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('identifier') ? ' border-red-500' : '' }} rounded
                                py-3 px-4  leading-tight focus:outline-none focus:bg-white"
                                    name="identifier" wire:model="identifier" id="identifier" type="text" placeholder="Identifiant" value="{{ old('identifier') }}">
                                @if($errors->has('identifier'))
                                    <p class="text-red-500 text-sm">{{ $errors->first('identifier') }}</p>
                                @endif
                            </div>
                            --}}
                            <div class="w-full px-3 mb-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="fullname">
                                    Nom & prénoms
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('fullname') ? ' border-red-500' : '' }} rounded
                                py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                    name="fullname" wire:model="fullname" id="fullname" type="text" placeholder="Nom & prénoms" value="{{ old('fullname') }}">
                                @if($errors->has('fullname'))
                                    <p class="text-red-500 text-sm">{{ $errors->first('fullname') }}</p>
                                @endif
                            </div>

                        </div>

                        <div class="flex gray-400 mb-3">
                            <div class="w-full px-3 mb-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="born_date">
                                    Date de naissance
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('born_date') ? ' border-red-500' : '' }} rounded
                                 py-3 px-4  leading-tight focus:outline-none focus:bg-white"
                                    name="born_date" id="born_date" wire:model="born_date" type="date" placeholder="Date de naissance" value="{{ old('born_date') }}">
                                @if($errors->has('born_date'))
                                    <p class="text-red-500 text-sm">{{ $errors->first('born_date') }}</p>
                                @endif
                            </div>

                            <div class="w-full px-3 mb-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="born_place">
                                    Lieu de naissance
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('born_place') ? ' border-red-500' : '' }} rounded
                                 py-3 px-4  leading-tight focus:outline-none focus:bg-white"
                                    name="born_place" id="born_place" wire:model="born_place" type="text" placeholder="Lieu de naissance" value="{{ old('born_place') }}">
                                @if($errors->has('born_place'))
                                    <p class="text-red-500 text-sm">{{ $errors->first('born_place') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex gray-400 mb-3">
                            <div class="w-full px-3 mb-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="sexe">
                                    Sexe
                                </label>
                                <div class="relative">
                                    <select class="block appearance-none w-full bg-gray-200 border {{ $errors->has('sexe') ? 'border-red-500' : '' }}
                                text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white" id="sexe" name="sexe" wire:model="sexe">
                                        <option value="">Sélectionner le sexe</option>
                                        <option @if(old('sexe') == "AUCUN") selected @endif value="AUCUN">Aucun</option>
                                        <option @if(old('sexe') == "H") selected @endif value="H">Homme</option>
                                        <option @if(old('sexe') == "F") selected @endif value="F">Femme</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                                @if($errors->has('sexe'))
                                    <p class="text-red-500 text-sm">{{ $errors->first('sexe') }}</p>
                                @endif
                            </div>
                        </div>
                    @else

                        

                       

                        <div class="flex gray-400 mb-6">

                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                                    Numéro de téléphone
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('phone') ? ' border-red-500' : '' }} rounded
                                 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    name="phone" id="phone" type="text" placeholder="Téléphone" wire:model="phone" value="{{ old('phone') }}"
                                    x-mask:dynamic="
                                        $input.startsWith('34') || $input.startsWith('37')
                                            ? '99 99 99 99 99' : '99 99 99 99 99'
                                    ">
                                @if($errors->has('phone'))
                                    <p class="text-red-500 text-sm">{{ $errors->first('phone') }}</p>
                                @endif
                            </div>
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                                    Numéro de téléphone mobile money
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('phone') ? ' border-red-500' : '' }} rounded
                                 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    name="phone" id="phone_payement" type="text" placeholder="Téléphone" wire:model="phone_payment" value="{{ old('phone_payment') }}"
                                    x-mask:dynamic="
                                        $input.startsWith('34') || $input.startsWith('37')
                                            ? '99 99 99 99 99' : '99 99 99 99 99'
                                    ">
                                @if($errors->has('phone_payment'))
                                    <p class="text-red-500 text-sm">{{ $errors->first('phone_payment') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex gray-400 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="sexe">
                                    Region
                                </label>
                                <div class="relative">
                                    <select class="block appearance-none w-full bg-gray-200 border {{ $errors->has('region_id') ? 'border-red-500' : 'border-gray-200' }}
                                text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white" id="region_id" name="region_id" wire:model.change="region_id">
                                        <option value="">Sélectionner la region</option>
                                        @foreach ($regions as $region)
                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endforeach
                                        
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                                @if($errors->has('region_id'))
                                    <p class="text-red-500 text-sm">{{ $errors->first('region_id') }}</p>
                                @endif
                            </div>

                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="sexe">
                                    Departement
                                </label>
                                <div class="relative">
                                    <select class="block appearance-none w-full bg-gray-200 border {{ $errors->has('departement_id') ? 'border-red-500' : 'border-gray-200' }}
                                text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white" id="departement_id" name="departement_id" wire:model="departement_id">
                                        <option value="">Sélectionner le departement</option>
                                        @foreach ($departements as $departement)
                                        <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                                        @endforeach
                                        
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                                @if($errors->has('departement_id'))
                                    <p class="text-red-500 text-sm">{{ $errors->first('departement_id') }}</p>
                                @endif
                            </div>
                           
                        </div>


                        <div class="flex gray-400 mb-6">                         

                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="identifier">
                                    Localité
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('identifier') ? ' border-red-500' : '' }} rounded
                                 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    name="locality" wire:model="locality" id="locality" type="text" placeholder="Enregistrer la loalité" value="{{ old('locality') }}">
                                @if($errors->has('locality'))
                                    <p class="text-red-500 text-sm">{{ $errors->first('locality') }}</p>
                                @endif
                            </div>

                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="sexe">
                                    Activité
                                </label>
                                <div class="relative">
                                    <select class="block appearance-none w-full bg-gray-200 border {{ $errors->has('activity') ? 'border-red-500' : 'border-gray-200' }}
                                text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white" id="activite" name="activity" wire:model="activity">
                                        <option value="">Sélectionner l'activité du fournisseur</option>
                                        <option value="C">Collectrice</option>
                                        <option value="T">Transformatrice</option>
                                        <option value="CT">Collecte et transformatrice </option>
                                        
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                                @if($errors->has('activity'))
                                    <p class="text-red-500 text-sm">{{ $errors->first('departement_id') }}</p>
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
                            <button type="submit" class="bg-amber-900 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded mr-2" >Valider</button>
                            <button type="button" wire:click='closeModal' class="bg-gray-200 hover:bg-gray-300 text-amber-800 font-bold py-2 px-4 mx-1 rounded focus:outline-none focus:shadow-outline ">Annuler</button>

                        </div>
                            
                        @endif
                    </div>
                    
                   
                </form>

            </div>
        </div>
@endif

@if($isOpenShow)
        <div class="fixed inset-0 flex items-center justify-center z-50 scroll-smooth">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="relative bg-gray-100 p-8 rounded shadow-lg w-1/2 ">
                <!-- Modal content goes here -->
                <svg wire:click.prevent="$set('isOpenShow', false)"
                    class="ml-auto w-6 h-6 text-gray-900 dark:text-gray-900 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                </svg>
               
                 
                <h2 class="text-2xl font-bold mb-4">Information du fournisseur</h2>

               
                    @if($step === 1)
                        <div class="flex gray-400 mb-3">
                            <div class="w-full px-3 mb-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="picture">
                                    photo du fournisseur
                                </label>
                               
                            </div>

                            <div class="w-full px-3 mb-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="agribusiness_id">
                                    coopérative / indépendant : <br> {{ $farmerInfo->agribusiness->denomination }}
                                </label>
                               
                            </div>
                        </div>

                        <div class="flex gray-400 mb-3">                         

                            <div class="w-full px-3 mb-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="identifier">
                                    Identifiant- : {{ $farmerInfo->identifier }}
                                </label>
                               
                            </div>

                            <div class="w-full px-3 mb-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="fullname">
                                    Nom & prénoms : {{ $farmerInfo->fullname }}
                                </label>
                               
                            </div>

                        </div>

                        <div class="flex gray-400 mb-3">
                            <div class="w-full px-3 mb-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="born_date">
                                    Date de naissance : {{ my_date_format_fr($farmerInfo->born_date) }}
                                </label>
                               
                            </div>

                            <div class="w-full px-3 mb-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="born_place">
                                    Lieu de naissance : {{ $farmerInfo->born_place }}
                                </label>
                                
                            </div>
                        </div>
                        <div class="flex gray-400 mb-3">
                            <div class="w-full px-3 mb-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="sexe">
                                    Sexe: 
                                    @if($farmerInfo->sexe == 'H')
                                        Homme
                                    @elseif($farmerInfo->sexe == 'F')
                                        Femme
                                    @else
                                        Aucun
                                    @endif
                                </label>
                                
                               
                            </div>
                        </div>
                    @else

                        

                       

                        <div class="flex gray-400 mb-6">

                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                                    Numéro de téléphone : {{ $farmerInfo->phone }}
                                </label>
                               
                            </div>
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                                    Numéro de téléphone mobile money : {{ $farmerInfo->phone_payment }}
                                </label>
                                
                            </div>
                        </div>

                        <div class="flex gray-400 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="sexe">
                                    Region : {{ $farmerInfo->region->name }}
                                </label>
                                
                            </div>

                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="sexe">
                                    Departement : {{ $farmerInfo->departement->name }}
                                </label>
                               
                            </div>
                           
                        </div>


                        <div class="flex gray-400 mb-6">                         

                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="identifier">
                                    Localité : {{ $farmerInfo->locality }}
                                </label>
                                
                            </div>

                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="sexe">
                                    Activité: 
                                    @if($farmerInfo->activity == 'C')
                                        Collecteur(trice)
                                    @elseif($farmerInfo->activity =='T')
                                        Transformateur(trice)
                                    @else
                                        Collecteur et transformateur
                                    @endif
                                </label>

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
                           
                            <button type="button" wire:click='closeModalShow' class="bg-gray-200 hover:bg-gray-300 text-amber-800 font-bold py-2 px-4 mx-1 rounded focus:outline-none focus:shadow-outline ">Fermer</button>

                        </div>
                            
                        @endif
                    </div>
                    
                   
                

            </div>
        </div>
@endif


    @livewire('farmer.farmer-edit-component')


@if($isOpenDelete)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="relative bg-gray-100 p-8 rounded shadow-lg w-1/2">
                <!-- Modal content goes here -->
                <svg wire:click.prevent="$set('isOpenDelete', false)"
                class="ml-auto w-6 h-6 text-gray-900 dark:text-gray-900 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                </svg>
                <h2 class="text-2xl font-bold mb-4">Voulez vous supprimer cet fournisseur ?</h2>
                <div class="flex justify-end mt-5">

                        <button type="button" class="btn-green-table hover:bg-green-800 text-white font-bold py-2 px-4 rounded mr-2" wire:click='delete("{{$farmerId}}")'>Valider</button>
                        <button type="button" class="bg-gray-200 hover:bg-gray-300 text-green-900 font-bold py-2 px-4 rounded" wire:click="closeModalDelete">Annuler</button>
                </div>
            </div>
        </div>
@endif