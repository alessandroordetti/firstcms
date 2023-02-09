@extends('layouts.users-index')

@section('content')

<section class="p-5">
    <div class="col-12">
        <h1 class="p-2">Pagine</h1>
    </div>

  <div class="container-fluid bg-white rounded border border-3 border-top py-4">
    <div class="row">
        @if(session('deleteMessage'))
           <h3 class="text-danger"> {{session('deleteMessage')}}</h3>
        @elseif(session('errorMessage'))
            <h3 class="text-danger">{{session('errorMessage')}}</h3>
        @endif

        <div class="col-12">
            <a href="{{ route('pagina-create')}}"><button class="btn border mb-4"><i class="fa-solid fa-plus bg-dark text-white rounded-circle p-1"></i> Crea Pagina</button></a>
            <table class="table">
            <thead>
                <tr class="border">
                <th scope="col">#</th>
                <th scope="col">Titolo</th>
                <th scope="col">Template</th>
                <th scope="col">Stato</th>
                <th scope="col">Ultima modifica</th>
                <th scope="col">Azione</th>
                </tr>
            </thead>
            <tbody>
                <?php forEach($pages as $page) { ?>
                    @if($page->deleted_at !== 1)
                    <tr class="border">
                        <th scope="row">{{$page->id}}</th>
                        <th class="text-primary">{{$page->titolo}}</th>
                        <td>{{$page->template}}</td>
                        <td><?php echo $page->stato == 0 ? '<i class="fa-solid fa-check text-success"></i> Online' : ' <i class="fa-solid fa-x text-danger me-1"></i> Offline'; ?></td>
                        <td>{{$page->updated_at}}</td>
                        <td class="d-flex">
                            <a href="{{ route('pagina-edit', $page->id) }}" class="me-1">Modifica</a>
                            <form action="{{ route('pagina-delete', $page->id)}}" method="post">
                            @csrf
                            @method('POST')
                            <a href="#" onclick="if (confirm('Sei sicuro di voler cancellare lapagina?')) this.closest('form').submit()">Elimina</a>
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
