{{-- <div class="row d-flex align-items-center flex-row-reverse">
    <div class="col-md-4">
        <h5 class="float-md-end mb-3 mb-md-0">{{$total_user_vote}} Suara</h5>
        <a href="/result" class="btn btn-primary btn-sm text-white mt-1" type="button"><i class="fa-solid fa-chart-bar"></i> Result</a>
    </div>
  <div class="col-md-8">
    <div class="d-grid d-md-flex gap-2">
      <a href="/result" class="btn btn-primary btn-sm text-white mt-1" type="button"><i class="fa-solid fa-chart-bar"></i> Result</a>
    </div>
  </div>
</div> --}}

  {{-- Validasi Login Role Admin --}}
  {{-- @if (Auth::guard('admin')->user()) --}}
    <h5 class="float-end mb-0">{{$total_user_vote}} Suara</h5>
  {{-- @endif --}}
