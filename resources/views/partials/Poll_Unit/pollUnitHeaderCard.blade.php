@php
$epoch_start = $polling_unit_with_items->date_start;
 $dt = new DateTime("@$epoch_start");  // convert UNIX timestamp to PHP DateTime
 $date_start = $dt->format('d-m-Y');

$epoch_end = $polling_unit_with_items->date_end;
 $dt = new DateTime("@$epoch_end");  // convert UNIX timestamp to PHP DateTime
 $date_end = $dt->format('d-m-Y');

 // $date = new DateTime('07/09/2022'); // format: MM/DD/YYYY
 // echo $date->format('U');

//    echo time();

 $times = round(microtime(true));
 $ts = new DateTime("@$times");
 $today = $ts->format('d-m-Y');

@endphp
 {{-- Sub Title --}}
 <div class="row d-flex align-items-center">
    <div class="col-md-3 folat-star mb-3 mb-md-0">
      @if ($epoch_end <= $times)
        {{-- @if ( $date_end <= $today) --}}
        <small class="text-danger  fst-italic"><i class="fas fa-times-circle"></i> Closed Polling</small>
        @else
        <small class="text-success fst-italic"><i class="fas fa-check-circle"></i> Live Polling</small>
        @endif
    </div>
    <div class="col-md-6">
      <h4 class="card-title text-md-center">{{ $polling_unit_with_items->subtitle }}</h4>
    </div>
    <div class="col-md-3">
        @if (Auth::guard('admin')->user())
            <a href="{{ route('admin.home') }}" class="btn btn-outline-secondary btn-sm float-end d-none d-md-block">Back <i class="fas fa-reply"></i></a>
            @else
            <a href="{{ '/' }}" class="btn btn-outline-secondary btn-sm float-end d-none d-md-block">Back <i class="fas fa-reply"></i></a>
        @endif
    </div>
  </div>

