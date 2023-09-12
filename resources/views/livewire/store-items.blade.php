{{-- The Master doesn't talk, he acts. --}}

<form wire:submit.prevent="storeItems" method="post" id="image-form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" wire:model="postId">
        <div class="card my-3">
            <div class="card-header text-secondary">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-0 d-none d-md-block">Add Polling Items</h6>
                    </div>
                    <div class="col-md-6">
                        <small class="fst-italic float-md-end"><i class="fas fa-times-circle"></i> Basic Profile Items</small>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row d-flex align-items-center">
                    @if ($vote_image)
                        {{-- Thumbnail Poll Unit --}}
                        <div class="preview col-md-4 mb-3 mb-md-0 d-flex justify-content-center">
                            <img src="{{ $vote_image->temporaryUrl() }}" class="img-thumbnail img_thumb_2">
                        </div>
                    @else
                        {{-- Thumbnail Poll Unit --}}
                        <div class="preview col-md-4 mb-3 mb-md-0 d-flex justify-content-center">
                            <img src="{{ asset('img/default1.jpg') }}" id="file-ip-1-preview" class="img-thumbnail img_thumb_2">
                        </div>
                    @endif
                    <div class="col-md-8">
                        {{-- File name thumbnail --}}
                        <input class="form-control mb-3" type="file" id="file-ip-1" accept="image/*" onchange="showPreview(event);" name="vote_image" wire:model="vote_image">
                        {{-- Response notif form input vote image --}}
                        @error('vote_image')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                        {{-- Input Name & title --}}
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control mb-3" placeholder="Name" aria-label="Name" wire:model="vote_name">
                                {{-- Response notif form input short desc --}}
                                @error('vote_name')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ $message }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control mb-3" placeholder="Position" aria-label="Position" wire:model="vote_position">
                            </div>
                        </div>
                        {{-- Input description --}}
                        {{-- <textarea class="form-control mb-3" placeholder="Bio" id="floatingTextarea2" style="height: 100px" wire:model="short_desc"></textarea> --}}
                        <input type="text" class="form-control mb-3" placeholder="Short Desc" wire:model="short_desc">
                        @error('short_desc')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="gap-2 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Save Profile Items</button>
                    <a href="{{ route('admin.home') }}" class="btn btn-secondary btn-sm" type="button"><i class="fas fa-reply"></i> Back</a>
                </div>
            </div>
        </div>
</form>

{{-- <hr> --}}

<div class="my-5 col-lg-12">
    @if ($message = Session::get('success'))
        {{-- Alert After Create Item --}}
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Looping data items --}}
    {{-- <h6>Poll Items in "{{$data_unit->title}}"</h6> --}}

    <div class="table-responsive">
        <table class="table table-sm" style="width: 100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Profile Items</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($data_items as $item)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{$item->vote_name}}</td>
                        <td>{{$item->vote_position}}</td>

                        @if ($item->voteProfile)
                            <td><small class="text-success fst-italic"><i class="fas fa-check-circle"></i> Premium Profile Items</small></td>
                            <td>
                                {{-- <a href="/admin/showProfile/{{ $item->id }}" class="btn btn-info btn-sm text-light"><i class="fas fa-eye"></i> View</a> --}}
                                <a href="/admin/editPollItems/{{ $item->id }}" class="btn btn-primary btn-sm text-light"><i class="fas fa-pen"></i> Edit</a>
                                {{-- Delete Item --}}
                                <button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?') ? @this.deleteItem({{$item->id}}) : false"><i class="fas fa-trash"></i> Delete</button>
                            </td>
                        @else
                            <td><small class="text-secondary fst-italic"><i class="fas fa-times-circle"></i> Basic Profile Items </small></td>
                            <td>
                                <a href="/admin/editPollItems/{{ $item->id }}" class="btn btn-primary btn-sm text-light"><i class="fas fa-pen"></i> Edit</a>
                                <a href="/admin/moreProfile/{{ $item->id }} " class="btn btn-success btn-sm"><i class="fas fa-plus"></i> More Profile</a>
                                {{-- Delete Item --}}
                                <button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?') ? @this.deleteItem({{$item->id}}) : false"><i class="fas fa-trash"></i> Delete</button>
                            </td>
                        @endif

                        {{-- @foreach ($item->voteProfile as $p)
                            {{$p}}
                        @endforeach --}}

                            {{-- {{$data_items->voteProfile->id}} --}}


                            {{-- @if ($item->voteProfile->vote_item_id === 1)
                                <td>
                                    <a href="/moreProfile" class="btn btn-info btn-sm text-light"><i class="fas fa-eye"></i> View more profile</a>
                                </td>
                            @else
                                <td>
                                    <a href="/moreProfile/{{ $item->id }} " class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add more profile</a>
                                </td>
                            @endif --}}

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
