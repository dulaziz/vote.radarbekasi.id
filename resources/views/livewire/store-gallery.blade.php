<div>
    {{-- Stop trying to control. --}}
    <h6 class="mb-3 text-muted">Gallery: <span class="badge bg-success">{{ $data_item->vote_name }}</span></h6>
    <div class="border rounded p-2 d-block">
        @foreach ($data_item->voteProfiles as $v)
            @foreach (json_decode($v->gallery) as $key => $g)
                <img src="{{ asset('storage/'.$g) }}" class="img-fluid img_gallery" alt="...">
                {{-- <td>



                    @if($i === $g)
                        {{$i}}
                        <br>
                        {{$g}}
                        <button wire:click="kill({{ $i }})" class="btn-danger text-white w-32 px-4 py-1 hover:bg-red-600 rounded border">Sure?</button>
                    @else
                    @php
                        $data = $v->g;
                    @endphp
                        <button wire:click="confirmDelete({{json_encode($key)}})" class="btn-secondary text-dark w-32 px-4 py-1 hover:bg-red-600 rounded border">Delete</button>
                    @endif
                </td> --}}
            @endforeach
        @endforeach
    </div>
</div>
