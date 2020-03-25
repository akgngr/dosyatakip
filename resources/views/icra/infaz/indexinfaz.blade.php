@extends('backpack::layout')

@section('content')
@section('header')
    <section class="content-header">
        <h1>
            <span class="text-capitalize">Mahkeme Dosyaları</span>
            <div class="box-header hidden-print pull-right">
                <a href="{{ route('infaz.create') }}" class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i> Yeni İnfaz Ekle</span></a>
            </div>
        </h1>
    </section>
@endsection
<div class="box">
    <div class="row">
    <div class="box-body">
    <div class="col-md-12">
        <div class="table-responsive">
                <table id="infaz" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Dosya No</th>
                            <th scope="col">İli</th>
                            <th scope="col">Mahkeme</th>
                            <th scope="col">Davalı</th>
                            <th scope="col">Davacı</th>
                            <th scope="col">Kategorisi</th>
                            <th scope="col">Durum</th>
                            <th scope="col">İşlemler</th>
                        </tr>
                    </thead>
                </table>
            </div></div></div></div></div>
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
    $(document).ready(function(){
        
        // Setup - add a text input to each footer cell
        $('#infaz thead tr').clone(true).appendTo( '#infaz thead' );
        $('#infaz thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
    } );
    
    var table = $('#infaz').DataTable({
                        orderCellsTop: true,
                        processing: true,
                        serverSide: true,
                        ajax: 'http://127.0.0.1:8000/admin/icra/infaz/infaz_data',
                        
                    dom: 'lenghtMenu, Bfrtip',
                    buttons: [
                        'pdf', 'print', {
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
                        'colvis'
    
                    ],
                        columns: [
                            {data: 'dosya_no'},
                            {data: 'ili'},
                            {data: 'mahkeme'},
                            {data: 'davali'},
                            {data: 'davaci'},
                            {data: 'kategori'},
                            {data: 'durum'},
                            {data: 'action'},
                        ],
                        language: {
                        "lengthMenu":     "Bu kadar _MENU_ göster",
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
                            colvis: "Sütunlar"
                        },
    
                        paginate: {
                            first: "İlk",
                            previous: "Önceki",
                            next: "Sonraki",
                            last: "Son"
                        },
                    }
                    
                    });
                });
            </script>
@endsection