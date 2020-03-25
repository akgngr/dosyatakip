@extends('backpack::layout')

@section('content')
@section('header')
    <section class="content-header">
        <h1 style="float: left; padding-right: 15px;"><span class="text-capitalize"> {{ $infazlar->dosya_no }} </span> </h1> <h3 style="padding:0; margin:0;"><span class="text-capitalize">{{ $infazlar->davali }} - {{ $infazlar->davaci }}</span></h3></span>
    </section>
@endsection
<div class="box">

    <div class="box-header hidden-print with-border">
        <a type="button" class="btn btn-success pull-right" href="{{route('infaz.edit', $infazlar->id)}}"><i class="fa fa-edit"></i> Düzenle</a>&nbsp;&nbsp;
        <button type="button" class="m-r-10 btn btn-primary pull-right" data-toggle="modal" data-target="#durum">Durum</button>
        <div class="modal fade" id="durum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabell">Durum</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('infaz.update', $infazlar->id) }}" method="post">
                            {{method_field('PUT')}}
                            {{csrf_field()}}
                            <input type="hidden" name="eski_durum" value="{{$infazlar->durum}}">
                            <input type="hidden" name="kategori" value="{{$infazlar->kategori}}">
                            <div class="box-body">
                            <div class="col-md-4">
                                <div class="card" style="margin:50px 0">
                                <ul class="list-group list-group-flush durum">
                                    <li class="list-group-item">
                                        Derdest
                                        <label class="switch ">
                                            <input type="radio" class="primary" name="durum" @if($infazlar->durum == "Derdest") checked @endif value="Derdest">
                                            <span class="slider round"></span>
                                        </label>
                                    </li>
                                    <li class="list-group-item">
                                        İnfaz
                                        <label class="switch ">
                                            <input type="radio" class="primary" name="durum" @if($infazlar->durum == "infaz") checked @endif value="infaz">
                                            <span class="slider round"></span>
                                        </label>
                                    </li>
                                </ul>
                                </div>
                            </div>

                            <div class="col-md-12">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Çık</button>
                                <input type="submit" class="btn btn-primary" value="Kaydet">
                            </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">
    <div class="table-responsive col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
        <div class="panel-heading">Dosya Detayı</div>
        <div class="panel-body">
        <table class="table">
            <thead><tr><th>Başlık</th><th>Bilgiler</th></tr></thead>
            <tbody>
            <tr><th>Föy Numarası</th>

                @if($infazlar->durum == 'Derdest')

                    @if(isset($infazlar->mahkeme_derdest_foy_no))
                        <td>{{$infazlar->mahkeme_derdest_foy_no->foy_no}}</td>
                    @else
                        <td>
                            <form action="{{route('mahkeme.derdest.kaydet')}}" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="mahkeme_id" value="{{$infazlar->id}}">
                                <input type="hidden" name="kategori" value="{{$infazlar->kategori}}">
                                <input type="submit" class="btn btn-success" value="Föyno Oluştur">
                            </form>
                        </td>
                    @endif

                @else
                    @if(isset($infazlar->mahkeme_infaz_foy_no))
                        <td>{{$infazlar->mahkeme_infaz_foy_no->foy_no}}</td>
                    @else
                        <td>
                            <form action="{{route('mahkeme.infaz.kaydet')}}" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="mahkeme_id" value="{{$infazlar->id}}">
                                <input type="hidden" name="kategori" value="{{$infazlar->kategori}}">
                                <input type="submit" class="btn btn-success" value="Föyno Oluştur">
                            </form>
                        </td>
                    @endif
                @endif

            </tr>
            
            @if(isset($infazlar->eski_foy_no))
                <tr>
                    <th>Eski Föy No:</th>
                    <td>{{$infazlar->eski_foy_no}}</td>
                </tr>
            @endif
            
            <tr><th>Dosya No:</th><td>{{ $infazlar->dosya_no }}</td></tr>
            <tr>
                <th>Kategorisi:</th>
                <td>
                    @if(isset($infazlar->parent))
                        @php($ust_kategori=$infazlar->parent)
                        @if(isset($ust_kategori->parent))

                            @php($ust_ust_kategori=$ust_kategori->parent)
                            @if(isset($ust_ust_kategori->parent))
                                {{$ust_ust_kategori->parent->title}}
                            @endif
                            {{$ust_kategori->parent->title}}
                        @endif
                        {{ $infazlar->parent->title }}
                    @endif
                </td>
            </tr>
            <tr><th>İli:</th><td>{{ $infazlar->ili }}</td></tr>
            <tr><th>Mahkeme:</th><td>{{ $infazlar->mahkeme }}</td></tr>
            <tr><th>Davalı:</th><td>{{ $infazlar->davali }}</td></tr>
            <tr><th>Davacı:</th><td>{{ $infazlar->davaci }}</td></tr>
            <tr><th>Ekleyen Kişi</th><td>{{$infazlar->user->name}}</td></tr>
            <tr><th>Oluşturma Tarihi:</th><td>{{$infazlar->created_at}}</td></tr>
            <tr class="@if($infazlar->durum == 'infaz') danger @endif"><th>Durum</th><td>{{$infazlar->durum}}</td></tr>
            </tbody>
        </table>
    </div>
        </div>
    </div>

    </div>
