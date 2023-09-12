@extends('layouts.main')

@section('child')

<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- Content --}}
<div class="col-md-10 mx-md-auto my-5">

          <div class="card">
            <div class="card-body">
                <div class="row mb-5 d-flex align-items-center">
                    <div class="col-md-3 d-flex justify-content-center justify-content-md-start mb-3 mb-md-0">
                        <div class="img-holder">
                            <img src="img/default1.jpg" class="img_card img-thumbnail" alt="">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <form action="{{route('save.product')}}" method="post" enctype="multipart/form-data" id="form">
                            @csrf
                              <div class="form-group mb-3">
                                  <input type="text" name="product_name" class="form-control" placeholder="Enter product name">
                                  <span class="text-danger error-text product_name_error"></span>
                              </div>
                              <div class="form-group mb-3">
                                  <input type="file" name="product_image" class="form-control">
                                  <span class="text-danger error-text product_image_error"></span>
                              </div>
                              <button type="submit" class="btn btn-primary">Save Product</button>
                          </form>
                    </div>
                </div>
                  <div class="d-md-flex" id="AllProducts"></div>
            </div>
          </div>
    
</div>

@include('edit-product-modal')

<script src="js/script.js"></script>

<script>
    $(function(){
            $('#form').on('submit', function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        $(form).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.code == 0){
                            $.each(data.error, function(prefix,val){
                                $(form).find('span.'+prefix+'_error').text(val[0]);
                            });
                        }else{
                            $(form)[0].reset();
                             // alert(data.msg);
                            fetchAllProducts();
                        }
                    }
                });
            });

            //Reset input file
            $('input[type="file"][name="product_image"]').val('');
            //Image preview
            $('input[type="file"][name="product_image"]').on('change', function(){
                var img_path = $(this)[0].value;
                var img_holder = $('.img-holder');
                var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();

                if(extension == 'jpeg' || extension == 'jpg' || extension == 'png'){
                     if(typeof(FileReader) != 'undefined'){
                          img_holder.empty();
                          var reader = new FileReader();
                          reader.onload = function(e){
                              $('<img/>',{'src':e.target.result,'class':'img_card img-thumbnail'}).appendTo(img_holder);
                          }
                          img_holder.show();
                          reader.readAsDataURL($(this)[0].files[0]);
                     }else{
                         $(img_holder).html('This browser does not support FileReader');
                     }
                }else{
                    $(img_holder).empty();
                }
            });

            //Fetch all products
            fetchAllProducts();
            function fetchAllProducts(){
                $.get('{{route("fetch.products")}}',{}, function(data){
                     $('#AllProducts').html(data.result);
                },'json');
            }

            //Edit product
            $(document).on('click','#editBtn', function(){
                var product_id = $(this).data('id');
                var url = '{{ route("get.product.details") }}';
                $.get(url,{product_id:product_id}, function(data){
                    // alert(data.result.product_name);
                    var product_modal = $('.editProductModal');
                    $(product_modal).find('form').find('input[name="pid"]').val(data.result.id);
                    $(product_modal).find('form').find('input[name="product_name"]').val(data.result.product_name);
                    $(product_modal).find('form').find('.img-holder-update').html('<img src="/storage/files/'+data.result.product_image+'" class="img-fluid" style="max-width:100px; margin-bottom:10px;">');
                    $(product_modal).find('form').find('input[type="file"]').attr('data-value', '<img src="/storage/files/'+data.result.product_image+'" class="img-fluid" style="max-width:150px; margin-bottom:10px;">');
                    $(product_modal).find('form').find('input[type="file"]').val("");
                    $(product_modal).find('form').find('span.error-text').text('');

                    $(product_modal).modal('show');
                },'json');
            });

            //Change image
            $('input[type="file"][name="product_image_update"]').on('change', function(){
                var img_path = $(this)[0].value;
                var img_holder = $('.img-holder-update');
                var currentImagePath = $(this).data('value');
                var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();
                if(extension == 'jpg' || extension == 'jpeg' || extension == 'png'){
                    if(typeof(FileReader) != 'undefined'){
                        img_holder.empty();
                        var reader = new FileReader();
                        reader.onload = function(e){
                            $('<img/>',{'src':e.target.result, 'class':'img-fluid', 'style':'max-width:100px;margin-bottom:10px;'}).appendTo(img_holder);
                        }
                        img_holder.show();
                        reader.readAsDataURL($(this)[0].files[0]);
                    }else{
                        $(img_holder).html('This browse not support FileReader');
                    }
                }else{
                    $(img_holder).html(currentImagePath);
                }
            });

            //Clear img
            $(document).on('click','#clearInputFile',function(){
                var form = $(this).closest('form');
                $(form).find('input[type="file"]').val('');
                $(form).find('.img-holder-update').html($(form).find('input[type="file"]').data('value'));
            });

            //Update product
            $('#update_form').on('submit', function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        $(form).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.code == 0){
                            $.each(data.error, function(prefix, val){
                                $(form).find('span.'+prefix+'_error').text(val[0]);
                            });
                        }else{
                            alert(data.msg);
                            fetchAllProducts();
                            $('.editProductModal').modal('hide');
                        }
                    }
                })
            });

            //Delete product
            $(document).on('click','#deleteBtn', function(){
                var product_id = $(this).data('id');
                var url = '{{ route("delete.product") }}';

                if(confirm('Are you sure want to delete?')){
                    $.ajax({
                        headers:{
                            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                        },
                        url:url,
                        method:'POST',
                        data:{product_id:product_id},
                        dataType:'json',
                        success: function(data){
                            if(data.code == 1){
                                fetchAllProducts();
                            }else{
                                alert(data.msg);
                            }
                        }
                    })
                }
            })

    })
</script>

<script>
    
</script>

@endsection