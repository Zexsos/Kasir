@extends('Home.home')
@push('style')
@endpush
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">pelanggan</h3>

        <!-- <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div> -->
    </div>
    <div class="card-body">
        <!-- Button trigger modal -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach($errors -> all() as $error)
                <li>
                    {{$error}}
                </li>
                @endforeach
            </ul>

        </div>
        @endif
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFromPelanggan">
            Tambah Pelanggan
        </button>
        @include('pelanggan.data')
    </div>
    <!-- /.card-body -->
    <div class="card-footer">Footer</div>
    <!-- /.card-footer-->
    @include('pelanggan.form')
</div>
<!-- /.card -->

@endsection


@push('script')
<script>
    $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
        $('.alert-success').slideUp(500)
    });

    $('#error-alert').fadeTo(10000, 500).slideUp(500, function() {
        $('#error-alert').slideUp(500)
    });


    $('#data-pelanggan').DataTable()


    $('.btn-Delete').on('click', function(e) {
        let nama = $(this).closest('tr').find('td:eq(0)').text();
        swal.fire({
            icon: 'error',
            title: 'Hapus Data',
            html: `Apakah Data <b>${nama}<b> akan dihapus?`,
            confirmButtonText: 'Ya',
            denyButtonText: 'tidak',
            showDenyButton: true,
            focusConfirm: false
        }).then((result) => {
            if (result.isConfirmed) $(e.target).closest('form').submit()
            else swal.close();
        })
    })

    $('#modalFromPelanggan').on('show.bs.modal', function(e) {
        const btn = $(e.relatedTarget)
        // console.log(btn.data('mode'))
        const mode = btn.data('mode')
        const nama = btn.data('nama')
        const email = btn.data('email')
        const no_telp = btn.data('no_telp')
        const alamat = btn.data('alamat')
        const id = btn.data('id')
        const modal = $(this)
        if (mode == 'edit') {
            modal.find('.modal-title').text('Edit Data Pelanggan')
            modal.find('#nama').val(nama)
            modal.find('#email').val(email)
            modal.find('#no_telp').val(no_telp)
            modal.find('#alamat').val(alamat)
            modal.find('.modal-body form').attr('action', '{{ url("pelanggan")}}/' + id)
            modal.find('#method').html('@method("PATCH")')
        } else {
            modal.find('.modal-title').text('Input Data Pelanggan')
            modal.find('#nama').val('')
            modal.find('#email').val('')
            modal.find('#no_telp').val('')
            modal.find('#alamat').val('')
            modal.find('#method').html('')
            modal.find('.modal-body form').attr('action', '{{url("pelanggan")}}')
        }
    })
</script>
@endpush