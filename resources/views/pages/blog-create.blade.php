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
                        <input type="text" name="titolo" class="form-control" id="title" required>
                        <span class="form-control w-25" id="genera-url"><i class="fa-solid fa-arrows-rotate"></i> Genera</span>
                    </div>
                </div>

                <div class="mb-3 d-flex" id="slug-div">
                    <label for="category-id" class="mb-4 fw-bold me-2 w-25 text-center">Categoria</label>                   
                    <select name="category_id" id="category-id" class="form-control">
                        <?php foreach ($categories as $category) { ?>
                            <option class="category-option" value="{{$category->id}}" data-slug="{{ $category->slug }}"><i class="fa-solid fa-chevron-down"></i> {{$category->nome}} </option>
                        <?php } ?>
                    </select>            
                </div>

                <div class="mb-3 d-flex" id="slug-div">
                    <label for="slug" class="mb-4 fw-bold me-2 w-25 text-center">Slug</label>                   
                    <input type="text" name="slug" class="form-control h-100" id="slug" required readonly placeholder="Per generare lo slug, inserisci nel campo titolo un valore valido dopodiché premi su Genera">            
                </div>

                <div class="mb-4 d-flex justify-content-between">
                    <label for="contenuto" class="mb-4 fw-bold me-2 w-25 text-center">Contenuto</label>
                    <textarea class="summernote" name="contenuto"></textarea>
                </div> 

                <div class="mb-3 d-flex ">
                    <label for="stato" class="mb-4 fw-bold me-2 w-25 text-center">Stato</label>
                    <div class="text-start">
                        <span class="mx-2" >Off</span>
                        <label class="switch">
                            <input type="hidden" name="stato" input="0">
                            <input type="checkbox" name="stato" value="1" checked>
                            <span class="slider round"></span>
                        </label>
                        <span class="mx-2">On</span>
                    </div>
                </div>

                <div class="mb-3 d-flex w-25 d-flex justify-content-center">                  
                    <button type="submit" class="btn btn-primary mb-3 text-center">Salva</button>            
                </div>
                
            </form>
        </div>  
    </div>
  </div>
</section>
<script>
    $('.summernote').summernote({
        tabsize: 2,
        height: 300,
        width: 1250
    });
</script> 

<!-- SLUG GENERATOR SCRIPTO -->
<script src="{{ asset('js/category-title-generator.js') }}"></script>
@endsection