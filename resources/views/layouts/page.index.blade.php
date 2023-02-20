<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link href="{{ asset('summernote/summernote.css') }}" rel="stylesheet">
    <script src="{{ asset('summernote/summernote.js') }}"></script>

    <!-- include libraries(jQuery, bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <!-- Axios CDN -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- CUSTOM STYLE CSS -->
    <link rel="stylesheet" href="{{asset('/css/header.css')}}">
    <link rel="stylesheet" href="{{asset('/css/footer.css')}}">
    <link rel="stylesheet" href="{{asset('/css/sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">

    <title>Cms Multiversity</title>
  </head>
  <body>

    @include('components.header')

    <div class="d-flex" id="main-content">
        @include('components.sidebar')
        
        <!-- Main Content Section -->
        @yield('content')
    </div>
    
    @include('components.footer')

    <!-- POPPERJS FOR BOOTSTRAP 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
  </body>
</html>

