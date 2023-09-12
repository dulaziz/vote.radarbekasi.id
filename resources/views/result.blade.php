
@extends('layouts.main')

@section('child')

{{-- Print style --}}
<link rel="stylesheet" type="text/css" media="print" href="{{ asset('css/print.css') }}">

  <div class="container">

    {{-- Content --}}
    <div class="col-md-10 mx-auto my-5">

    {{-- Polling unit --}}
    <h6 class="text-muted mb-5">{{ $title }}</h6>

      <div class="print-container">

        @include('partials/Result.resultHeader')

        @include('partials/Result.resultTable')

      </div>

        @include('partials/Result.resultFooter')

    </div>

  </div>


@endsection
