@extends('layouts.users-index')

@section('content')

<section class="p-5">

  <h1>Categorie</h1>
  
  <div class="container-fluid bg-white rounded border border-3 border-top py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex">
                <a href="{{ route('categoria-create')}}"><button class="btn border mb-4"><i class="fa-solid fa-plus bg-dark text-white rounded-circle p-1"></i> Crea Categoria</button></a>
            </div>

            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col ">Id</th>
                        <th scope="col ">Nome</th>
                        <th scope="col ">Slug</th>
                        <th scope="col ">Azione</th>
                    </tr>
                </thead>
                @if(isset($categories))
                    <tbody>
                        <?php forEach($categories as $category) { ?>
                        @if($category->deleted !== 1)
                            <tr>
                            <th scope="row">{{$category->id}}</th>
                            <td>{{$category->nome}}</td>
                            <td>{{$category->slug}}</td>
                            <td class="d-flex">
                                <a href="{{ route('categoria-edit', $category->id) }}" class="me-1">Modifica</a>
                                <form action="{{ route('categoria-delete', $category->id)}}" method="post">
                                    @csrf
                                    @method('POST')
                                    <a href="#" onclick="if (confirm('Sei sicuro di voler cancellare la categoria?')) this.closest('form').submit()">Elimina</a>
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