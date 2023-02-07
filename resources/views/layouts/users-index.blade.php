<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- include libraries(jQuery, bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    
    <!-- SUMMERNOTE TEXT EDITOR -->
    <link href="{{ asset('summernote/summernote.css') }}" rel="stylesheet">
    <script src="{{ asset('summernote/summernote.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/86168026ac.js" crossorigin="anonymous"></script>
    
    <!-- BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">   
    
    <!-- CUSTOM STYLE CSS -->
    <link rel="stylesheet" href="{{asset('/css/header.css')}}">
    <link rel="stylesheet" href="{{asset('/css/footer.css')}}">
    <link rel="stylesheet" href="{{asset('/css/sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/css/pagine.css')}}">
    <title>Users-Index</title>
</head>
<body class="vh-100">
    @include('components.header')


    <div class="container-fluid">
        <div class="row">
            <div class="col-2 px-0" id="navbar-component-bg">
                @include('components.sidebar')
            </div>
            
            <div class="col-10 p-3" id="bg-light-blue">
                <!-- Main Content Section -->
                @yield('content')
            </div>

        </div>
    </div>

    @include('components.footer')

    <!-- POPPERJS FOR BOOTSTRAP 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>