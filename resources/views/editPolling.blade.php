
@extends('layouts.main')

@section('child')

<div class="container">
{{-- Content --}}
<div class="col-md-10 mx-auto my-3 my-md-5">
    <h6 class="text-muted mb-3 mb-md-5">{{ $title }}: <a class="fst-italic" href="{{ '/admin/pollingUnitBar/' . $vote_unit->id }}"> {{$vote_unit->title}}</a></h6>

  {{-- Response --}}
  @if ($message = Session::get('success'))
  {{-- Allert after Vote --}}
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>{{ $message }}</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  @endif
  {{-- End Response --}}

    <div class="card">
        <form action="{{ '/admin/editPolling/' . $vote_unit->id }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h6 class="mb-0 text-muted"><i class="fas fa-pen"></i> Edit Polling Unit</h6>
            </div>
            <div class="card-body">
                <div class="row my-2 d-flex align-items-center">
                    @if($vote_unit->thumbnail)
                        {{-- Thumbnail Poll Unit --}}
                        <div class="preview col-md-4 my-3">
                            <img src="{{ asset('storage/' . $vote_unit->thumbnail) }}" id="file-ip-1-preview" class="img-thumbnail img_thumb_upl">
                            
                            {{-- File name thumbnail --}}
                            <input class="form-control mt-2" type="hidden" value="{{ $vote_unit->thumbnail }}" name="thumbnail_old">
                            <input class="form-control mt-2" type="file" id="file-ip-1" accept="image/*" onchange="showPreview(event);" name="thumbnail">
                            {{-- Response notif form input thumbnail --}}
                            @error('thumbnail')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @enderror
                        </div>
                    @else
                        {{-- Thumbnail Poll Unit --}}
                        <div class="preview col-md-4 my-3">
                            <img src="{{ asset('img/default1.jpg') }}" id="file-ip-1-preview" class="img-thumbnail img_thumb_upl">

                            {{-- File name thumbnail --}}
                            <input class="form-control mt-2" type="hidden" value="{{ $vote_unit->thumbnail }}" name="thumbnail_old">
                            <input class="form-control mt-2" type="file" id="file-ip-1" accept="image/*" onchange="showPreview(event);" name="thumbnail">
                            {{-- Response notif form input thumbnail --}}
                            @error('thumbnail')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @enderror
                        </div>
                    @endif

                    <div class="col-md-8 mb-2">
                    {{-- Input title --}}
                    <input type="text" class="form-control mb-3" placeholder="Title" aria-label="Title" value="{{ $vote_unit->title }}" name="title">
                     {{-- Response notif form input thumbnail --}}
                     @error('title')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    {{-- Input subtitle --}}
                    <input type="text" class="form-control mb-3" placeholder="Subtitle" aria-label="Subtiitle" value="{{ $vote_unit->subtitle }}" name="subtitle">
                     {{-- Response notif form input thumbnail --}}
                     @error('subtitle')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    {{-- Input description --}}
                    {{-- <textarea class="form-control mb-3" placeholder="Description" id="floatingTextarea2" style="height: 100px" value="{{ $vote_unit->description }}" name="description">{{ $vote_unit->description }}</textarea> --}}
                    <textarea class="form-control" id="edit_summer" value="{{ $vote_unit->description }}" name="description">{{ $vote_unit->description }}</textarea>
                     {{-- Response notif form input thumbnail --}}
                     @error('description')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    {{-- Input date --}}
                    <div class="row mt-3">

                        {{-- Convert Date Time --}}
                        @php
                            $epoch_start = $vote_unit->date_start;
                            $dt = new DateTime("@$epoch_start");  // convert UNIX timestamp to PHP DateTime
                            $date_start = $dt->format('d/m/Y');

                            $epoch_start = $vote_unit->date_start;
                            $dt = new DateTime("@$epoch_start");  // convert UNIX timestamp to PHP DateTime
                            $date_start_old = $dt->format('m/d/Y');

                            $epoch_end = $vote_unit->date_end;
                            $dt = new DateTime("@$epoch_end");  // convert UNIX timestamp to PHP DateTime
                            $date_end = $dt->format('d/m/Y');

                            $epoch_end = $vote_unit->date_end;
                            $dt = new DateTime("@$epoch_end");  // convert UNIX timestamp to PHP DateTime
                            $date_end_old = $dt->format('m/d/Y');

                            // $date = new DateTime('07/09/2022'); // format: MM/DD/YYYY
                            // echo $date->format('U');

                            //    echo time();

                            $times = round(microtime(true));
                            $ts = new DateTime("@$times");
                            $today = $ts->format('d-m-Y');

                        @endphp

                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="form-floating">
                                <input class="form-control-edit" type="hidden" name="date_start_old" id="floatingInput" value="{{ $date_start_old }}">
                                <input class="form-control-edit" type="text" name="date_start" id="floatingInput" placeholder="{{$date_start}}" onfocus="(this.type='date')">
                                <label for="floatingInput title-text" class="label-form-control-input">Start Date</label>
                                 {{-- Response notif form input thumbnail --}}
                                 @error('date_start')
                                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                     <strong>{{ $message }}</strong>
                                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                 </div>
                             @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input class="form-control-edit" type="hidden" name="date_end_old" id="floatingInput" value="{{ $date_end_old }}">
                                <input type="text" class="form-control-edit" id="floatingInput" placeholder="{{ $date_end }}" name="date_end" onfocus="(this.type='date')">
                                <label for="floatingInput title-text" class="label-form-control-input">Expired</label>
                                {{-- Response notif form input thumbnail --}}
                                @error('date_end')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ $message }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="gap-2 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Save Polling Unit</button>
                    <a href="/admin" class="btn btn-secondary btn-sm" type="button"><i class="fas fa-reply"></i> Back</a>
                </div>
            </div>
        </form>
    </div>

</div>

</div>

<script src="js/pollForm.js"></script>
{{-- cdn add form --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</div>

<script>
    $(document).ready(function() {
        // $('#summernote').summernote();
        $('#edit_summer').summernote({
          tabsize: 2,
          height: 200,
          toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'underline', 'clear']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['table', ['table']],
              ['insert', ['link']]
          ],

      });
    });
</script>

@endsection



