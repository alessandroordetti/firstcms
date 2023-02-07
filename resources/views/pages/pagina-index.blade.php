@extends('layouts.users-index')

@section('content')

<section class="p-5">
    <div class="col-12">
        <h1 class="p-2">Pagine</h1>
    </div>

  <div class="container-fluid bg-white rounded border border-3 border-top py-4">
    <div class="row">
        @if(session('deleteMessage'))
           <h3> {{session('deleteMessage')}}</h3>
        @endif
        <div class="col-12">
            <table class="table">
            <thead>
                <tr>
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
                <tr>
                    <th scope="row">{{$page->id}}</th>
                    <th class="text-primary">{{$page->titolo}}</th>
                    <td>{{$page->template}}</td>
                    <td>{{$page->stato}}</td>
                    <td>{{$page->updated_at}}</td>
                    <td class="d-flex">
                        <a href="{{ route('pagina-edit', $page->id) }}">Modifica</a>
                        <a href="{{ route('pagina-delete', $page->id)}}" class="ms-1">Elimina</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            </table>
        </div>
    </div>
  </div>
</section>
@endsection
