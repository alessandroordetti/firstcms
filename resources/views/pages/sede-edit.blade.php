@extends('layouts.users-index')

@section('content')

<section class="p-5">
    <div class="col-12">
        <h1 class="p-2">Modifica sede</h1>
    </div>

  <div class="container-fluid bg-white rounded border border-3 border-top py-4">
    <div class="row">
        <div class="col-10 mx-auto">
        <form action="{{route('sede-update', $sede->id)}}" method="POST" id="form">
                
                @if(session('errorMessage'))
                    <h2>{{session('errorMessage')}}</h2>
                @elseif(session('response'))
                    <h2>{{session('response')}}</h2>
                @elseif(session('queryError'))
                    <h2 class="text-danger text-center mb-3">{{session('queryError')}}</h2>
                @elseif(session('queryTitleError'))
                    <h2>{{session('queryTitleError')}}</h2>
                @elseif(session('success'))
                    <h2 class="text-success text-center mb-3">{{session('success')}}</h2>
                @endif
                
                @csrf 

                <div class="mb-3 d-flex align-items-center">
                    <label for="ateneo" class="mb-4 fw-bold me-2 w-25 h-100 text-center">Ateneo</label>
                    <select class="form-select mb-3" aria-label="Default select example" name="ateneo">
                        <option selected disabled>- Seleziona un Ateneo -</option>
                        <option value="unipegaso" {{($sede->ateneo == 'unipegaso' ? 'selected' : '')}}>Unipegaso</option>
                        <option value="mercatorum" {{($sede->ateneo == 'mercatorum' ? 'selected' : '')}}>Mercatorum</option> 
                    </select>
                </div>

                <div class="mb-3 d-flex">
                    <label for="titolo" class="mb-4 fw-bold me-2 w-25 text-center">Titolo</label>
                    
                    <div class="w-100 d-flex justify-content-between align-items-center rounded">
                        <input type="text" name="titolo" class="form-control" id="title" value="{{$sede->titolo}}" required>
                        <span class="form-control w-25" id="genera-url"><i class="fa-solid fa-arrows-rotate"></i> Genera</span>
                    </div>
                </div>

                <div class="mb-3 d-flex" id="slug-div">
                    <label for="slug" class="mb-4 fw-bold me-2 w-25 text-center">Slug</label>                   
                    <input type="text" name="slug" class="form-control h-100" value="{{$sede->slug}}" id="slug" required readonly placeholder="Per generare lo slug, inserisci nel campo titolo un valore valido dopodiché premi su Genera">            
                </div>

                <div class="mb-3 d-flex">
                    <label for="regione" class="mb-4 fw-bold me-2 w-25 text-center">Regione</label>
                    <select name="regione" id="regione" class="form-control">
                        <?php foreach ($regioni as $regione) { ?>
                            <option value="{{$regione->nome}}" <?php if ($regione->nome == $selectedRegione->nome) { ?>selected<?php } ?>>{{$regione->nome}}</option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3 d-flex">
                    <label for="provincia" class="mb-4 fw-bold me-2 w-25 text-center">Provincia</label>
                    <select name="provincia" id="provincia" class="form-control">
                        <?php foreach ($province as $provincia) { ?>
                            <option value="{{$provincia->nome}}" <?php if ($provincia->nome == $selectedProvincia->nome) { ?>selected<?php } ?>>{{$provincia->nome}}</option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3 d-flex">
                    <label for="citta" class="mb-4 fw-bold me-2 w-25 text-center">Città</label>
                    <select name="citta" id="citta" class="form-control">
                        <?php foreach ($comuni as $comune) { ?>
                            <option value="{{$comune->nome}}" <?php if ($comune->nome == $selectedComune->nome) { ?>selected<?php } ?>>{{$comune->nome}}</option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3 d-flex">
                    <label for="indirizzo" class="mb-4 fw-bold me-2 w-25 text-center">Indirizzo</label>
                    <input type="text" name="indirizzo" class="form-control" value="{{$sede->indirizzo}}" id="indirizzo" required>
                </div>
                
                <div class="mb-3 d-flex justify-content-between">
                    <label for="referenti" class="mb-4 fw-bold me-2 w-25 text-center">Referenti</label>
                    <input type="text" name="referenti" class="form-control" value="{{$sede->referenti}}" id="referenti" required> 
                </div> 

                <div class="mb-3 d-flex justify-content-between">
                    <label for="telefono" class="mb-4 fw-bold me-2 w-25 text-center">Telefono</label>
                    <input type="tel" name="telefono" class="form-control" value="{{$sede->telefono}}" id="telefono" required>
                </div>

                <div class="mb-3 d-flex">
                    <label for="email" class="mb-4 fw-bold me-2 w-25 text-center">Email</label>
                    <input type="email" name="email" class="form-control" value="{{$sede->email}}" id="email" required>
                </div>

                <div class="mb-3 d-flex">
                    <label for="lat" class="mb-4 fw-bold me-2 w-25 text-center">Latitudine</label>
                    <input type="text" name="lat" class="form-control" value="{{$sede->lat}}" id="lat" required>
                </div>

                <div class="mb-4 d-flex">
                    <label for="lng" class="mb-4 fw-bold me-2 w-25 text-center">Longitudine</label>
                    <input type="text" name="lng" class="form-control" value="{{$sede->lng}}" id="lng" required>
                </div>

                <div class="mb-3 d-flex ">
                    <label for="stato" class="mb-4 fw-bold me-2 w-25 text-center">Stato</label>
                    <div class="text-start">
                        <span class="mx-2" >Non attivo</span>
                        <label class="switch">
                            <input type="hidden" name="stato" value="0">
                            <input type="checkbox" name="stato" value="1" {{ ($sede->stato == 1) ? 'checked' : ''}}>
                            <span class="slider round"></span>
                        </label>
                        <span class="mx-2">Attivo</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Salva</button>
            </form>
        </div>

        
        <script>
            $('#summernote').summernote({
                tabsize: 2,
                height: 300,
                width: 1100
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
<script src="{{ asset('js/location-helper.js')}}"></script>

@endsection