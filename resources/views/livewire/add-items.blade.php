@section('child')

<div class="container">
  {{-- Content --}}
    <div class="col-md-10 mx-auto my-3 my-md-5">

    {{-- <h6 class="text-muted mb-5">{{ $title }}</h6> --}}

    {{-- @include('partials.addPolling') --}}
    {{-- @include('partials/poll_items/poll-header-items') --}}
    <h6>Polling Unit: <a class="fst-italic" href="{{ '/admin/pollingUnitBar/' . $vote_unit->id }}"> {{$vote_unit->title}}</a></h6>
    {{-- Polling item --}}
    
        @livewire('store-items', ['id_unit' => $id_unit,'vote_unit' => $vote_unit])
        
    </div>
</div>

@endsection
