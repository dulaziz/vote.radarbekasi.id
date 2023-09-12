// Thumbnail Preview
function showPreview(event){
    if(event.target.files.length > 0){
      var src = URL.createObjectURL(event.target.files[0]);
      var preview = document.getElementById("file-ip-1-preview");
      preview.src = src;
    }
  }
  // Thumbnail poll items preview
  function showPreview2(event){
    if(event.target.files.length > 0){
      var src = URL.createObjectURL(event.target.files[0]);
      var preview = document.getElementById("file-ip-2-preview");
      preview.src = src;
    }
  }
  
  // Add poll item form
  // $(document).ready(function() {
  //     $(".add_item_btn").click(function(e) {
  //       e.preventDefault();
  //       $("#form_item_add").prepend(`<div class="row my-5 d-flex align-items-center">
  //       <div class="preview col-md-3 d-flex justify-content-center my-3">
  //           <img src="img/default2.jpg" id="file-ip-2-preview" class="img-thumbnail img_thumb_2">
  //       </div>
  //     <div class="col-md-9 mb-2">
  //       <input class="form-control mb-3" type="file" id="file-ip-2" accept="image/*" onchange="showPreview2(event);">
  //       <div class="row">
  //         <div class="col-md-6">
  //           <input type="text" class="form-control mb-3" placeholder="Name" aria-label="Name">
  //         </div>
  //         <div class="col-md-6">
  //           <input type="text" class="form-control mb-3" placeholder="Position" aria-label="Position">
  //         </div>
  //       </div>
  //       <div class="form-floating">
  //         <textarea class="form-control mb-3" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
  //         <label for="floatingTextarea2">Profile</label>
  //       </div>
  //       <button type="button" class="btn btn-danger btn-sm remove_item_btn"><i class="fa-solid fa-trash"></i> Delete</button>
  //     </div>   
  //   </div>`);
  //     });  
  
  //     $(document).on('click', '.remove_item_btn', function(e) {
  //       e.preventDefault();
  //       let row_item = $(this).parent().parent();
  //       $(row_item).remove();
  //     });
  //   });