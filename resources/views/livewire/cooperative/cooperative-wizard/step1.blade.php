
@push('stylesheet')
    <style>
            .select2-container--default .select2-selection--single {
                background-color: #fff;
                border: 1px solid #aaa;
                border-radius: 0px;
                padding-top: 10px;
                padding-left: 4px;
                padding-bottom: 30px;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                color: #444;
                line-height: 15px;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                display: none;
            }

            .selectize-input, .selectize-input input {
                color: #303030;
                font-family: inherit;
                font-size: 10px;
                /* line-height: 44px; */
                font-smoothing: inherit;
                border: 1px solid #aaa;
                border-radius: 0px;
               
            }

            .selectize-input.dropdown-active {
                border-radius: 0px;
            }

            .selectize-control.multi .selectize-input [data-value] {
                text-shadow: 0 1px 0 rgba(0,51,83,.3);
                border-radius: 0px;
                background-color: #778801;
                border: 1px solid #778801;
                background-image: linear-gradient(to bottom,#778801,#97a533);
                background-repeat: repeat-x;
                box-shadow: 0 1px 0 rgba(0,0,0,.2),inset 0 1px rgba(255,255,255,.03)
            }

            .selectize-control.multi .selectize-input [data-value].active {
                background-color: #778801;
                border: 1px solid #778801;
                background-image: linear-gradient(to bottom,#778801,#97a533);
                background-repeat: repeat-x;
            }

            .selectize-control.multi .selectize-input>div.active {
                background: #92c836;
                color: #fff;
                border: 1px solid #778801;
            }
    </style>
@endpush
<div class="flex  place-items-center mb-5">
    <h4 class="text-2xl w-1/4">Informations sur la cooperative</h4>
    <hr class="w-3/4 h-1 bg-amber-300">
</div>
<div class="flex">
    <div class="w-1/2 mr-5">

        <div class="mb-4 ">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="matricule">
                Matricule de la coopérative
            </label>
            <input wire:model="matricule" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="matricule" type="text" placeholder="Entrez votre Matricule">
        </div>

        <div class="mb-4 ">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="matricule">
                Denomination
            </label>
            <input wire:model="denomination" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="denomination" type="text" placeholder="Entrez votre Denomination">
        </div>

        <div class="mb-4 ">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="matricule">
                Sigle
            </label>
            <input wire:model="sigle" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="sigle" type="text" placeholder="Entrez votre Sigle ">
        </div>

        <div class="mb-4 ">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="matricule">
                Region
            </label>
            <select name="region_id" wire:model="region_id"  class="form-control">
               @foreach ($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->name }}</option>
               @endforeach
            </select>
        </div>

        <div class="mb-4 ">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="matricule">
                Departement du siège
            </label>
            <select name="departement_id" wire:model="departement_id"  class="form-control">
                @foreach ($departements as $departement)
                    <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                @endforeach
            </select>
        </div>

        

        <div class="mb-4 ">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="matricule">
                Village du siège
            </label>
            <input wire:model="village" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="ville" type="text" placeholder="Entrez le village du siège">
        </div>

       

        <div class="mb-4 ">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="matricule">
                Adresse postale
            </label>
            <input wire:model="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="matricule" type="text" placeholder="Entrez votre adresse postale">
        </div>

    </div>
    <div class="w-1/2">


        <div class="mb-4 ">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="matricule">
            Certification
            </label>
            <select wire:model="certification" name="" id="" class="form-control text-gray-700 text-sm font-bold mb-2">
                <option value="">Bio</option>
                <option value="">Ordinaire</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-1" for="matricule">
            Banques
            </label>
            <select id="bank" name="bank[]" wire:model="bank" multiple class="w-full">
                <option value="NSA">NSA</option>
                <option value="SGBCI">SGBCI</option>
                <option value="ECOBANK">ECOBANK</option>
                <option value="UBA">UBA</option>
                <option value="BNI">BNI</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm mb-2 font-bold" for="matricule">
            DFE
            </label>

            <input
                wire:model="dfe"
                class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.16rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-amber-950 focus:text-gray-700 focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white  file:dark:text-white"
                type="file"
                id="dfe" />
            
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm  mb-1 font-bold" for="matricule">
            Registre de commerce
            </label>

            <input
                wire:model="registre_commerce"
                class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.16rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-amber-950 focus:text-gray-700 focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white  file:dark:text-white"
                type="file"
                id="registre_commerce" />
            
        </div>
        <div class="mb-4 ">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="number_sections">
            Nombres de sections
            </label>
            <input wire:model="number_sections" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="matricule" type="text" placeholder="Entrez le nombre de vos sections">
        </div>
        <div class="mb-4 ">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="matricule">
                Nombre d'unités de transformations
            </label>
            <input wire:model="number_unite_transformations" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="number_unite_transformations" type="text" placeholder="Entrez le nombre d'unités de transformations que vous avez">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm mb-2 font-bold" for="file_producers">
            Fichier des producteurs
            </label>

            <input
                wire:model="file_producers"
                class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.16rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-amber-950 focus:text-gray-700 focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white  file:dark:text-white"
                type="file"
                id="file_producers" />
        </div>
        <div class="">
            
        </div>

    </div>
</div>

@push('javascript')
    <script>
        $(document).ready(function() {
            $('#bank').selectize();
            $('#departement').selectize({ maxItems: 3 });
            $('#bank-selectized').attr('style','width:1px;');
            $('#departement-selectized').attr('style','width:1px;');
        });
       
    </script>
@endpush



