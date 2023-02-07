@extends('layouts.users-index')

@section('content')

<section class="p-5">
    <h1 class="py-3">Modifica l'utente</h1>
    
    <div class="container-fluid bg-white rounded border border-3 border-top py-4">
        <div class="row mb-4">
            <div class="col-12">
                @if(session('response'))
                    <h1 class="py-3 text-success">{{ session('response') }}</h1>
                @elseif(session('success'))
                    <h1 class="py-3 text-success">{{session('success')}}</h1>
                @endif
                
                <form action="{{route('user-update', $user->id)}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email*</label>
                        <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$user->email}}" required>
                    </div> 

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Gruppo*</label>
                        <select class="form-select mb-3" aria-label="Default select example" name="gruppo_id">
                            <option selected>Ruolo*</option>
                            <option value="1" {{ ($user->gruppo_id == 1) ? 'selected' : '' }}>Admin</option>
                            <option value="2" {{ ($user->gruppo_id == 2) ? 'selected' : '' }}>Editor</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Player*</label>
                        <select class="form-select mb-3" aria-label="Default select example" name="player_id" value="{{$user->player_id}}">
                            <option selected>Player*</option>
                            <option value="1" {{ ($user->player_id == 1) ? 'selected' : '' }}>All</option>
                            <option value="2" {{ ($user->player_id == 2) ? 'selected' : '' }}>Pegaso</option>
                            <option value="3" {{ ($user->player_id == 3) ? 'selected' : '' }}>Mercatorum</option>
                        </select>
                    </div>

                    <p class="mb-3">I campi contrassegnati con * sono obbligatori</p>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary text-center">Conferma modifica</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <h3 class="mb-3">Attenzione: la cancellazione dell'utente non è reversibile</h3>
            </div>

            <div class="col-4 text-end">
                <form action="{{route('user-delete', $user->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Cancella utente</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
