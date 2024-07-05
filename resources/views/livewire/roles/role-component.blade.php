<div>
    @include('livewire.roles.rolemodal')
    <label for="" class="text-4xl font-bold">Liste des Roles</label>
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
                    
                        <button class="btn-amber-karite flex items-center w-full sm:w-auto mt-2 sm:mt-0 sm:ml-2 " data-te-toggle="modal" data-te-target="#roleModal" data-te-ripple-init data-te-ripple-color="light" wire:click="create"> 

                            <img src="{{ asset('assets/img/icons/add.svg') }}" alt="" class="w-5 pr-2">
                            <label for="" class="cursor-pointer">Ajouter un role</label>
                        </button>
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
                                    <th scope="col" class="px-6 py-4">Nom du role</th>
                                   
                                    <th scope="col" class="rounded-tr-lg px-6 py-4">Action</th>
                                
                                    </tr>
                                </thead>
                                <tbody >
                                <?php $i=0;?>
                               
                                    @forelse($roles as $role)
                                        
                                    <?php $i++ ?>
                                    <tr class="border-b border-t-2 border-amber-900 {{ $i % 2 !== 0 ? '' : 'bg-amber-100' }} dark:border-amber-900">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium" wire:key="{{ $role->id }}">{{ $i }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $role->name }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <button class="btn-success" wire:click='edit("{{$role->id}}")' >
                                                <svg width="15px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z" fill="#fff"/>
                                                </svg>
                                            </button>
                                            <button class="btn-danger flex flex-row" wire:click='deleteForm("{{$role->id}}")' >
                                                <svg width="15px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 2.75C11.0215 2.75 10.1871 3.37503 9.87787 4.24993C9.73983 4.64047 9.31134 4.84517 8.9208 4.70713C8.53026 4.56909 8.32557 4.1406 8.46361 3.75007C8.97804 2.29459 10.3661 1.25 12 1.25C13.634 1.25 15.022 2.29459 15.5365 3.75007C15.6745 4.1406 15.4698 4.56909 15.0793 4.70713C14.6887 4.84517 14.2602 4.64047 14.1222 4.24993C13.813 3.37503 12.9785 2.75 12 2.75Z" fill="#fff"/>
                                                    <path d="M2.75 6C2.75 5.58579 3.08579 5.25 3.5 5.25H20.5001C20.9143 5.25 21.2501 5.58579 21.2501 6C21.2501 6.41421 20.9143 6.75 20.5001 6.75H3.5C3.08579 6.75 2.75 6.41421 2.75 6Z" fill="#ffff"/>
                                                    <path d="M5.91508 8.45011C5.88753 8.03681 5.53015 7.72411 5.11686 7.75166C4.70356 7.77921 4.39085 8.13659 4.41841 8.54989L4.88186 15.5016C4.96735 16.7844 5.03641 17.8205 5.19838 18.6336C5.36678 19.4789 5.6532 20.185 6.2448 20.7384C6.83639 21.2919 7.55994 21.5307 8.41459 21.6425C9.23663 21.75 10.2751 21.75 11.5607 21.75H12.4395C13.7251 21.75 14.7635 21.75 15.5856 21.6425C16.4402 21.5307 17.1638 21.2919 17.7554 20.7384C18.347 20.185 18.6334 19.4789 18.8018 18.6336C18.9637 17.8205 19.0328 16.7844 19.1183 15.5016L19.5818 8.54989C19.6093 8.13659 19.2966 7.77921 18.8833 7.75166C18.47 7.72411 18.1126 8.03681 18.0851 8.45011L17.6251 15.3492C17.5353 16.6971 17.4712 17.6349 17.3307 18.3405C17.1943 19.025 17.004 19.3873 16.7306 19.6431C16.4572 19.8988 16.083 20.0647 15.391 20.1552C14.6776 20.2485 13.7376 20.25 12.3868 20.25H11.6134C10.2626 20.25 9.32255 20.2485 8.60915 20.1552C7.91715 20.0647 7.54299 19.8988 7.26957 19.6431C6.99616 19.3873 6.80583 19.025 6.66948 18.3405C6.52891 17.6349 6.46488 16.6971 6.37503 15.3492L5.91508 8.45011Z" fill="#fff"/>
                                                    <path d="M9.42546 10.2537C9.83762 10.2125 10.2051 10.5132 10.2464 10.9254L10.7464 15.9254C10.7876 16.3375 10.4869 16.7051 10.0747 16.7463C9.66256 16.7875 9.29502 16.4868 9.25381 16.0746L8.75381 11.0746C8.71259 10.6625 9.0133 10.2949 9.42546 10.2537Z" fill="#fff"/>
                                                    <path d="M15.2464 11.0746C15.2876 10.6625 14.9869 10.2949 14.5747 10.2537C14.1626 10.2125 13.795 10.5132 13.7538 10.9254L13.2538 15.9254C13.2126 16.3375 13.5133 16.7051 13.9255 16.7463C14.3376 16.7875 14.7051 16.4868 14.7464 16.0746L15.2464 11.0746Z" fill="#fff"/>
                                                </svg>
                                               
                                            </button>
                                            <button wire:click='redirectToPermission("{{ $role->id }}")' class="btn-success mb-0 flex flex-row">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="15px" viewBox="0 0 39.74 44.872">
                                                    <g id="Groupe_3206" data-name="Groupe 3206" transform="translate(1 1)">
                                                        <path id="Tracé_15" data-name="Tracé 15" d="M48.887,28A3.861,3.861,0,0,0,46.8,24.578a4.775,4.775,0,0,1-2.214-2.394.992.992,0,0,0-.142-.348,4.788,4.788,0,0,1-.129-3.308A3.861,3.861,0,0,0,39.479,13.7a4.8,4.8,0,0,1-3.308-.142l-.348-.142a4.6,4.6,0,0,1-2.381-2.214,3.861,3.861,0,0,0-6.86,0A4.6,4.6,0,0,1,24.2,13.419l-.348.142a4.8,4.8,0,0,1-3.308.142,3.861,3.861,0,0,0-4.826,4.826,4.788,4.788,0,0,1-.142,3.308l-.142.348a4.723,4.723,0,0,1-2.214,2.394,3.861,3.861,0,0,0,0,6.847,4.646,4.646,0,0,1,2.2,2.381,1.051,1.051,0,0,0,.142.36,4.762,4.762,0,0,1,.142,3.295A3.861,3.861,0,0,0,20.572,42.3a4.8,4.8,0,0,1,3.308.129l.347.154a4.62,4.62,0,0,1,2.381,2.2,3.861,3.861,0,0,0,6.86,0,4.62,4.62,0,0,1,2.381-2.2l.347-.154A4.8,4.8,0,0,1,39.5,42.3a3.861,3.861,0,0,0,4.839-4.839,4.762,4.762,0,0,1,.129-3.295c0-.116.1-.245.142-.36a4.7,4.7,0,0,1,2.214-2.381A3.861,3.861,0,0,0,48.887,28Z" transform="translate(-11.147 -9.118)" fill="none" stroke="#f9f9f9" stroke-width="2"/>
                                                        <path id="Tracé_16" data-name="Tracé 16" d="M20.52,24.865,25,29.331,34.06,20.27" transform="translate(-8.457 -5.916)" fill="none" stroke="#f9f9f9" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                                        <path id="Tracé_17" data-name="Tracé 17" d="M17.028,34.72l-3.694,6.924a.553.553,0,0,0,.592.8l5.238-1.081a.528.528,0,0,1,.579.257l1.647,2.729a.566.566,0,0,0,.978,0l3.514-6.989M41.25,34.913l3.591,6.744a.553.553,0,0,1-.592.8L39.01,41.374a.528.528,0,0,0-.579.257L36.784,44.36a.566.566,0,0,1-.978,0l-3.256-6.435" transform="translate(-10.537 -1.769)" fill="none" stroke="#f9f9f9" stroke-width="2"/>
                                                        <path id="Tracé_27" data-name="Tracé 27" d="M740.349,203.994l-2.621,5v.908h4.554l1.85.607,1.4,1.2,2.06-2.711.686-3.443v-1.556l-2.746-.837h-4.465Z" transform="translate(-733.802 -169.926)" fill="#f9f9f9"/>
                                                        <path id="Tracé_28" data-name="Tracé 28" d="M746.806,204.564l1.04,1.8.659,2.629v.908l-2.621-.908h-1.936l-1.847,1.515-1.4,1.2-2.06-2.711-1.728-2.629,1.042-2.37,2.746-.837h4.465Z" transform="translate(-714.728 -169.676)" fill="#f9f9f9"/>
                                                    </g>
                                                </svg>
                                            </button>
                                        </td>
                                        
                                    </tr>
                                    @empty
                                    <tr class="border-b border-t-4 border-green-900 dark:border-green-900">
                                                <td colspan="6" class="whitespace-nowrap text-center px-6 py-4 text-2xl font-bold">
                                                    Aucune donnée enregistrée
                                                </td>
                                    </tr>
                                    @endforelse
                                   
                                </tbody>
                            </table>
                            <div class="livewire-pagination">{{ $roles->links('custom-pagination-links') }}</div>
                            
                        </div>
                    </div>
                </div>
            </div>
</div>
