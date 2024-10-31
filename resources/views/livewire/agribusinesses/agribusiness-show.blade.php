<div>
    {{--  
        <div class="bg-white  p-4 rounded shadow-xl overflow-hidden max-w-sm my-4">
            <div class="font-semibold text-xl text-amber-700 uppercase">Coopérative: </div>
            <b class="text-gray-700 ">{{ $agribusiness->denomination }}</b>
        </div>
        

        <div class="my-4">
            <label for="" class="text-2xl font-bold uppercase">Sections </label>
        </div>
    
        
        <div class="w-full flex justify-center">
            <div class="w-1/5">
                <ul class="nav nav-tabs flex flex-col" id="pills-tab" role="tablist">
                    @php
                        $tabs = [
                            'cooperative' => 'Information de la coopérative',
                            'direction' => 'Direction de la coopérative',
                            'parcs' => 'Parcs a karité de la coopérative',
                        ];
                    @endphp
                    @foreach ($tabs as $tabKey => $tabLabel)
                        <li class="nav-item" role="presentation">
                            <button 
                                class="nav-link w-full text-left py-2 px-3 my-2 rounded-md {{ $activeTab === $tabKey ? 'active-tabs bg-amber-700 text-white' : 'bg-zinc-100 text-gray-700' }}"
                                wire:click="setActiveTab('{{ $tabKey }}')" 
                                type="button" 
                                role="tab">
                                {{ $tabLabel }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="w-4/5 pl-4">
            
                @if (session()->has('error'))
                    <div class="relative flex flex-col sm:flex-row sm:items-center bg-gray-200 dark:bg-red-700 shadow rounded-md py-5 pl-6 pr-8 sm:pr-6 mb-3 mt-3">
                        <div class="flex flex-row items-center border-b sm:border-b-0 w-full sm:w-auto pb-4 sm:pb-0">
                            <div class="text-red-500" dark:text-gray-500>
                                <button wire:click="closeMessage">
                                    <svg class="w-6 sm:w-5 h-6 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="text-sm font-medium ml-3">Success!</div>
                        </div>
                        <div class="text-sm tracking-wide text-gray-500 dark:text-white mt-4 sm:mt-0 sm:ml-4">
                            {{ session('message') }}
                        </div>
                        <div class="absolute sm:relative sm:top-auto sm:right-auto ml-auto right-4 top-4 text-gray-400 hover:text-gray-800 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </div>
                @endif

                <div class="tab-content mx-10" id="pills-tabContent">
                
                    
                        <div class="tab-pane fade mb-3 {{ $activeTab === 'cooperative' ? 'show active-tabs' : '' }}" role="tabpanel">
                            @if($activeTab ==='cooperative')
                            <div class="flex  place-items-center mb-5">
                                <h4 class="text-2xl w-1/5 text-amber-950 uppercase font-bold">Coopérative</h4>
                                <hr class="w-4/5 h-1 bg-amber-400">
                            </div>
                            <div class="flex flex-col">

                                <div class="flex gray-400 mb-6">
                                    
                                    <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                            Dénomination :
                                        </label>
                                        <p class="text-amber-600 uppercase">{{ $agribusiness->denomination }}</p>                       
                                    </div>
                                
                                    <div class="w-full md:w-1/2 px-3">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                            Sigle de la coopérative :<span class="text-amber-600">{{ $agribusiness->sigle }}</span>
                                        </label>
                                        
                                    </div>
                                    
                                </div>

                                <div class="flex gray-400 mb-6">
                                    
                                    <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                            Addresse : <span class="text-amber-600">{{ $agribusiness->address }}</span>
                                        </label> 
                                        
                                    </div>
                                
                                    <div class="w-full md:w-1/2 px-3">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                            Region :<span class="text-amber-600">{{ $agribusiness->region->name }}</span>
                                        </label>
                                        
                                    </div>
                                    
                                </div>

                                <div class="flex gray-400 mb-6">
                                    
                                    <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                            Departement : <span class="text-amber-600">{{ $agribusiness->departement->name }}</span>
                                        </label>                  
                                    </div>
                                
                                    <div class="w-full md:w-1/2 px-3">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                            Siège :<span class="text-amber-600">{{ $agribusiness->headquaters }}</span>
                                        </label>
                                        
                                    </div>
                                    
                                </div>

                                <div class="flex gray-400 mb-6">
                                    
                                    <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                            Certification : <span class="text-amber-600">{{ $agribusiness->certification->name }}</span>
                                        </label>
                                        
                                    </div>
                                
                                    <div class="w-full md:w-1/2 px-3">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                            Banque :<span class="text-amber-600">{{ $agribusiness->bank }}</span>
                                        </label>
                                        
                                    </div>
                                    
                                </div>

                                <div class="flex gray-400 mb-6">
                                    
                                    <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                            Nombre de sections : <span class="text-amber-600">{{ $agribusiness->number_sections }}</span>
                                        </label>
                                        
                                    </div>
                                
                                    <div class="w-full md:w-1/2 px-3">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                            Unité de transformations :<span class="text-amber-600">{{ $agribusiness->number_unite_transformations }}</span>
                                        </label>
                                        
                                    </div>
                                    
                                </div>

                                <div class="flex gray-400 mb-6">
                                    
                                    <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                            Registre de commerce : <a href="{{ asset($registre_commerce) }}" target="_blank" class="text-amber-600">Voir</a>
                                        </label>  
                                    </div>   
                                    
                                    <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                        <label for="" class="block uppercase tracking-wide text-gray-700 text-xs font-blod mb-2">
                                            <h4 class="text-s font-bold mb-4 uppercase">Numéro du Registre de Commerce: <span class="text-amber-600">{{ $agribusiness->numRegistreCommerce }}</span></h4>
                                        </label>
                                    </div>
                                    
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="tab-pane fade mb-3 {{ $activeTab === 'direction' ? 'show active-tabs' : '' }}" role="tabpanel">
                            @if($activeTab ==='direction')
                            
                                            <div class="flex flex-col">
                                                    <div class="overflow-x-auto  sm:-mx-6 lg:-mx-8">
                                                        <div class="inline-block min-w-full  sm:px-6 lg:px-8">
                                                            <div class="overflow-hidden">
                                                            <div class="flex  place-items-center mb-5">
                                                <h4 class="text-2xl w-1/5 text-amber-950 uppercase font-bold">PCA</h4>
                                                <hr class="w-4/5 h-1 bg-amber-400">
                                            </div>

                                            <div class="flex gray-400 mb-6">
                                                
                                                <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                                    Nom & prénoms : <span class="text-amber-600">{{ $pca?->fullname ??''  }}</span>
                                                    </label>
                                                    
                                                </div>
                                            
                                                <div class="w-full md:w-1/2 px-3">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                                        Contact : <span class="text-amber-600">{{ $pca?->phone ??'' }}</span>
                                                    </label>
                                                    
                                                </div>
                                                
                                            </div>

                                            <div class="flex gray-400 mb-6">
                                                
                                                <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                                    Email : <span class="text-amber-600">{{ $pca?->email ??'' }}</span>
                                                    </label>

                                                    
                                                    
                                                    
                                                </div>
                                            
                                                <div class="w-full md:w-1/2 px-3">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                                        Photo : 
                                                        @if(!empty($photo_pca))
                                                            <a href="{{ asset($photo_pca) }}" target="_blank" class="text-amber-600">Voir</a>
                                                        @else
                                                            Aucune photo
                                                        @endif
                                                    </label>
                                                    
                                                </div>
                                                
                                            </div>
                                        @if(!empty($sup))

                                            <div class="flex  place-items-center mb-6">
                                                <h4 class="text-2xl w-1/5 text-amber-950 uppercase font-bold">Superviseur</h4>
                                                <hr class="w-4/5 h-1 bg-amber-400">
                                            </div>

                                            <div class="flex gray-400 mb-6">
                                                
                                                <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                                    Nom & prénoms : <span class="text-amber-600">{{ $sup?->fullname ?? '' }}</span>
                                                    </label>

                                                    
                                                </div>
                                            
                                                <div class="w-full md:w-1/2 px-3">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                                        Contact : <span class="text-amber-600">{{ $sup?->phone ?? '' }}</span>
                                                    </label>
                                                    
                                                </div>
                                                
                                            </div>

                                            <div class="flex gray-400 mb-6">
                                                
                                                <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                                    Email : <span class="text-amber-600">{{ $sup?->email ??'' }}</span>
                                                    </label>

                                                    
                                                    
                                                    
                                                </div>
                                                
                                                <div class="w-full md:w-1/2 px-3">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="photo_sup" >
                                                        Photo :
                                                        @if(!empty($photo_sup))
                                                        <a href="{{ asset($photo_sup) }}" class="text-amber-600" target="_blank">Voir</a>
                                                        @else 
                                                            Aucune photo 
                                                        @endif
                                                    </label>
                                                    
                                                </div>
                                                
                                               
                                                
                                            </div>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="tab-pane fade mb-3 {{ $activeTab === 'parcs' ? 'show active-tabs' : '' }}" role="tabpanel">
                            @if($activeTab ==='parcs')
                            
                            <div class="flex flex-col">
                                <div class="overflow-x-auto  sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full  sm:px-6 lg:px-8">
                                        <div class="overflow-hidden">
                                            <div class="flex  place-items-center mb-6">
                                                    <h4 class="text-2xl w-2/5 text-amber-950 uppercase font-bold">PARCS A KARITE</h4>
                                                    <hr class="w-3/5 h-1 bg-amber-400">
                                            </div>

                                            @foreach ($parcs as $parc)
                                            <div class="flex gray-400 mb-6">

                                                <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                                        Nom du parc : <span class="text-amber-600">{{ $parc?->name ??'' }}</span>
                                                    </label>
                                                </div>
                                                <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                                    Discription : <span class="text-amber-600">{{ $parc?->description ??'' }}</span>
                                                    </label>
                                                </div>

                                                
                                            
                                            </div>

                                            <div class="flex gray-400">
                                                <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                                    Photo : <img class="rounded w-54" src="{{ asset('images/'.$parc?->picture ??'') }}">
                                                    </label>
                                                </div>
                                                
                                            </div>
                                            @endforeach
                                        

                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                </div>

                <div class="w-full mt-3  mb-6 md:mb-0" wire:ignore>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                        Localisation des parcs à karité de la cooperative
                        </label>
                        <div id="map" style="height: 500px; width: 100%;" class="rounded shadow-xl"></div>
                </div>
                
            </div>
        </div>
    --}}
    <div class="my-4">
    <label class="text-2xl font-bold uppercase text-gray-800">Sections</label>
</div>

<div class="w-full flex justify-center">
    <!-- Navigation -->
    <div class="w-1/5">
        <ul class="flex flex-col" id="pills-tab" role="tablist">
            @php
                $tabs = [
                    'cooperative' => 'Information de la coopérative',
                    'direction' => 'Direction de la coopérative',
                    'parcs' => 'Parcs à karité de la coopérative',
                ];
            @endphp
            @foreach ($tabs as $tabKey => $tabLabel)
                <li role="presentation" class="mb-2">
                    <button 
                        class="w-full text-left py-2 px-3 rounded-lg shadow-md transition duration-300 {{ $activeTab === $tabKey ? 'bg-amber-700 text-white' : 'bg-zinc-100 hover:bg-amber-100 text-gray-700' }}"
                        wire:click="setActiveTab('{{ $tabKey }}')" 
                        type="button" 
                        role="tab">
                        {{ $tabLabel }}
                    </button>
                </li>
            @endforeach
            
        </ul>

        @if($statusCoop <> 1)
                <div class="w-full  mt-4">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                        Motif
                    </label>

                    <textarea
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border {{  (!empty(session('errorMotif'))) ? ' border-red-500' : '' }} border-gray-200 rounded
                        py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        name="motif" wire:model="motif"  id="motif" type="text" placeholder="Motif"></textarea>
                        @if(!empty(session('errorMotif')))
                                <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                                        <strong>{{ session('errorMotif') }}</strong>
                                </div>
                        @endif
                </div>
                <div class="w-full flex mt-4">
                    
                    <button class="bg-amber-400 rounded-lg mx-1 text-gray-100 py-2 px-3 font-semibold w-1/2" wire:click="valideCoop({{'$agribusiness->id'}})">Valider</button>
                    <button class="bg-red-500 rounded-lg mx-1 text-gray-100 py-2 px-3 font-semibold w-1/2" wire:click="rejetCoop({{'$agribusiness->id'}})">Rejeter</button>
                </div>
            @endif
    </div>

    <!-- Content Area -->
    <div class="w-4/5 pl-6">
        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="flex items-center bg-green-200 text-green-700 p-4 rounded-md shadow-md mb-4">
                <span class="text-lg mr-3">&#10003;</span>
                <div>{{ session('message') }}</div>
                <button wire:click="closeMessage" class="ml-auto text-lg">&times;</button>
            </div>
        @endif

        <div class="tab-content" id="pills-tabContent">
            <!-- Cooperative Tab -->
            <div class="tab-pane fade {{ $activeTab === 'cooperative' ? 'show active-tabs' : '' }}" role="tabpanel">
                @if($activeTab === 'cooperative')
                    <div class="mb-6">
                        <h4 class="text-2xl text-amber-950 font-bold">Coopérative</h4>
                        <hr class="border-amber-400 mb-4">
                    </div>

                    <!-- Cooperative Details -->
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="font-semibold text-gray-700">Dénomination :</label>
                            <span class="text-amber-600">{{ $agribusiness->denomination }}</span>
                        </div>
                        <div>
                            <label class="font-semibold text-gray-700">Sigle de la coopérative :</label>
                            <span class="text-amber-600">{{ $agribusiness->sigle }}</span>
                        </div>
                        <div>
                            <label class="font-semibold text-gray-700">Adresse :</label>
                            <span class="text-amber-600">{{ $agribusiness->address }}</span>
                        </div>
                        <div>
                            <label class="font-semibold text-gray-700">Région :</label>
                            <span class="text-amber-600">{{ $agribusiness->region->name }}</span>
                        </div>
                        <!-- Add more fields as needed... -->
                    </div>
                @endif
            </div>

            <!-- Direction Tab -->
            <div class="tab-pane fade {{ $activeTab === 'direction' ? 'show active-tabs' : '' }}" role="tabpanel">
                @if($activeTab === 'direction')
                    <div class="mb-6">
                        <h4 class="text-2xl text-amber-950 font-bold">Direction</h4>
                        <hr class="border-amber-400 mb-4">
                    </div>

                   
                        <div class = "text-uppercase font-semibold text-amber-800 block">PCA</div>
                            <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                    <div class="flex gray-400 mb-6">
                                    
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                        Nom & prénoms : <span class="text-amber-600">{{ $pca?->fullname ??''  }}</span>
                                        </label>
                                        
                                    </div>
                                
                                    <div class="w-full md:w-1/2">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                            Contact : <span class="text-amber-600">{{ $pca?->phone ??'' }}</span>
                                        </label>
                                        
                                    </div>
                                                    
                            </div>
                   
                            <div class="flex gray-400 mb-6">
                                                
                                    <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                        Email : <span class="text-amber-600">{{ $pca?->email ??'' }}</span>
                                        </label>
                                    </div>
                                    
                                    <div class="w-full md:w-1/2 px-3">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="photo_sup" >
                                            Photo :
                                            @if(!empty($photo_pca))
                                            <a href="{{ asset($photo_pca) }}" class="text-amber-600" target="_blank">Voir</a>
                                            @else 
                                                Aucune photo 
                                            @endif
                                        </label>
                                        
                                    </div>
                                    
                                   
                                                
                            </div>

                    @if(!empty($sup))

                        
                    <div class = "text-uppercase font-semibold text-amber-800 block">SuPerviseur</div>
                        <div class="flex gray-400 mb-6">

                            <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Nom & prénoms : <span class="text-amber-600">{{ $sup?->fullname ?? '' }}</span>
                                </label>


                            </div>

                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym" >
                                    Contact : <span class="text-amber-600">{{ $sup?->phone ?? '' }}</span>
                                </label>

                            </div>

                        </div>

                        <div class="flex gray-400 mb-6">

                            <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Email : <span class="text-amber-600">{{ $sup?->email ??'' }}</span>
                                </label>

                            </div>

                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="photo_sup" >
                                    Photo :
                                    @if(!empty($photo_sup))
                                    <a href="{{ asset($photo_sup) }}" class="text-amber-600" target="_blank">Voir</a>
                                    @else 
                                        Aucune photo 
                                    @endif
                                </label>

                            </div>

                           

                        </div>
                    @endif
                @endif
            </div>

            <!-- Parcs Tab -->
            <div class="tab-pane fade {{ $activeTab === 'parcs' ? 'show active-tabs' : '' }}" role="tabpanel">
                @if($activeTab === 'parcs')
                    <div class="mb-6">
                        <h4 class="text-2xl text-amber-950 font-bold">Parcs à Karité</h4>
                        <hr class="border-amber-400 mb-4">
                    </div>
                    @foreach ($parcs as $parc)
                        <div class="flex gray-400 mb-6">

                            <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                    Nom du parc : <span class="text-amber-600">{{ $parc?->name ??'' }}</span>
                                </label>
                            </div>
                            <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Discription : <span class="text-amber-600">{{ $parc?->description ??'' }}</span>
                                </label>
                            </div>

                            
                        
                        </div>

                        <div class="flex gray-400">
                            <div class="w-full md:w-1/2  mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Photo : <img class="rounded w-54" src="{{ asset('images/'.$parc?->picture ??'') }}">
                                </label>
                            </div>
                            
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Map -->
        <div class="mt-6" wire:ignore>
            <label class="block font-semibold text-gray-700">Localisation des parcs à karité</label>
            <div id="map" class="h-96 w-full rounded-lg shadow-lg"></div>
        </div>
    </div>
</div>

</div>

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        console.log('test');
        // Initialiser la carte avec un zoom par défaut et un point central
        var map = L.map('map').setView([7.539989, -5.547080], 7); // Par exemple, centré sur la Côte d'Ivoire

        // Ajouter un fond de carte OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Points des parcs (remplacez `@json($parcs)` par les données des parcs avec coordonnées GPS)
        const parcs = @json($parcs);

        // Ajouter un marqueur pour chaque parc
        parcs.forEach(parc => {
            if (parc.latitude && parc.longitude) {
                L.marker([parc.latitude, parc.longitude])
                .addTo(map)
                .bindPopup(`<strong>${parc.name}</strong><br>Coordonnées: ${parc.latitude}, ${parc.longitude}`);
            }
        });
    });
    </script>
@endpush