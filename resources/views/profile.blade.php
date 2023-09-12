@extends('layouts.main')

@section('child')

{{-- @include('layouts.navbar') --}}

<link rel="stylesheet" href="{{ asset('css/slider.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<div class="container">
{{-- Content --}}
<div class="col-md-10 mx-auto my-3 my-md-5">

    {{-- Basic Profile Tes --}}
    <div class="row align-items-center d-flex flex-column-reverse flex-md-row mb-5">
        <div class="col-md-7">
            <div data-aos="fade-down" data-aos-duration="1000">
                <h1 class="card-title mb-0 fw-bold mb-3 mb-md-0 text-uppercase">{{$data_item->vote_name}}</h1>
                <hr class="mt-1 mb-3 d-none d-md-block">
                <p class="mb-1 fw-bold">{{$data_item->vote_position}}</p>
                <p class="fw-bold">{{ $data_item->short_desc }}</p>
            </div>
        </div>
        <div class="col-md-5 d-flex align-items-center justify-content-center profile_bgx mb-3">
            <img class="img_thumbx bg-white p-1 shadow" data-aos="zoom-out" data-aos-duration="1500" src="{{ asset('storage/' . $data_item->vote_image) }}" alt="...">
        </div>
    </div>



    {{-- Basic Profile Asli --}}
    {{-- <div class="d-block d-md-none" data-aos="fade-up" data-aos-duration="1500">
        <h4 class="card-title mb-0">{{$data_item->vote_name}}</h4>
        <p class="card-text"><small class="text-muted">{{$data_item->vote_position}}</small></p>
    </div>

    <div class="row align-items-center d-flex flex-column-reverse flex-md-row mb-5">
        <div class="col-md-7">
            <div data-aos="fade-down" data-aos-duration="1000">
                <div class="d-none d-md-flex mb-3">
                    <div class="ms-1">
                    <h4 class="card-title mb-0">{{$data_item->vote_name}}</h4>
                    <p class="card-text"><small class="text-muted">{{$data_item->vote_position}}</small></p>
                    </div>
                </div>
                <hr class="mt-1 mb-3 d-none d-md-block">
                <p>{{$data_item->short_desc}}</p>
            </div>
        </div>
        <div class="col-md-5 d-flex align-items-center profile_bg1">
            <img class="img_thumb1 bg-white p-1 shadow" data-aos="zoom-out" data-aos-duration="1500" src="{{ asset('storage/' . $data_item->vote_image) }}" alt="...">
        </div>
    </div> --}}




  {{-- Basic Profile --}}
  {{-- <div class="row g-0 d-flex align-items-center mb-5">
    <div class="col-md-4 mb-3 mb-md-0 d-flex justify-content-center justify-content-md-start">
        <img class="img_thumb img-fluid" data-aos="fade-up" data-aos-duration="1500" src="{{ asset('storage/' . $data_item->vote_image) }}" alt="...">
    </div>
      <div class="col-md-8 p-md-3">
        <div data-aos="fade-down" data-aos-duration="1000">
            <div class="d-none d-md-flex mb-3">
              <div class="ms-1">
                <h4 class="card-title mb-0">{{$data_item->vote_name}}</h4>
                <p class="card-text"><small class="text-muted">{{$data_item->vote_position}}</small></p>
              </div>
            </div>
            <hr class="mt-1 mb-3 d-none d-md-block">
            <p>{{$data_item->short_desc}}</p>
        </div>
    </div>
  </div> --}}

  @if ($data_item->voteProfile)
  {{-- {{$data_item->voteProfile->title}} --}}

  {{-- More Profile --}}
  {{-- <ul class="nav nav-pills mb-3 d-flex justify-content-between justify-content-md-start" id="pills-tab" role="tablist">
        @foreach ($data_item->voteProfiles  as $d)
        <li class="nav-item me-2" role="presentation">
            <button class="nav-link" id="pills-{{$d->title}}" data-bs-toggle="pill" data-bs-target="#pills-{{ $d->title }}" type="button" role="tab" aria-controls="pills-{{$d->title}}" aria-selected="true">{{$d->title}}</button>
        </li>
        @endforeach
    </ul> --}}

    {{-- @endforeach --}}
    @foreach ($data_item->voteProfiles as $d)

<div class="row mb-5">
    <div class="col-md-3 mb-3 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center profile_bg2">
        <img src="{{ asset('storage/' . $d->icon)}}" alt="..." class="img-fluid" style="max-width: 230px;
        filter: drop-shadow(-3px 3px 3px #14141466);" data-aos="fade-up" data-aos-duration="1500">
    </div>
    <div class="col-md-9" data-aos="fade-down" data-aos-duration="1000">
        <h4 class="card-title text-uppercase mb-1">{{ $d->title }}</h4>
        <p class="card-text">{!! $d->description !!}</p>
    </div>
</div>

    {{-- <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-{{$d->title}}" role="tabpanel" aria-labelledby="pills-{{$d->title}}">
        <div class="row g-0 d-flex align-items-center">
            <div class="col-md-3 d-flex justify-content-center">
                <img src="{{ asset('storage/' . $d->icon)}}" alt="..." class="img-fluid" style="max-width: 150px;" data-aos="fade-up" data-aos-duration="1500">
            </div>
            <div class="col-md-9">
            <div class="card-body px-0 px-md-3" data-aos="fade-down" data-aos-duration="1000">
                <h4 class="card-title text-uppercase mb-1">{{ $d->title }}</h4>
                <p class="card-text">{{$d->description}}</p>
            </div>
            </div>
        </div>
        </div>
        <div class="tab-pane fade" id="" role="tabpanel" aria-labelledby="pills-{{ $d->title }}-tab">
            <div class="row g-0 d-flex align-items-center">
                <div class="col-md-3 d-flex justify-content-center">
                    <img src="/img/graph.png" alt="..." class="img-fluid" style="max-width: 150px;">
                </div>
                <div class="col-md-9">
                <div class="card-body px-0 px-md-3">
                    <h4 class="card-title text-uppercase mb-1">{{ $d->title }}</h4>
                    <p class="card-text">{{$d->description}}</p>
                </div>
                </div>
            </div>
        </div>
    </div> --}}

@endforeach

    {{-- Gallery --}}
    @if ($data_item->voteProfiles)
    <div class="my-5">
        {{-- <h5 class="border-start border-danger border-4 text-uppercase ps-2 fw-bold rb-blue-tx" data-aos="fade-down" data-aos-duration="1000">Photo</h5> --}}
            {{-- Lopping Image --}}
            @foreach ($data_item->voteProfiles as $item)
            <div class="slider">
                    @foreach (json_decode($item->gallery) as $g)
                    <a href="{{asset('storage/' . $g)}}" class="fancybox item" data-fancybox="gallery1">
                    <img src="{{asset('storage/' . $g)}}" class="img-fluid img_slick" alt="...">
                    @endforeach
                </div>
            @endforeach
    </div>
    @endif

    <div class="d-grid gap-2 d-md-flex justify-content-end">
        @if (Auth::guard('admin')->user())
            <a href="/admin/addItems/{{$data_item->vote_unit_id}}" class="text-end text-decoration-none mb-3" type="button"><i class="fas fa-reply"></i> Back</a>
        @endif
    </div>

    @endif
    <div class="d-grid gap-2 d-md-flex justify-content-end">
        <a href="/pollingUnit/{{encrypt($data_item->vote_unit_id)}}" class="text-end text-decoration-none mb-3" type="button"><i class="fas fa-reply"></i> Back</a>
    </div>
</div>

</div>

<script src="{{ asset('js/slider.js')}}" type="text/javascript"></script>

@endsection
