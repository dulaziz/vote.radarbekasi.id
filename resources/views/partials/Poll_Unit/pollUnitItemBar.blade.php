{{-- Loop Iteration --}}
@php
    $i = 1;
@endphp

{{-- Looping data vote item --}}
@foreach ($polling_item as $item)


{{-- Vote Item --}}
<div class="row g-0 my-3">
  <div class="col-md-3 d-flex justify-content-center">
    {{-- Vote Thumbnail --}}
    <img src="{{ asset('storage/' . $item->vote_image) }}" class="img-thumbnail img_card" alt="...">
  </div>
  <div class="col-md-9 d-flex align-items-center">
    <div class="card-body px-0 ps-md-3">
      {{-- Vote Name --}}
      <div class="d-flex mb-3">
        {{-- <h5>{{$i++}}.</h5> --}}
        <div class="">
            <h2>{{ $item->vote_name }}</h2>
            {{-- <p class="card-text"><small class="text-muted">{{ $item->vote_position }}</small></p> --}}
            {{-- <p class="card-text"><small class="text-muted">{{ $item->short_desc }}</small></p> --}}
            {{-- <a href="/profile/{{ encrypt($item->id) }}">Profile</a> --}}
        </div>
      </div>
          {{-- Cari jumlah persentase dari pemilih --}}
          @php
            // Cek apakah ada data total user vote
            if($total_user_vote > 0){
                $total_vote = $item->response / $total_user_vote * 100;
            }else {
                $total_user_vote = 0;
                # jika tidak ada data total user vote
                $total_vote = $item->response;
            }
          @endphp
          <p class="text-primary mb-2">{{ round($total_vote) }}% Suara</p>
      <div class="progress">
          {{-- Validasi Login Role Admin --}}
            @if ($total_vote == 0)
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width:100%; background-color:#d5d5d5;" aria-valuenow="{{ $total_vote }}" aria-valuemin="0" aria-valuemax="100"></div>
            @else
                <div class="progress-bar progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $total_vote }}%" aria-valuenow="{{ $total_vote }}" aria-valuemin="0" aria-valuemax="100"></div>
            @endif
      </div>
      <hr class="d-block d-md-none">
    </div>
  </div>
</div>


@endforeach

