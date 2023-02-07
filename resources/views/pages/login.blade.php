<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/86168026ac.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">   
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <title>Document</title>
</head>
<body class="bg-login">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-8 col-sm-6 col-md-6 col-lg-3 bg-white rounded">
                <form action="login" method="POST" class="p-2 bottom-line">
                    @csrf

                    <div class="text-center bottom-line py-2">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                        <br>
                        <span>Accesso al Pannello di Controllo</span>
                    </div>  

                    <div class="py-3">
                        <div class="form-group mb-3">
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" required>
                        </div>

                        <div class="form-group ">
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                        </div>

                        
                        @if(isset($error))
                            <p>{{$error}}</p>
                        @endif
                    </div>
                    
                    <button type="submit" class="border-white bg-button text-white w-100"><i class="fa fa-sign-in me-1"></i>Login</button>

                    @if(isset($warning))
                        <h5 class="text-danger">{{$warning}}</h5>
                    @endif

                    @if(session('renewCookie'))
                        <h5 class="text-danger">{{session('renewCookie')}}</h5>
                    @endif
                </form>

                <div class="d-flex  justify-content-center py-2">
                    <span class="text-center"><a href="" class="text-decoration-none"><i class="fa-solid fa-circle-arrow-left me-1"></i>Torna alla Home</a></span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
