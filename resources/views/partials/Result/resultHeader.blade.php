{{-- Poll unit title & date --}}
<div class="mb-4">
    {{-- Ubat date time epoch time ke date normal --}}
    @php
    $epoch_start = $vote_unit->date_start;
     $dt = new DateTime("@$epoch_start");  // convert UNIX timestamp to PHP DateTime
     $date_start = $dt->format('d-m-Y');

    $epoch_end = $vote_unit->date_end;
     $dt = new DateTime("@$epoch_end");  // convert UNIX timestamp to PHP DateTime
     $date_end = $dt->format('d-m-Y');

     // $date = new DateTime('07/09/2022'); // format: MM/DD/YYYY
     // echo $date->format('U');

     // echo time();

     $times = round(microtime(true));
     $ts = new DateTime("@$times");
     $today = $ts->format('d-m-Y');

 @endphp

    <h2 class="fw-bold">{{$vote_unit->title}}</h2>
    <p class="fst-italic">Waktu Polling {{$date_start}} s/d {{$date_end}}</p>
</div>
