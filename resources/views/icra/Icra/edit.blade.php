@extends('backpack::layout')

@section('content')
@section('header')
	<section class="content-header">
		<h1>
			<span class="text-capitalize">İcra Dosyası Düzenleme Ekranı</span>
		</h1>
	</section>
@endsection
<div class="box">
	<div class="box-body">


	<form method="POST" action="{{ route('icra.update', $icralar->id) }}">
	    {{method_field('PUT')}}
	    {{csrf_field()}}
      <div class="form-group row">
        <label for="title" class="col-md-4 col-form-label text-md-right">Kategori</label>
        <div class="col-md-6">
          <select class="form-control" name="kategori" value="{{$icralar->kategori}}">
            <option value="0">Diğer Kategori</option>

            @foreach($kategoriler as $kategori)
              <option value="{{$kategori->id}}" @if($icralar->kategori == $kategori->id) selected @endif>{{$kategori->title}}</option>

                @foreach($kategori->chidren as $altkategori)
                  <option value="{{$altkategori->id}}" @if($icralar->kategori == $altkategori->id) selected @endif>{{$kategori->title}}-->{{$altkategori->title}}</option>

                    @foreach($altkategori->chidren as $altaltkategori)
                      <option value="{{$altaltkategori->id}}" @if($icralar->kategori == $altaltkategori->id) selected @endif>{{$kategori->title}}-->{{$altkategori->title}}-->{{$altaltkategori->title}}</option>
                    @endforeach

                 @endforeach
              @endforeach
          </select>
        </div>
      </div>
      <div class="form-group row">
	        <label for="title" class="col-md-4 col-form-label text-md-right">Dosya No</label>

	        <div class="col-md-6">
	            <input id="title" type="text" class="form-control" name="dosya_no" value="{{$icralar->dosya_no}}" required >
	        </div>
	    </div>

	    <div class="form-group row">
	        <label for="title" class="col-md-4 col-form-label text-md-right">İli</label>

			<div class="col-md-6">
				<!--<select name="ili" class="form-control" id="">
					@foreach($iller as $il)
						<option value="{{$il->iller}}" @if($il->iller == $icralar->ili) selected @endif>{{$il->iller}}</option>
					@endforeach
				</select>
				-->
				<input class="form-control" type="text" name="ili" value="{{$icralar->ili}}">
			</div>
	    </div>

      <div class="form-group row">
          <label class="col-md-4 col-form-label text-md-right">Mahkeme</label>
					<div class="col-md-6">
						<input id="title" type="text" class="form-control" name="mahkeme" value="{{$icralar->mahkeme}}" required >
					</div>
			</div>

      <div class="form-group row">
	        <label for="title" class="col-md-4 col-form-label text-md-right">Alacaklı</label>

	        <div class="col-md-6">
	            <input id="title" type="text" class="form-control" name="alacakli" value="{{$icralar->alacakli}}" required >
	        </div>
	    </div>
      <div class="form-group row">
	        <label for="title" class="col-md-4 col-form-label text-md-right">Borçlu</label>

	        <div class="col-md-6">
	            <input id="title" type="text" class="form-control" name="borclu" value="{{$icralar->borclu}}" required >
	        </div>
	    </div>

	    <div class="form-group row mb-0">
	        <div class="col-md-6 offset-md-4">
	            <button type="submit" class="btn btn-primary">
					<span class="fa fa-save" role="presentation" aria-hidden="true"> </span>  {{ __('Güncelle') }}
	            </button>
	        </div>
	    </div>
	</form>
    </div>
@endsection

@section('after_scripts')
@endsection
