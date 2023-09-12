@extends('layouts.main')

@section('child')

{{-- @include('layouts.navHome') --}}
{{-- Banner --}}
<div class="bg-bg bnr">
    @include('partials.banner')
</div>

{{-- Content --}}
  @include('partials/cardPollUnit')

<script src="{{ asset('js/script.js')}}"></script>

@endsection
