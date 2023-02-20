@extends('layouts.users-index')

@section('content')

<section class="p-5">

    <div class="d-flex justify-content-between">
        <h1>Crea un nuovo blog</h1>
        <a href="{{route('blog-index')}}" class="btn btn-primary h-25">Torna indietro</a>
    </div>
  
  <div class="container-fluid bg-white rounded border border-3 border-top py-4">
    <div class="row">
        <div class="col-12">
            <form action="{{route('blog-store')}}" method="POST">        
                @csrf 

                @if(session('errorMessage'))
                    <h2>{{session('errorMessage')}}</h2>
                @elseif(session('queryError'))
                    <h2 class="text-danger text-center mb-3">{{session('queryError')}}</h2>
                @endif
    
                <div class="mb-3 d-flex">
                    <label for="ateneo" class="mb-4 fw-bold me-2 w-25 text-center">Nome</label>
                    
                    <div class="w-100 d-flex justify-content-between align-items-center rounded">
                        <input type="text" name="nome" class="form-control" id="title" required>
                        <span class="form-control w-25" id="genera-url"><i class="fa-solid fa-arrows-rotate"></i> Genera</span>
                    </div>
                </div>

                <div class="mb-3 d-flex" id="slug-div">
                    <label for="slug" class="mb-4 fw-bold me-2 w-25 text-center">Slug</label>                   
                    <input type="text" name="slug" class="form-control h-100" id="slug" required readonly placeholder="Per generare lo slug, inserisci nel campo titolo un valore valido dopodiché premi su Genera">            
                </div>

                <div class="mb-3 d-flex w-25 d-flex justify-content-center">                  
                    <button type="submit" class="btn btn-primary mb-3 text-center">Salva</button>            
                </div>
                
            </form>
        </div>  
    </div>
  </div>
</section>


<!-- SLUG GENERATOR SCRIPTO -->
<script src="{{ asset('js/slug-generator.js') }}"></script>
@endsection