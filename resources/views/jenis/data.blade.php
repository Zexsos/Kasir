<table class="datatable-init nowrap table" id="data-jenis">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Jenis</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jenis as $p)
        <tr>
            <td>{{$i = !isset($i)?$i=1:++$i}}</td>
            <td>{{ $p -> jenis}}</td>
            <td>
                <button type=" button" class="btn btn-success btn-edit" data-toggle="modal" data-target="#modalFromJenis" data-mode="edit" data-id="{{$p->id}}" data-jenis="{{$p->jenis}}">
                    <ion-icon name="create-outline"></ion-icon></button>

                <form method="POST" action="jenis/{{ $p->id }}" style="display:inline">
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