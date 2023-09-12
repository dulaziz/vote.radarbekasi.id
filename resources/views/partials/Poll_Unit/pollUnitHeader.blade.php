
  {{-- <h3 class="fw-bold mb-3" data-aos="fade-right" data-aos-duration="1000">{{ $polling_unit_with_items->title }}</h3>

  <div class="">
    <img class="img_thumb_artcl img-fluid" data-aos="fade-up" data-aos-duration="1500"
    src="{{ url('storage/' . $polling_unit_with_items->thumbnail) }}" alt="...">
  </div>

  <p class="mt-3 text-secondary" data-aos="fade-right" data-aos-duration="1500">{{ $polling_unit_with_items->description }}</p> --}}

  <div class="row d-flex align-items-center mb-5" data-aos="zoom-in">
    <h2 class="fw-bold mb-3 d-block d-md-none" data-aos="fade-right" data-aos-duration="1000">{{ $polling_unit_with_items->title }}</h2>
    <div class="col-md-4 mb-3 mb-md-0">
      <img src="{{ url('storage/' . $polling_unit_with_items->thumbnail) }}" class="pstr_thumb" alt="">
    </div>
    <div class="col-md-8">
      <h2 class="fw-bold mb-3 d-none d-md-block" data-aos="fade-right" data-aos-duration="1000">{{ $polling_unit_with_items->title }}</h2>
      <hr class="d-none d-md-block">
      <p>{!! $polling_unit_with_items->description !!}</p>

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
      {{-- Date --}}
      <p class="fst-italic mb-3" data-aos="fade-right" data-aos-duration="2000">Waktu Polling {{ $date_start }} s/d {{ $date_end }}</p>

    </div>
  </div>


{{-- Response --}}
@if ($message = Session::get('success'))
{{-- Allert after Vote --}}
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
{{-- End Response --}}

