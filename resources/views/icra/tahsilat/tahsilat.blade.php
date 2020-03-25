<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Tahsilat Edilecek Ücreti Girin</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('tahsilat.alacak')}}" method="post">
          {{csrf_field()}}
          @if(isset($icralar->id))
            <input type="hidden" name="icra_id" value="{{$icralar->id}}">
          @elseif(isset($infazlar->id))
            <input type="hidden" name="infaz_id" value="{{$infazlar->id}}">
          @endif
          <div class="form-group">
            <label for="">Anlaşılan Kişi Adı Soyadı</label>
            <input type="text" class="form-control" name="anlasilan_kisi" value="">
          </div>
          <div class="form-group">
            <label for="">Anlaşılan Ücret</label>
            <input type="number" id="replyNumber" min="0" step="1" class="form-control" name="ucret" value="">
          </div>
          <div class="form-group">
            <label for="">Anlaşılan Kişi İletişim</label>
            <input type="text" class="form-control" name="iletisim" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Çık</button>
            <input type="submit" class="btn btn-primary" value="Kaydet">
          </div>
          </form>
      </div>
    </div>
  </div>
