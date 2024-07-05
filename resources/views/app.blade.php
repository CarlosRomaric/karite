@extends('layouts.app')
@section('title') - Tableau de bord @endsection
@section('content')
       
        <div class="container py-5 px-20 mx-auto md:px-20  md:container md:mx-auto">

            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-3 h-3 text-green-900 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                            </svg>
                            Tableau de Bord
                        </a>
                    </li>
                    
                    
                </ol>
            </nav>
            <div class="pt-10">
                <label for="" class="text-4xl font-bold">Tableau de Bord</label>


                <div class="flex flex-col md:flex-row">
                    <!-- Partie gauche -->
                    <div class="w-full md:w-2/3 px-4 md:px-0">
                        <div class="bg-green-100 pl-4  grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-5 rounded-lg my-5 shadow-lg">
                            <!-- Cartes de statistiques -->
                            <div class="card-green">
                                <p class="font-semibold">Nombre de Producteurs</p>
                                <p class="stat">5386</p>
                            </div>
                            <div class="card-green">
                                <p class="font-semibold">Nombre de Coopératives</p>
                                <p class="stat">08</p>
                            </div>
                            <div class="card-green">
                                <p class="font-semibold">Nombre de Parcelles</p>
                                <p class="stat">08</p>
                            </div>
                            <!-- Zone de texte responsive -->
                            <div class="text-green-800 py-5 max-w-full col-span-1 md:col-span-2 md:text-base">
                                <p class="font-semibold text-base">Repartitions de Producteurs</p>
                                <p class="mt-5 text-green-800">
                                    <span class="font-semibold text-base">Hommes: </span><span class="stat-farmers">5237</span>
                                    <span class="font-semibold text-base">Femmes: </span><span class="stat-farmers">5237</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Partie droite -->
                    <div class="w-full md:w-1/3  px-4 mt-4 md:mt-0">
                        <div class="bg-green-100 rounded-lg my-5 py-7 px-10 text-green-800 flex flex-col md:flex-row items-center justify-between shadow-lg">
                            <div class="mb-4 md:mb-0">
                                <p>Utilisateurs créés</p>
                                <p class="stat">06</p>
                            </div>
                            <div class="md:ml-auto">
                                <img src="{{ asset('assets/img/icons/UserP-green.svg') }}" alt="userIcons" class="outline-gray-500">
                            </div>
                        </div>
                    </div>
                </div>
              
                
               <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 
                <div class="flex flex-col">
                    <div class="overflow-x-auto  sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full text-left text-sm font-light my-10">
                                <thead class="border-b bg-green-900 text-white font-medium dark:border-green-900">
                                    <tr class="">
                                        <th scope="col" class="rounded-tl-lg px-6 py-4">#</th>
                                        <th scope="col" class="px-6 py-4">Coopératives</th>
                                        <th scope="col" class="px-6 py-4">Total Producteurs</th>
                                        <th scope="col" class="px-6 py-4">Total Parcelles</th>
                                        <th scope="col" class=" px-6 py-4">Total Producteurs Hommes</th>
                                        <th scope="col" class="rounded-tr-lg px-6 py-4">Total Producteurs Femmes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b border-t-4 border-green-900 dark:border-green-900">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">1</td>
                                        <td class="whitespace-nowrap px-6 py-4">Mark</td>
                                        <td class="whitespace-nowrap px-6 py-4">Otto</td>
                                        <td class="whitespace-nowrap px-6 py-4">Otto</td>
                                        <td class="whitespace-nowrap px-6 py-4">@mdo</td>
                                        <td class="whitespace-nowrap px-6 py-4">@mdo</td>
                                    </tr>
                                    <tr class="border-b  bg-green-100 dark:border-green-900">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">2</td>
                                        <td class="whitespace-nowrap px-6 py-4">Jacob</td>
                                        <td class="whitespace-nowrap px-6 py-4">Thornton</td>
                                        <td class="whitespace-nowrap px-6 py-4">Thornton</td>
                                        <td class="whitespace-nowrap px-6 py-4">@fat</td>
                                        <td class="whitespace-nowrap px-6 py-4">@fat</td>
                                    </tr>
                                    <tr class="border-b border-t-2 border-green-900 dark:border-green-900">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">3</td>
                                    <td class="whitespace-nowrap px-6 py-4">Larry</td>
                                    <td class="whitespace-nowrap px-6 py-4">Wild</td>
                                    <td class="whitespace-nowrap px-6 py-4">@fat</td>
                                    <td class="whitespace-nowrap px-6 py-4">@fat</td>
                                    <td class="whitespace-nowrap px-6 py-4">@twitter</td>
                                    </tr>
                                    <tr class="border-b  bg-green-100 dark:border-green-900">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">2</td>
                                    <td class="whitespace-nowrap px-6 py-4">Jacob</td>
                                    <td class="whitespace-nowrap px-6 py-4">Thornton</td>
                                    <td class="whitespace-nowrap px-6 py-4">Thornton</td>
                                    <td class="whitespace-nowrap px-6 py-4">@fat</td>
                                    <td class="whitespace-nowrap px-6 py-4">@fat</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 
                                <nav aria-label="Page navigation example my-10">
                                    <ul class="list-style-none flex  float-end" name="menu">
                                        <li>
                                        <a
                                            class="pointer-events-none relative block rounded-full bg-green-900 px-3 py-1.5 text-sm text-white transition-all duration-300 dark:text-neutral-400"
                                            ><</a
                                        >
                                        </li>
                                        <li>
                                        <a
                                            class="relative block rounded-full bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300 hover:bg-green-900  hover:text-white dark:text-white dark:hover:bg-white dark:hover:text-white"
                                            href="#!"
                                            >1</a
                                        >
                                        </li>
                                        <li aria-current="page">
                                        <a
                                            class="relative block rounded-full bg-primary-100 px-3 py-1.5 text-sm font-medium text-primary-700 transition-all duration-300"
                                            href="#!"
                                            >2
                                            <span
                                            class="absolute -m-px h-px w-px overflow-hidden whitespace-nowrap border-0 p-0 [clip:rect(0,0,0,0)]"
                                            >(current)</span
                                            >
                                        </a>
                                        </li>
                                        <li>
                                        <a
                                            class="relative block rounded-full bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300 hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white"
                                            href="#!"
                                            >3</a
                                        >
                                        </li>
                                        <li>
                                        <a
                                            class="relative block rounded-full bg-transparent px-3 py-1.5 text-sm text-neutral-600 transition-all duration-300 hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white"
                                            href="#!"
                                            >></a
                                        >
                                        </li>
                                    </ul>
                                </nav>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
      

@endsection