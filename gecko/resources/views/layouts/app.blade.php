<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gecko</title>

        {{-- Bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        {{-- FontAwesome --}}
        <script src="https://kit.fontawesome.com/8a296eb741.js" crossorigin="anonymous"></script>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <meta name="csrf-token" content="{{ csrf_token() }}" />

        {{-- Jquery --}}
        <script
			  src="https://code.jquery.com/jquery-3.7.1.min.js"
			  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
			  crossorigin="anonymous"></script>

        <script type="text/javascript">
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        </script>
        <script src="/libraries/loader/ajax-loading.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        
    </head>
    <body class="font-sans antialiased">
        <nav class="logo">
            <div class=filters>
                <label class="green" for="green"></label>
                <input class="filter" id="green" checked type="checkbox">
                <label class="yellow" for="yellow"></label>
                <input class="filter" id="yellow" checked type="checkbox">
                <label class="red" for="red"></label>
                <input class="filter" id="red" checked type="checkbox">
                <label class="solved" for="solved">Solucionados</label>
                <input class="filter" id="solved" checked type="checkbox">
            </div>
            <img src="{{ asset('img/logo.jpg') }}" alt="logo"/>
        </nav>
        <div class="sticky-nav">
            <i class="fa-solid fa-plus" data-bs-toggle="modal" data-bs-target="#taskModal"></i>
        </div>
    </body>
</html>