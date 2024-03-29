@extends('layouts.users-index')

@section('content')

<section class="p-5">

  <h1>Corsi di Laurea</h1>
  
  <div class="container-fluid bg-white rounded border border-3 border-top py-4">
    <div class="row">
        <div class="col-12">
            <form action="{{route('cdl-store')}}" method="POST">        
                @csrf 

                @if(session('errorMessage'))
                    <h2>{{session('errorMessage')}}</h2>
                @elseif(session('queryError'))
                    <h2 class="text-danger text-center mb-3">{{session('queryError')}}</h2>
                @endif

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
                    
                    <div class="w-100 d-flex justify-content-between align-items-center rounded">
                        <input type="text" name="titolo" class="form-control" id="title" required>
                        <span class="form-control w-25" id="genera-url"><i class="fa-solid fa-arrows-rotate"></i> Genera</span>
                    </div>
                </div>

                <div class="mb-3 d-flex" id="slug-div">
                    <label for="slug" class="mb-4 fw-bold me-2 w-25 text-center">Slug</label>                   
                    <input type="text" name="slug" class="form-control h-100" id="slug" required readonly placeholder="Per generare lo slug, inserisci nel campo titolo un valore valido dopodiché premi su Genera">            
                </div>

                <div class="mb-3 d-flex">
                    <label for="codice" class="mb-4 fw-bold me-2 w-25 text-center">Codice</label>
                    <input type="text" name="codice" class="form-control" id="codice" required>
                </div>

                <div class="mb-3 d-flex">
                    <label for="codice" class="mb-4 fw-bold me-2 w-25 text-center">Classe</label>
                    <input type="text" name="classe" class="form-control" id="classe" required>
                </div>

                <div class="mb-3 d-flex align-items-center">
                    <label for="tipologia" class="mb-4 fw-bold me-2 w-25 h-100 text-center">Tipologia</label>
                    <select class="form-select mb-3" aria-label="Default select example" name="tipologia">
                        <option selected disabled>- Seleziona una tipologia -</option>
                        <option value="triennale">Triennale</option>
                        <option value="magistrale-biennale">Magistrale-Biennale</option>
                        <option value="magistrale-ciclo-unico">Magistrale-Ciclo-Unico</option>
                    </select>
                </div>

                <div class="mb-3 d-flex align-items-center">
                    <label for="durata" class="mb-4 fw-bold me-2 w-25 h-100 text-center">Durata</label>
                    <select class="form-select mb-3" aria-label="Default select example" name="durata">
                        <option selected disabled>- Seleziona una durata -</option>
                        <option value="1">2 Anni</option>
                        <option value="2">3 Anni</option>
                        <option value="3">5 Anni</option>
                    </select>
                </div>
                <div class="mb-3 d-flex">
                    <label for="prezzo" class="mb-4 fw-bold me-2 w-25 text-center">Prezzo</label>
                    <input type="text" name="prezzo" class="form-control" id="classe" required>
                </div>

                <div class="mb-4 d-flex justify-content-between">
                    <label for="descrizione" class="mb-4 fw-bold me-2 w-25 text-center">Descrizione</label>
                    <textarea class="summernote" name="descrizione"></textarea>
                </div> 

                <div class="mb-4 d-flex justify-content-between">
                    <label for="obiettivi" class="mb-4 fw-bold me-2 w-25 text-center">Obiettivi</label>
                    <textarea class="summernote" name="obiettivi"></textarea>
                </div> 

                <div class="mb-4 d-flex justify-content-between">
                    <label for="sbocchi" class="mb-4 fw-bold me-2 w-25 text-center">Sbocchi</label>
                    <textarea class="summernote" name="sbocchi"></textarea>
                </div> 

                <div class="mb-4 d-flex justify-content-between">
                    <label for="conoscenze" class="mb-4 fw-bold me-2 w-25 text-center">Conoscenze</label>
                    <textarea class="summernote" name="conoscenze"></textarea>
                </div> 

                <div class="mb-4 d-flex justify-content-between">
                    <label for="contenuto" class="mb-4 fw-bold me-2 w-25 text-center">Contenuto</label>
                    <textarea class="summernote" name="contenuto"></textarea>
                </div> 

                <div class="mb-3 d-flex ">
                    <label for="tirocinio" class="mb-4 fw-bold me-2 w-25 text-center">Tirocinio</label>
                    <div class="text-start">
                        <span class="mx-2">No</span>
                        <label class="switch">
                            <input type="hidden" name="tirocinio" value="0">
                            <input type="checkbox" name="tirocinio" value="1">
                            <span class="slider round"></span>
                        </label>
                        <span class="mx-2">Si</span>
                    </div>
                </div>

                <div class="mb-3 d-flex ">
                    <label for="stage" class="mb-4 fw-bold me-2 w-25 text-center">Stage</label>
                    <div class="text-start">
                        <span class="mx-2">No</span>
                        <label class="switch">
                            <input type="hidden" name="stage" value="0">
                            <input type="checkbox" name="stage" value="1">
                            <span class="slider round"></span>
                        </label>
                        <span class="mx-2">Si</span>
                    </div>
                </div>


                <div class="mb-3 d-flex">
                    <label for="ateneo" class="mb-4 fw-bold me-2 w-25 text-center">Titolo Seo</label>
                    <input type="text" name="seo_title" class="form-control" id="input-text" required>
                </div>

                <div class="mb-4 d-flex">
                    <label for="descrizione_seo" class="mb-4 fw-bold me-2 w-25 text-center">Descrizione Seo</label>
                    <input type="text" name="seo_description" class="form-control" id="input-text" required>
                </div>

                <div class="mb-3 d-flex ">
                    <label for="stato" class="mb-4 fw-bold me-2 w-25 text-center">Stato</label>
                    <div class="text-start">
                        <span class="mx-2">Off</span>
                        <label class="switch">
                            <input type="hidden" name="stato" value="0">
                            <input type="checkbox" name="stato" value="1">
                            <span class="slider round"></span>
                        </label>
                        <span class="mx-2">On</span>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary mb-3">Salva</button>
            </form>
        </div>  
    </div>
  </div>
</section>

<script>
    $('.summernote').summernote({
        tabsize: 2,
        height: 300,
        width: 1200
    });
</script> 

<!-- SLUG GENERATOR SCRIPTO -->
<script src="{{ asset('js/slug-generator.js') }}"></script>
@endsection