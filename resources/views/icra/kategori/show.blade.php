@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            <span class="text-capitalize">{{ $kategori->title }} </span>
            <a type="button" class="btn btn-success pull-right" href="{{route('kategori.create')}}"><i class="fa fa-plus"></i> Başka Kategori Ekle</a>
        </h1>
    </section>
@endsection

@section('content')

    <div class="box">
<div class="box-body">
        <p class=""><b>Kategori Adı:</b> {{$kategori->title}}</p>
        <p class=""><b>Oluşturma Tarihi:</b> {{$kategori->created_at}}</p>
</div>
@endsection
