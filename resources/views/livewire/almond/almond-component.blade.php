<div>
<label for="" class="text-4xl font-bold">Liste des achats d'amandes</label>
            <div class="flex flex-col sm:flex-row mt-2 w-full justify-between">
                <!-- Formulaire de recherche et bouton Vider -->
                <div class="mb-2 sm:mb-0 sm:flex-grow w-full sm:w-60 sm:order-1">
                    <input type="search" class="bg-amber-100 w-30 rounded-lg shadow px-4 py-2 mt-2" wire:model.live="search" placeholder="Saisir pour rechercher">
                    <button class="btn-amber-karite  mt-2" wire:click="resetSearch">Vider</button>
                </div>
                <!-- Boutons d'action -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center mt-2 sm:mt-0 sm:order-2">
                
                    <!-- Boutons d'import, export et créer un producteur -->
                    <div class="flex flex-col sm:flex-row mt-2 sm:mt-0 sm:ml-2 w-full sm:w-auto">
                    
                        <!-- <button class="btn-amber-karite flex items-center w-full sm:w-auto mt-2 sm:mt-0 sm:ml-2 " data-te-toggle="modal" data-te-target="#roleModal" data-te-ripple-init data-te-ripple-color="light" wire:click="create"> 

                            <img src="{{ asset('assets/img/icons/add.svg') }}" alt="" class="w-5 pr-2">
                            <label for="" class="cursor-pointer">Ajouter une almond</label>
                        </button> -->
                    </div>
                </div>
            </div>
        <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 
            <div class="flex flex-col">
                <div class="overflow-x-auto  sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full text-left text-sm font-light my-10">
                                <thead class="bg-amber-800 bt-table">
                                    <tr class="">
                                    <th scope="col" class="rounded-tl-lg px-6 py-4">#</th>
                                    <th scope="col" class="px-6 py-4">Cooprative</th>
                                    <th scope="col" class="px-6 py-4">Producteur</th>
                                    <th scope="col" class="px-6 py-4">Prix Unintaire (FCFA)</th>
                                    <th scope="col" class="px-6 py-4">Quantité (kg)</th>
                                    <th scope="col" class="px-6 py-4">Montant (FCFA) </th>
                                    <th scope="col" class="px-6 py-4">Mode de paiement </th>
                                   
                                    <th scope="col" class="rounded-tr-lg px-6 py-4">Action</th>
                                
                                    </tr>
                                </thead>
                                <tbody >
                                <?php $i=0;?>
                               
                                    @forelse($almonds as $almond)
                                        
                                    <?php $i++ ?>
                                    <tr class="border-b border-t-2 border-amber-900 {{ $i % 2 !== 0 ? '' : 'bg-amber-100' }} dark:border-amber-900">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium" wire:key="{{ $almond->id }}">{{ $i }}</td>

                                        <td class="whitespace-nowrap px-6 py-4">{{ optional($almond->agribusiness)->sigle }}</td>
                                        
                                        <td class="whitespace-nowrap px-6 py-4">{{ $almond->farmer->fullname}}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $almond->selling_price }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $almond->weight }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ number_format($almond->amount, 0, ',', ' ') }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <div class="flex items-center space-x-2">
                                                <svg fill="#000000" width="80px" height="30px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M20.629 5h-9.257a1.6 1.6 0 0 0-1.601 1.603V25.4a1.6 1.6 0 0 0 1.601 1.601h9.257c.883 0 1.6-.718 1.6-1.601V6.603c0-.885-.717-1.603-1.6-1.603zm-6.247 1.023h3.302v.768h-3.302v-.768zm1.619 19.395a1.024 1.024 0 0 1-1.023-1.021 1.023 1.023 0 0 1 2.044 0c-.001.494-.46 1.021-1.021 1.021zm5.028-3.501H10.971V7.704h10.058v14.213z"/>
                                                </svg>: 
                                                <span class=""> {{ number_format($almond->mobile_money, 0, ',', ' ') }}</span>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <svg fill="#000000" width="80px" height="30px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">

                                                    <title/>

                                                    <g data-name="Money Flow" id="Money_Flow">

                                                    <path d="M60,11H32a1,1,0,0,0-1,1v7H13a1,1,0,0,0-1,1V33.32H4a1,1,0,0,0-1,1V52a1,1,0,0,0,1,1H32a1,1,0,0,0,1-1V45H51a1,1,0,0,0,1-1V30.68h8a1,1,0,0,0,1-1V12A1,1,0,0,0,60,11ZM31,51H5V35.32h7V44a1,1,0,0,0,1,1H31ZM50,38.09A6,6,0,0,0,45.09,43H14V25.91A6,6,0,0,0,18.91,21H50Zm9-9.41H52V20a1,1,0,0,0-1-1H33V13H59Z"/>

                                                    <circle cx="32" cy="32" r="7"/>

                                                    <polygon points="38.63 17 43 17 43 15 38.63 15 38.63 13.91 35 16 38.63 18.09 38.63 17"/>

                                                    <polygon points="25.37 50.09 29 48 25.37 45.91 25.37 47 21 47 21 49 25.37 49 25.37 50.09"/>

                                                    </g>

                                                </svg>: 
                                                <span class="">{{ number_format($almond->cash, 0, ',', ' ') }}</span>    
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <button class="btn-amber-100" wire:click='show("{{$almond->id}}")' >
                                                <svg fill="#fff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                    width="15px" height="15px" viewBox="0 0 442.04 442.04"
                                                    xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <path d="M221.02,341.304c-49.708,0-103.206-19.44-154.71-56.22C27.808,257.59,4.044,230.351,3.051,229.203
                                                                c-4.068-4.697-4.068-11.669,0-16.367c0.993-1.146,24.756-28.387,63.259-55.881c51.505-36.777,105.003-56.219,154.71-56.219
                                                                c49.708,0,103.207,19.441,154.71,56.219c38.502,27.494,62.266,54.734,63.259,55.881c4.068,4.697,4.068,11.669,0,16.367
                                                                c-0.993,1.146-24.756,28.387-63.259,55.881C324.227,321.863,270.729,341.304,221.02,341.304z M29.638,221.021
                                                                c9.61,9.799,27.747,27.03,51.694,44.071c32.83,23.361,83.714,51.212,139.688,51.212s106.859-27.851,139.688-51.212
                                                                c23.944-17.038,42.082-34.271,51.694-44.071c-9.609-9.799-27.747-27.03-51.694-44.071
                                                                c-32.829-23.362-83.714-51.212-139.688-51.212s-106.858,27.85-139.688,51.212C57.388,193.988,39.25,211.219,29.638,221.021z"/>
                                                        </g>
                                                        <g>
                                                            <path d="M221.02,298.521c-42.734,0-77.5-34.767-77.5-77.5c0-42.733,34.766-77.5,77.5-77.5c18.794,0,36.924,6.814,51.048,19.188
                                                                c5.193,4.549,5.715,12.446,1.166,17.639c-4.549,5.193-12.447,5.714-17.639,1.166c-9.564-8.379-21.844-12.993-34.576-12.993
                                                                c-28.949,0-52.5,23.552-52.5,52.5s23.551,52.5,52.5,52.5c28.95,0,52.5-23.552,52.5-52.5c0-6.903,5.597-12.5,12.5-12.5
                                                                s12.5,5.597,12.5,12.5C298.521,263.754,263.754,298.521,221.02,298.521z"/>
                                                        </g>
                                                        <g>
                                                            <path d="M221.02,246.021c-13.785,0-25-11.215-25-25s11.215-25,25-25c13.786,0,25,11.215,25,25S234.806,246.021,221.02,246.021z"/>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </button>
                                        </td>
                                        
                                    </tr>
                                    @empty
                                    <tr class="border-b border-t-4 border-amber-900 dark:border-amber-900">
                                                <td colspan="6" class="whitespace-nowrap text-center px-6 py-4 text-2xl font-bold">
                                                    Aucune donnée enregistrée
                                                </td>
                                    </tr>
                                    @endforelse
                                   
                                </tbody>
                            </table>
                            <div class="livewire-pagination">{{ $almonds->links('custom-pagination-links') }}</div>
                            
                        </div>
                    </div>
                </div>
            </div>
</div>
