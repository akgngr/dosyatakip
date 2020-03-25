@extends('backpack::layout')

@section('content')

    <div class="card-header">Kategoriler</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

               <h1>Listeler</h1>
               {{ $detay->title }}
                </div>
@endsection
	