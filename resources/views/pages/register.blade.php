@extends('layouts.users-index')

@section('content')

<section class="p-5">
    
    @if(isset($response))
        <h3 class="text-danger">{{$response}}</h3>
    @endif

    <h1 class="py-3">Registrazione nuovo utente</h1>

    <div class="container-fluid bg-white rounded border border-3 border-top py-4">
        <div class="row">
            <div class="col-12">
            <form action="/user/store" method="POST">
                @csrf

                @if(session('errorMessage'))
                    <h3>{{session('errorMessage')}}</h3>
                @endif
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email*</label>
                    <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password*</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="La password deve comprendere almeno 8 caratteri" required>
                </div>
                <div>
                    <label for="exampleInputPassword1" class="form-label">Gruppo Id*</label>
                    <select class="form-select mb-3" aria-label="Default select example" name="gruppo_id" required>
                        <option selected disabled>Ruolo*</option>
                        <option value="1">Admin</option>
                        <option value="2">Editor</option>
                    </select>
                </div>

                <div>
                    <label for="exampleInputPassword1" class="form-label">Player Id*</label>
                    <select class="form-select mb-3" aria-label="Default select example" name="player_id" required>
                        <option selected disabled>Player*</option>
                        <option value="1">All</option>
                        <option value="2">Pegaso</option>
                        <option value="3">Mercatorum</option>
                    </select>
                </div>


                <p>I campi contrassegnati con * sono obbligatori</p>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary text-center">Registra utente</button>
                </div>
            </form>
            </div>
        </div>
    </div>



</section>

@endsection