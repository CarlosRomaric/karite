@extends('layouts.app')
@section('title') - Liste des Utilisateurs @endsection
@section('content')

<div class="container py-5 px-20 mx-auto md:px-20  md:container md:mx-auto content">

        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('users.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-amber-800 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 text-amber-900 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        utilisateur 
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-amber-800 dark:text-gray-400 dark:hover:text-white">
                        >
                        Affectation de role a l'utilisateur
                    </a>
                </li>
                
                
                
            </ol>
        </nav>

        <div class="pt-10">
        <label for="" class="text-3xl py-2 font-bold">Affectation de role a l'utilisateur</label>
            <div class="bg-white rounded shadow overflow-hidden max-w-3xl flex justify-center">
                <form method="post" action="{{ route('users.role.store', ['user' => $user->id]) }}" class="w-full p-10">
                    @csrf
                    <div class="flex gray-400">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            @foreach($roles as $role)
                                <label class="custom-checkbox-label flex my-4">
                                    <div class="bg-gray-300 shadow border-amber-600 w-6 h-6 p-1 flex justify-center items-center mr-2">
                                        <input type="checkbox"  @if($user->hasRole($role->name)) checked @endif name="role_id[]" value="{{ $role->id }}" class="hidden">
                                        <svg class="hidden w-4 h-4 text-amber-700 pointer-events-none" viewBox="0 0 172 172">
                                            <g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal">
                                                <path d="M0 172V0h172v172z"/>
                                                <path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="2"/>
                                            </g>
                                        </svg>
                                    </div>
                                    <span class="select-none">{{ $role->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="px-8 mt-8 flex justify-end items-center">
                        <button class="focus:outline-none flex items-center bg-amber-700 text-white text-xl  p-2 rounded" type="submit">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>



</div>
@endsection

@section('script')
<script>
   
</script>
@endsection