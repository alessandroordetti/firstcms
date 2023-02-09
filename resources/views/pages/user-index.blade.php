@extends('layouts.users-index')

@section('content')

<section class="p-5">

  <h1>Utenti</h1>
  
  <div class="container-fluid bg-white rounded border border-3 border-top py-4">
    <div class="row">

      <div class="col-6 mx-auto">
        @if(session('deleteMessage'))
          <h2 class="text-danger text-center">{{ session('deleteMessage') }}</h2>
        @endif
      </div>

      <div class="col-12">
      <a href="{{ route('register')}}"><button class="btn border mb-4"><i class="fa-solid fa-plus bg-dark text-white rounded-circle p-1"></i> Crea Utente</button></a>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Email</th>
              <th scope="col">Gruppo Id</th>
              <th scope="col">Player Id</th>
              <th scope="col">Created At</th>
              <th scope="col">Gestione Utenti</th>
            </tr>
          </thead>
          @if(isset($users))
          <tbody>
            <?php forEach($users as $user) { ?>
              @if($user->deleted_at !== 1)
                <tr>
                  <th scope="row">{{$user->id}}</th>
                  <td>{{$user->email}}</td>
                  <td>{{$user->gruppo_id}}</td>
                  <td>{{$user->player_id}}</td>
                  <td>{{$user->created_at}}</td>
                  <td><a href="{{route('user-edit', $user->id)}}" class="btn btn-warning" >Gestisci utente</a></td>
                </tr>
              @endif
            <?php } ?>
          </tbody>
          @endif
        </table>
      </div>
    </div>
  </div>
</section>


@endsection