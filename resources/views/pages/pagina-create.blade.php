@extends('layouts.users-index')

@section('content')

<section class="p-5">
    <div class="col-12">
        <h1 class="p-2">Pagine</h1>
    </div>

  <div class="container-fluid bg-white rounded border border-3 border-top py-4">
    <div class="row">

        <div class="col-10 mx-auto">
            <form action="/pagina/store" method="POST" id="form">
                
                @if(session('errorMessage'))
                    <h2>{{session('errorMessage')}}</h2>
                @endif
                
                @csrf 

                <div class="mb-3 d-flex align-items-center">
                    <label for="ateneo" class="mb-4 fw-bold me-2 w-25 h-100 text-center">Ateneo</label>
                    <select class="form-select mb-3" aria-label="Default select example" name="ateneo">
                        <option selected disabled>- Seleziona un Ateneo -</option>
                        <option value="unipegaso">Unipegaso</option>
                        <option value="mercatorum">Mercatorum</option>
                    </select>
                </div>

                <div class="mb-3 d-flex">
                    <label for="ateneo" class="mb-4 fw-bold me-2 w-25 text-center">Titolo</label>
                    <input type="text" name="titolo" class="form-control" id="title" required>
                </div>

                <div class="mb-3 d-flex">
                    <label for="ateneo" class="mb-4 fw-bold me-2 w-25 text-center">Categoria</label>
                    <select class="form-select" aria-label="Default select example" name="categoria">
                        <option selected disabled>- Seleziona una categoria -</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>


                <div class="mb-3 d-flex" id="slug-div">
                    <label for="slug" class="mb-4 fw-bold me-2 w-25 text-center">Slug</label>

                    <div class="w-100 d-flex justify-content-between align-items-center rounded">
                        <input type="text" name="slug" class="form-control h-100" id="slug" required>
                        <span class="form-control h-100 w-25" id="genera-url"><i class="fa-solid fa-arrows-rotate"></i> Genera</span>
                        <!-- <div class="border rounded text-center px-2 w-25 h-100"><a href="" class="text-decoration-none text-secondary"><i class="fa-solid fa-arrow-rotate-right mx-1"></i>Genera Url</a></div> -->
                    </div>
                </div>

                <div class="mb-3 d-flex">
                    <label for="ateneo" class="mb-4 fw-bold me-2 w-25 text-center">Titolo Seo</label>
                    <input type="text" name="seo_title" class="form-control" id="input-text" required>
                </div>

                <div class="mb-3 d-flex">
                    <label for="descrizione_seo" class="mb-4 fw-bold me-2 w-25 text-center">Descrizione Seo</label>
                    <input type="text" name="seo_description" class="form-control" id="input-text" required>
                </div>

                <div class="mb-4 d-flex justify-content-between">
                    <label for="contenuto" class="mb-4 fw-bold me-2 w-25 text-center">Contenuto</label>
                    <textarea id="summernote" name="contenuto"></textarea>
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
                <button type="submit" class="btn btn-primary mb-3">Salva</button>
            </form>
        </div>

        
        <script>
            $('#summernote').summernote({
                tabsize: 2,
                height: 300,
                width: 1050
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