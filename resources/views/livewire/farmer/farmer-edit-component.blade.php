<div>
@if ($isOpenEdit)
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative bg-gray-100 p-8 rounded shadow-lg w-1/2">
            <!-- Modal content goes here -->
            <svg wire:click.prevent="$set('isOpen', false)"
            class="ml-auto w-6 h-6 text-gray-900 dark:text-gray-900 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
            </svg>
            <h2 class="text-2xl font-bold mb-4">Modification des informations du producteurs</h2>
            <form wire:submit.prevent="{{ updateFarmer }}">
                    
                <div class="flex gray-400 mb-6">
                    
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <form wire:submit.prevent="{{ updateFarmer() }}" >
                            @csrf

                               
                            <div class="py-6">
                                <h1 class="font-semibold uppercase text-gray-700 text-2xl border-b-2 border-gray-700">1. Coordonnées</h1>
                            </div>
                            <div class="flex gray-400 mb-6">
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="picture">
                                        Ajouter la photo du producteur
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('picture') ? ' border-red-500' : '' }} rounded
                                    py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        name="picture" wire:model="picture" id="picture" type="file" placeholder="Ajouter la photo du producteur" >
                                    @if($errors->has('picture'))
                                        <p class="text-red-500 text-sm">{{ $errors->first('picture') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex gray-400 mb-6">
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="agribusiness_id">
                                        Sélectionner la coopérative
                                    </label>
                                    <div class="relative">
                                <select class="block appearance-none w-full bg-gray-200 border {{ $errors->has('agribusiness_id') ? 'border-red-500' : 'border-gray-200' }}
                                text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white
                                " id="agribusiness_id" name="agribusiness_id" wire:model="agribusiness_id">
                                            <option value="">Sélectionner la coopérative</option>
                                            @foreach($agribusinesses as $agribusiness)
                                                <option value="{{ $agribusiness->id }}" @if(old('agribusiness_id') === $agribusiness->id) selected @endif>{{ $agribusiness->name }}</option>
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
                            <div class="flex gray-400 mb-6">
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="locality">
                                        Site
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('locality') ? ' border-red-500' : '' }} rounded
                                    py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        name="locality" id="locality" wire:model="locality" type="text" placeholder="Site" value="{{ old('locality') }}">
                                    @if($errors->has('locality'))
                                        <p class="text-red-500 text-sm">{{ $errors->first('locality') }}</p>
                                    @endif
                                </div>
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="identifier">
                                        Identifiant
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('identifier') ? ' border-red-500' : '' }} rounded
                                    py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        name="identifier" wire:model="identifier" id="identifier" type="text" placeholder="Identifiant" value="{{ old('identifier') }}">
                                    @if($errors->has('identifier'))
                                        <p class="text-red-500 text-sm">{{ $errors->first('identifier') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex gray-400 mb-6">
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="_gps_code">
                                        Code GPS
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('_gps_code') ? ' border-red-500' : '' }} rounded
                                    py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        name="_gps_code" id="_gps_code" type="text" wire:model="_gps_code" placeholder="Code GPS" value="{{ old('_gps_code') }}">
                                    @if($errors->has('_gps_code'))
                                        <p class="text-red-500 text-sm">{{ $errors->first('_gps_code') }}</p>
                                    @endif
                                </div>
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="fullname">
                                        Nom & prénoms
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('fullname') ? ' border-red-500' : '' }} rounded
                                    py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        name="fullname" wire:model="fullname" id="fullname" type="text" placeholder="Nom & prénoms" value="{{ old('fullname') }}">
                                    @if($errors->has('fullname'))
                                        <p class="text-red-500 text-sm">{{ $errors->first('fullname') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex gray-400 mb-6">
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="sexe">
                                        Sexe
                                    </label>
                                    <div class="relative">
                                        <select class="block appearance-none w-full bg-gray-200 border {{ $errors->has('sexe') ? 'border-red-500' : 'border-gray-200' }}
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
                            </div>
                            <div class="flex gray-400 mb-6">
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="born_date">
                                        Date de naissance
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('born_date') ? ' border-red-500' : '' }} rounded
                                    py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        name="born_date" id="born_date" wire:model="born_date" type="date" placeholder="Date de naissance" value="{{ old('born_date') }}">
                                    @if($errors->has('born_date'))
                                        <p class="text-red-500 text-sm">{{ $errors->first('born_date') }}</p>
                                    @endif
                                </div>
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="born_place">
                                        Lieu de naissance
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('born_place') ? ' border-red-500' : '' }} rounded
                                    py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        name="born_place" id="born_place" wire:model="born_place" type="text" placeholder="Lieu de naissance" value="{{ old('born_place') }}">
                                    @if($errors->has('born_place'))
                                        <p class="text-red-500 text-sm">{{ $errors->first('born_place') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex gray-400 mb-6">
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="manager_fullname">
                                        Nom & prénoms <br> (Gestionnaire)
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('manager_fullname') ? ' border-red-500' : '' }} rounded
                                    py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        name="manager_fullname" wire:model="manager_fullname" id="manager_fullname" type="text" placeholder="Nom & prénoms (Gestionnaire)" value="{{ old('manager_fullname') }}">
                                    @if($errors->has('manager_fullname'))
                                        <p class="text-red-500 text-sm">{{ $errors->first('manager_fullname') }}</p>
                                    @endif
                                </div>
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="manager_sexe">
                                        Sexe <br> (Gestionnaire)
                                    </label>
                                    <div class="relative">
                                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200
                                    text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white
                                    focus:border-gray-500" wire:model="manager_sexe" id="manager_sexe" name="manager_sexe">
                                            <option value="">Sélectionner le sexe</option>
                                            <option @if(old('manager_sexe') == "AUCUN") selected @endif value="AUCUN">Aucun</option>
                                            <option @if(old('manager_sexe') == "H") selected @endif value="H">Homme</option>
                                            <option @if(old('manager_sexe') == "F") selected @endif value="F">Femme</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                        </div>
                                    </div>
                                    @if($errors->has('manager_sexe'))
                                        <p class="text-red-500 text-sm">{{ $errors->first('manager_sexe') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex gray-400 mb-6">
                                <div class="w-full px-3 mb-6 md:mb-0" >
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="manager_phone">
                                        Numéro de téléphone <br>(Gestionnaire)
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('manager_phone') ? ' border-red-500' : '' }} rounded
                                    py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        name="manager_phone" id="manager_phone"  wire:model="manager_phone" type="text" placeholder="Numéro de téléphone (Gestionnaire)" value="{{ old('manager_phone') }}" 
                                        x-mask:dynamic="
                                            $input.startsWith('34') || $input.startsWith('37')
                                                ? '99 99 99 99 99' : '99 99 99 99 99'
                                        ">
                                    @if($errors->has('manager_phone'))
                                        <p class="text-red-500 text-sm">{{ $errors->first('manager_phone') }}</p>
                                    @endif
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
                                    <div class="relative">
                                        <select class="block appearance-none w-full bg-gray-200 border {{ $errors->has('marital_status') ? 'border-red-500' : 'border-gray-200' }}
                                    text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white" id="marital_status" name="marital_status" wire:model="marital_status">
                                            <option value="">Etat matrimonial</option>
                                            <option @if(old('marital_status') == "AUCUN") selected @endif value="AUCUN">AUCUN</option>
                                            <option @if(old('marital_status') == "CELIBATAIRE") selected @endif value="CELIBATAIRE">Célibataire</option>
                                            <option @if(old('marital_status') == "MARIE") selected @endif value="MARIE">Marié(e)</option>
                                            <option @if(old('marital_status') == "VEUF") selected @endif value="VEUF">Veuf/Veuve</option>
                                            <option @if(old('marital_status') == "DIVORCE") selected @endif value="DIVORCE">Divorcé(e)</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                        </div>
                                    </div>
                                    @if($errors->has('marital_status'))
                                        <p class="text-red-500 text-sm">{{ $errors->first('marital_status') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex gray-400 mb-6">
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="number_of_children">
                                        Nombre d'enfants
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('number_of_children') ? ' border-red-500' : '' }} rounded
                                    py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        name="number_of_children" id="number_of_children" type="number" min="0" placeholder="Nombre d'enfants" value="{{ old('number_of_children') }}" wire:model="number_of_children">
                                    @if($errors->has('number_of_children'))
                                        <p class="text-red-500 text-sm">{{ $errors->first('number_of_children') }}</p>
                                    @endif
                                </div>
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="number_of_dependants">
                                        Nombre de personne à charge
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('number_of_dependants') ? ' border-red-500' : '' }} rounded
                                    py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        name="number_of_dependants" id="number_of_dependants" type="number" min="0" placeholder="Nombre de personne à charge" value="{{ old('number_of_dependants') }}" wire:model="number_of_dependants">
                                    @if($errors->has('number_of_dependants'))
                                        <p class="text-red-500 text-sm">{{ $errors->first('number_of_dependants') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex gray-400 mb-6">
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="number_of_women">
                                        Nombre de Femme
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('number_of_women') ? ' border-red-500' : '' }} rounded
                                    py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        name="number_of_women" id="number_of_women" type="number" min="0" placeholder="Nombre de Femme" value="{{ old('number_of_women') }}" wire:model="number_of_women">
                                    @if($errors->has('number_of_women'))
                                        <p class="text-red-500 text-sm">{{ $errors->first('number_of_women') }}</p>
                                    @endif
                                </div>
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="number_of_plots">
                                        Nombre de parcelles
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('number_of_plots') ? ' border-red-500' : '' }} rounded
                                    py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" readonly min="0"
                                        name="number_of_plots" id="number_of_plots" type="number" placeholder="Nombre de parcelles" value="{{ old('number_of_plots') }}" wire:model="number_of_plots">
                                    @if($errors->has('number_of_plots'))
                                        <p class="text-red-500 text-sm">{{ $errors->first('number_of_plots') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="px-8 mt-8 flex justify-end items-center">
                                <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border
                                            border-gray-400 outline-none focus:shadow-outline rounded shadow mx-1 cursor-pointer" wire:click.prevent="closeModal">
                                    Annuler
                                </button>
                                <button class="focus:outline-none flex items-center btn-green-table" type="submit">Enregistrer</button>

                                
                            </div>
                        </form>
                    </div>
                
                    
                    
                </div>
            
                
                
                <div class="flex justify-end mt-5">

                    <button type="submit" class="btn-green-table hover:bg-green-800 text-white font-bold py-2 px-4 rounded mr-2">Enregistrer</button>
                    <button type="button" class="bg-gray-200 hover:bg-gray-300 text-green-900 font-bold py-2 px-4 rounded" wire:click="closeModal">Annuler</button>
                </div>
            </form>

        </div>
    </div>
    @endif
</div>
