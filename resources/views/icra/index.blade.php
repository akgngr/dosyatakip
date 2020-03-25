@extends('backpack::layout')

@section('content')
@guest
Giriş yapın

@else
<div class="card">
    <div class="card-header"><h1>Dosya Takip Uygulaması</h1></div>
    <div class="col-md-9">
      <div class="card-body">

      </div>
    </div>
</div>
@endguest
@endsection
