@php
    $i =1;
@endphp

{{-- Looping data polling --}}
@foreach ($polling_unit_with_items->vote_items as $pi)

{{-- Cek apakah ada data votings di unit ini --}}

@if ($polling_unit_with_items->votings)

        {{-- Cek jika user telah melakukan voting di unit ini --}}
        @if ($polling_unit_with_items->votings->user_vote == Auth::user()->id)

        {{-- Cek apakah id item sama dengan data item yang telah user voting --}}
        @if ($pi->id == $polling_unit_with_items->votings->vote_item_id && $polling_unit_with_items->votings->user_id == Auth::user()->id)


            {{-- Vote Item Bar --}}
            <div class="row g-0 my-3">
                <div class="col-md-3 d-flex justify-content-center">
                    {{-- Vote Thumbnail --}}
                    <img src="{{ asset('storage/' . $pi->vote_image) }}" class="img-thumbnail img_card" alt="...">
                    </div>
                    <div class="col-md-9 d-flex align-items-center">
                    <div class="card-body px-0 ps-md-3">
                        {{-- Vote Name --}}
                        <div class="d-flex">
                            <h5>{{$i++}}.</h5>
                            <div class="ms-1">
                                <h5 class="card-title mb-0">{{ $pi->vote_name }}</h5>
                                {{-- <p class="card-text mb-3"><small class="text-muted">{{ $pi->vote_position }}</small></p> --}}
                            </div>
                        </div>
                        <div class="progress" style="height: 2rem">
                            {{-- Cari jumlah persentase dari pemilih --}}
                            @php
                                // Cek apakah ada data total user vote
                                if($total_user_vote > 0){
                                    $total_vote = $pi->response / $total_user_vote * 100;
                                }else {
                                    $total_user_vote = 0;
                                    # jika tidak ada data total user vote
                                    $total_vote = $pi->response;
                                }
                            @endphp
                            @if ($total_vote == 0)
                                <div class="progress-bar text-dark" role="progressbar" style="width:100%; background-color:#d5d5d5;" aria-valuenow="{{ $total_vote }}" aria-valuemin="0" aria-valuemax="100">{{ $total_vote }}% / {{ $total_user_vote }} Suara</div>
                            @else
                                <div class="progress-bar" role="progressbar" style="width: {{ $total_vote }}%" aria-valuenow="{{ $total_vote }}" aria-valuemin="0" aria-valuemax="100">{{ $total_vote }}% / {{ $total_user_vote }} Suara</div>
                            @endif
                        </div>
                        <hr class="d-block d-md-none">
                    </div>
                </div>
            </div>

@else
    {{-- Vote Item Bar --}}
    <div class="row g-0 my-3">
        <div class="col-md-3 d-flex justify-content-center">
            {{-- Vote Thumbnail --}}
            <img src="{{ asset('storage/' . $pi->vote_image) }}" class="img-thumbnail img_card" alt="...">
            </div>
            <div class="col-md-9 d-flex align-items-center">
            <div class="card-body px-0 ps-md-3">
                {{-- Vote Name --}}
                <div class="d-flex mb-2">
                    {{-- <h5>{{$i++}}.</h5> --}}
                        <a href="/profile/{{ encrypt($pi->id) }}" class="text-decoration-none text-dark"><h2>{{ $pi->vote_name }}</h2></a>
                        {{-- <p class="card-text mb-0"><small class="text-muted">{{ $pi->vote_position }}</small></p> --}}
                        {{-- <a href="/profile/{{ encrypt($pi->id) }}">Profile</a> --}}
                </div>

                {{-- Vote progres bar --}}
                
                    {{-- Cari jumlah persentase dari pemilih --}}
                    @php
                        // Cek apakah ada data total user vote
                        if($total_user_vote > 0){
                            $total_vote = $pi->response / $total_user_vote * 100;
                        }else {
                            $total_user_vote = 0;
                            # jika tidak ada data total user vote
                            $total_vote = $pi->response;
                        }
                    @endphp
                    <p class="text-primary mb-2">{{ round($total_vote) }}% Suara</p>
                    <div class="progress">
                        @if ($total_vote === 0)
                            {{-- <div class="progress-bar text-dark" role="progressbar" style="width:100%; background-color:#d5d5d5;" aria-valuenow="{{ $total_vote }}" aria-valuemin="0" aria-valuemax="100">{{ $total_vote }}% / {{ $total_user_vote }} Suara</div> --}}
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width:100%; background-color:#d5d5d5;" aria-valuenow="{{ $total_vote }}" aria-valuemin="0" aria-valuemax="100"></div>
                        @else
                            {{-- <div class="progress-bar" role="progressbar" style="width: {{ $total_vote }}%" aria-valuenow="{{ $total_vote }}" aria-valuemin="0" aria-valuemax="100">{{ round($total_vote) }}% / {{ $total_user_vote }} Suara</div> --}}
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $total_vote }}%" aria-valuenow="{{ $total_vote }}" aria-valuemin="0" aria-valuemax="100"></div>
                        @endif
                    </div>
                

                <hr class="d-block d-md-none">
            </div>
        </div>
    </div>
