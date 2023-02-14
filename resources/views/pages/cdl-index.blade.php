@extends('layouts.users-index')

@section('content')

<section class="p-5">

  <h1>Corsi di Laurea</h1>
  
  <div class="container-fluid bg-white rounded border border-3 border-top py-4">
    <div class="row">

        <div class="col-6 mx-auto">
            @if(session('deleteMessage'))
                <h2 class="text-danger text-center">{{ session('deleteMessage') }}</h2>
            @endif
        </div>

        <div class="col-12">
            <a href="{{ route('cdl-create')}}"><button class="btn border mb-4"><i class="fa-solid fa-plus bg-dark text-white rounded-circle p-1"></i> Crea Corso di Laurea</button></a>

            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col ">Codice</th>
                        <th scope="col ">Nome</th>
                        <th scope="col ">Classe</th>
                        <th scope="col ">CFU</th>
                        <th scope="col ">Durata</th>
                        <th scope="col ">Ultima modifica</th>
                        <th scope="col ">Azione</th>
                    </tr>
                </thead>
                @if(isset($corsi))
                    <tbody>
                        <?php forEach($corsi as $corso) { ?>
                        @if($corso->deleted_at !== 1)
                            <tr>
                            <th scope="row">{{$corso->id}}</th>
                            <td>{{$corso->titolo}}</td>
                            <td>{{$corso->classe}}</td>
                            <td>{{$corso->codice}}</td>
                            <td>{{$corso->durata}}</td>
                            <td>{{$corso->updated_at}}</td>
                            <td class="d-flex">
                                <a href="{{ route('cdl-edit', $corso->id) }}" class="me-1">Modifica</a>
                                <form action="{{ route('cdl-delete', $corso->id)}}" method="post">
                                    @csrf
                                    @method('POST')
                                    <a href="#" onclick="if (confirm('Sei sicuro di voler cancellare lapagina?')) this.closest('form').submit()">Elimina</a>
                                </form>
                            </td>
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