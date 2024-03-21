<table class="datatable-init nowrap table" id="data-pelanggan">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pelanggan as $p)
        <tr>
            <td>{{$i = !isset($i)?$i=1:++$i}}</td>
            <td>{{ $p -> nama}}</td>
            <td>{{ $p -> email}}</td>
            <td>{{ $p -> no_telp}}</td>
            <td>{{ $p -> alamat}}</td>
            <td>
                <button type=" button" class="btn btn-success btn-edit" data-toggle="modal" data-target="#modalFromPelanggan" data-mode="edit" data-id="{{$p->id}}" data-nama="{{$p->nama}}" data-email="{{$p->email}}" data-no_telp="{{$p->no_telp}}" data-alamat="{{$p->alamat}}">
                    <ion-icon name="create-outline"></ion-icon></button>

                <form method="POST" action="pelanggan/{{ $p->id }}" style="display:inline">
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