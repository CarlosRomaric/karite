<div>
                            <table class="w-full">  
                                <tbody>   
                                        <tr>
                                            <td>
                                                <div class="flex flex-col gray-400 mb-6">
                                                
                                                    <h1 class="pb-6 text-gray-700 text-md font-bold">Parcelle</h1>
                                                    <div class="flex">
                                                        <div class="w-full px-3 mb-6 md:mb-0">
                                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                                                Superficie totale de <br> l'exploitation (ha)
                                                            </label>
                                                            <input
                                                                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded
                                                py-3 px-4 leading-tight focus:outline-none focus:bg-white {{ $errors->has('state.plotForms.{$i}.total_area') ? ' border-red-500' : '' }}"
                                                                type="number" step="any"
                                                
                                                                
                                                                name="total_area[]" type="text" wire:model="total_area" placeholder="Superficie totale de l'exploitation (ha)">
                                                                @if($errors->has("total_area"))
                                                                    <p class="text-red-500 text-xs"> {{ $errors->first("total_area") }}  </p>
                                                                @endif
                                                        </div>
                                                        <div class="w-full px-3 mb-6 md:mb-0">
                                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                                                Joindre le fichier du <br>tracé GPS (Kmz)
                                                            </label>
                                                            <input
                                                                class="appearance-none block w-full bg-gray-200 text-gray-700 border {{ $errors->has('state.plotForms.{$i}.gps_track') ? ' border-red-500' : '' }} rounded
                                                py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                                                name="gps_track" type="file" wire:model="gps_track">
                                                                @if($errors->has("gps_track"))
                                                                    <p class="text-red-500 text-xs"> {{ $errors->first("gps_track") }}  </p> 
                                                                @endif
                                                        </div>
                                                    </div>
                                                    <div class="flex mt-2">
                                                        <table class="w-full">
                                                            <tr>
                                                                <td class="px-3">
                                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                                                        Code GPS
                                                                    </label>
                                                                </td>
                                                                <td class="px-3">
                                                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                                                        Coordonnées (Latitude - Longitude)
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="px-3" valign="top">
                                                                    <div class="flex flex-col">
                                                                        <input
                                                                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded
                                                                            py-3 px-4 leading-tight focus:outline-none focus:bg-white mr-4 {{ $errors->has('state.plotForms.{$i}.gps_code')  ? ' border-red-500' : ''}} "
                                                                            name="gps_code[]" wire:model="gps_code" type="text"  placeholder="Code GPS">
                                                                            @if($errors->has("gps_code"))
                                                                                <p class="text-red-500 text-xs"> {{ $errors->first("gps_code") }}  </p> 
                                                                            @endif
                                                                        
                                                                    </div>
                                                                </td>
                                                                <td class="px-3" valign="top">
                                                                    <div class="flex flex-row w-full">
                                                                        <div class="w-1/2 flex flex-col">
                                                                            <input
                                                                                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded
                                                    py-3 px-4 leading-tight focus:outline-none focus:bg-white mr-4 {{ $errors->has('state.plotForms.$i}.latitude')  ? ' border-red-500' : ''}}"
                                                                                name="latitude[]" type="text" wire:model="latitude"  placeholder="Latitude">
                                                                                @if($errors->has("latitude"))
                                                                                        <p class="text-red-500 text-xs"> {{ $errors->first("plotForms.$i.latitude") }}  </p> 
                                                                                @endif

                                                                        </div>
                                                                        <div class="w-1/2 flex flex-col mx-3">
                                                                            <input
                                                                                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded
                                                    py-3 px-4 leading-tight focus:outline-none focus:bg-white {{ $errors->has('state.plotForms.{$i}.longitude')  ? ' border-red-500' : ''}}"
                                                                    
                                                                                name="longitude[]" wire:model="longitude" type="text"   placeholder="Longitude">
                                                                                @if($errors->has("longitude"))
                                                                                        <p class="text-red-500 text-xs"> {{ $errors->first("longitude") }}  </p> 
                                                                                @endif
                                                                        </div>
                                                                       
                                                                        

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                    

                                </tbody>
                                <tfoot>
                                    <th colspan="2" class="flex justify-start">
                                        <button wire:click.prevent="addPlotFormCount"
                                            class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border
                                            border-gray-400 outline-none focus:shadow-outline rounded shadow mx-1 cursor-pointer">
                                            Modifier une parcelle
                                        </button>
                                    </th>
                                </tfoot>
                            </table>

                            <table class="w-full text-left text-sm b  font-light my-10">
                                <thead>
                                    <tr class="border-b bg-green-custom text-white font-medium dark:border-green-custom">
                                        <th scope="col" class="rounded-tl-lg px-6 py-4">#</th>
                                        <th scope="col" class="px-6 py-4">SUPERFICIE TOTALE DE L'EXPLOITATION (HA)</th>
                                        <th scope="col" class="px-6 py-4">FICHIER DU TRACÉ GPS (KMZ)</th>
                                        <th scope="col" class="px-6 py-4">CODE GPS</th>
                                        <th scope="col" class="px-6 py-4">LATITUDE</th>
                                        <th scope="col" class="px-6 py-4">LONGITIDUE</th>
                                        <th scope="col" class="rounded-tr-lg px-6 py-4">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i=0;?>
                                    @forelse ($plots as $plot)
                                    <?php $i++;?>
                                        <tr class="border-b border-t-4 border-green-900 dark:border-green-900">
                                            <td class="whitespace-nowrap px-6 py-4">{{ $i }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $plot->total_area }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $plot->total_area }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $plot->gps_code }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $plot->latitude }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $plot->longitude }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">

                                                <button class="btn-success" wire:click='editPlot({{ $plot->id }})'>
                                                    <svg width="15px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.1213 2.70705C19.9497 1.53548 18.0503 1.53547 16.8787 2.70705L15.1989 4.38685L7.29289 12.2928C7.16473 12.421 7.07382 12.5816 7.02986 12.7574L6.02986 16.7574C5.94466 17.0982 6.04451 17.4587 6.29289 17.707C6.54127 17.9554 6.90176 18.0553 7.24254 17.9701L11.2425 16.9701C11.4184 16.9261 11.5789 16.8352 11.7071 16.707L19.5556 8.85857L21.2929 7.12126C22.4645 5.94969 22.4645 4.05019 21.2929 2.87862L21.1213 2.70705ZM18.2929 4.12126C18.6834 3.73074 19.3166 3.73074 19.7071 4.12126L19.8787 4.29283C20.2692 4.68336 20.2692 5.31653 19.8787 5.70705L18.8622 6.72357L17.3068 5.10738L18.2929 4.12126ZM15.8923 6.52185L17.4477 8.13804L10.4888 15.097L8.37437 15.6256L8.90296 13.5112L15.8923 6.52185ZM4 7.99994C4 7.44766 4.44772 6.99994 5 6.99994H10C10.5523 6.99994 11 6.55223 11 5.99994C11 5.44766 10.5523 4.99994 10 4.99994H5C3.34315 4.99994 2 6.34309 2 7.99994V18.9999C2 20.6568 3.34315 21.9999 5 21.9999H16C17.6569 21.9999 19 20.6568 19 18.9999V13.9999C19 13.4477 18.5523 12.9999 18 12.9999C17.4477 12.9999 17 13.4477 17 13.9999V18.9999C17 19.5522 16.5523 19.9999 16 19.9999H5C4.44772 19.9999 4 19.5522 4 18.9999V7.99994Z" fill="#fff"/>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="whitespace-nowrap px-6 py-4" colspan="6"> Aucune parcelle enregistrée</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
</div>
