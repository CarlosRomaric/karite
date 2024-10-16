<div>
        <label for="" class="text-4xl font-bold">Liste des Commandes</label>
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
                
                    {{--<button class="btn-amber-karite flex items-center w-full sm:w-auto mt-2 sm:mt-0 sm:ml-2 " data-te-toggle="modal" data-te-target="#offerModal" data-te-ripple-init data-te-ripple-color="light" wire:click="create"> 

                        <img src="{{ asset('assets/img/icons/add.svg') }}" alt="" class="w-5 pr-2">
                        <label for="" class="cursor-pointer">Créer une offer</label>
                    </button> --}}
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
                                    <th scope="col" class="px-6 py-4">Code</th>
                                    <th scope="col" class="px-6 py-4">Nom & Prénoms</th>
                                    <th scope="col" class="px-6 py-4">Contact</th>
                                    <th scope="col" class="px-6 py-4">Email</th>
                                    <th scope="col" class="px-6 py-4">Quantité</th>
                                    <th scope="col" class="px-6 py-4">Conditionnement</th>
                                    <th scope="col" class="px-6 py-4">Status</th>
                                    <th scope="col" class="rounded-tr-lg px-6 py-4">Action</th>
                                </tr>
                            </thead>
                            <tbody >
                            <?php $i=0;?>
                            
                                @forelse($orders as $order)
                                    
                                <?php $i++ ?>
                                <tr class="border-b border-t-2 border-amber-800 {{ $i % 2 !== 0 ? '' : 'bg-amber-100' }} dark:border-amber-900">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium" wire:key="{{ $order->id }}">{{ $i }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $order->offer->code }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $order->lastname.' '.$order->firstname }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $order->phone }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $order->email }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $order->quantity }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $order->type_package->name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $order->state }}</td>
                                    
                                    <td class="whitespace-nowrap px-6 py-4">
                                   
                                          
                                    </td>
                                    
                                    
                                </tr>
                                @empty
                                <tr class="border-b border-t-4 border-amber-900 dark:border-amber-900">
                                            <td colspan="8" class="whitespace-nowrap text-center px-6 py-4 text-2xl font-bold">
                                                Aucune donnée enregistrée
                                            </td>
                                </tr>
                                @endforelse
                                
                            </tbody>
                        </table>
                        <div class="livewire-pagination bg-green-100">{{ $orders->links('custom-pagination-links') }}</div>
                        
                    </div>
                </div>
            </div>
        </div>
</div>