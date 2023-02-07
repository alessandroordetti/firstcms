@extends('layouts.sample-form')

@section('content')

<section class="p-5">
  <div class="col-10 mx-auto">
    <form>
      <div class="mb-3 d-flex align-items-center">
        <label for="ateneo" class="mb-4 me-2 w-25 text-center">Ateneo</label>
        <input type="text" name="ateneo" class="form-control" id="input-text">
      </div>

      <div class="mb-3 d-flex">
        <label for="ateneo" class="mb-4 me-2 w-25 text-center">Titolo</label>
        <input type="text" name="titolo" class="form-control" id="input-description">
      </div>

      <div class="mb-3 d-flex">
        <label for="ateneo" class="mb-4 me-2 w-25 text-center">Categoria</label>
        <select class="form-select" aria-label="Default select example">
          <option selected>- Seleziona una categoria -</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
      </div>

      <div class="mb-3 d-flex">
        <label for="ateneo" class="mb-4 me-2 w-25 text-center">Slug</label>
        <input type="text" name="slug" class="form-control" id="input-text">
      </div>

      <div class="mb-3 d-flex">
        <label for="ateneo" class="mb-4 me-2 w-25 text-center">Autore</label>
        <input type="text" name="autore" class="form-control" id="input-text">
      </div>

      <div class="mb-3 d-flex">
        <label for="ateneo" class="mb-4 me-2 w-25 text-center">Titolo Seo</label>
        <input type="text" name="seo_title" class="form-control" id="input-text">
      </div>

      <div class="mb-3 d-flex">
        <label for="descrizione_seo" class="mb-4 me-2 w-25 text-center">Descrizione Seo</label>
        <input type="text" name="seo_description" class="form-control" id="input-text">
      </div>

      <div class="mb-3 d-flex">
        <label for="stato" class="mb-4 me-2 w-25 text-center">Stato</label>
        <input type="text" name="state" class="form-control" id="input-text">
      </div>


      <div class="mb-3 d-flex justify-content-center">
        <textarea id="summernote" name="content"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Salva</button>
    </form>
  </div>
</section>


 
 <script>
  $('#summernote').summernote({
    tabsize: 2,
    height: 200,
    width: 800
  });
  </script>

@endsection