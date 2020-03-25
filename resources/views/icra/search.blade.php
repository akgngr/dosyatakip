@extends('backpack::layout')

@section('content')
<div class="box">
    <div class="box-header"><h2>Arama Yap</h2></div>
    <div class="box-body ">
      <div class="col-md-12">
        <form class="" action="{{route('search')}}" method="post" role="search">
          {{ csrf_field() }}
          <div class="input-group">
            <input type="text" class="form-control" name="q" placeholder="Arama Yap">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search">Ara</span>
              </button>
            </span>
          </div>
        </form>
      

@if(isset($details))
        <h2>İcra Araması</h2> 
        <div class="table-responsive">
        <table id="table" class="display table table-striped">
          <thead>
            <tr>
                <th scope="col">Föy No</th>
                <th scope="col">Dosya No</th>
                <th scope="col">İli</th>
                <th scope="col">Mahkeme</th>
                <th scope="col">Alacaklı</th>
                <th scope="col">Borçlu</th>
                <th scope="col">Durum</th>
                <th scope="col">İşlemler</th>
            </tr>
        </thead>
          <tbody>
            @foreach($details as $icra)
            <tr>
              <tr @if($icra->durum == 'infaz') class="danger" @endif>

                    @if($icra->durum == 'Derdest')

                            @if(isset($icra->icra_derdest_foy_no))
                                <td>{{$icra->icra_derdest_foy_no->foy_no}}</td>
                            @endif

                        @else

                            @if(isset($icra->icra_infaz_foy_no))
                                <td>{{$icra->icra_infaz_foy_no->foy_no}}</td>
                            @endif
                    @endif

                    <td><a href="{{url('admin/icra/icra', $icra->id)}}">{{$icra->dosya_no}}</a></td>
                    <td>{{$icra->ili}}</td>
                    <td>{{$icra->mahkeme}}</td>
                    <td>{{$icra->alacakli}}</td>
                    <td>{{$icra->borclu}}</td>
                    <td>{{$icra->durum}}</td>
                    <td><a type="button" class="btn btn-twitter" href="{{ route('icra.show', $icra->id) }}"><i class="fa fa-eye"></i> </a>&emsp;
                        <a type="button" class="btn btn-primary" href="{{ route('icra.edit', $icra->id) }}"><i class="fa fa-edit"></i> </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
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
                                        <form method="POST" action="{{route('icra.destroy', $icra->id)}}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{csrf_field()}}
                                            <label for="">Dosyayı Silmek İstediğinizden Eminmisiniz!</label>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Çık</button>
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>  Sil</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tr> 
         	@endforeach
          </tbody>
        </table>
        </div>
       

        <h2>Mahkeme Araması</h2>
        <div class="table-responsive">
 <table id="table" class="display table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Föy No</th>
                            <th scope="col">Dosya No</th>
                            <th scope="col">İli</th>
                            <th scope="col">Mahkeme</th>
                            <th scope="col">Davalı</th>
                            <th scope="col">Davacı</th>
                            <th scope="col">Durum</th>
                            <th scope="col">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($infazlar as $infaz)
                            <tr @if($infaz->durum == 'infaz') class="danger" @endif>


                            @if($infaz->durum == 'Derdest')

                                @if(isset($infaz->mahkeme_derdest_foy_no))
                                    <td>{{$infaz->mahkeme_derdest_foy_no->foy_no}}</td>
                                @endif

                            @else

                                @if(isset($infaz->mahkeme_infaz_foy_no))
                                    <td>{{$infaz->mahkeme_infaz_foy_no->foy_no}}</td>
                                @endif
                            @endif
                                <td><a href="{{url('admin/icra/infaz', $infaz->id)}}">{{$infaz->dosya_no}}</td>
                                <td>{{$infaz->ili}}</td>
                                <td>{{$infaz->mahkeme}}</td>
                                <td>{{$infaz->davali}}</td>
                                <td>{{$infaz->davaci}}</td>
                                <td>{{$infaz->durum}}</td>
                                <td><a type="button" class="btn btn-twitter" href="{{ route('infaz.show', $infaz->id) }}"><i class="fa fa-eye"></i> </a>
                                    <a type="button" class="btn btn-primary" href="{{ route('infaz.edit', $infaz->id) }}"><i class="fa fa-edit"></i> </a>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
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
                                                    <form method="POST" action="{{route('infaz.destroy', $infaz->id)}}">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        {{csrf_field()}}
                                                        <label for="">Dosyayı Silmek İstediğinizden Eminmisiniz!</label>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Çık</button>
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>  Sil</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                 @endif
                 @if(isset($message))
             <div class="col-md-12" style="margin-top: 20px;">
                 <div class="alert alert-danger" role="alert">{{$message}}</div>
             </div>
             @endif
                 </div>
                 </div>
</div>
 @endsection

@section('before_styles')
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
    <style>
        .dataTables_filter{float: right;}
        .dataTables_info{float: left;}
    </style>
@endsection

@section('after_scripts')
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('js/datatables.min.js')}}"></script>
    <script src="{{asset('https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js')}}"></script>
    <script src="{{asset('https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('table.display').DataTable({
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