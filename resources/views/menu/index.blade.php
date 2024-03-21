@extends('Home.home')
@push('style')
@endpush
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Menu</h3>

        <!-- <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div> -->
    </div>
    <div class="dcard-body">
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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFromMenu">
            Tambah Menu
        </button>
        @include('menu.data')
    </div>
    <!-- /.card-body -->
    <div class="card-footer">Footer</div>
    <!-- /.card-footer-->
    @include('menu.form')
</div>
<!-- /.card -->

@endsection


@push('script')
<script>
    console.log('menu')
    $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
        $('.alert-success').slideUp(500)
    });

    $('#error-alert').fadeTo(10000, 500).slideUp(500, function() {
        $('#error-alert').slideUp(500)
    });


    $('#data-menu').DataTable()


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

    $('#modalFromMenu').on('show.bs.modal', function(e) {
        const btn = $(e.relatedTarget)
        // console.log(btn.data('mode'))
        const mode = btn.data('mode')
        const nama = btn.data('nama')
        const jumlah = btn.data('jumlah')
        const harga = btn.data('harga')
        const jenis = btn.data('jenis')
        const image = btn.data('image')
        const id = btn.data('id')
        const modal = $(this)
        if (mode == 'edit') {
            modal.find('.modal-title').text('Edit Data Menu')
            modal.find('#nama').val(nama)
            modal.find('#jumlah').val(jumlah)
            modal.find('#harga').val(harga)
            modal.find('#jenis').val(jenis)
            modal.find('#old_image').val(image)
            modal.find('.img-preview').attr('src', '{{asset("storage/images")}}/' + image)
            modal.find('.modal-body form').attr('action', '{{ url("menu")}}/' + id)
            modal.find('#method').html('@method("PATCH")')
        } else {
            modal.find('.modal-title').text('Input Data Menu')
            modal.find('#nama').val('')
            modal.find('#jumlah').val('')
            modal.find('#harga').val('')
            modal.find('#jenis').val('')
            modal.find('#old_image').val('')
            modal.find('.img-preview').attr('src', '')
            modal.find('#method').html('')
            modal.find('.modal-body form').attr('action', '{{url("menu")}}')
        }
    })

    function previewImage() {
        console.log('image')
        const image = document.querySelector('#image');
        const imagPreview = document.querySelector('.img-preview');

        imagPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imagPreview.src = oFREvent.target.result;
        }
        console.log(imagPreview.src)
    }
</script>
@endpush