<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="card my-5">
        <form wire:submit.prevent="storeProfile" method="post" enctype="multipart/form-data">
            @csrf

            <div class="card-header"><small class="text-success fst-italic"><i class="fas fa-check-circle"></i> Premium Profile Items</small></div>
            <div class="card-body">
            <div class="row d-flex align-items-center mb-5">
                <h5>More Profile</h5>
                <div class="col-md-3 d-flex justify-content-center mb-3 mb-md-0">
                    @if ($icon_profile)
                            <img src="{{ $icon_profile->temporaryUrl(); }}" class="img-thumbnail img_thumb_2">
                        @else
                            <img src="{{asset('img/default1.jpg')}}" class="img-thumbnail img_thumb_2">
                    @endif
                </div>
                <div class="col-md-9 mb-2">
                    <input class="form-control mb-3" type="file" wire:model="icon_profile">
                    @error('icon_profile')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    <input type="text" class="form-control mb-3" placeholder="Title" aria-label="Title" wire:model="title_profile">
                        @error('title_profile')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror

                        {{-- <textarea class="form-control mb-3" placeholder="Description" id="floatingTextarea2" style="height: 100px" wire:model="desc_profile"></textarea> --}}

                        {{-- Summernote --}}
                        <div wire:ignore>
                            {{-- <div id="summernote" wire:model="desc_profile" input="">Hello Summernote</div> --}}
                            <textarea type="text" input="desc_profile" id="summernote" class="form-control summernote">{{ $desc_profile }}</textarea>
                        </div>

                        @error('desc_profile')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror

                </div>
            </div>
            {{-- Gallery upload --}}
            <h5>Gallery</h5>
            <div class="upload__box">
                <div class="upload__btn-box">
                    <label class="upload__btn">
                        <p class="mb-0">Upload images</p>
                        <input type="file" data-max_length="20" class="upload__inputfile" wire:model="gallery">
                        @error('gallery.*')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                    </label>
                </div>
                <div class="upload__img-wrap">
                    @if($gallery)
                        @foreach ($gallery as $g)
                        {{-- <img src="{{ $g->temporaryUrl(); }}" alt="" class="img-thumbnail img_thumb_2"> --}}
                        <div class='upload__img-box'>
                                <div style='background-image: url("{{ $g->temporaryUrl(); }}")' class='img-bg' data-file='{{ $g->temporaryUrl(); }}'><div class='upload__img-close' wire:click="removeUpload('gallery','$g->temporaryUrl()')"></div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
            <div class="card-footer">
                <div class="gap-2 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success btn-sm" wire:click="$emitUp('profileAdded')"><i class="fas fa-save"></i> Save More Profile</button>
                    <a href="/admin/addItems/{{ $data_item->vote_unit_id }}" class="btn btn-secondary btn-sm" type="button"><i class="fas fa-reply"></i> Back</a>
                </div>
            </div>
        </form>
    </div>

    {{-- Looping Data Profile --}}
    <div class="my-5">
        <h6 class="mb-3">More Profile: <span class="badge bg-success">{{$data_item->vote_name}}</span></h6>
        <div class="table-responsive">
            <table class="table table-sm" style="width: 930px;">
                <thead class="fw-normal">
                <tr>
                    <th scope="col" style="width: 5%;">No</th>
                    <th scope="col" style="width: 20%;">Icon</th>
                    <th scope="col" style="width: 20%;">More Profile Title</th>
                    <th scope="col" style="width: 55%;">Desc</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach ($data_profile as $p)
                    <tr>
                        <th scope="row">{{ $i++  }}</th>
                        <td>
                            <img src="{{asset('storage/'. $p->icon)}}" alt="" style="width:45px; height:45px;">
                        </td>
                        <td>{{ $p->title }}</td>
                        <td>{{$p->description}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="my-5">
            <h6 class="mb-3">Gallery: <span class="badge bg-success">{{$data_item->vote_name}}</span></h6>
            @foreach ($data_profile as $p)
                @foreach (json_decode($p->gallery) as $g)
                    <img src="{{ asset('storage/' .$g)  }}" class="img-fluid img_gallery" alt="...">
                @endforeach
            @endforeach
        </div>
    </div>


</div>


<script>
    $(document).ready(function() {
        // $('#summernote').summernote();
        $('.summernote').summernote({
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
          callbacks: {
              onChange: function(contents, $editable) {
              @this.set('desc_profile', contents);
          }
      }
      });
    });

</script>

