<link rel="stylesheet" href="{{ asset('css/global.css') }}">

<form action="{{ '/addUnit' }}" method="post" id="image-form" enctype="multipart/form-data">
    <div class="row my-2">
        <div class="ml-2 col-md-3">
            <img src="" id="preview-thumbnail" class="img-thumbnail" style="max-width: 160px; max-height: 174px;">
        </div>
        <div class="col-md-9 mb-2">
            <div id="msg"></div>
            @csrf
            <label for="floatingInput title-text">Thumbnail*</label>
            <input type="file" name="thumbnail" class="file" id="input-file-thumbnail" accept="image/*">
            <div class="input-group mb-3">
                <input type="text" class="form-control" disabled placeholder="Upload File" id="file-thumbnail"
                    name="thumbnail">
                {{-- Response notif form input title --}}
                <div class="input-group-append">
                    <button type="button" class="browse btn btn-primary" id="browse-thumbnail">Browse...</button>
                </div>
            </div>
            @error('thumbnail')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
        </div>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" placeholder="Text" name="title"
            value="{{ old('title') }}">
        <label for="floatingInput title-text">Title *</label>
        {{-- Response notif form input title --}}
        @error('title')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
    </div>
    <div class="form-floating mb-3">
        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"
            name="description" value="{{ old('description') }}">{{ old('description') }}</textarea>
        <label for="floatingTextarea2">Description</label>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="floatingInput" placeholder="Text" name="date_start"
                    value="{{ old('date_start') }}">
                <label for="floatingInput title-text">Star from *</label>
                {{-- Response notif form input date start --}}
                @error('date_start')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="floatingInput" placeholder="Text" name="date_end"
                    value="{{ old('date_end') }}">
                <label for="floatingInput title-text">Expired *</label>
                {{-- Response notif form input date expired --}}
                @error('date_start')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
            </div>
        </div>
    </div>
    <hr>
    <div class="card border-light rounded-3 shadow-sm">
        <div class="card-body">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Text" name="subtitle"
                    value="{{ old('subtitle') }}">
                <label for="floatingInput">Sub Title</label>
            </div>
            <hr>
            <div id="form_item_tambah">
                {{-- <form action="{{ 'addItems' }}" method="post" id="image-form" enctype="multipart/form-data"> --}}
                {{-- @csrf --}}
                <input type="hidden" name="vote_unit_id" value="{{ $vote_unit_id_latest }}">
                <div class="row my-2">
                    <div class="ml-2 col-md-3">
                        <img src="" id="preview-item" class="img-thumbnail"
                            style="max-width: 160px; max-height: 174px;">
                    </div>
                    <div class="col-md-9 mb-2">
                        <div id="msg"></div>
                        <input type="file" name="vote_image" class="file" id="input-file-item"
                            accept="image/*">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" disabled placeholder="Upload File"
                                id="file-item" name="vote_image">
                            <div class="input-group-append">
                                <button type="button" class="browse btn btn-primary"
                                    id="browse-item">Browse...</button>
                            </div>
                        </div>
                        @error('vote_image')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @enderror
                        <input type="text" class="form-control mb-3" placeholder="Name*" aria-label="Name"
                            name="vote_name" value="{{ old('vote_name') }}">
                        @error('vote_name')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @enderror
                        <input type="text" class="form-control mb-3" placeholder="Short desc*"
                            aria-label="Short desc" name="short_desc" value="{{ old('short_desc') }}">
                        @error('short_desc')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @enderror
                        <button type="button" class="btn btn-primary btn-sm add_item_tambah"><i
                                class="fa-solid fa-plus"></i> Tambah</button>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-success btn-sm" type="submit"><i class="fa-solid fa-floppy-disk"></i>
                    Save</button>
                <a href="/admin" class="btn btn-secondary btn-sm" type="button"><i class="fas fa-reply"></i>
                    Back</a>
            </div>
            {{-- </form> --}}
            {{-- End Form Add Items --}}
        </div>
    </div>

</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // Function klik browse file thumbnail
    $(document).on("click", "#browse-thumbnail", function(e) {
        var file = $(this).parents().find("#input-file-thumbnail");
        file.trigger("click");
    });

    // Function klik browse file unit
    $(document).on("click", "#browse-item", function(e) {
        var file = $(this).parents().find("#input-file-item");
        file.trigger("click");
    });

    // Fucntion merubah file dari input thumbnail
    $('#input-file-thumbnail').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file-thumbnail").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview-thumbnail").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });

    // Fucntion merubah file dari input items
    $('#input-file-item').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file-item").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview-item").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });

    // Function menambah form
    $(document).ready(function() {
        $(".add_item_tambah").click(function(e) {
            e.preventDefault();
            $("#form_item_tambah").prepend(`<div class="row my-2">
        <div class="ml-2 col-md-3">
          <img src="" id="preview-item" class="img-thumbnail" style="max-width: 160px; max-height: 174px;">
        </div>
        <div class="col-md-9 mb-2">
          <div id="msg"></div>
          <form method="post" id="image-form">
            <input type="file" name="vote_image" class="file" id="input-file-item" accept="image/*">
            <div class="input-group mb-3">
              <input type="text" class="form-control" disabled placeholder="Upload File" id="file-item" name="vote_image">
              <div class="input-group-append">
                <button type="button" class="browse btn btn-primary" id="browse-item">Browse...</button>
              </div>
            </div>
          </form>
          <input type="text" class="form-control mb-3" placeholder="Name" aria-label="Name">
          <input type="text" class="form-control mb-3" placeholder="Short desc" aria-label="Short desc">
          <button type="button" class="btn btn-danger btn-sm remove_item_tambah"><i class="fa-solid fa-trash"></i> Hapus</button>
          <hr>
        </div>
      </div>`);
        });

        // Function menghapus form
        $(document).on('click', '.remove_item_tambah', function(e) {
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });
    });
</script>
{{-- <script src="js/script.js"></script> --}}
