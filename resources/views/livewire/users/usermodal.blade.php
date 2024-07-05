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
                <h2 class="text-2xl font-bold mb-4">{{ $userId ? 'Modification d\' utilisateur' : 'Creation d\' utilisateur' }}</h2>
                <form wire:submit.prevent="{{ $userId ? 'update':'saveUser' }} ">
                        
                <div class="flex gray-400 mb-6">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="fullname">
                            Nom et prénoms
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('fullname') ? ' border-red-500' : '' }} rounded
                             py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            name="fullname" id="fullname" wire:model="fullname" type="text" placeholder="Nom et prénoms" value="{{ old('fullname') }}">
                        @if($errors->has('fullname'))
                            <p class="text-red-500 text-sm">{{ $errors->first('fullname') }}</p>
                        @endif
                    </div>
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="username">
                            Nom d'utilisateur
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('username') ? ' border-red-500' : '' }} rounded
                             py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" autocomplete="off"
                            name="username" id="username"  wire:model="username" type="text" placeholder="Nom d'utilisateur" value="{{ old('username') }}">
                        @if($errors->has('username'))
                            <p class="text-red-500 text-sm">{{ $errors->first('username') }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex gray-400 mb-6">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                            Mot de passe
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('password') ? ' border-red-500' : '' }} rounded
                             py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" autocomplete="off"
                            name="password" id="password" wire:model="password" type="password" placeholder="*****************">
                        @if($errors->has('password'))
                            <p class="text-red-500 text-sm">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password_confirmation">
                            Confirmation du mot de passe
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('password_confirmation') ? ' border-red-500' : '' }} rounded
                             py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" autocomplete="off"
                            name="password_confirmation" wire:model="password_confirmation" id="password_confirmation" type="password" placeholder="*****************">
                        @if($errors->has('password_confirmation'))
                            <p class="text-red-500 text-sm">{{ $errors->first('password_confirmation') }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex gray-400 mb-6">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="fullname">
                            Contact
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('phone') ? ' border-red-500' : '' }} rounded
                             py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            name="phone" id="phone" wire:model="phone" type="text" placeholder="Contact" value="{{ old('phone') }}">
                        @if($errors->has('phone'))
                            <p class="text-red-500 text-sm">{{ $errors->first('phone') }}</p>
                        @endif
                    </div>
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="agribusiness_id">
                            Sélectionner la coopérative
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-gray-200 border border-gray-200
                            text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white
                             focus:border-gray-500" id="agribusiness_id" wire:model="agribusiness_id" name="agribusiness_id">
                                <option value="">Sélectionner la coopérative</option>
                                @foreach($agribusinesses as $agribusiness)
                                <option value="{{ $agribusiness->id }}" @if(old('agribusiness_id') === $agribusiness->id) selected @endif>{{ $agribusiness->denomination }}</option>
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
                @if(!$userId)
                <div class="flex gray-400 mb-6">
                    <div class="w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="agribusiness_id">
                            Sélectionner le rôle
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-gray-200 border border-gray-200
                            text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white
                             focus:border-gray-500 {{ $errors->has('role_id') ? ' border-red-500' : '' }}" id="role_id" wire:model="role_id" name="role_id">
                                <option value="">Sélectionner le rôle</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @if(old('role_id') === $role->id) selected @endif>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        @if($errors->has('role_id'))
                            <p class="text-red-500 text-sm">{{ $errors->first('role_id') }}</p>
                        @endif
                    </div>
                </div>
                @endif
                
                   
                    
                    <div class="flex justify-end mt-5">

                        <button type="submit" class="bg-amber-800 hover:bg-amber-800 text-white font-bold py-2 px-4 rounded mr-2">Enregistrer</button>
                        <button type="button" class="bg-gray-200 hover:bg-gray-300 text-amber-800 font-bold py-2 px-4 rounded" wire:click="closeModal">Annuler</button>
                    </div>
                </form>

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
                <h2 class="text-2xl font-bold mb-4">Voulez vous supprimer cet utilisateur ?</h2>
                <div class="flex justify-end mt-5">

                        <button type="button" class="bg-amber-800 hover:bg-amber-800 text-white font-bold py-2 px-4 rounded mr-2" wire:click='delete("{{$userId}}")'>Valider</button>
                        <button type="button" class="bg-gray-200 hover:bg-gray-300 text-amber-800 font-bold py-2 px-4 rounded" wire:click="closeModalDelete">Annuler</button>
                </div>
            </div>
        </div>
@endif