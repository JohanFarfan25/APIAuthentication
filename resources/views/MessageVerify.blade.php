
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.APIAuthentication', 'API Home') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>

    .input-font-family{
        color:#212529;

    }

    .buutton-orange{
        background:#fd7e14;
        color:#fff;
        width:auth;
        
    }


    .panel-orange{
        background:#fd7e14;
        color:#fff;
        height:auth;
        
        
    }

    .buutton-link{
        
        color:#212529;
        
    }

    .a-titles{
        
        color:#212529;
        
    }

     .i-titles{
        
        color:#212529;
        
    }
    .container-page{
        background:#6c757d;
    }

    .container-navbar{
        background:#212529;
        color:#212529;
    }

    .link-navbar{
      
        color:#212529;
    }

 
    </style>


</head>
<body>

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.APIAuthentication', 'APIAuthentication') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
               
            </div>
        </nav>

<br></br>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">                
                <div class="panel text-center panel-orange"><h3><b>¡Congratulations!</b></h3></div>

                <div class="card-body">
                    

                @if(session()->has('message'))
            <div class="alert {{session('alert') ?? 'alert-info'}}">
                {{ session('message') }}
            </div>
            @endif
          
            <div class="text-center"><h3><b>User verified successfully</b></h3></div>
                <br></br>
                <div class="col-md-12  text-center">
                <a class="btn  panel-orange " href="{{ route('login') }}">Go tu login</a>
                  </div>  
            
                <br></br>


                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
