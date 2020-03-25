<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="exampleModalLabell">Tahsilat Edilen Ücreti Girin</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('tahsilat.alinan')}}" method="post">
                {{csrf_field()}}
                @if(isset($icralar->id))
                    <input type="hidden" name="icra_id" value="{{$icralar->id}}">
                @elseif(isset($infazlar->id))
                    <input type="hidden" name="infaz_id" value="{{$infazlar->id}}">
                @endif
                <div class="form-group">
                    <label for="">Ücreti Veren Kişi</label>
                    <input type="text" class="form-control" name="veren_kisi"       >
                </div>
                <div class="form-group">
                    <label for="">Alınan Ücret</label>
                    <input type="number" id="replyNumber" min="0" step="1" class="form-control" name="ucret">
                </div>
                <div class="form-group">
                    <label for="">Veren Kişi İletişim</label>
                    <input type="text" class="form-control" name="veren_kisi_iletisim">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Çık</button>
                    <input type="submit" class="btn btn-primary" value="Kaydet">
                </div>
            </form>
        </div>
    </div>
</div>
