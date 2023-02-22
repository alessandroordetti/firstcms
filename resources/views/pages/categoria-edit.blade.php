@extends('layouts.users-index')

@section('content')

<section class="p-5">

  <h1>Crea una categoria</h1>
  
  <div class="container-fluid bg-white rounded border border-3 border-top py-4">
    <div class="row">
        <div class="col-12">
        <form action="{{route('categoria-update', $category->id)}}" method="POST">        
                @csrf 

                @if(session('errorMessage'))
                    <h2>{{session('errorMessage')}}</h2>
                @elseif(session('success'))
                    <h2 class="text-success text-center mb-3">{{session('success')}}</h2>
                @elseif(session('queryError'))
                    <h2 class="text-danger text-center mb-3">{{session('queryError')}}</h2>
                @endif
                
                <div class="mb-3 d-flex">
                    <label for="ateneo" class="mb-4 fw-bold me-2 w-25 text-center">Nome</label>
                    
                    <div class="w-100 d-flex justify-content-between align-items-center rounded">
                        <input type="nome" name="nome" class="form-control" id="title" value="{{$category->nome}}" required>
                        <span class="form-control w-25" id="genera-url"><i class="fa-solid fa-arrows-rotate"></i> Genera</span>
                    </div>
                </div>

                <div class="mb-3 d-flex" id="slug-div">
                    <label for="slug" class="mb-4 fw-bold me-2 w-25 text-center">Slug</label>                   
                    <input type="text" name="slug" class="form-control h-100" id="slug" value="{{$category->slug}}" required readonly>            
                </div>
                
                <button type="submit" class="btn btn-primary mb-3">Salva</button>
            </form>

        </div>  
    </div>
  </div>
</section>

<!-- SLUG GENERATOR SCRIPTO -->
<script src="{{ asset('js/slug-generator.js') }}"></script>
@endsection