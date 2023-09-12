<div class="modal fade editProductModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('update.product') }}" method="post" enctype="multipart/form-data" id="update_form">
            @csrf
            <input type="hidden" name="pid">
            <div class="form-group mb-3">
                <label for="">Product Name</label>
                <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name">
                <span class="text-danger error-text product_name_error"></span>
            </div>
            <div class="form-group mb-3">
                <label class="mb-3" for="">Product Image <button id="clearInputFile" type="button" class="btn btn-danger btn-sm">Clear</button> </label>
                <input type="file" name="product_image_update" class="form-control" data-value="">
                <span class="text-danger error-text product_image_update_error"></span>
            </div>
            <div class="img-holder-update"></div>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>