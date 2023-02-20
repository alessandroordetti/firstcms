@extends('layouts.users-index')

@section('content')

<section class="p-5">

  <h1>Blogs</h1>
  
  <div class="container-fluid bg-white rounded border border-3 border-top py-4">
    <div class="row">
        <div class="col-12">
            <a href="{{ route('blog-create')}}"><button class="btn border mb-4"><i class="fa-solid fa-plus bg-dark text-white rounded-circle p-1"></i> Crea Blog</button></a>

            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col ">#</th>
                        <th scope="col ">Nome</th>
                        <th scope="col ">Slug</th>
                        <th scope="col ">Azione</th>
                    </tr>
                </thead>
                @if(isset($blogs))
                    <tbody>
                        <?php forEach($blogs as $blog) { ?>
                        @if($blog->deleted !== 1)
                            <tr>
                            <th scope="row">{{$blog->id}}</th>
                            <td>{{$blog->nome}}</td>
                            <td>{{$blog->slug}}</td>
                            <td class="d-flex">
                                <a href="{{ route('blog-edit', $blog->id) }}" class="me-1">Modifica</a>
                                <form action="{{ route('blog-delete', $blog->id)}}" method="post">
                                    @csrf
                                    <a href="#" onclick="if (confirm('Sei sicuro di voler cancellare il blog?')) this.closest('form').submit()">Elimina</a>
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