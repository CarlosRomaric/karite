@extends('layouts.app')
@section('title') - Distribution de scéllés @endsection
@section('content')
<div class="container py-5 px-20 mx-auto md:px-20  md:container md:mx-auto content">

        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 text-green-900 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Scéllés
                    </a>
                </li>
            </ol>
        </nav>
        <div class="pt-10">
            <label for="" class="text-4xl my-5 font-bold">Distribution de scellés</label>
            @if(session()->get('status'))
                <div class="relative flex flex-col sm:flex-row sm:items-center bg-gray-200 dark:bg-green-700 shadow rounded-md py-5 pl-6 pr-8 sm:pr-6 mb-3 mt-3">
                    <div class="flex flex-row items-center border-b sm:border-b-0 w-full sm:w-auto pb-4 sm:pb-0">
                        <div class="text-green-500" dark:text-gray-500="">
                            <svg class="w-6 sm:w-5 h-6 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="text-sm font-medium ml-3">Success!.</div>
                    </div>
                    <div class="text-sm tracking-wide text-gray-500 dark:text-white mt-4 sm:mt-0 sm:ml-4"> {{session()->get('message')}}</div>
                    <div class="absolute sm:relative sm:top-auto sm:right-auto ml-auto right-4 top-4 text-gray-400 hover:text-gray-800 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                </div>
            @endif
            <form method="post" action="{{ route('sealeds.set_agribusiness') }}" class="w-full p-10">
                @csrf
                <div class="flex gray-400 mb-6">
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acronym">
                            Coopérative
                        </label>
                        <div class="relative">
                            <select required class="block appearance-none w-full bg-gray-200 border {{ $errors->has('agribusiness_id') ? 'border-red-500' : 'border-gray-200' }}
                                text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white
                                " id="agribusiness_id" name="agribusiness_id">
                                <option value="">Coopérative</option>
                                @foreach($agribusinesses as $agribusiness)
                                    <option value="{{ $agribusiness->id }}" @if(old('agribusiness_id') === $agribusiness->id) selected @endif>{{ $agribusiness->matricule }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                        @if($errors->has('agribusiness_id'))
                            <p class="text-red-500 text-sm">{{ $errors->first('agribusiness_id') }}</p>
                        @endif
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                           Lot de scellés
                        </label>
                        <div class="relative">
                            <select required class="block appearance-none w-full bg-gray-200 border {{ $errors->has('lot_id') ? 'border-red-500' : 'border-gray-200' }}
                                text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white
                                " id="lot_id" name="lot_id">
                                <option value="">Sélectionner le lot de secllés</option>
                                @foreach($lots as $lot)
                                    <option value="{{ $lot->id }}" @if(old('lot_id') === $lot->id) selected @endif>{{ $lot->code }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                        @if($errors->has('lot_id'))
                            <p class="text-red-500 text-sm">{{ $errors->first('lot_id') }}</p>
                        @endif
                    </div>
                </div>
                <div class="px-8 mt-8 flex justify-end items-center">
                    <button class="focus:outline-none flex items-center btn-green" type="submit">Assigner</button>
                </div>
            </form>
        </div>
</div>
@endsection
@push('javascript')
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('select').select2();
    </script>
@endpush
