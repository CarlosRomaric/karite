          

<div class="">

        @if(($errors->any()))
        
            <div class="py-5 px-4 mb-4 bg-red-200 text-red-900 text-center rounded">
                <svg wire:click.prevent="$set('isClose', false)"
                class="ml-auto w-6 h-6 text-gray-900 dark:text-gray-900 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                </svg>
                Tous les champs du formulaire n'ont pas bien été renseigner verifier sur chaque partie du formulaire pour le cooriger
            </div>
        @endif

        @if(!empty(session('message')))
       
            <div class="py-5 px-4 mb-4 bg-gray-200 text-neutral-900 text-center rounded">
                <svg wire:click.prevent="$set('isClose', false)"
                class="ml-auto w-6 h-6 text-gray-900 dark:text-gray-900 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                </svg>
               {{ session('message') }}
            </div>
        @endif

    <form wire:submit.prevent="saveCoop">
        @if($step === 1)
            <!-- Étape 1 -->

            <div class="flex  place-items-center mb-5">
                <h4 class="text-2xl w-1/5 text-amber-950 uppercase font-bold">cooperative</h4>
                <hr class="w-4/5 h-1 bg-amber-300">
            </div>

            <div class="flex">
                <div class="w-1/2 mr-5">

                    <div class="mb-4 ">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="matricule">
                            Matricule de la coopérative <b class="text-red-500">*</b>
                        </label>
                        <input  name="matricule" wire:model="matricule" value="{{ old('matricule') }}" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="matricule" type="text" placeholder="Entrez votre Matricule">
                        @if($errors->has('matricule'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4  mt-2">
                                    <strong>{{ $errors->first('matricule') }}</strong>
                                </div>
                        @endif
                    </div>

                    <div class="mb-4 ">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="matricule">
                            Denomination <b class="text-red-500">*</b>
                        </label>
                        <input name="denomination"  wire:model="denomination" value="{{ old('denomination') }}" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="denomination" type="text" placeholder="Entrez votre Denomination">
                        @if($errors->has('denomination'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                    <strong>{{ $errors->first('denomination') }}</strong>
                                </div>
                        @endif
                    </div>

                    <div class="mb-4 ">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="matricule">
                            Sigle <b class="text-red-500">*</b>
                        </label>
                        <input  name="sigle" wire:model="sigle" value="{{ old('sigle') }}" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="sigle" type="text" placeholder="Entrez votre Sigle ">
                        @if($errors->has('sigle'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                    <strong>{{ $errors->first('sigle') }}</strong>
                                </div>
                        @endif
                    </div>

                    <div class="mb-4 ">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="matricule">
                            Region <b class="text-red-500">*</b>
                        </label>
                        <select name="region_id" wire:model.change="region_id"  class="form-control focus:border-amber-300 focus:outline-none">
                        <option value="">Choississez la region</option>
                        @foreach ($regions as $region)
                                <option  value="{{ $region->id }}">{{ $region->name }}</option>
                        @endforeach
                        </select>
                        @if($errors->has('region_id'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                    <strong>{{ $errors->first('region_id') }}</strong>
                                </div>
                        @endif
                    </div>

                    <div class="mb-4 ">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="matricule">
                            Departement <b class="text-red-500">*</b>
                        </label>
                        <select name="departement_id" wire:model="departement_id"  class="form-control focus:border-amber-500">
                            <option value="">Choississez le departement</option>
                            @foreach ($departements as $departement)
                                <option  value="{{ $departement->id }}">{{ $departement->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('departement_id'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                    <strong>{{ $errors->first('departement_id') }}</strong>
                                </div>
                        @endif
                    </div>

                    

                    <div class="mb-4 ">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="headquaters">
                            Siège <b class="text-red-500">*</b>
                        </label>
                        <input  name="headquaters" wire:model="headquaters" value="{{ old('headquaters') }}" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="headquaters" type="text" placeholder="Entrez le du siège de la coopérative">
                        @if($errors->has('headquaters'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                    <strong>{{ $errors->first('headquaters') }}</strong>
                                </div>
                        @endif
                    </div>

                

                    <div class="mb-4 ">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="matricule">
                            Adresse postale
                        </label>
                        <input  name="address" wire:model="address" value="{{ old('address') }}" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="matricule" type="text" placeholder="Entrez votre adresse postale">
                        @if($errors->has('address'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </div>
                        @endif
                    </div>

                </div>
                <div class="w-1/2">


                    <div class="mb-4 ">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="matricule">
                        Certification <b class="text-red-500">*</b>
                        </label>
                        <select name="certification" wire:model="certification"  id="certification" class="form-control text-gray-700 text-sm font-bold mb-2">
                            <option value="">Choississez la certification</option>
                            <option value="Bio">Bio</option>
                            <option value="Ordinaire">Ordinaire</option>
                        </select>
                        @if($errors->has('certification'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                    <strong>{{ $errors->first('certification') }}</strong>
                                </div>
                        @endif 
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="matricule">
                        Banques <b class="text-red-500">*</b>
                        </label>
                        <select  id="bank" name="bank" wire:model="bank"   class="form-control">
                            <option value="">Choississez votre banque</option>
                            <option value="NSA">NSA</option>
                            <option value="SGBCI">SGBCI</option>
                            <option value="ECOBANK">ECOBANK</option>
                            <option value="UBA">UBA</option>
                            <option value="BNI">BNI</option>
                            <option value="Autres">Autres</option>
                        </select>
                        @if($errors->has('bank'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                    <strong>{{ $errors->first('bank') }}</strong>
                                </div>
                        @endif 
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm mb-2 font-bold" for="matricule">
                        DFE
                        </label>

                        <input
                            wire:model="dfe"
                            value="{{ old('dfe') }}"
                            class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.16rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-amber-950 focus:text-gray-700 focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white  file:dark:text-white"
                            type="file"
                            id="dfe" />
                            @if($errors->has('certification'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                        <strong>{{ $errors->first('certification') }}</strong>
                                </div>
                            @endif
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm  mb-1 font-bold" for="matricule">
                        Registre de commerce
                        </label>

                        <input
                            wire:model="registre_commerce"
                            value="{{ old('registre_commerce') }}"
                            class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.16rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-amber-950 focus:text-gray-700 focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white  file:dark:text-white"
                            type="file"
                            id="registre_commerce" />

                            @if($errors->has('registre_commerce'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                        <strong>{{ $errors->first('registre_commerce') }}</strong>
                                </div>
                            @endif
                        
                    </div>
                    <div class="mb-4 ">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="number_sections">
                        Nombres de sections <b class="text-red-500">*</b>
                        </label>
                        <input  wire:model="number_sections"  onkeypress="return isNumber(event)"  value="{{ old('number_sections') }}" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="matricule" type="text" placeholder="Entrez le nombre de vos sections">
                        @if($errors->has('number_sections'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                        <strong>{{ $errors->first('number_sections') }}</strong>
                                </div>
                        @endif
                    </div>
                    <div class="mb-4 ">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="matricule">
                            Nombre d'unités de transformations <b class="text-red-500">*</b>
                        </label>
                        <input  wire:model="number_unite_transformations"  onkeypress="return isNumber(event)" value="{{ old('number_unite_transformations') }}" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="number_unite_transformations" type="text" placeholder="Entrez le nombre d'unités de transformations que vous avez">
                        @if($errors->has('number_unite_transformations'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                        <strong>{{ $errors->first('number_unite_transformations') }}</strong>
                                </div>
                        @endif
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm mb-2 font-bold" for="logo">
                            Logo de la coopérative
                        </label>

                        <input
                            wire:model="logo"
                            value="{{ old('logo') }}"
                            class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.16rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-amber-950 focus:text-gray-700 focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white  file:dark:text-white"
                            type="file"
                            id="logo" />
                            @if($errors->has('logo'))
                                    <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                            <strong>{{ $errors->first('logo') }}</strong>
                                    </div>
                            @endif
                    </div>
                
                </div>
            </div>

        @else
            <!-- Étape 2 -->
            <div class="flex  place-items-center mb-5">
                <h4 class="text-2xl w-1/6  text-amber-900 uppercase font-bold">PCA</h4>
                <hr class="w-5/6 h-1 bg-amber-300 ">
            </div>


            <div class="flex">

                <div class="w-1/2 mr-5">
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname_pca">
                            Nom du président <b class="text-red-500">*</b>
                        </label>
                        
                        <input  wire:model="lastname_pca" value="{{ old('lastname_pca') }}" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="president_nom" type="text" placeholder="Nom"> 
                        @if($errors->has('lastname_pca'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                        <strong>{{ $errors->first('lastname_pca') }}</strong>
                                </div>
                        @endif
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="phone_pca">
                        Contact <b class="text-red-500">*</b>
                        </label>
                        
                        <input  wire:model="phone_pca" onkeypress="return isNumberKey(event)" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="president_nom" type="text" placeholder="contact" maxlength="14"> 
                        @if($errors->has('phone_pca'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                        <strong>{{ $errors->first('phone_pca') }}</strong>
                                </div>
                        @endif
                    </div>
                 
                   
                
                </div>
                <div class="w-1/2">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="firstname_pca">
                        Prenoms <b class="text-red-500">*</b>
                        </label>
                        
                        <input  wire:model="firstname_pca" name="firstname_pca" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="president_nom" type="text" placeholder="Nom"> 
                        @if($errors->has('firstname_pca'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                        <strong>{{ $errors->first('firstname_pca') }}</strong>
                                </div>
                        @endif
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="phone_pca">
                        Email
                        </label>
                        
                        <input  wire:model="email_pca" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email_pca" type="text" placeholder="Email"> 
                        @if($errors->has('email_pca'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                        <strong>{{ $errors->first('email_pca') }}</strong>
                                </div>
                        @endif
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm mb-2 font-bold" for="photo_pca">
                        Photo d'identité
                        </label>

                        <input
                            name="photo_pca"
                            wire:model="photo_pca"
                            class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.16rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-amber-950 focus:text-gray-700 focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white  file:dark:text-white"
                            type="file"
                            id="photo_pca" />

                        @if($errors->has('photo_pca'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                        <strong>{{ $errors->first('photo_pca') }}</strong>
                                </div>
                        @endif
                        
                    </div>
                    
                    
                  
                </div>

            </div> 

            <div class="flex  place-items-center my-5">
                <h4 class="text-2xl w-1/6 text-amber-950 font-bold uppercase">superviseur</h4>
                <hr class="w-5/6 h-1 bg-amber-300 ">
            </div>

            <div class="flex">

                <div class="w-1/2 mr-5">
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname_sup">
                            Nom <b class="text-red-500">*</b>
                        </label>
                        
                        <input  name="lastname_sup" wire:model="lastname_sup" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="president_nom" type="text" placeholder="Nom"> 
                        @if($errors->has('lastname_sup'))
                            <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                    <strong>{{ $errors->first('lastname_sup') }}</strong>
                            </div>
                        @endif
                    
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="phone_sup">
                        Contact <b class="text-red-500">*</b>
                        </label>
                        
                        <input  name="phone_sup" onkeypress="return isNumberKey(event)" wire:model="phone_sup" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="contact_sup" type="text" placeholder="contact" maxlength="14"> 
                        @if($errors->has('phone_sup'))
                            <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                    <strong>{{ $errors->first('phone_sup') }}</strong>
                            </div>
                        @endif
                    
                    </div>
                   

                </div>
                <div class="w-1/2">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="firstname_sup">
                        Prenoms <b class="text-red-500">*</b>
                        </label>
                        
                        <input name="firstname_sup"  wire:model="firstname_sup" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="president_prenom" type="text" placeholder="Prénoms"> 
                        @if($errors->has('firstname_sup'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                        <strong>{{ $errors->first('firstname_sup') }}</strong>
                                </div>
                        @endif
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="phone_sup">
                        Email
                        </label>
                        
                        <input  name="email_sup" wire:model="email_sup" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email_sup" type="text" placeholder="Email"> 
                        @if($errors->has('email_sup'))
                            <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                    <strong>{{ $errors->first('email_sup') }}</strong>
                            </div>
                        @endif
                    
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm mb-2 font-bold" for="photo_sup">
                        Photo d'identité
                        </label>

                        <input
                            name="photo_sup"
                            wire:model="photo_sup"
                            class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.16rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-amber-950 focus:text-gray-700 focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white  file:dark:text-white"
                            type="file"
                            id="photo_sup" />
                            @if($errors->has('photo_sup'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                        <strong>{{ $errors->first('photo_sup') }}</strong>
                                </div>
                            @endif
                        
                    </div>

                    
                   

                </div>

            </div> 
                
        
        @endif
    
    
        <div class="flex justify-between">
            @if($step > 1)
                <button type="button"  wire:click="prevStep" class="bg-amber-400 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Précédent</button>
            @endif
            
            @if($step < 2)
                <button type="button" wire:click="goToNextStep" class="bg-amber-900 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Suivant</buttion>
            
            @else
                <button type="submit" class="bg-amber-900 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Soummettre</button>
            @endif
        </div>

    <!-- </form> -->
</div>

@push('javascript')
<script>
    function isNumber(event){
                var charCode = (event.which) ? event.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            }
    function isNumberKey(event) {
        var charCode = (event.which) ? event.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        } else {
            var inputValue = event.target.value.replace(/\s/g, '');
            var formattedValue = '';
            for (var i = 0; i < inputValue.length; i += 2) {
                formattedValue += inputValue.substr(i, 2) + ' ';
            }
            event.target.value = formattedValue.trim();
            return true;
        }
    }
 
</script>
@endpush