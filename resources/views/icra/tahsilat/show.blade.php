<div class="table-responsive ">
  <table class="table text-left table-bordered table-striped ">
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
    <tbody>

    @php($i=1)

    @if(isset($icralar->id))

    @foreach($icralar->tahsilat_ana as $tahsilat)
      <tr>
        <th>{{$i++}}</th>
        <td>{{$tahsilat->anlasilan_kisi}}</td>
        <td>{{$tahsilat->user->name}}</td>
        <td>{{$tahsilat->iletisim}}</td>
        <td class="text-right">₺ {{number_format($tahsilat->ucret, 2)}}</td>
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
                  <form method="POST" action="{{route('tahsilat.alacaksil', $tahsilat->id)}}">
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
    <tr><td></td><td></td><td></td><th class="text-right">TOPLAM</th><th class="text-right">₺ {{number_format($icralar->tahsilat_ana->sum('ucret'), 2)}}</th></tr>
    </tbody>

    @elseif(isset($infazlar->id))

      @foreach($infazlar->tahsilat_ana as $tahsilat)
        <tr>
          <th>{{$i++}}</th>
          <td>{{$tahsilat->anlasilan_kisi}}</td>
          <td>{{$tahsilat->user->name}}</td>
          <td>{{$tahsilat->iletisim}}</td>
          <td class="text-right">₺ {{number_format($tahsilat->ucret, 2)}}</td>
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
                    <form method="POST" action="{{route('tahsilat.alacaksil', $tahsilat->id)}}">
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
      <tr><td></td><td></td><td></td><th class="text-right">TOPLAM</th><th class="text-right">₺ {{number_format($infazlar->tahsilat_ana->sum('ucret'), 2)}}</th></tr>
      </tbody>

    @endif

  </table>
</div>