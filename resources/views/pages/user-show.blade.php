@extends('layouts.users-index')

@section('content')

<section class="p-5">
  <div class="d-flex justify-content-between align-items-center">
    <button class="btn btn-primary h-50"><a href="http://cmsmultiversity/user" class="text-decoration-none text-white">Torna alla Home</a></button>
  </div>


  <div class="container-fluid bg-white rounded border border-3 border-top py-4">
    <div class="row">
      <div class="col-12">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Email</th>
              <th scope="col">Gruppo Id</th>
              <th scope="col">Player Id</th>
              <th scope="col">Created At</th>
            </tr>
          </thead>
          <tbody>
            @if(isset($newUser))
            <tr>
              <th scope="row">{{$newUser->id}}</th>
              <td>{{$newUser->email}}</td>
              <td>{{$newUser->gruppo_id}}</td>
              <td>{{$newUser->player_id}}</td>
              <td>{{$newUser->created_at}}</td>
            </tr>
            @endif

            @if(isset($user))
            <tr>
              <th scope="row">{{$user->id}}</th>
              <td>{{$user->email}}</td>
              <td>{{$user->gruppo_id}}</td>
              <td>{{$user->player_id}}</td>
              <td>{{$user->created_at}}</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
@endsection