@extends('layouts.refonte.app')
@section('title') - Modification d'un producteur @endsection
@section('content')
    <div class="w-full overflow-hidden px-4 py-8 md:p-12">
        <h1 class="mb-8 font-bold text-3xl">
            <a href="{{ route('farmers') }}" class="text-green-600 hover:text-teal-600">Producteurs</a>
            <span class="text-green-600 font-medium"> /</span> Modification
        </h1>
        <alert-component
            message="{{ session()->get('message') }}" type="{{ session()->get('status') }}"
            visible="{{ session()->has('message') && session()->get('status') }}"></alert-component>
        <farmer-edit-component
            inline-template
            :old-plots="{{ json_encode($farmer->plots) }}"
            :total_area="{{ json_encode(old('total_area', [])) }}"
            :gps_code="{{ json_encode(old('gps_code', [])) }}"
            :latitude="{{ json_encode(old('latitude', [])) }}"
            :longitude="{{ json_encode(old('longitude', [])) }}"
            :errors="{{ $errors->any() ? $errors->toJson() : json_encode([]) }}"
            >
            <div class="bg-white w-full rounded shadow overflow-hidden flex justify-center">
                <form method="post" action="{{ route('farmers.update', ['farmer' => $farmer->id]) }}" class="w-full p-10 flex flex-row" enctype="multipart/form-data">
                    @csrf
                    <div class="w-1/3">
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
                                    name="picture" id="picture" type="file" placeholder="Ajouter la photo du producteur" >
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
                            " id="agribusiness_id" name="agribusiness_id">
                                        <option value="">Sélectionner la coopérative</option>
                                        @foreach($agribusinesses as $agribusiness)
                                            <option value="{{ $agribusiness->id }}" @if(old('agribusiness_id') === $agribusiness->id || $farmer->agribusiness_id === $agribusiness->id) selected @endif>{{ $agribusiness->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
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
                                    name="locality" id="locality" type="text" placeholder="Site" value="{{ old('locality') ?: $farmer->locality }}">
                                @if($errors->has('locality'))
                                    <p class="text-red-500 text-sm">{{ $errors->first('locality') }}</p>
                                @endif
                            </div>
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="fullname">
                                    Identifiant
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('identifier') ? ' border-red-500' : '' }} rounded
                                 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    name="identifier" id="identifier" type="text" placeholder="Identifiant" value="{{ old('identifier') ?: $farmer->identifier }}">
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
                                    name="_gps_code" id="_gps_code" type="text" placeholder="Code GPS" value="{{ old('_gps_code') ?: $farmer->gps_code }}">
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
                                    name="fullname" id="fullname" type="text" placeholder="Nom & prénoms" value="{{ old('fullname') ?: $farmer->fullname }}">
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
                                text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white" id="sexe" name="sexe">
                                        <option value="">Sélectionner le sexe</option>
                                        <option @if($farmer->sexe == 'AUCUN' || old('sexe') == 'AUCUN') selected @endif value="AUCUN">Aucun</option>
                                        <option @if($farmer->sexe == 'H' || old('sexe') == 'H') selected @endif value="H">Homme</option>
                                        <option @if($farmer->sexe == 'F' || old('sexe') == 'F') selected @endif value="F">Femme</option>
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
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="fullname">
                                    Numéro de téléphone
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('phone') ? ' border-red-500' : '' }} rounded
                                 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    name="phone" id="phone" type="text" placeholder="Téléphone" value="{{ old('phone') ?: $farmer->phone }}">
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
                                    name="born_date" id="born_date" type="date" placeholder="Date de naissance" value="{{ old('born_date') ?: custom_date_format('d/m/Y', 'Y-m-d', $farmer->born_date) }}">
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
                                    name="born_place" id="born_place" type="text" placeholder="Lieu de naissance" value="{{ old('born_place') ?: $farmer->born_place }}">
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
                                    name="manager_fullname" id="manager_fullname" type="text" placeholder="Nom & prénoms (Gestionnaire)" value="{{ old('manager_fullname') ?: $farmer->manager_fullname }}">
                                @if($errors->has('manager_fullname'))
                                    <p class="text-red-500 text-sm">{{ $errors->first('manager_fullname') }}</p>
                                @endif
                            </div>
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="manager_sexe">
                                    Sexe <br> (Gestionnaire)
                                </label>
                                <div class="relative">
                                    <select class="block appearance-none w-full bg-gray-200 border {{ $errors->has('manager_sexe') ? 'border-red-500' : 'border-gray-200' }}
                                text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white" id="manager_sexe" name="manager_sexe">
                                        <option value="">Sélectionner le sexe</option>
                                        <option @if($farmer->manager_sexe == 'AUCUN' || old('manager_sexe') == 'AUCUN') selected @endif value="AUCUN">Aucun</option>
                                        <option @if($farmer->manager_sexe == 'H' || old('manager_sexe') == 'H') selected @endif value="H">Homme</option>
                                        <option @if($farmer->manager_sexe == 'F' || old('manager_sexe') == 'F') selected @endif value="F">Femme</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4"
                                             xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20">
                                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                        </svg>
                                    </div>
                                </div>
                                @if($errors->has('manager_sexe'))
                                    <p class="text-red-500 text-sm">{{ $errors->first('manager_sexe') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex gray-400 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="manager_phone">
                                    Numéro de téléphone <br> (Gestionnaire)
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('manager_phone') ? ' border-red-500' : '' }} rounded
                                 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    name="manager_phone" id="manager_phone" type="text" placeholder="Numéro de téléphone (Gestionnaire)" value="{{ old('manager_phone') ?: $farmer->manager_phone }}">
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
                                text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white" id="marital_status" name="marital_status">
                                        <option value="">Etat matrimonial</option>
                                        <option @if($farmer->marital_status == 'AUCUN') selected @endif value="AUCUN">Aucun</option>
                                        <option @if($farmer->marital_status == 'CELIBATAIRE') selected @endif value="CELIBATAIRE">Célibataire</option>
                                        <option @if($farmer->marital_status == 'MARIE') selected @endif value="MARIE">Marié(e)</option>
                                        <option @if($farmer->marital_status == 'VEUF') selected @endif value="VEUF">Veuf/Veuve</option>
                                        <option @if($farmer->marital_status == 'DIVORCE') selected @endif value="DIVORCE">Divorcé(e)</option>
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
                                    name="number_of_children" id="number_of_children" type="number" min="0" placeholder="Nombre d'enfants" value="{{ old('number_of_children') ?: $farmer->number_of_children }}">
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
                                    name="number_of_dependants" id="number_of_dependants" type="number" min="0" placeholder="Nombre de personne à charge" value="{{ old('number_of_dependants') ?: $farmer->number_of_dependants }}">
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
                                    name="number_of_women" id="number_of_women" type="number" min="0" placeholder="Nombre de Femme" value="{{ old('number_of_women') ?: $farmer->number_of_women }}">
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
                                 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" v-model="numberOfPlots" readonly min="0"
                                    name="number_of_plots" id="number_of_plots" type="number" placeholder="Nombre de parcelles" value="{{ old('number_of_plots') ?: $farmer->number_of_plots }}">
                                @if($errors->has('number_of_plots'))
                                    <p class="text-red-500 text-sm">{{ $errors->first('number_of_plots') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="px-8 mt-8 flex justify-between items-center">
                            <delete-component destroy_url="{{ route('farmers.delete', ['farmer' => $farmer->id]) }}" list_url="{{ route('farmers') }}"></delete-component>
                            <button class="focus:outline-none flex items-center btn-green" type="submit">Valider</button>
                        </div>
                    </div>
                    <div class="w-2/3 pl-4">
                        <div class="py-6">
                            <h1 class="font-semibold uppercase text-gray-700 text-2xl border-b-2 border-gray-700">3. Parcelles</h1>
                        </div>
                        <br>
                        <table class="w-full">
                            <tbody>
                                <tr v-for="(plot, index) in plots" :key=`plot_line_${plot.id}_update`>
                                    <td>
                                        <input type="hidden" name="plotId[]" :value="plot.line_type">
                                        <div class="flex flex-col gray-400 mb-6">
                                            <h1 class="pb-6 text-gray-700 text-md font-bold">@{{ `Parcelle ${index + 1}` }}</h1>
                                            <div class="flex">
                                                <div class="w-full px-3 mb-6 md:mb-0">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                                        Superficie totale de <br> l'exploitation (ha)
                                                    </label>
                                                    <input
                                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded
                                     py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                                        v-bind:class="[errors.hasOwnProperty(`total_area.${index}`) ? ' border-red-500' : '']"
                                                        name="total_area[]" type="text" v-model="plots[index].total_area" placeholder="Superficie totale de l'exploitation (ha)">
                                                    <p v-if="errors.hasOwnProperty(`total_area.${index}`)" class="text-red-500 text-xs">Ce champ est obligatoire.</p>
                                                </div>
                                                <div class="w-full px-3 mb-6 md:mb-0">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                                        Joindre le fichier du <br>tracé GPS (Kmz)
                                                    </label>
                                                    <input
                                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('gps_track') ? ' border-red-500' : '' }} rounded
                                     py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                                        name="gps_track[]" type="file">
                                                </div>
                                            </div>
                                            <div class="flex">
                                                <table class="w-full">
                                                    <tr>
                                                        <td class="px-3">
                                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                                                Code GPS
                                                            </label>
                                                        </td>
                                                        <td class="px-3">
                                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                                                Coordonnées (Latitude - Longitude)
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-3" valign="top">
                                                            <div class="flex flex-col">
                                                                <input
                                                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded
                                     py-3 px-4 leading-tight focus:outline-none focus:bg-white mr-4"
                                                                    v-bind:class="[errors.hasOwnProperty(`gps_code.${index}`) ? ' border-red-500' : '']"
                                                                    name="gps_code[]" type="text" v-model="plots[index].gps_code" placeholder="Code GPS">
                                                                <p v-if="errors.hasOwnProperty(`gps_code.${index}`)" class="text-red-500 text-xs">Ce champ est obligatoire.</p>
                                                            </div>
                                                        </td>
                                                        <td class="px-3" valign="top">
                                                            <div class="flex flex-row w-full">
                                                                <div class="w-1/2 flex flex-col">
                                                                    <input
                                                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded
                                         py-3 px-4 leading-tight focus:outline-none focus:bg-white mr-4"
                                                                        v-bind:class="[errors.hasOwnProperty(`latitude.${index}`) ? ' border-red-500' : '']"
                                                                        name="latitude[]" type="text" v-model="plots[index].latitude" placeholder="Latitude">
                                                                    <p v-if="errors.hasOwnProperty(`latitude.${index}`)" class="text-red-500 text-xs">Ce champ est obligatoire.</p>
                                                                </div>
                                                                <div class="w-1/2 flex flex-col mx-3">
                                                                    <input
                                                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded
                                         py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                                                        v-bind:class="[errors.hasOwnProperty(`longitude.${index}`) ? ' border-red-500' : '']"
                                                                        name="longitude[]" type="text" v-model="plots[index].longitude" placeholder="Longitude">
                                                                    <p v-if="errors.hasOwnProperty(`longitude.${index}`)" class="text-red-500 text-xs">Ce champ est obligatoire.</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a @click="removeLine(plot.id)" class="text-red-500 cursor-pointer">Supprimer</a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="flex justify-start">
                                    <td colspan="2">
                                        <a @click="addNewLine()"
                                           class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border
                                            border-gray-400 outline-none focus:shadow-outline rounded shadow mx-1 cursor-pointer">
                                            Ajouter une parcelle
                                        </a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </form>
            </div>
        </farmer-edit-component>
    </div>
@endsection
