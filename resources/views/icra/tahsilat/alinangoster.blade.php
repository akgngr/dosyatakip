<div class="table-responsive ">
    <table class="table text-left table-bordered table-striped">
        <thead>
        <tr class="bg-primary">
            <th>#</th>
            <th>Ad Soyad</th>
            <th>Alan Kişi</th>
            <th>İletişim</th>
            <th>Ücret</th>
            <th>İşlem</th>
        </tr>
        </thead>

        @if(isset($icralar->id))
        <tbody>
        @php($i=1)
        @foreach($icralar->alinanlar as $alinan)
            <tr>
                <th>{{$i++}}</th>
                <td>{{$alinan->veren_kisi}}</td>
                <td>{{$alinan->user->name}}</td>
                <td>{{$alinan->veren_kisi_iletisim}}</td>
                <td class="text-right">₺ {{number_format($alinan->ucret, 2)}}</td>
                <td>
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
                                    <form method="POST" action="{{route('tahsilat.alinansil', $alinan->id)}}">
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
                    <a target="popup" onclick="window.open('{{route("icra.alinan.makbuz", $icralar->id)}}','popup','width=900,height=650,scrollbars=no,resizable=no'); return false;" href="{{route('icra.alinan.makbuz', $icralar->id)}}" type="button" class="btn btn-primary" ><i class="fa fa-print"></i> </a>
                </td>
            </tr>
        @endforeach
        <tr><td></td><td></td><td></td><th class="text-right">TOPLAM</th><th class="text-right">₺ {{number_format($icralar->alinanlar->sum('ucret'), 2)}}</th></tr>
        </tbody>

    </table>

</div>

@php($alinacak=$icralar->tahsilat_ana->sum('ucret'))
@php($alinan=$icralar->alinanlar->sum('ucret'))
@php($sonuc=$alinacak-$alinan)


<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#alinan">Yeni Tahsilat</button>
<div class="modal fade" id="alinan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabell" aria-hidden="true">
    @include('icra.tahsilat.alinan')
</div>

<div class="box-header col-md-9"><h3>Kalan Ücret</h3></div>

<div class="col-md-12">
<div class="table-responsive">
    <table class="table price-table table-bordered table-striped">
        <thead><tr class="bg-primary"><th class="text-right">Toplam Kalan Ücret</th></tr></thead>
        <tbody><tr><th class="price-value text-right">₺ {{number_format($sonuc, 2)}}</th></tr></tbody>
    </table>
</div>
</div>

@elseif(isset($infazlar->id))

<tbody>
@php($i=1)
@foreach($infazlar->alinanlar as $alinan)
    <tr>
        <th>{{$i++}}</th>
        <td>{{$alinan->veren_kisi}}</td>
        <td>{{$alinan->user->name}}</td>
        <td>{{$alinan->veren_kisi_iletisim}}</td>
        <td class="text-right">₺ {{number_format($alinan->ucret, 2)}}</td>
        <td>
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
                            <form method="POST" action="{{route('tahsilat.alinansil', $alinan->id)}}">
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
            <a target="popup" onclick="window.open('{{route("mahkeme.alinan.makbuz", $infazlar->id)}}','popup','width=900,height=650,scrollbars=no,resizable=no'); return false;" href="{{route('mahkeme.alinan.makbuz', $infazlar->id)}}" type="button" class="btn btn-primary" ><i class="fa fa-print"></i> </a>
        </td>
    </tr>
@endforeach
<tr><td></td><td></td><td></td><th class="text-right">TOPLAM</th><th class="text-right">₺ {{number_format($infazlar->alinanlar->sum('ucret'), 2)}}</th></tr>
</tbody>

</table>

</div>

@php($alinacak=$infazlar->tahsilat_ana->sum('ucret'))
@php($alinan=$infazlar->alinanlar->sum('ucret'))
@php($sonuc=$alinacak-$alinan)


<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#alinan">Yeni Tahsilat</button>
<div class="modal fade" id="alinan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabell" aria-hidden="true">
    @include('icra.tahsilat.alinan')
</div>

<div class="box-header col-md-9"><h3>Kalan Ücret</h3></div>
<div class="row">
<div class="col-md-12">
    <div class="table-responsive">
        <table class="table price-table table-bordered table-striped">
            <thead><tr class="bg-primary"><th class="text-right">Toplam Kalan Ücret</th></tr></thead>
            <tbody><tr><th class="price-value text-right">₺ {{number_format($sonuc, 2)}}</th></tr></tbody>
        </table>
    </div>
</div>
</div>
@endif