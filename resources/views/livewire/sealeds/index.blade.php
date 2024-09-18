<div>

<label for="" class="text-4xl font-bold my-2">Lots distribués</label>
    
    <div class="flex flex-col sm:flex-row mt-2 w-full justify-between">
        <!-- Formulaire de recherche et bouton Vider -->
        <div class="mb-2 sm:mb-0 sm:flex-grow w-full sm:w-60 sm:order-1">
            <input type="text" class="bg-amber-100 w-30 rounded-lg shadow px-4 py-2 mt-2" wire:model.live="search" placeholder="Saisir pour rechercher">
            <button class="btn-amber-karite  mt-2" wire:click="resetSearch">Vider</button>
        </div>
        <!-- Boutons d'action -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center mt-2 sm:mt-0 sm:order-2">
            <!-- Nombre d'enregistrements -->
            <div class="py-1 px-4 text-center sm:text-right">
                <label for="">Nombre de lot distribué : {{ $lots->count() }} </label>
            </div>
        </div>
    </div>
         <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 
            <div class="flex flex-col">
                <div class="overflow-x-auto  sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full text-left text-sm font-light my-10">
                            <thead class="border-b bg-amber-800 bt-table text-white font-medium dark:border-amber-800">
                                <tr class="">
                                <th scope="col" class="rounded-tl-lg px-6 py-4">#</th>
                                <th scope="col" class="px-6 py-4">Code</th>
                                <th scope="col" class="px-6 py-4">Type</th>
                                <th scope="col" class="px-6 py-4">Cooperative</th>
                                <th scope="col" class="px-6 py-4">Scéllés utilisés</th>
                                <th scope="col" class="px-6 py-4">Scéllés non utilisés</th>
                                <th scope="col" class="px-6 py-4">Region</th>
                                <th scope="col" class="rounded-tr-lg px-6 py-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=0;?>
                          
                                @forelse ($lots as $lot)
                                <?php $i++;?>
                                <tr class="border-b border-t-4 border-amber-900 dark:border-amber-900">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{$i }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $lot->code }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $lot->batch->type }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $lot->agribusiness->matricule }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $lot->sealeds->where('state','USED')->count() }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $lot->sealeds->where('state','NOT USED')->count() }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $lot->batch->region->name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <button class="btn-amber-karite  mt-2" style="display: flex" onclick="window.location.href='{{route('sealeds.print',[$lot->id])}}'" >
                                           Imprimer &nbsp;
                                           <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                                                <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                                            
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                                            
                                                <g id="SVGRepo_iconCarrier"> <path d="M6 17.9827C4.44655 17.9359 3.51998 17.7626 2.87868 17.1213C2 16.2426 2 14.8284 2 12C2 9.17157 2 7.75736 2.87868 6.87868C3.75736 6 5.17157 6 8 6H16C18.8284 6 20.2426 6 21.1213 6.87868C22 7.75736 22 9.17157 22 12C22 14.8284 22 16.2426 21.1213 17.1213C20.48 17.7626 19.5535 17.9359 18 17.9827" stroke="#ffffff" stroke-width="1.5"/> <path d="M9 10H6" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"/> <path d="M19 14L5 14" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"/> <path d="M17.1213 2.87868L16.591 3.40901V3.40901L17.1213 2.87868ZM6.87868 2.87868L7.40901 3.40901V3.40901L6.87868 2.87868ZM6.87868 21.1213L7.40901 20.591H7.40901L6.87868 21.1213ZM18.75 14C18.75 13.5858 18.4142 13.25 18 13.25C17.5858 13.25 17.25 13.5858 17.25 14H18.75ZM6.75 14C6.75 13.5858 6.41421 13.25 6 13.25C5.58579 13.25 5.25 13.5858 5.25 14H6.75ZM17.25 16C17.25 17.4354 17.2484 18.4365 17.1469 19.1919C17.0482 19.9257 16.8678 20.3142 16.591 20.591L17.6517 21.6517C18.2536 21.0497 18.5125 20.2919 18.6335 19.3918C18.7516 18.5132 18.75 17.393 18.75 16H17.25ZM12 22.75C13.393 22.75 14.5132 22.7516 15.3918 22.6335C16.2919 22.5125 17.0497 22.2536 17.6517 21.6517L16.591 20.591C16.3142 20.8678 15.9257 21.0482 15.1919 21.1469C14.4365 21.2484 13.4354 21.25 12 21.25V22.75ZM12 2.75C13.4354 2.75 14.4365 2.75159 15.1919 2.85315C15.9257 2.9518 16.3142 3.13225 16.591 3.40901L17.6517 2.34835C17.0497 1.74643 16.2919 1.48754 15.3918 1.36652C14.5132 1.24841 13.393 1.25 12 1.25V2.75ZM12 1.25C10.607 1.25 9.48678 1.24841 8.60825 1.36652C7.70814 1.48754 6.95027 1.74643 6.34835 2.34835L7.40901 3.40901C7.68577 3.13225 8.07434 2.9518 8.80812 2.85315C9.56347 2.75159 10.5646 2.75 12 2.75V1.25ZM5.25 16C5.25 17.393 5.24841 18.5132 5.36652 19.3918C5.48754 20.2919 5.74643 21.0497 6.34835 21.6517L7.40901 20.591C7.13225 20.3142 6.9518 19.9257 6.85315 19.1919C6.75159 18.4365 6.75 17.4354 6.75 16H5.25ZM12 21.25C10.5646 21.25 9.56347 21.2484 8.80812 21.1469C8.07435 21.0482 7.68577 20.8678 7.40901 20.591L6.34835 21.6517C6.95027 22.2536 7.70814 22.5125 8.60825 22.6335C9.48678 22.7516 10.607 22.75 12 22.75V21.25ZM18.7323 5.97741C18.6859 4.43521 18.5237 3.22037 17.6517 2.34835L16.591 3.40901C17.0016 3.8196 17.1859 4.4579 17.233 6.02259L18.7323 5.97741ZM6.76698 6.02259C6.81413 4.4579 6.99842 3.8196 7.40901 3.40901L6.34835 2.34835C5.47633 3.22037 5.31413 4.43521 5.26766 5.97741L6.76698 6.02259ZM18.75 16V14H17.25V16H18.75ZM6.75 16V14H5.25V16H6.75Z" fill="#ffffff"/> <circle cx="17" cy="10" r="1" fill="#ffffff"/> <path d="M15 16.5H9" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"/> <path d="M13 19H9" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"/> </g>
                                            
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr class="border-b border-t-4 border-amber-900 dark:border-amber-900">
                                    <td colspan="9" class="whitespace-nowrap text-center px-6 py-4 text-2xl font-bold">
                                        Aucune donnée enregistrée
                                    </td>
                                </tr>
                                @endforelse
                              
                            </tbody>
                        </table>
                        <div class="livewire-pagination">{{ $lots->links('custom-pagination-links') }}</div>
                    </div>
                    </div>
                </div>
            </div>


</div>
