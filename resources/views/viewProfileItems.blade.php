{{-- VIEW SHOW PROFILE --}}

@extends('layouts.main')

@section('child')

<link rel="stylesheet" href="{{ asset('css/uploadGalleryBox.css') }}">

<div class="container">
{{-- Cek Validasi Data Profile --}}
@if ($data_item)

{{-- Content --}}
<div class="col-md-10 mx-auto my-3 my-md-5">
    <h6 class="text-muted mb-3 mb-md-5">{{ $title }}</h6>


    <div class="card">
        <div class="card-header">
            <small class="text-secondary"><i class="fas fa-eye"></i> View Profile <strong>{{$data_item->vote_name}}</strong></small>
        </div>
        <div class="card-body">
            <div class="row d-flex align-items-center mb-5">
                <h6 class="text-muted mb-3">Basic Profile</h6>
                <div class="col-md-4 d-flex justify-content-center mb-3 mb-md-0">
                    <img src="{{asset('storage/'. $data_item->vote_image) }}" class="img-thumbnail img_thumb_2">
                </div>
                <div class="col-md-8">
                    {{-- File name thumbnail --}}
                    {{-- <input class="form-control mb-3" type="file"> --}}
                    {{-- Input Name & title --}}
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control mb-3 text-muted" placeholder="Name" aria-label="Name" value="{{ $data_item->vote_name }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control mb-3 " placeholder="Position" aria-label="Position" readonly>
                        </div>
                    </div>
                    {{-- Input description --}}
                    <textarea class="form-control mb-3 text-muted" placeholder="Bio" id="floatingTextarea2" style="height: 150px" value="{{$data_item->short_desc}}" readonly>{{$data_item->short_desc}}</textarea>
                </div>
            </div>

            {{-- @foreach ($data_item->voteProfile as $vp) --}}


            @if ($data_item->voteProfiles)

                <div class="row d-flex align-items-center mb-5">
                    <h6 class="text-muted mb-3">More Profile</h6>
                    @foreach ($data_item->voteProfiles as $vp)
                        <div class="col-md-4 d-flex justify-content-center p-0 p-md-3">
                            <img src="{{asset('storage/' . $vp->icon)}}" class="img-thumbnail img_thumb_2">
                        </div>
                        <div class="col-md-8 mt-3 mb-5 mt-md-0 mb-md-0">
                            {{-- <input class="form-control mb-3" type="file"> --}}
                            <input type="text" class="form-control mb-3 text-muted" placeholder="Title" aria-label="Title" value="{{$vp->title}}" readonly>
                            <div class="form-floating">
                                <textarea class="form-control py-2 text-muted" placeholder="Description" id="floatingTextarea2" style="height: 150px" value="{{$vp->description}}" readonly>{{$vp->description}}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>


                @livewire('store-gallery', ['data_item' => $data_item])

            @else

            @endif
            {{-- @endforeach --}}
        </div>
        <div class="card-footer">
            <div class="d-flex gap-2 float-end">
                @if (Auth::guard('admin')->user())
                    {{-- <a href="editPollItems" type="button" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i> Edit Profile</button> --}}
                        <a href="/admin/addItems/{{$data_item->vote_unit_id}}" class="btn btn-secondary btn-sm" type="button"><i class="fas fa-reply"></i> Back</a>
                @else
                <a href="/pollingUnit/{{$data_item->vote_unit_id}}" class="btn btn-secondary btn-sm" type="button"><i class="fas fa-reply"></i> Back</a>
                @endif
            </div>
        </div>
    </div>



</div>

@endif

</div>

<script src="js/pollForm.js"></script>
{{-- cdn add form --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection
