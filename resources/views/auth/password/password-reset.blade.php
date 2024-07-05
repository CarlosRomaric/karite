<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Réinitialisation</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
</head>
<style>
	.title{
    	text-align: center!important;
    	color: #768801 !important;
    	text-transform: none;
    	font-size: 30px;
	    padding-bottom: 28px;
		width: 100%;
	}
	.form-control{
        margin-bottom: 24px;
    	box-shadow: 0px 0px 6px #00000029;
    	height: 57px;
    	border-bottom: 3px solid #778801;
        font-size:20px;
    }
	::placeholder {
  		color: #768801 !important;
	}

	.btn-primary{
    	background: #768801;
    	width: 233px;
    	font-size: 20px;
    	height: 54px;
	    margin: auto;
	}

	.btn-primary:hover{
    	background: #454f07;
    	width: 233px;
    	font-size: 20px;
    	height: 54px;
	    margin: auto;
	}

	@media only screen and (max-width: 600px) {
  		
		.px-24 {
    		padding-left: 2rem;
    		padding-right: 2rem;
		}
		.pd-top{
    		margin-top:10px  !important;
    	}
	}

	.pd-top{
    	margin-top:150px
    }
    
</style>
<body>
<div id="app" class="">
    <div class=" row">
        
        <div class="col-md-8" >
			<div style="box-shadow: 0px 0px 35px #00000029;padding-left: 70px;">
				<img src="{{ asset('assets/images/banner-ham.png') }}" style="width:55%;padding:10px;" >
			</div>
			<img src="{{ asset('assets/images/Cacao.png') }}" style="width:100%" >
        </div>
        <div class="col-md-4">
			<img src="{{ asset('assets/images/banner-hm-2.png') }}" style="width:100%" >

            <div class="w-full  flex-col justify-center align-items-start min-h-screen px-24 pd-top" style="min-height: 85vh;">
                @if(session()->has('message') && session()->get('status'))
                    <div class="{{ session()->get('status') === 'error' ? 'bg-red-400 border border-red-400 text-white px-4 py-3 my-2 rounded relative max-w-3xl' : 'bg-green-400 border border-green-400 text-white px-4 py-3 my-2 rounded relative max-w-3xl' }}" role="alert" >
                        <span class="block sm:inline">{{ session()->get('message') }}</span>
{{--                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">--}}
{{--                            <svg class="fill-current h-6 w-6 text-gray-600" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">--}}
{{--                                <title>Close</title>--}}
{{--                                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />--}}
{{--                            </svg>--}}
{{--                        </span>--}}
                    </div>
                @endif
                <form method="post" action="{{ route('backend.auth.restore') }}" class="pt-6 pb-8 m-2 ">
                    @csrf
                   <input value="{{$_GET['token']}}" name="token" type="hidden" >
                    <h1 class="font-bold title">Nouveau mot de passe</h1>
                        <input class="form-control"
                               id="password" name="password" value="" placeholder="Mot de passe" minlength="8" required>
                        @if($errors->has('password'))
                            <p class="text-red-500 text-sm">{{ $errors->first('email') }}</p>
                        @endif
                        <input class="form-control"
                               id="password_confirmation" name="password_confirmation" value=""  minlength="8" required placeholder="Confirmer le mot de passe">
                        @if($errors->has('password_confirmation'))
                            <p class="text-red-500 text-sm">{{ $errors->first('email') }}</p>
                        @endif
                    <div class="flex items-center justify-between" style="width:100%">
                        <button class="btn-primary focus:outline-none" type="submit">Réinitialiser</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