@endif

@else
    {{-- Form Vote Item --}}
    <form action="{{ '/pollSurvey' }}" method="post">
            @csrf
            {{-- Value Vote +1 --}}
            <input type="hidden" name="response" value="{{ $total_user_vote +1 }}">
            {{-- Validasi User Login --}}
            {{-- @if (Auth::user()->id == $data_vote_user->user_vote) --}}
                <input type="hidden" name="user_vote" value="{{ Auth::user()->id }}">
            {{-- @endif --}}
                <input type="hidden" name="vote_unit_id" value="{{ $polling_unit_with_items->id }}">
            {{-- @foreach ($vote_unit as $v) --}}
                <input type="hidden" name="vote_item_id" value="{{$pi->id}}">
            {{-- @endforeach --}}

            <div class="row g-0 my-3">
                <div class="col-md-3 d-flex justify-content-center">
                    {{-- Vote Thumbnail --}}
                    <img src="{{ asset('storage/'.$pi->vote_image)}}" class=" img-thumbnail img_card" alt="...">
                </div>
                <div class="col-md-9 d-grid align-items-center py-3 ps-md-3">
                    {{-- Vote Name --}}
                    <div class="d-flex mb-3">
                        <h5>{{$i++}}.</h5>
                        <div class="ms-1">
                            <h5 class="card-title mb-o">{{$pi->vote_name}}</h5>
                            {{-- <p class="card-text"><small class="text-muted">{{ $pi->vote_position }}</small></p> --}}
                        </div>
                    </div>
                    <hr class="d-none d-md-block">
                    {{-- Validasi User Login --}}
                    @if (Auth::user())
                        {{-- Vote Button --}}
                        <div class="d-grid d-md-flex gap-2 col-md-2">
                            <a href="/profile/{{ $pi->id }}" class="btn btn-info btn-sm text-light px-5">Profile</a>
                            <button type="submit" class="btn btn-success btn-sm px-5">Vote</button>
                        </div>
                    @else
                        {{-- Vote Button Redirect Login --}}
                        <div class="d-grid d-md-flex gap-2 col-md-2">
                            <a href="/profile/{{ $pi->id }}" class="btn btn-info btn-sm text-light px-5">Profile</a>
                            <a href="{{ route('google.login') }}" class="btn btn-success btn-sm px-5">Vote</a>
                        </div>
                    @endif
                </div>
            </div>
            <hr class="d-md-none">
    </form>
@endif

@else
    {{-- Form Vote Item --}}
    <form action="{{ '/pollSurvey' }}" method="post">
            @csrf
            {{-- Value Vote +1 --}}
            @if ($data_user_vote)
                <input type="hidden" name="response" value="{{ $pi->response + 1 }}">
            @else
                <input type="hidden" name="response" value="{{ +1 }}">
            @endif
            {{-- Validasi User Login --}}
            {{-- @if (Auth::user()->id == $data_vote_user->user_vote) --}}
                <input type="hidden" name="user_vote" value="{{ Auth::user()->id }}">
            {{-- @endif --}}
            {{-- {{$polling_unit_with_items->response}} --}}
                <input type="hidden" name="vote_unit_id" value="{{ $polling_unit_with_items->id }}">
            {{-- @foreach ($vote_unit as $v) --}}
                <input type="hidden" name="vote_item_id" value="{{$pi->id}}">
            {{-- @endforeach --}}

            <div class="row g-0 my-3">
                <div class="col-md-3 d-flex justify-content-center">
                {{-- Vote Thumbnail --}}
                <img src="{{ asset('storage/'.$pi->vote_image)}}" class=" img-thumbnail img_card" alt="...">
                </div>
                <div class="col-md-9 d-grid align-items-center py-3 ps-md-3">

                    {{-- Vote Name --}}
                    <div class="d-flex mb-3 mb-md-0">
                        {{-- <h5>{{$i++}}.</h5> --}}
                        <div class="ms-1">
                            <h2 class="card-title mb-0 fw-bold">{{$pi->vote_name}}</h2>
                            {{-- <p class="card-text"><small class="text-muted">{{ $pi->vote_position }}</small></p> --}}
                        </div>
                    </div>
                    <hr class="d-none d-md-block my-0">
                    {{-- Validasi User Login --}}
                    @if (Auth::user())
                        {{-- Vote Button --}}
                        <div class="d-grid d-md-flex gap-2 col-md-2">
                            <a href="/profile/{{ encrypt($pi->id) }}" class="btn btn-info btn-sm text-light px-5">Profile</a>
                            <button type="submit" class="btn btn-success btn-sm px-5">Vote</button>
                        </div>
                    @else
                        {{-- Vote Button Redirect Login --}}
                        <div class="d-grid d-md-flex gap-2 col-md-2">
                            <a href="/profile/{{ $pi->id }}" class="btn btn-info btn-sm text-light px-5">Profile</a>
                            <a href="{{ route('google.login') }}" class="btn btn-success btn-sm px-5">Vote</a>
                        </div>
                    @endif
                </div>
            </div>
            <hr class="d-md-none">
    </form>
@endif

@endforeach
