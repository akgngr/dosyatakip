@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<h1>
			<span class="text-capitalize">Yeni Kategori Ekleme Ekranı </span>
		</h1>
	</section>
@endsection

@section('content')


    <div class="box">
		<div class="box-body">

	<form method="POST" action="{{ route('kategori.store') }}">
	    @csrf

      <div class="form-group row">
	        <label for="title" class="col-md-4 col-form-label text-md-right"> Üst Kategori</label>

	        <div class="col-md-6">
	            <select class="form-control" name="ust_kategori">
                <option value="0">Üst Kategori</option>

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
	        <label for="title" class="col-md-4 col-form-label text-md-right"> Kategori Adı</label>

	        <div class="col-md-6">
	            <input id="title" type="text" class="form-control" name="title" required >
	        </div>
	    </div>





	    <div class="form-group row mb-0">
	        <div class="col-md-6 offset-md-4">
	            <button type="submit" class="btn btn-primary">
					<span class="fa fa-save" role="presentation" aria-hidden="true"> </span>  {{ __('Yeni Kategori Oluştur') }}
	            </button>
	        </div>
	    </div>
	</form>
    </div>
	</div>
@endsection
