<!-- Modal -->
<div class="modal fade" id="modalFromMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Form Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="menu" enctype="multipart/form-data">
                    @csrf
                    <div id="method"></div>
                    <input type="hidden" name="old_image" id="old_image">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Nama Menu</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama" value=" " name="nama">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">jumlah</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="jumlah" value=" " name="jumlah">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">harga</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="harga" value=" " name="harga">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Jenis Makanan</label>
                        <select class="form-controll col-md-4 col-xs-12" required="required" name="jenis_id">
                            @foreach($jenis as $p)
                            <option value="{{$p->id}}">{{$p->jenis}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group row">
                        <label>image</label>
                        <img class="img-preview img-fluid" style="max-height: 200px;">
                        <div class="input-group input-group-outline my-3">
                            <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage()">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>