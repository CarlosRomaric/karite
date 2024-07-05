<?php
/**
 * Created by PhpStorm.
 * User: salioudiabate
 * Date: 27/03/2020
 * Time: 08:08
 */
?>
@extends('layouts.app')
@section('title') - Modification du profil @endsection
@section('content')
<div class="container py-5 px-20 mx-auto md:px-20  md:container md:mx-auto">

    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 text-green-900 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                    </svg>
                   Mon Profil
                </a>
            </li>
            
            
            
        </ol>
    </nav>

    <div class="pt-10">
        <div class="w-full overflow-hidden px-4 py-8 md:p-12">
            <h1 class="mb-8 font-bold text-3xl">
                Modification du profil
            </h1>
        
            <div class="bg-white rounded shadow overflow-hidden max-w-3xl flex justify-center">
                <form method="post" action="{{ route('profile.update', ['user' => $user->id]) }}" class="w-full p-10">
                    @csrf
                    <div class="flex gray-400 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Nom & prénoms
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('fullname') ? ' border-red-500' : '' }} rounded
                                py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                name="fullname" id="fullname" type="text" value="{{ old('fullname') ?: $user->fullname }}" placeholder="Nom & prénoms">
                            @if($errors->has('fullname'))
                                <p class="text-red-500 text-sm">{{ $errors->first('fullname') }}</p>
                            @endif
                        </div>
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Nom d'utilisateur
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('username') ? ' border-red-500' : '' }} rounded
                                py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                name="username" id="username" type="text" value="{{ old('username') ?: $user->username }}" placeholder="Nom d'utilisateur">
                            @if($errors->has('username'))
                                <p class="text-red-500 text-sm">{{ $errors->first('username') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex gray-400 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Contact
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('phone') ? ' border-red-500' : '' }} rounded
                                py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                name="phone" id="phone" type="text" value="{{ old('phone') ?: $user->phone }}" placeholder="Contact">
                            @if($errors->has('phone'))
                                <p class="text-red-500 text-sm">{{ $errors->first('phone') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex gray-400 mb-6 mt-3 pt-6 border-t-2">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="current_password">
                                Entrez votre mot de passe actuel
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('current_password') ? ' border-red-500' : '' }} rounded
                                py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" autocomplete="off"
                                name="current_password" id="current_password" type="password" placeholder="*****************">
                            @if($errors->has('current_password'))
                                <p class="text-red-500 text-sm">{{ $errors->first('current_password') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex gray-400 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                                Nouveau mot de passe
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('password') ? ' border-red-500' : '' }} rounded
                                py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" autocomplete="off"
                                name="password" id="password" type="password" placeholder="*****************">
                            @if($errors->has('password'))
                                <p class="text-red-500 text-sm">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password_confirmation">
                                Confirmation du nouveau mot de passe
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border{{ $errors->has('password_confirmation') ? ' border-red-500' : '' }} rounded
                                py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" autocomplete="off"
                                name="password_confirmation" id="password_confirmation" type="password" placeholder="*****************">
                            @if($errors->has('password_confirmation'))
                                <p class="text-red-500 text-sm">{{ $errors->first('password_confirmation') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="px-8 mt-8 flex justify-end items-center">
                        <button class="focus:outline-none flex items-center btn-green" type="submit">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
