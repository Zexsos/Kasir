@extends('Home.home')
@push('style')
@endpush
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Produk Titipan</h3>
        <div class="card-tools">


        </div>
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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFrom">
            Tambah Produk Titipan
        </button>
        <a href="{{ url('produk/export') }}" class="btn btn-success">Export excel</a>
        <form action="{{ route('import') }}" method="post" enctype="multipart/form-data" class="form-inline" id="importForm">
            @csrf
            <div class="form-group">
                <input type="file" name="file" class="form-control-file" id="file" style="display: none;">
            </div>
            <button type="button" class="btn btn-primary ml-2" id="importButton">Import</button>
        </form>


        @include('produktitipan.data')
    </div>
    <!-- /.card-body -->
    <div class="card-footer">Footer</div>
    <!-- /.card-footer-->
    @include('produktitipan.form')
</div>
<!-- /.card -->

@endsection


@push('scripts')
<script>
    $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
        $('.alert-success').slideUp(500)
    });

    $('#error-alert').fadeTo(10000, 500).slideUp(500, function() {
        $('#error-alert').slideUp(500)
    });


    $('#data-produktitipan').DataTable()


    $('.btn-Delete').on('click', function(e) {
        e.preventDefault(); // Prevent default form submission
        let form = $(this).closest('form');
        let id = form.attr('action').split('/').pop(); // Get the ID from the form action URL
        swal.fire({
            icon: 'warning',
            title: 'Hapus Data',
            html: `Apakah Anda yakin ingin menghapus data dengan ID <b>${id}</b>?`,
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Submit the form if confirmed
            } else {
                swal.close(); // Close the swal modal if not confirmed
            }
        });
    });

    $('#modalFrom').on('show.bs.modal', function(e) {
        const btn = $(e.relatedTarget)
        const mode = btn.data('mode')
        const nama_produk = btn.data('nama_produk')
        const nama_supplier = btn.data('nama_supplier')
        const harga_beli = btn.data('harga_beli')
        const harga_jual = btn.data('harga_jual')
        const stok = btn.data('stok')
        const keterangan = btn.data('keterangan')
        const id = btn.data('id')
        const modal = $(this)
        if (mode == 'edit') {
            modal.find('.modal-title').text('Edit Data Produk titipan')
            modal.find('#nama_produk').val(nama_produk)
            modal.find('#nama_supplier').val(nama_supplier)
            modal.find('#harga_beli').val(harga_beli)
            modal.find('#harga_jual').val(harga_jual)
            modal.find('#stok').val(stok)
            modal.find('#keterangan').val(keterangan)
            modal.find('.modal-body form').attr('action', '{{ url("produktitipan")}}/' + id)
            modal.find('#method').html('@method("PATCH")')
        } else {
            modal.find('.modal-title').text('Input Data Produk titipan')
            modal.find('#nama_produk').val('')
            modal.find('#nama_supplier').val('')
            modal.find('#harga_beli').val('')
            modal.find('#harga_jual').val('')
            modal.find('#stok').val('')
            modal.find('#keterangan').val('')
            modal.find('#method').html('')
            modal.find('.modal-body form').attr('action', '{{url("produktitipan")}}')
        }
    });

    function calculateSellingPrice(costPrice) {
        const profitMargin = 0.7; // 70% profit margin
        const roundingValue = 500; // Rounding to the nearest 500
        let sellingPrice = costPrice * (1 + profitMargin);
        sellingPrice = Math.ceil(sellingPrice / roundingValue) * roundingValue;
        return sellingPrice;
    }

    $('#harga_beli').on('input', function() {
        const costPrice = parseFloat($(this).val());
        if (!isNaN(costPrice)) {
            const sellingPrice = calculateSellingPrice(costPrice);
            $('#harga_jual').val(sellingPrice);
            $('#harga_jual_hidden').val(sellingPrice); // Store the calculated price in a hidden input
            $('#harga_jual_display').text(sellingPrice); // Optional: Display the calculated price to the user
        } else {
            // Clear the selling price if cost price is empty or not a number
            $('#harga_jual').val('');
            $('#harga_jual_hidden').val('');
            $('#harga_jual_display').text('');
        }
    });

    $(document).ready(function() {
        $('#importButton').click(function() {
            $('#file').click(); // Ketika tombol "Import" diklik, klik input file tersembunyi
        });

        $('#file').change(function() {
            $('#importForm').submit(); // Ketika file dipilih, submit form
        });
    });
</script>

@endpush