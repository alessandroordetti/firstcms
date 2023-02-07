@extends('layouts.users-index')

@section('content')

<section class="p-5">
    <div class="col-12">
        <h1 class="p-2">Pagine</h1>
    </div>

  <div class="container-fluid bg-white rounded border border-3 border-top py-4">
    <div class="row">

        <div class="col-10 mx-auto">
            <form action="{{route('pagina-update', $page->id)}}" method="POST" id="form">
                
                @if(session('response'))
                    <h2>{{session('response')}}</h2>
                @elseif(session('success'))
                    <h2>{{session('success')}}</h2>
                @endif
                
                @csrf 

                <div class="mb-3 d-flex align-items-center">
                    <label for="ateneo" class="mb-4 fw-bold me-2 w-25 h-100 text-center">Ateneo</label>
                    <select class="form-select mb-3" aria-label="Default select example" name="ateneo">
                        <option selected disabled>- Seleziona un Ateneo -</option>
                        <option value="unipegaso" {{ ($page->ateneo == 'unipegaso') ? 'selected' : '' }}>Unipegaso</option>
                        <option value="mercatorum" {{ ($page->ateneo == 'mercatorum') ? 'selected' : '' }}>Mercatorum</option>
                    </select>
                </div>

                <div class="mb-3 d-flex">
                    <label for="ateneo" class="mb-4 fw-bold me-2 w-25 text-center">Titolo</label>
                    <input type="text" name="titolo" class="form-control" id="title" value="{{$page->titolo}}" required>
                </div>

                <div class="mb-3 d-flex">
                    <label for="ateneo" class="mb-4 fw-bold me-2 w-25 text-center">Categoria</label>
                    <select class="form-select" aria-label="Default select example" name="categoria">
                        <option selected disabled>- Seleziona una categoria -</option>
                        <option value="1" {{ ($page->categoria == 1) ? 'selected' : '' }}>One</option>
                        <option value="2" {{ ($page->categoria == 2) ? 'selected' : '' }}>Two</option>
                        <option value="3" {{ ($page->categoria == 3) ? 'selected' : '' }}>Three</option>
                    </select>
                </div>


                <div class="mb-3 d-flex" id="slug-div">
                    <label for="slug" class="mb-4 fw-bold me-2 w-25 text-center">Slug</label>

                    <div class="w-100 d-flex justify-content-between align-items-center rounded">
                        <input type="text" name="slug" class="form-control h-100" id="slug" required disabled>
                        <span class="form-control h-100 w-25" id="genera-url"><i class="fa-solid fa-arrows-rotate"></i> Genera</span>
                    </div>
                </div>

                <div class="mb-3 d-flex">
                    <label for="ateneo" class="mb-4 fw-bold me-2 w-25 text-center">Titolo Seo</label>
                    <input type="text" name="seo_title" class="form-control" id="input-text" value="{{$page->seo_title}}" required>
                </div>

                <div class="mb-3 d-flex">
                    <label for="descrizione_seo" class="mb-4 fw-bold me-2 w-25 text-center">Descrizione Seo</label>
                    <input type="text" name="seo_description" class="form-control" value="{{$page->seo_description}}" id="input-text" required>
                </div>

                <div class="mb-4 d-flex justify-content-between">
                    <label for="contenuto" class="mb-4 fw-bold me-2 w-25 text-center">Contenuto</label>
                    <textarea id="summernote" name="contenuto">{{$page->contenuto}}</textarea>
                </div> 

                <div class="mb-3 d-flex ">
                    <label for="stato" class="mb-4 fw-bold me-2 w-25 text-center">Stato</label>
                    <div class="text-start">
                        <span class="mx-2" value="1">Off</span>
                        <label class="switch">
                            <input type="checkbox" name="stato" value="0" checked>
                            <span class="slider round"></span>
                        </label>
                        <span class="mx-2" value="0">On</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Modifica</button>
            </form>
        </div>

        
        <script>
            $('#summernote').summernote({
                tabsize: 2,
                height: 300,
                width: 1200
            });
        </script> 
    </div>
  </div>
</section>

<style>
    #slug-div:hover{
        cursor: pointer;
    }
</style>

<!-- SLUG GENERATOR SCRIPTO -->
<script src="{{ asset('js/page-slug.js') }}"></script>
@endsection
