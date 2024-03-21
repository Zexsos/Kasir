<table class="datatable-init nowrap table" id="data-stok">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Menu</th>
            <th>Stok</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stok as $p)
        <tr>
            <td>{{$i = !isset($i)?$i=1:++$i}}</td>
            <td>{{ $p -> menu->nama}}</td>
            <td>{{ $p -> jumlah}}</td>
            <td>
                <button type=" button" class="btn btn-success btn-edit" data-toggle="modal" data-target="#modalFromStok" data-mode="edit" data-id="{{$p->id}}" data-nama="{{$p->menu->nama}}" data-jumlah="{{$p->jumlah}}">
                    <ion-icon name="create-outline"></ion-icon></button>

                <form method="POST" action="stok/{{ $p->id }}" style="display:inline">
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