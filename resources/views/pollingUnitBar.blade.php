
@extends('layouts.main')

@section('child')

<div class="container">
  {{-- Content --}}
  <div class="col-md-10 mx-auto my-3 my-md-5">

    <div class="d-md-none">
    @include('partials/Poll_Unit.pollUnitHeader')
    </div>
      {{-- Card Poll --}}
      <div class="card border-light rounded-3 shadow-sm mb-3" data-aos="zoom-in" data-aos-duration="1000">
        <div class="card-body">
          @include('partials/Poll_Unit.pollUnitHeaderCard')
          <hr>
          @include('partials/Poll_Unit.pollUnitItemBar')

          @include('partials/Poll_Unit.pollUnitFooterCard')
        </div>
      </div>

      <div class="d-grid d-md-flex gap-2 justify-content-md-center">
          @if (Auth::guard('admin')->user())
          <a class="btn btn-primary btn-sm px-5" href="/admin/result/{{ $polling_unit_with_items->id }}" role="button"><i class="fa-solid fa-chart-bar"></i> Print result</a>
            <a href="{{ route('admin.home') }}" class="btn btn-secondary btn-sm float-end d-block d-md-none"><i class="fas fa-reply"></i> Back</a>
            @else
            <div class="d-grid gap-2 d-md-flex justify-content-end">
            <a href="{{ '/' }}" class="text-end text-decoration-none mb-3 d-block d-md-none"><i class="fas fa-reply"></i> Back</a>
          </div>
        @endif
      </div>

  </div>
</div>

</div>

@endsection
