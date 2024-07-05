<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script> 
    <title>Navbar responsive tailwind css</title>
    @vite(['resources/scss/style.scss','resources/js/app.js'])
</head>
    <body class="">
        <nav class="py-5 bg-green-50 grid  grid-cols-6 gap-6 justify-items-center">
            <div class="col-start-1 col-end-3">
                <img src="{{ asset('assets/img/logo-trace-agri.png') }}" alt="Logo" class="h-10 mx-4 inline">
            </div>
            <div class="col-end-7 grid justify-items-stretch col-span-2">
                <div class="col-start-1 pt-1 pr-2">
                        <span class="text-sm float-right md:float-right sm:float-right">
                            <b>Koffi Konan</b>
                        </span><br>
                        <span class="text-xs float-right  md:float-right sm:float-right">
                          Administrateur
                        </span>
                </div>
                <div class="col-end-7" id="dropdownDefaultButton" data-dropdown-toggle="dropdown">
                    <img src="https://picsum.photos/200" class="rounded-full mr-5" width="50">
                </div>
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mon profile</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Paramètres</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Deconnexion</a>
                    </li>
                    </ul>
                </div>
                
            </div>
        </nav>

        <nav class="menu">
            <span class="text-3xl cursor-pointer md:hidden block mx-2  text-gray-100">
                <ion-icon name="menu" class="text-gray-100" onclick="Menu(this)"></ion-icon> Menu
            </span>
            <ul class="menu-content">
                <li class="my-6 md:my-0 hover:h-full  hover:opacity-50 ">
                    <a href="#" class="menu-item ">
                        <img  src="assets/img/icons/dashboard.svg" alt="dashboardIcons" class="opacity-">
                        <label for="" class="cursor-pointer ">Tableau de Bord</label>
                    </a>
                </li>
                <li class="my-6 md:my-0 hover:h-full hover:opacity-50">
                    <a href="#" class="menu-item">
                        <img  src="assets/img/icons/Groupe 3205.svg" alt="cooperativeIcons" >
                        <label for="" class="cursor-pointer">Coopérative</label>
                    </a>
                </li>
                <li class="my-6 md:my-0 hover:h-full hover:opacity-50">
                    <a href="#" class="menu-item">
                        <img src="assets/img/icons/farmer.svg" alt="producteurIcons" >
                        <label for="" class="cursor-pointer">Producteurs</label>
                    </a>
                </li>
                <li class="my-6 md:my-0 hover:h-full hover:opacity-50">
                    <a href="#" class="menu-item">
                        <img  src="assets/img/icons/Groupe 3206.svg" alt="permissionIcons" >
                        <label for="" class="cursor-pointer">Permissions</label>
                    </a>
                </li>
                <li class="my-6 md:my-0 hover:h-full hover:opacity-50">
                    <a href="#" class="menu-item">
                        <img src="assets/img/icons/task-complete.svg" alt="roleIcons" >
                        <label for="" class="cursor-pointer">Rôles</label>
                    </a>
                </li>
                <li class="my-6 md:my-0 hover:h-full hover: hover:opacity-50">
                    <a href="#" class="menu-item">
                        <img  src="assets/img/icons/UserP-1.svg" alt="userIcons" >
                        <label for="" class="cursor-pointer">Utilisateur</label>
                    </a>
                </li>
                <li class="my-6 md:my-0 hover:h-full hover:opacity-50 ">
                    <a href="#" class="menu-item">
                        <img  src="assets/img/icons/phone.svg" alt="phoneIcons" >
                        <label for="" class="cursor-pointer">Application Mobile</label>
                    </a>
                </li>
               
                
            </ul>

        </nav>
       
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
            <div class="pt-10 ">
                <label for="" class="text-4xl font-bold">Tableau de Bord</label>

                <div class="flex flex-row">
                    <div class="bg-green-50 grid grid-cols-5 gap-5 md:flex md:flex-row rounded-lg my-5 shadow-lg">
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
                        <div class="text-green-800 py-5 max-w-3xl md:pl-[12px] md:pr-[13px] col-span-2 md:text-xs">
                            <p class="font-semibold text-base">Repartitions de Producteurs</p>
                            <p class="mt-5 text-green-800">
                                <span class="font-semibold text-base">Hommes: </span><span class="stat-farmers">5237</span>
                                <span class="font-semibold text-base">Femmes: </span><span class="stat-farmers">5237</span>
                            </p>
                        </div>
                    </div>

                    <div class="bg-green-50 rounded-lg my-5 py-5 px-10  flex flex-row text-green-800 ml-10 shadow-lg">
                           <div class="">
                                <p>Utilisateurs crées</p>
                                <p class="stat">06</p>
                           </div>
                           <div class="pt-8 px-4">
                                 <img  src="{{ asset('assets/img/icons/UserP-green.svg') }}" alt="userIcons" class="outline-gray-500">
                           </div>
                    </div>

                </div>

              
                
               <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 
                <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
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
                                <tr class="border-b  bg-green-50 dark:border-green-900">
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
      

        <script>
            function Menu(e){
                let list = document.querySelector('ul');

                e.name === 'menu'  ?  (e.name = "close", list.classList.
                add('top-[80px]'), list.classList.add('opacity-100')) 
                :( e.name = "menu", list.classList.remove('top-[80px]'),list.classList.remove('opacity-100'))
            }
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    </body>
</html>