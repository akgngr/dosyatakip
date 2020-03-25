@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            <span class="text-capitalize">Kategoriler </span>
            <div class="box-header hidden-print pull-right">
                <a href="{{route('kategori.create')}}" class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i> Yeni kategori ekle</span></a>
            </div>
        </h1>
    </section>
@endsection

@section('content')
<div class="row"><div class="col-md-12">
    <div class="box">
<div class="box-body">
                <table id="kategori" class="table table-bordered table-hover">
                    <thead>
                        <tr role="row">
                            <th>#</th>
                            <th>Kategori Adı</th>
                            <th>Oluşturma Tarihi</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i=1)
                        @foreach($kategoriler as $kategori)
                            <tr>
                              <td class="font-bold">{{$i++}}</td>
                              <td><a href="{{url('/admin/icra/kategori',$kategori->id)}}">{{$kategori->title}}</a></td>
                              <td>{{$kategori->created_at}}</td>
                              <td>
                                <form method="POST" action="{{route('kategori.destroy', $kategori->id)}}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    {{csrf_field()}}
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>  Sil</button>
                                </form>
                              </td>
                            </tr>

                        @foreach($kategori->chidren as $altkategori)
                            <tr>
                            <td>{{$i++}}</td>
                            <td><a href="{{url('/admin/icra/kategori',$altkategori->id)}}">{{$kategori->title}}<span style="color:red;font-size:bold;"> --> </span>{{$altkategori->title}}</a></td>
                            <td>{{$kategori->created_at}}</td>
                            <td>
                              <form method="POST" action="{{route('kategori.destroy', $altkategori->id)}}">
                                  <input type="hidden" name="_method" value="DELETE">
                                  {{csrf_field()}}
                                  <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>  Sil</button>
                              </form>
                            </td>
                          </tr>
                      @foreach($altkategori->chidren as $altaltkategori)

                          <tr>
                            <td class="font-weight-bold">{{$altaltkategori->id}}</td>
                            <td><a href="{{url('/admin/icra/kategori',$altaltkategori->id)}}">{{$kategori->title}}<span style="color:red;"> --> </span>{{$altkategori->title}}<span style="color:red;"> --> </span>{{$altaltkategori->title}}</a></td>
                            <td>{{$kategori->created_at}}</td>
                            <td>
                            <form method="POST" action="{{route('kategori.destroy', $altaltkategori->id)}}">
                                <input type="hidden" name="_method" value="DELETE">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>  Sil</button>
                            </form>
                          </td>
                          </tr>

                      @endforeach
                                @endforeach

                        @endforeach
                    </tbody>
                </table>
                </div></div></div></div>
@endsection

@section('before_styles')
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
    <style>
        .dataTables_filter{float: right;}
        .dataTables_info{float: left;}
        .modal-content .modal-body{
            color: black;
        }
    </style>
@endsection

@section('after_scripts')
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('js/datatables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/jszip.min.js')}}"></script>
    <script src="{{asset('js/buttons.colVis.min.js')}}"></script>
    <script>

        $(function () {
            $('#kategori').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,
                'infoFiltered': true,  
                language: {
                    info: "_TOTAL_ kayıttan _START_ - _END_ kayıt gösteriliyor.",
                    infoEmpty:      "Gösterilecek hiç kayıt yok.",
                    loadingRecords: "Kayıtlar yükleniyor.",
                    zeroRecords: "Tablo boş",
                    search: "Arama:",
                    infoFiltered:   "(toplam _MAX_ kayıttan filtrelenenler)",
                    buttons: {
                        copyTitle: "Panoya kopyalandı.",
                        copySuccess:"Panoya %d satır kopyalandı",
                        copy: "Kopyala",
                        print: "Yazdır",
                        excel: "Excel",
                        colvis: "Sütünlar"
                    },

                    paginate: {
                        first: "İlk",
                        previous: "Önceki",
                        next: "Sonraki",
                        last: "Son"
                    },
                },
                dom: 'lenghtMenu, Bfrtip',
                pageLength: 50,
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                buttons: [
                        'copy', 'pdf', 'print',
                        {
                            extend: 'excelHtml5',
                            text: 'Excel',
                            customize: function( xlsx ) {
                                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                $('row:first c', sheet).attr( 's', '42' );
                            },
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5 ]
                            }
                        },
                        'colvis',
                ],
            });
        });

    </script>
@endsection