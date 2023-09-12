
@extends('layouts.frontLayout.main')

@section('child')

<div class="container">

{{-- Content --}}
<div class="col-md-10 mx-auto my-5">

  {{-- Title --}}
  <h3 class="fw-bold">{{ $polling_unit->title }}</h3>

  {{-- Desc --}}
  <p class="mt-4 text-secondary">{{ $polling_unit->description }}</p>

  @php
  $epoch_start = $polling_unit->date_start;
   $dt = new DateTime("@$epoch_start");  // convert UNIX timestamp to PHP DateTime
   $date_start = $dt->format('d-m-Y');

  $epoch_end = $polling_unit->date_end;
   $dt = new DateTime("@$epoch_end");  // convert UNIX timestamp to PHP DateTime
   $date_end = $dt->format('d-m-Y');

   // $date = new DateTime('07/09/2022'); // format: MM/DD/YYYY
   // echo $date->format('U');

//    echo time();

   $times = round(microtime(true));
   $ts = new DateTime("@$times");
   $today = $ts->format('d-m-Y');

@endphp

  <p class="fst-italic mb-3">Waktu Polling {{ $date_start }} s/d {{ $date_end }}</p>

    {{-- Card Vote --}}
  <div class="card border-light rounded-3 shadow-sm mb-3">
    <div class="card-body">

      {{-- Sub Title --}}
      <div class="row d-flex align-items-center">
        <div class="col-md-3">
            @if ( $date_end <= $today)
            <small class="text-danger  fst-italic"><i class="fas fa-times-circle"></i> Closed Polling</small>
            @else
            <small class="text-success fst-italic"><i class="fas fa-check-circle"></i> Live Polling</small>
            @endif
        </div>
        <div class="col-md-6">
          <h4 class="card-title text-md-center fw-bold">{{ $polling_unit->subtitle }}</h4>
        </div>
        <div class="col-md-3">

        </div>
      </div>
      <hr>

    {{-- Looping data vote item --}}

    @foreach ($polling_item as $item)


      {{-- Vote Item --}}
      <div class="row g-0 my-3">
        <div class="col-md-2">
          {{-- Vote Thumbnail --}}
          <img src="{{ asset('storage/' . $item->vote_image) }}" class="img-fluid img-thumbnail rounded" alt="...">
        </div>
        <div class="col-md-10 d-flex align-items-center">
          <div class="card-body">
            {{-- Vote Name --}}
            <h5 class="card-title fw-bold">{{ $item->vote_name }}</h5>
            <p class="card-text"><small class="text-muted">{{ $item->short_desc }}</small></p>
            <div class="progress" style="height: 2rem">
                {{-- Cari jumlah persentase dari pemilih --}}
                @php
                    $total_vote = $item->response / $total_user_vote * 100;
                @endphp
                <div class="progress-bar" role="progressbar" style="width: {{ $total_vote }}%" aria-valuenow="{{ $total_vote }}" aria-valuemin="0" aria-valuemax="100">{{ $total_vote }}% / {{ $total_user_vote }} Suara</div>
              </div>
          </div>
        </div>
      </div>


    @endforeach

      <hr>

      <div class="row d-flex flex-row-reverse">
          <div class="col-md-7">
              <h5 class="float-md-end">{{ $total_user_vote }} Suara</h5>
          </div>
        <div class="col-md-5">
            <a href="/editPolling" class="btn btn-success btn-sm mt-1" type="button"><i class="fas fa-pen"></i> Edit</a>
            <a href="/result" class="btn btn-primary btn-sm text-white mt-1" type="button"><i class="fa-solid fa-chart-bar"></i> Result</a>
            <button class="btn btn-warning btn-sm text-white mt-1" type="button"><i class="fa-solid fa-xmark"></i> Close</button>
            <button class="btn btn-danger btn-sm text-white mt-1" type="button"><i class="fa-solid fa-trash"></i> Delet</button>
            <a href="/admin" class="btn btn-secondary btn-sm mt-1" type="button"><i class="fas fa-reply"></i> Back</a>
        </div>
      </div>





    </div>
  </div>

</div>

</div>

@endsection
