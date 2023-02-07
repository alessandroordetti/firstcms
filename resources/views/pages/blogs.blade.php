@extends('layouts.users-index')

@section('content')

<section class="p-5">
  <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <?php forEach($posts as $post) { ?>
                <p>{{$post}}</p>
            <?php } ?>
        </div>
    </div>
  </div>
</section>


@endsection