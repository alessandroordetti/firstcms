@extends('layouts.users-index')

@section('content')

<section class="p-5">
    <div class="d-flex justify-content-between mb-4">
        <h3>Modifica il Corso di Laurea</h3>
        <a href="{{route('cdl-index')}}" class="btn btn-primary">Torna ai Corsi di Laurea</a>
    </div>

    <div class="container-fluid bg-white rounded border border-3 border-top py-4">
        <div class="row">
            <div class="col-12">

                @if(session('errorMessage'))
                    <h3>{{session('errorMessage')}}</h3>
                @elseif(session('queryError'))
                    <h3>{{session('queryError')}}</h3>
                @elseif(session('success'))
                    <h3 class="text-success text-center">{{session('success')}}</h3>
                @elseif(session('successMessage'))
                    <h3 class="text-success text-center">{{session('successMessage')}}</h3>
                @endif

                <form action="{{route('cdl-update', $cdl->id)}}" method="POST">
                    @csrf

                    <div class="mb-3 d-flex align-items-center">
                        <label for="ateneo" class="mb-4 fw-bold me-2 w-25 h-100 text-center">Ateneo</label>
                        <select class="form-select mb-3" aria-label="Default select example" name="ateneo">
                            <option selected disabled>- Seleziona un Ateneo -</option>
                            <option value="unipegaso" {{ ($cdl->ateneo == 'unipegaso') ? 'selected' : '' }}>Unipegaso</option>
                            <option value="mercatorum" {{ ($cdl->ateneo == 'marcatorum') ? 'selected' : '' }}>Mercatorum</option>
                        </select>
                    </div>
                    
                    <div class="mb-3 d-flex">
                    <label for="ateneo" class="mb-4 fw-bold me-2 w-25 text-center">Titolo</label>
                    
                    <div class="w-100 d-flex justify-content-between align-items-center rounded">
                        <input type="text" name="titolo" class="form-control" id="title" value="{{$cdl->titolo}}" required>
                        <span class="form-control h-100 w-25" id="genera-url"><i class="fa-solid fa-arrows-rotate"></i> Genera</span>
                    </div>
                </div>

                <div class="mb-3 d-flex" id="slug-div">
                    <label for="slug" class="mb-4 fw-bold me-2 w-25 text-center">Slug</label>                   
                    <input type="text" name="slug" class="form-control h-100" id="slug" value="{{$cdl->slug}}" required readonly placeholder="Per generare lo slug, inserisci nel campo titolo un valore valido dopodiché premi su Genera">            
                </div>

                <div class="mb-3 d-flex">
                    <label for="codice" class="mb-4 fw-bold me-2 w-25 text-center">Codice</label>
                    <input type="text" name="codice" class="form-control" id="codice" value="{{$cdl->codice}}" required>
                </div>

                <div class="mb-3 d-flex">
                    <label for="codice" class="mb-4 fw-bold me-2 w-25 text-center">Classe</label>
                    <input type="text" name="classe" class="form-control" id="classe" value="{{$cdl->classe}}" required>
                </div>

                <div class="mb-3 d-flex align-items-center">
                    <label for="tipologia" class="mb-4 fw-bold me-2 w-25 h-100 text-center">Tipologia</label>
                    <select class="form-select mb-3" aria-label="Default select example" name="tipologia">
                        <option selected disabled>- Seleziona una tipologia -</option>
                        <option value="1" {{ ($cdl->tipologia == 1) ? 'selected' : '' }}>Triennale</option>
                        <option value="2" {{ ($cdl->tipologia == 2) ? 'selected' : '' }}>Magistrale-Biennale</option>
                        <option value="3" {{ ($cdl->tipologia == 3) ? 'selected' : '' }}>Magistrale-Ciclo-Unico</option>
                    </select>
                </div>

                <div class="mb-3 d-flex align-items-center">
                    <label for="durata" class="mb-4 fw-bold me-2 w-25 h-100 text-center">Durata</label>
                    <select class="form-select mb-3" aria-label="Default select example" name="durata">
                        <option selected disabled>- Seleziona una durata -</option>
                        <option value="1" {{ ($cdl->tipologia == 1) ? 'selected' : '' }}>2 Anni</option>
                        <option value="2" {{ ($cdl->tipologia == 2) ? 'selected' : '' }}>3 Anni</option>
                        <option value="3" {{ ($cdl->tipologia == 3) ? 'selected' : '' }}>5 Anni</option>
                    </select>
                </div>
                <div class="mb-3 d-flex">
                    <label for="prezzo" class="mb-4 fw-bold me-2 w-25 text-center">Prezzo</label>
                    <input type="text" name="prezzo" class="form-control" id="classe" value="{{$cdl->prezzo}}" required>
                </div>

                <div class="mb-4 d-flex justify-content-between">
                    <label for="descrizione" class="mb-4 fw-bold me-2 w-25 text-center">Descrizione</label>
                    <textarea class="summernote" name="descrizione">{{$cdl->descrizione}}</textarea>
                </div> 

                <div class="mb-4 d-flex justify-content-between">
                    <label for="obiettivi" class="mb-4 fw-bold me-2 w-25 text-center">Obiettivi</label>
                    <textarea class="summernote" name="obiettivi">{{$cdl->obiettivi}}</textarea>
                </div> 

                <div class="mb-4 d-flex justify-content-between">
                    <label for="sbocchi" class="mb-4 fw-bold me-2 w-25 text-center">Sbocchi</label>
                    <textarea class="summernote" name="sbocchi">{{$cdl->sbocchi}}</textarea>
                </div> 

                <div class="mb-4 d-flex justify-content-between">
                    <label for="conoscenze" class="mb-4 fw-bold me-2 w-25 text-center">Conoscenze</label>
                    <textarea class="summernote" name="conoscenze">{{$cdl->conoscenze}}</textarea>
                </div> 

                <div class="mb-3 d-flex ">
                    <label for="tirocinio" class="mb-4 fw-bold me-2 w-25 text-center">Tirocinio</label>
                    <div class="text-start">
                        <span class="mx-2" value="1">No</span>
                        <label class="switch">
                            <input type="checkbox" name="tirocinio" value="1">
                            <span class="slider round"></span>
                        </label>
                        <span class="mx-2" value="0">Si</span>
                    </div>
                </div>

                <div class="mb-3 d-flex ">
                    <label for="stage" class="mb-4 fw-bold me-2 w-25 text-center">Stage</label>
                    <div class="text-start">
                        <span class="mx-2" value="1">No</span>
                        <label class="switch">
                            <input type="checkbox" name="stage" value="1">
                            <span class="slider round"></span>
                        </label>
                        <span class="mx-2" value="0">Si</span>
                    </div>
                </div>


                <div class="mb-3 d-flex">
                    <label for="ateneo" class="mb-4 fw-bold me-2 w-25 text-center">Titolo Seo</label>
                    <input type="text" name="seo_title" class="form-control" id="input-text" value="{{$cdl->seo_title}}" required>
                </div>

                <div class="mb-4 d-flex">
                    <label for="descrizione_seo" class="mb-4 fw-bold me-2 w-25 text-center">Descrizione Seo</label>
                    <input type="text" name="seo_description" class="form-control" id="input-text" value="{{$cdl->seo_description}}" required>
                </div>

                <div class="mb-3 d-flex ">
                    <label for="stato" class="mb-4 fw-bold me-2 w-25 text-center">Stato</label>
                    <div class="text-start">
                        <span class="mx-2" value="1">Off</span>
                        <label class="switch">
                            <input type="checkbox" name="stato" value="0">
                            <span class="slider round"></span>
                        </label>
                        <span class="mx-2" value="0">On</span>
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
<script src="{{ asset('js/cdl-slug.js') }}"></script>
@endsection