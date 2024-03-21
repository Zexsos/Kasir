<table class="datatable-init nowrap table" id="data-produktitipan">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Produk</th>
            <th>Nama Supplier</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>stok</th>
            <th>keterangan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produktitipan as $p)
        <tr>
            <td>{{$i = !isset($i)?$i=1:++$i}}</td>
            <td>{{ $p -> nama_produk}}</td>
            <td>{{ $p -> nama_supplier}}</td>
            <td>{{ $p -> harga_beli}}</td>
            <td>{{ $p -> harga_jual}}</td>
            <td class="editable">{{ $p->stok }}</td>
            <td>{{ $p -> keterangan}}</td>
            <td>
                <button type="button" class="btn btn-success btn-edit" data-toggle="modal" data-target="#modalFrom" data-mode="edit" data-id="{{ $p->id }}" data-nama_produk="{{ $p->nama_produk }}" data-nama_supplier="{{ $p->nama_supplier }}" data-harga_beli="{{ $p->harga_beli }}" data-harga_jual="{{ $p->harga_jual }}" data-stok="{{ $p->stok }}" data-keterangan="{{ $p->keterangan }}">
                    <ion-icon name="create-outline"></ion-icon></button>

                <form method="POST" action="produktitipan/{{ $p->id }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-Delete"><ion-icon name="trash-outline"></ion-icon>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>