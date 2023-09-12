<div class="card shadow-sm border-0" style="width: 19rem;">
    <div class="card-body">
      <h6 class="card-title text-muted mb-4">Login</h6>
       {{-- Response --}}
        @if ($message = Session::get('fail'))
        {{-- Allert after Vote --}}
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Response --}}
      <form action="{{ route('admin.check') }}" method="post">
        @csrf
        <div class="mb-3">
          <input type="text" class="form-control bg-light" placeholder="Username" id="username" aria-describedby="username" name="email">
           {{-- Response notif form input email --}}
            @error('email')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control bg-light pwd" placeholder="Password" id="exampleInputPassword1" name="password">
          <button class="btn btn-outline-secondary reveal" type="button" id="button-addon2"><i class="fas fa-eye"></i></button>
          {{-- Response notif form input email --}}
          @error('password')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @enderror
        </div>
        {{-- <div class="mb-3">
            <input type="password" class="form-control bg-light" placeholder="Password" id="exampleInputPassword1" name="password">
             @error('password')
                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                     <strong>{{ $message }}</strong>
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
             @enderror
        </div> --}}
        <hr>
        <div class="d-grid">
            <button type="submit" class="btn btn-outline-primary">Login</button>
        </div>
      </form>
    </div>
  </div>
