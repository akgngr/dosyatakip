@extends('backpack::layout')

@section('content')
@section('header')
	<section class="content-header">
		<h1>
			<span class="text-capitalize">Yeni Mahkeme Dosyası Ekleme</span>
		</h1>
	</section>
@endsection
<div class="box">
	<div class="box-body">
	<form method="POST" action="{{ route('infaz.store') }}">
	    @csrf

      <div class="form-group row">
        <label for="title" class="col-md-4 col-form-label text-md-right">Kategori</label>
        <div class="col-md-6">
          <select class="form-control" name="kategori">
            <option value="0">Diğer Kategori</option>

            @foreach($kategoriler as $kategori)
              <option value="{{$kategori->id}}">{{$kategori->title}}</option>

                @foreach($kategori->chidren as $altkategori)
                  <option value="{{$altkategori->id}}">{{$kategori->title}}-->{{$altkategori->title}}</option>

                    @foreach($altkategori->chidren as $altaltkategori)
                      <option value="{{$altaltkategori->id}}">{{$kategori->title}}-->{{$altkategori->title}}-->{{$altaltkategori->title}}</option>
                    @endforeach

                 @endforeach
              @endforeach
          </select>
        </div>
      </div>
	    <div class="form-group row">
	        <label for="title" class="col-md-4 col-form-label text-md-right">Dosya No</label>

	        <div class="col-md-6">
	            <input id="title" type="text" class="form-control" name="dosya_no" required >
	        </div>
	    </div>

	    <div class="form-group row">
	        <label for="title" class="col-md-4 col-form-label text-md-right">İli</label>

	        <div class="col-md-6">
				<!--<select class="form-control" name="ili" id="" required>
					<option value="Seçiniz">Seçiniz...</option>
					@foreach($iller as $il)
						<option value="{{$il->iller}}">{{$il->iller}}</option>
					@endforeach
				</select>
				-->
<input class="form-control" name="ili">
	        </div>
	    </div>

	    <div class="form-group row">
	        <label for="title" class="col-md-4 col-form-label text-md-right">Mahkeme</label>

	        <div class="col-md-6">
	            <input id="title" type="text" class="form-control" name="mahkeme" required >
	        </div>
	    </div>
      <div class="form-group row">
	        <label for="title" class="col-md-4 col-form-label text-md-right">Davalı</label>

	        <div class="col-md-6">
	            <input id="title" type="text" class="form-control" name="davali" required >
	        </div>
	    </div>
      <div class="form-group row">
	        <label for="title" class="col-md-4 col-form-label text-md-right">Davacı</label>

	        <div class="col-md-6">
	            <input id="title" type="text" class="form-control" name="davaci" required >
	        </div>
	    </div>

	    <div class="form-group row mb-0">
	        <div class="col-md-6 offset-md-4">
	            <button type="submit" class="btn btn-primary">
					<span class="fa fa-save" role="presentation" aria-hidden="true"> </span> {{ __('Kaydet') }}
	            </button>
	        </div>
	    </div>
	</form>
    </div>

@endsection
