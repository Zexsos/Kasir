<table class="datatable-init nowrap table" id="data-menu">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>image</th>
            <th>jumlah</th>
            <th>Harga</th>
            <th>jenis</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($menu as $p)
        <tr>
            <td>{{$i = !isset($i)?$i=1:++$i}}</td>
            <td>{{ $p -> nama}}</td>
            <td><img src="{{ asset('storage/images/'.$p->image) }}" style="width:50px;"></td>
            <td>{{ $p -> jumlah}}</td>
            <td>{{ $p -> harga}}</td>
            <td>{{ $p -> jenis->jenis}}</td>
            <td>
                <button type=" button" class="btn btn-success btn-edit" data-toggle="modal" data-target="#modalFromMenu" data-mode="edit" data-id="{{$p->id}}" data-nama="{{$p->nama}}" data-jumlah="{{ $p->jumlah}}" data-harga="{{$p->harga}}" data-image="{{$p->image}}" data-jenis="{{$p->jenis}}"="">
                    <ion-icon name="create-outline"></ion-icon></button>

                <form method="POST" action="menu/{{ $p->id }}" style="display:inline">
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