@extends('layouts.users-index')

@section('content')

<section class="p-5">
    <div class="container-fluid bg-white rounded border border-3 border-top py-4">
        <div class="row mb-4">
            <div class="col-12">
                @foreach($pdfs as $pdf)
                    <p>{{$pdf}}</p>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection
