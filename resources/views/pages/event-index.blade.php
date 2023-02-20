@extends('layouts.users-index')

@section('content')

<section class="p-5">
    <h1>Eventi</h1>
    
    <div class="container-fluid bg-white rounded border border-3 border-top py-4">
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('event-create')}}"><button class="btn border mb-4"><i class="fa-solid fa-plus bg-dark text-white rounded-circle p-1"></i> Crea Evento</button></a>
                <table class="table">
                    <thead>
                        <tr class="border">
                        <th scope="col">#</th>
                        <th scope="col">Titolo</th>
                        <th scope="col">Data</th>
                        <th scope="col">Luogo</th>
                        <th scope="col">Stato</th>
                        <th scope="col">Ultima modifica</th>
                        <th scope="col">Azione</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php forEach($events as $event) { ?>
                            @if($event->deleted !== 1)
                            <tr class="border">
                                <td scope="row">{{$event->id}}</td>
                                <td class="text-primary fw-bold text-capitalize">{{$event->titolo}}</td>
                                <td>{{$event->data}}</td>
                                <td>{{$event->luogo}}</td>
                                <td><?php echo $event->stato == 1 ? '<i class="fa-solid fa-check text-success"></i> Online' : ' <i class="fa-solid fa-x text-danger me-1"></i> Offline'; ?></td>
                                <td>{{$event->updated_at}}</td>
                                <td class="d-flex">
                                    <a href="{{ route('event-edit', $event->id) }}" class="me-1">Modifica</a>
                                    <form action="{{ route('event-delete', $event->id)}}" method="post">
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
