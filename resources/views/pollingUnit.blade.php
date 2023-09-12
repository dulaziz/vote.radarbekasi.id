@extends('layouts.main')

@section('child')

<div class="container">

  {{-- Content --}}
  <div class="col-md-10 mx-auto my-2 my-md-5">

    <div class="d-md-none">
      @include('partials/Poll_Unit.pollUnitHeader')
    </div>
    {{-- Card Poll --}}
    <div class="card border-light rounded-3 shadow-sm mb-3" data-aos="zoom-in" data-aos-duration="1000">
        <div class="card-body">
          @include('partials/Poll_Unit.pollUnitHeaderCard')
          <hr>
          @include('partials/Poll_Unit.pollUnitItem')
          {{-- <hr class="d-none mt-3 d-md-block"> --}}
          {{-- @include('partials/Poll_Unit.pollUnitFooterCard') --}}
        </div>
    </div>
    
  </div>
    
  <div class="d-grid gap-2 d-md-flex justify-content-end d-md-none">
    <a class="text-end text-decoration-none mb-3" href="/" role="button"><i class="fas fa-reply"></i> Back</a>
  </div>
  
</div>

@endsection