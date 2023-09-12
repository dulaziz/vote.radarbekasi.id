@forelse ($products as $item)
<div class="text-center position-relative mb-4 mb-md-0">
    <img src="/storage/files/{{$item->product_image}}" class="rounded img_gallery" alt="...">
    <p class="mb-0 text-center">{{$item->product_name}}</p>
    <div class="position-absolute top-0 end-0 p-1">
        <button class="btn btn-sm btn-outline-primary" data-id="{{ $item->id }}" id="editBtn" style="border-radius: 50px;"><i class="fas fa-pen"></i></button>
        <button class="btn btn-sm btn-outline-danger" data-id="{{ $item->id }}" id="deleteBtn" style="border-radius: 50px;"><i class="fas fa-trash"></i></button>
    </div>
  </div>

    {{-- <div class="mb-3 position-relative">
        <img src="/storage/files/{{$item->product_image}}" alt="" class="img_gallery">
        <div class="">
            <p class="mb-0 text-center">{{$item->product_name}}</p>
            <div class="position-absolute top-0 end-0 p-1">
                <button class="btn btn-sm btn-outline-primary" style="border-radius: 50px;"><i class="fas fa-pen"></i></button>
                <button class="btn btn-sm btn-outline-danger" style="border-radius: 50px;"><i class="fas fa-trash"></i></button>
            </div>
        </div>
    </div> --}}
@empty
    <code>No product found</code>
@endforelse