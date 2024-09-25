<div>
   <form wire:submit.prevent="saveCoop">
   <div class="flex">
                <div class="w-1/2 mr-5">

                    <div class="mb-4 ">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="matricule">
                           Nom <b class="text-red-500">*</b>
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
                      
                                <option  value=""></option>
                       
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
                           
                                <option  value=""></option>
                           
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


                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="matricule">
                        Certification <b class="text-red-500">*</b>
                        </label>
                        
                        @if($errors->has('certification_id'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                    <strong>{{ $errors->first('certification_id') }}</strong>
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
                            @if($errors->has('dfe'))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                        <strong>{{ $errors->first('dfe') }}</strong>
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
   </form>
</div>
