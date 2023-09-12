@include('partials/Login.loginHeader')

{{-- Content --}}
<div style="
background-image: url('{{ asset('img/bg-log.jpg') }}');
background-size: 1380px 763px;
background-position: right 0px bottom 0px;
background-repeat: no-repeat;
">
<div class="col-md-10 mx-auto d-flex align-items-center" style="height: 100vh;">

  <div class="mx-auto">
    <div class="mb-3 d-flex justify-content-center">
        <img src="{{ asset('img/LOGO-RADAR-150x111.png')}}" alt="" class="img-fluid rounded">
    </div>
    @include('partials/Login.loginForm')
  </div>

</div>
</div>

@include('partials/Login.loginFooter')