</div>

<div class="box">
    <div class="box-body">
        <ul class="nav nav-tabs " role="tablist">
            <li class="active"><a data-toggle="tab" href="#not">Notlar</a></li>
            @role('super-admin')
            <li><a data-toggle="tab" href="#tahsilat">Tahsilat</a></li>
            @endrole
        </ul>
        <div class="tab-content">
            <div id="not" class="tab-pane fade in active">
                <div class="col-md-12">
                    <div class="box-header">
                        <h1>Notlar</h1>
                    </div>
                @foreach($infazlar->yorumlar as $yorum)
                    <section class="comment-list">
                        <!-- First Comment -->
                        <article class="row">
                            <div class="col-md-2 col-sm-2 hidden-xs">
                                <figure class="thumbnail">
                                    <img class="img-responsive" src="https://image.ibb.co/jw55Ex/def_face.jpg" />
                                    <figcaption class="text-center"><i class="fa fa-user"></i> {{$yorum->user->name}}</figcaption>
                                </figure>
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <div class="panel panel-default arrow left">
                                    <div class="panel-body">
                                        <header class="text-left">
                                            <p><b>{{$yorum->name}}</b></p>
                                            <time class="small comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> {{$yorum->created_at}}</time>
                                        </header>
                                        <div class="comment-post">

                                            <p>{!! $yorum->govde !!}</p>
                                        </div>
                                        <div class="col-md-2 pull-right yorum">
                                            <p class="pull-right"><a href="#" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i></a></p>
                                            @if($yorum->user_id == backpack_auth()->user()->id)
                                                <button type="button" class="m-r-10 pull-right btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{route('yorum.sil', $yorum->id)}}">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                {{csrf_field()}}
                                                                <label for="">Yorumu Silmek İstediğinizden Eminmisiniz!</label>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Çık</button>
                                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>  Sil</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </article>
                @endforeach

    <div class="col-md-12">
        <form action="{{route('infaz.kaydet')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name='infaz' value="{{$infazlar->id}}">
            <div class="form-group col-xs-12">
                <label>Başlık</label>

                <input id="title" type="text" class="form-control" name="name" required >

            </div>

            <div class="form-group col-xs-12">
                <label>Notunuz</label>
                <textarea id="ckeditor-govde" name="govde"  @include('crud::inc.field_attributes', ['default_class' => 'form-control'])></textarea>
            </div>
            <div class="box-footer">

                <div id="saveActions" class="form-group">

                    <div class="btn-group">

                        <button type="submit" class="btn btn-success">
                            <span class="fa fa-save" role="presentation" aria-hidden="true"></span> &nbsp;
                            <span data-value="save_and_back">Kaydet</span>
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
</div>
@role('super-admin')
<div id="tahsilat" class="tab-pane fade">
    <div class="box-header">
        <h3 class="col-md-9">Borçlar</h3>
        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#anatahsilat">Tahsilat Edilecek Ücret</button>
        <div class="modal fade" id="anatahsilat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            @include('icra.tahsilat.tahsilat')
        </div>
    </div>
    <div class="col-md-12">
        @include('icra.tahsilat.show')
    </div>
    <div class="col-md-12">
    <div class="box-header">
        <h3 class="col-md-9">Tahsilat</h3>
    </div>

        @include('icra.tahsilat.alinangoster')
    </div>
</div>
</div>
</div>
@endrole
@endsection

@section('after_scripts')
    <script src="{{ asset('vendor/backpack/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/backpack/ckeditor/adapters/jquery.js') }}"></script>

    <script>
        jQuery(document).ready(function($) {
            $('#ckeditor-govde').ckeditor({
                "filebrowserBrowseUrl": "http://127.0.0.1:8000/admin/elfinder/ckeditor",
                "extraPlugins" : 'oembed,widget'
            });
        });
    </script>
@endsection
@section('before_styles')
    <style media="screen">
        .nav-tabs { border-bottom: 2px solid #DDD; }
        .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }
        .nav-tabs > li > a { border: none !important; color: #666; }
        .nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none; color: #4285F4 !important; background: transparent; }
        .nav-tabs > li > a::after { content: ""; background: #4285F4; height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }
        .nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }
        .tab-nav > li > a::after { background: #21527d none repeat scroll 0% 0%; color: #fff; }
        .modal-title{width: 95%; float: left;}



        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
            float:right;
        }

        /* Hide default HTML checkbox */
        .switch input {display:none;}

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input.default:checked + .slider {
            background-color: #444;
        }
        input.primary:checked + .slider {
            background-color: #2196F3;
        }
        input.success:checked + .slider {
            background-color: #8bc34a;
        }
        input.info:checked + .slider {
            background-color: #3de0f5;
        }
        input.warning:checked + .slider {
            background-color: #FFC107;
        }
        input.danger:checked + .slider {
            background-color: #f44336;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .durum .list-group-item {
            position: relative;
            display: block;
            padding: 15px 20px;
            margin-bottom: 5px;
            background-color: #fff;
            border: 0;
            line-height: 30px;
        }
        .yorum{
            display: block;
            position: absolute !important;
            top: 5px;
            right: 5px;
        }
        .m-r-10{margin: 0 10px 0 0;}
    </style>
@endsection
