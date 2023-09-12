{{-- Looping Data Polling  --}}
@foreach ($data_polling as $dp)

    @php
    $epoch_start = $dp->date_start;
    $dt = new DateTime("@$epoch_start");  // convert UNIX timestamp to PHP DateTime
    $date_start = $dt->format('d-m-Y');

    $epoch_end = $dp->date_end;
    $dt = new DateTime("@$epoch_end");  // convert UNIX timestamp to PHP DateTime
    $date_end = $dt->format('d-m-Y');

    // $date = new DateTime('07/09/2022'); // format: MM/DD/YYYY
    // echo $date->format('U');

    //    echo time();

    $times = round(microtime(true));
    $ts = new DateTime("@$times");
    $today = $ts->format('d-m-Y');
    @endphp

    <div class="container mt-5">
      <div class="col-md-10 mx-auto">

        <div class="row d-flex align-items-center mb-5 " data-aos="zoom-in">
          <div class="col-md-4 mb-3 mb-md-0">
            <img src="{{ 'storage/' . $dp->thumbnail }}" class="pstr_thumb" alt="">
          </div>

          <div class="col-md-8">
            @if ( $date_end <= $today)
              <a href="/pollingUnitBar/{{ encrypt($dp->id) }}" class="mb-3 text-decoration-none text-dark"><h2><strong>{{ $dp->title }}</strong></h2></a>
            @else
              <a href="/pollingUnit/{{ encrypt($dp->id) }}" class="mb-3 text-decoration-none text-dark"><h2><strong>{{ $dp->title }}</strong></h2></a>
            @endif

            <hr class="d-none d-md-block">

            <div class="d-none d-md-block">
              {!! $dp->description !!}
            </div>

            <div class="d-flex flex-column">
              @if ($epoch_end <= $times)
              <small class="text-danger fst-italic mb-1"><i class="fas fa-times-circle"></i> Closed Polling</small>
              @else
              <small class="text-success fst-italic mb-1"><i class="fas fa-check-circle"></i> Live Polling</small>
              <small>{{ $date_start }} s/d {{ $date_end }}</small>
              @endif
            </div>

            <div class="btn-group d-grid d-md-block mt-3">
              @if ($epoch_end <= $times)
                <a href="/pollingUnitBar/{{ encrypt($dp->id) }}" class="btn btn-primary mt-md-3" type="button">Lihat Polling</a>
              @else
                <a href="/pollingUnit/{{ encrypt($dp->id) }}" class="btn btn-primary mt-md-3" type="button">Ikuti Polling</a>
              @endif
              </div>
              <hr class="d-block d-md-none">

          </div>
        </div>
      </div>
    </div>

{{-- <div class="container">

    <div class="row d-flex align-items-center mb-5 col-md-10 mx-auto" data-aos="zoom-in">
      <div class="col-md-4 mb-3 mb-md-0">
        <img src="{{ 'storage/' . $dp->thumbnail }}" class="pstr_thumb" alt="">
      </div>
      <div class="col-md-8">
        @if ( $date_end <= $today)
          <a href="/pollingUnitBar/{{ encrypt($dp->id) }}" class="mb-3 text-decoration-none text-dark"><h2><strong>{{ $dp->title }}</strong></h2></a>
        @else
          <a href="/pollingUnit/{{ encrypt($dp->id) }}" class="mb-3 text-decoration-none text-dark"><h2><strong>{{ $dp->title }}</strong></h2></a>
        @endif
        <hr class="d-none d-md-block">
        <div class="d-none d-md-block">
          {!! $dp->description !!}
        </div>
        <div class="d-flex flex-column">
          @if ($epoch_end <= $times)
          <small class="text-danger fst-italic mb-1"><i class="fas fa-times-circle"></i> Closed Polling</small>
          @else
          <small class="text-success fst-italic mb-1"><i class="fas fa-check-circle"></i> Live Polling</small>
          <small>{{ $date_start }} s/d {{ $date_end }}</small>
        </div>
        @endif

        <div class="btn-group d-grid d-md-block mt-3">
        @if ($epoch_end <= $times)
          <a href="/pollingUnitBar/{{ encrypt($dp->id) }}" class="btn btn-primary mt-md-3" type="button">Lihat Polling</a>
        @else
          <a href="/pollingUnit/{{ encrypt($dp->id) }}" class="btn btn-primary mt-md-3" type="button">Ikuti Polling</a>
        @endif
        </div>
        <hr class="d-block d-md-none">
      </div>
    </div>

  </div> --}}
  {{-- <div class="card mb-3 border-0 shadow-sm" data-aos="zoom-in">
    <div class="row g-0 d-flex align-items-center">
      <div class="col-md-4">
        <img src="{{ 'storage/' . $dp->thumbnail }}" class="img-fluid img_card3" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body"> --}}
            {{-- Validasi date polling time --}}
            {{-- @if ( $date_end <= $today)
              <a href="/pollingUnitBar/{{ encrypt($dp->id) }}"><h5 class="mb-3"><strong>{{ $dp->title }}</strong></h5></a>
            @else
              <a href="/pollingUnit/{{ encrypt($dp->id) }}"><h5 class="mb-3"><strong>{{ $dp->title }}</strong></h5></a>
            @endif
              <p class="text-muted mb-3 card_desc">{{$dp->description}}
              </p>

              <div class="row d-flex align-items-center">

                <div class="col-md-8 mb-3 mb-md-0">
                  <p class="d-grid d-md-flex fst-italic mb-0 ">
                    @if ($epoch_end <= $times)
                    <small class="text-danger fst-italic"><i class="fas fa-times-circle"></i> Closed Polling </small>
                    @else
                    <small class="text-success fst-italic me-md-3"><i class="fas fa-check-circle"></i> Live Polling </small>
                    {{ $date_start }} s/d {{ $date_end }}
                </p>
                @endif --}}
                  {{-- @if ( $date_end <= $today)
                  <p class="text-danger float-md-start fst-italic me-2 mb-0"><i class="fas fa-times-circle"></i> Closed Polling</p>
                  @else
                  <p class="text-success float-md-start fst-italic me-2 mb-0"><i class="fas fa-check-circle"></i> Live Polling</p>
                  @endif
                  <p class="fst-italic mt-1 mt-md-0 mb-0">{{$date_start}} s/d {{$date_end}}</p> --}}
                {{-- </div>
                <div class="col-md-4 d-grid justify-content-md-end"> --}}
                  {{-- Validasi date polling time --}}
                  {{-- @if ($epoch_end <= $times)
                    <a href="/pollingUnitBar/{{ encrypt($dp->id) }}" class="btn btn-primary btn-sm" type="button">Lihat Polling</a>
                  @else
                    <a href="/pollingUnit/{{ encrypt($dp->id) }}" class="btn btn-primary btn-sm" type="button">Ikuti Polling</a>
                  @endif
                </div>

              </div>
        </div>
      </div>
    </div>
  </div> --}}


@endforeach
