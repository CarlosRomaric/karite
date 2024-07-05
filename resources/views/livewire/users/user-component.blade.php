<div>
@include('livewire.users.usermodal')-
<label for="" class="text-4xl font-bold">Liste des utilisateurs</label>
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
                            <label for="" class="cursor-pointer">Ajouter un utilisateur</label>
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
                                    <th scope="col" class="px-6 py-4">Nom & prénoms</th>
                                    <th scope="col" class="px-6 py-4">Nom d'utilisateur</th>
                                    <th scope="col" class="px-6 py-4">Contact</th>
                                    <th scope="col" class="px-6 py-4">Poste</th>
                                    <th scope="col" class="px-6 py-4">Coopérative</th>
                                    <th scope="col" class="px-6 py-4">Rôles</th>
                                   
                                    <th scope="col" class="rounded-tr-lg px-6 py-4">Action</th>
                                
                                    </tr>
                                </thead>
                                <tbody >
                                <?php $i=0;?>
                               
                                    @forelse($users as $user)
                                        
                                    <?php $i++ ?>
                                    <tr class="border-b border-t-2 border-amber-900 {{ $i % 2 !== 0 ? '' : 'bg-amber-100' }} dark:border-amber-900">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium" wire:key="{{ $user->id }}">{{ $i }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $user->fullname }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $user->username }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $user->phone }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ ($user->job) ? $user->job : ' - ' }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            {{ ($user->agribusiness) ? $user->agribusiness->denomination : ' - ' }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                           @foreach ($user->roles as $role)
                                                <span class="inline-block bg-amber-500 text-white text-xs font-semibold px-4 py-2 mx-1 rounded-full">
                                                        {{ $role->name }}
                                                </span>
                                           @endforeach
                                        </td>
                                       
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <button class="btn-success" wire:click='edit("{{ $user->id }}")' >
                                                <svg width="15px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z" fill="#fff"/>
                                                </svg>
                                            </button>
                                            {{-- 
                                            <button class="btn-danger flex flex-row" wire:click='deleteForm("{{ $user->id }}")' >
                                                <svg width="15px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 2.75C11.0215 2.75 10.1871 3.37503 9.87787 4.24993C9.73983 4.64047 9.31134 4.84517 8.9208 4.70713C8.53026 4.56909 8.32557 4.1406 8.46361 3.75007C8.97804 2.29459 10.3661 1.25 12 1.25C13.634 1.25 15.022 2.29459 15.5365 3.75007C15.6745 4.1406 15.4698 4.56909 15.0793 4.70713C14.6887 4.84517 14.2602 4.64047 14.1222 4.24993C13.813 3.37503 12.9785 2.75 12 2.75Z" fill="#fff"/>
                                                    <path d="M2.75 6C2.75 5.58579 3.08579 5.25 3.5 5.25H20.5001C20.9143 5.25 21.2501 5.58579 21.2501 6C21.2501 6.41421 20.9143 6.75 20.5001 6.75H3.5C3.08579 6.75 2.75 6.41421 2.75 6Z" fill="#ffff"/>
                                                    <path d="M5.91508 8.45011C5.88753 8.03681 5.53015 7.72411 5.11686 7.75166C4.70356 7.77921 4.39085 8.13659 4.41841 8.54989L4.88186 15.5016C4.96735 16.7844 5.03641 17.8205 5.19838 18.6336C5.36678 19.4789 5.6532 20.185 6.2448 20.7384C6.83639 21.2919 7.55994 21.5307 8.41459 21.6425C9.23663 21.75 10.2751 21.75 11.5607 21.75H12.4395C13.7251 21.75 14.7635 21.75 15.5856 21.6425C16.4402 21.5307 17.1638 21.2919 17.7554 20.7384C18.347 20.185 18.6334 19.4789 18.8018 18.6336C18.9637 17.8205 19.0328 16.7844 19.1183 15.5016L19.5818 8.54989C19.6093 8.13659 19.2966 7.77921 18.8833 7.75166C18.47 7.72411 18.1126 8.03681 18.0851 8.45011L17.6251 15.3492C17.5353 16.6971 17.4712 17.6349 17.3307 18.3405C17.1943 19.025 17.004 19.3873 16.7306 19.6431C16.4572 19.8988 16.083 20.0647 15.391 20.1552C14.6776 20.2485 13.7376 20.25 12.3868 20.25H11.6134C10.2626 20.25 9.32255 20.2485 8.60915 20.1552C7.91715 20.0647 7.54299 19.8988 7.26957 19.6431C6.99616 19.3873 6.80583 19.025 6.66948 18.3405C6.52891 17.6349 6.46488 16.6971 6.37503 15.3492L5.91508 8.45011Z" fill="#fff"/>
                                                    <path d="M9.42546 10.2537C9.83762 10.2125 10.2051 10.5132 10.2464 10.9254L10.7464 15.9254C10.7876 16.3375 10.4869 16.7051 10.0747 16.7463C9.66256 16.7875 9.29502 16.4868 9.25381 16.0746L8.75381 11.0746C8.71259 10.6625 9.0133 10.2949 9.42546 10.2537Z" fill="#fff"/>
                                                    <path d="M15.2464 11.0746C15.2876 10.6625 14.9869 10.2949 14.5747 10.2537C14.1626 10.2125 13.795 10.5132 13.7538 10.9254L13.2538 15.9254C13.2126 16.3375 13.5133 16.7051 13.9255 16.7463C14.3376 16.7875 14.7051 16.4868 14.7464 16.0746L15.2464 11.0746Z" fill="#fff"/>
                                                </svg>
                                               
                                            </button>
                                            --}}
                                            <button wire:click='redirectToRole("{{ $user->id }}")'  class="btn-success mb-0 flex flex-row">
                                            <svg id="task-complete" xmlns="http://www.w3.org/2000/svg" width="15px" height="15px" viewBox="0 0 34.445 42.872">
                                                <path id="Tracé_22" data-name="Tracé 22" d="M17.617,6.17l.033.074a.652.652,0,0,0,.569.281H32.529A.643.643,0,0,0,33.1,6.23l.033-.074V4.736l-.007-.013V3.39L33.1,3.316a.651.651,0,0,0-.569-.275H29.085a1.42,1.42,0,0,1-1.025-.409.979.979,0,0,1-.295-.7,1.433,1.433,0,0,0-.08-.529A2.27,2.27,0,0,0,25.843.033,3.575,3.575,0,0,0,25.381,0a2.721,2.721,0,0,0-1.775.616,1.687,1.687,0,0,0-.63,1.266,1.08,1.08,0,0,1-.328.777,1.323,1.323,0,0,1-.965.382h-3.47a.616.616,0,0,0-.589.322l-.02.06v1.4l.007.013V6.17ZM18.2,16.553h3.229a.682.682,0,0,0,.683-.683V12.647a.686.686,0,0,0-.683-.683H18.2a.686.686,0,0,0-.683.683v3.222A.674.674,0,0,0,18.2,16.553Zm.683-3.222h1.856v1.849H18.883ZM17.51,22.293a.686.686,0,0,0,.683.683h3.229a.686.686,0,0,0,.683-.683V19.071a.686.686,0,0,0-.683-.683H18.193a.686.686,0,0,0-.683.683Zm1.373-2.539h1.856V21.6H18.883Zm3.229,8.97V25.5a.686.686,0,0,0-.683-.683H18.2a.686.686,0,0,0-.683.683v3.222a.686.686,0,0,0,.683.683h3.229A.686.686,0,0,0,22.112,28.724Zm-1.373-.69H18.883V26.185h1.856Zm11.8-14.463H23.921a.683.683,0,0,0,0,1.367h8.628a.683.683,0,1,0-.007-1.367Zm0,6.424H23.921a.683.683,0,0,0,0,1.367h8.628A.683.683,0,1,0,32.542,20Zm.69,7.114a.682.682,0,0,0-.683-.683H23.921a.683.683,0,0,0,0,1.367h8.628a.686.686,0,0,0,.683-.683Zm6.6,2.083a.17.17,0,0,1-.047-.013,7.1,7.1,0,0,0-2.4-.415c-.221,0-.435.007-.643.027a7.063,7.063,0,0,0-6.129,8.983c.013.047.027.087.04.127a7.078,7.078,0,0,0,1.42,2.539,6.98,6.98,0,0,0,5.305,2.432A7.059,7.059,0,0,0,39.83,29.193Zm1.708,4.6-5,5.017a.7.7,0,0,1-.489.2.656.656,0,0,1-.469-.181L33.245,36.7a.685.685,0,0,1,.924-1.012l1.849,1.695,4.548-4.562a.687.687,0,0,1,.971.971Z" transform="translate(-9.994 0)" fill="#f9f9f9"/>
                                                <path id="Tracé_23" data-name="Tracé 23" d="M25.777,40.749H10.3a.682.682,0,0,1-.683-.683V11.77a.682.682,0,0,1,.683-.683H33.031a.686.686,0,0,1,.683.683V29.408a8.19,8.19,0,0,1,1.956.241,7.546,7.546,0,0,1,1.373.469V9.339A3.229,3.229,0,0,0,33.822,6.11H30.452v2a1.56,1.56,0,0,1-1.634,1.46h-14.3a1.56,1.56,0,0,1-1.634-1.46v-2H9.512A3.229,3.229,0,0,0,6.29,9.339V40.414A3.222,3.222,0,0,0,9.512,43.63h18.06a8.494,8.494,0,0,1-1.8-2.88Z" transform="translate(-6.29 -2.017)" fill="#f9f9f9"/>
                                                <path id="Tracé_24" data-name="Tracé 24" d="M18.733,50.78a.683.683,0,1,0,0,1.367h.945a.683.683,0,1,0,0-1.367Zm3.316,1.373h.945a.683.683,0,1,0,0-1.367h-.945a.683.683,0,1,0,0,1.367Zm3.316-1.373a.683.683,0,1,0,0,1.367h.945a.683.683,0,1,0,0-1.367Z" transform="translate(-10.172 -16.764)" fill="#f9f9f9"/>
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
                            <div class="livewire-pagination">{{ $users->links('custom-pagination-links') }}</div>
                            
                        </div>
                    </div>
                </div>
            </div>
</div>
