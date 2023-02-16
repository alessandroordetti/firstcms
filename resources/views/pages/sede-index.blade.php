@extends('layouts.users-index')

@section('content')

<section class="p-5">
    <h1>Sedi</h1>
    
    <div class="container-fluid bg-white rounded border border-3 border-top py-4">
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('sede-create')}}"><button class="btn border mb-4"><i class="fa-solid fa-plus bg-dark text-white rounded-circle p-1"></i> Crea Sede</button></a>
                <table class="table">
                    <thead>
                        <tr class="border">
                        <th class="col">Ateneo</th>
                        <th class="col">Titolo</th>
                        <th class="col">Regione</th>
                        <th scope="col">Città</th>
                        <th scope="col">Indirizzo</th>
                        <th scope="col">Referenti</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefono</th>
                        <th class="col">Stato</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php forEach($sedi as $sede) { ?>
                            @if($sede->deleted !== 1)
                            <tr class="border">
                                <td scope="row" class="text-capitalize">{{$sede->ateneo}}</td>
                                <td class="text-primary fw-bold text-capitalize">{{$sede->titolo}}</td>
                                <td class="text-capitalize">{{$sede->regione}}</td>
                                <td class="text-capitalize">{{$sede->citta}}</td>
                                <td>{{$sede->indirizzo}}</td>
                                <td><?php echo $sede->stato == 0 ? '<span class="text-success"><i class="fa-solid fa-check "></i> Online</span>' : ' <span class="text-danger"><i class="fa-solid fa-x me-1"></i> Offline</span>'; ?></td>
                                <td>{{$sede->email}}</td>
                                <td class="text-capitalize">{{$sede->telefono}}</td>
                                
                                <td class="d-flex">
                                    <a href="{{ route('sede-edit', $sede->id) }}" class="me-1">Modifica</a>
                                    <form action="{{ route('sede-delete', $sede->id)}}" method="post">
                                        @csrf
                                        @method('POST')
                                        <a href="#" onclick="if (confirm('Sei sicuro di voler cancellare l\'evento?')) this.closest('form').submit()">Elimina</a>
                                    </form>
                                </td>
                            </tr>
                            @endif
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
