@extends('layouts.users-index')

@section('content')

<section class="p-5">
    <div class="col-12">
        <h1 class="p-2">Aggiungi una sede</h1>
    </div>

  <div class="container-fluid bg-white rounded border border-3 border-top py-4">
    <div class="row">
        <div class="col-10 mx-auto">
            <form action="{{route('sede-store')}}" method="POST" id="form">
                
                @if(session('errorMessage'))
                    <h2>{{session('errorMessage')}}</h2>
                @elseif(session('response'))
                    <h2>{{session('response')}}</h2>
                @elseif(session('queryError'))
                    <h2 class="text-danger text-center mb-3">{{session('queryError')}}</h2>
                @elseif(session('queryTitleError'))
                    <h2>{{session('queryTitleError')}}</h2>
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
                    <label for="titolo" class="mb-4 fw-bold me-2 w-25 text-center">Titolo</label>
                    
                    <div class="w-100 d-flex justify-content-between align-items-center rounded">
                        <input type="text" name="titolo" class="form-control" id="title" required>
                        <span class="form-control h-100 w-25" id="genera-url"><i class="fa-solid fa-arrows-rotate"></i> Genera</span>
                    </div>
                </div>

                <div class="mb-3 d-flex" id="slug-div">
                    <label for="slug" class="mb-4 fw-bold me-2 w-25 text-center">Slug</label>                   
                    <input type="text" name="slug" class="form-control h-100" id="slug" required readonly placeholder="Per generare lo slug, inserisci nel campo titolo un valore valido dopodiché premi su Genera">            
                </div>

                <div class="mb-3 d-flex">
                    <label for="regione" class="mb-4 fw-bold me-2 w-25 text-center">Regione</label>
                    <input type="text" name="regione" class="form-control" id="regione" required>
                </div>
                
                <div class="mb-3 d-flex">
                    <label for="provincia" class="mb-4 fw-bold me-2 w-25 text-center">Provincia</label>
                    <input type="text" name="provincia" class="form-control" id="provincia" required>
                </div>

                <div class="mb-3 d-flex">
                    <label for="citta" class="mb-4 fw-bold me-2 w-25 text-center">Città</label>
                    <input type="text" name="citta" class="form-control" id="citta" required>
                </div>

                <div class="mb-3 d-flex">
                    <label for="indirizzo" class="mb-4 fw-bold me-2 w-25 text-center">Indirizzo</label>
                    <input type="text" name="indirizzo" class="form-control" id="indirizzo" required>
                </div>
                
                <div class="mb-3 d-flex justify-content-between">
                    <label for="referenti" class="mb-4 fw-bold me-2 w-25 text-center">Referenti</label>
                    <input type="text" name="referenti" class="form-control" id="referenti" required> 
                </div> 

                <div class="mb-3 d-flex justify-content-between">
                    <label for="telefono" class="mb-4 fw-bold me-2 w-25 text-center">Telefono</label>
                    <input type="tel" name="telefono" class="form-control" id="telefono" required>
                </div>

                <div class="mb-3 d-flex">
                    <label for="email" class="mb-4 fw-bold me-2 w-25 text-center">Email</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>

                <div class="mb-3 d-flex">
                    <label for="lat" class="mb-4 fw-bold me-2 w-25 text-center">Latitudine</label>
                    <input type="text" name="lat" class="form-control" id="lat">
                </div>

                <div class="mb-4 d-flex">
                    <label for="lng" class="mb-4 fw-bold me-2 w-25 text-center">Longitudine</label>
                    <input type="text" name="lng" class="form-control" id="lng">
                </div>

                <div class="mb-3 d-flex ">
                    <label for="stato" class="mb-4 fw-bold me-2 w-25 text-center">Stato</label>
                    <div class="text-start">
                        <span class="mx-2" >Non attivo</span>
                        <label class="switch">
                            <input type="hidden" name="stato" input="0">
                            <input type="checkbox" name="stato" value="1" checked>
                            <span class="slider round"></span>
                        </label>
                        <span class="mx-2">Attivo</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Salva</button>
            </form>
        </div>

        
        <script>
            $('.summernote').summernote({
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
<script src="{{ asset('js/slug-generator.js') }}"></script>
@endsection