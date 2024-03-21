@extends('Home.home')
@push('style')
<style>
    .menu-container {
        list-style-type: none;
    }

    .menu-container li {
        margin-bottom: 20px;
    }

    .menu-container li h3 {
        text-transform: uppercase;
        font-weight: bold;
        font-size: 18px;
        background-color: aliceblue;
        padding: 5px 15px;
    }

    .menu-item {
        list-style-type: none;
        margin: 10px 20px;
        display: flex;
        flex-wrap: wrap-reverse;
        justify-content: flex-start;
        /* Atur flex-start agar card-menu berada di sisi kiri */
        gap: 10px;
        /* Atur jarak antar card-menu */
    }

    .menu-item .card {
        width: 18rem;
        border-radius: 10px;
        /* Atur sudut melengkung */
        overflow: hidden;
        /* Hindari gambar keluar dari card */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Efek bayangan */
        transition: transform 0.3s, box-shadow 0.3s;
        /* Transisi untuk efek hover */
    }

    .menu-item .card img {
        display: block;
        margin: 0 auto;
        border-radius: 10px 10px 0 0;
        /* Posisikan gambar di tengah */
        width: 100%;
    }

    .menu-item .card .card-body {
        text-align: center;
        /* Posisikan teks di tengah */
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px;
    }

    .menu-item .card .qty-overlay {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 5px 10px;
        border-radius: 5px;
        display: none;
    }

    .menu-item .card:hover .qty-overlay {
        display: block;
    }


    .menu-item .card:hover {
        transform: scale(1.05);
        /* Efek membesar saat hover */
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        /* Efek bayangan saat hover */
    }

    .ordered-list .card {
        margin-bottom: 10px;
    }
</style>
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 ">
            <ul class="menu-container ">
                @foreach($jenis as $j)
                <li>
                    <button class=" btn btn-primary jenis-button" data-id="{{$j->id}}">{{$j->jenis}}</button>
                    <div class="menu-item jenis-{{$j->id}} hidden " id="menu-{{$j->id}}">
                        @foreach($menu->where('jenis_id', $j->id) as $p)
                        <div class="card" style="width: 100px; height:200px;" data-harga="{{$p->harga}}" data-id="{{$p->id}}" data-jumlah="{{$p->jumlah}}">
                            <div class="qty-overlay">{{$p->jumlah}}</div>
                            <img src="{{ asset('storage/images/'.$p->image) }}" class="card-img-top" style="height: 100px; object-fit: cover;">
                            <div class="card-body">
                                <h6 class="card-title" style=" font-family: 'Open Sans', sans-serif; font-size:15px;">{{$p->nama}}</h6>
                                <p class="card-text" style="margin-top:-15px;">Rp. {{$p->harga}}</p>
                                <button class="btn btn-primary add-to-order" style="margin-top:-15px;">Pesan</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="col-4">
            <h3>Daftar Pesanan</h3>
            <div class="ordered-list"></div>
            <div>
                <h4>Total: <span id="total">0</span></h4>
                <div class="d-flex">
                    <select class="form-control mr-2" id="pelanggan" name="pelanggan">
                        <option value="">Pilih Pelanggan</option>
                        @foreach($pelanggan as $p)
                        <option data-id="{{$p->id}}" value="{{ $p->id }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
                    <button id="btn-bayar" class="btn btn-success" style="margin-left: 10px;;">Bayar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(function() {

        const orderedList = []

        const sum = () => {
            return orderedList.reduce((accumulator, Object) => {
                return accumulator + (Object.harga * Object.qty);
            }, 0)
        };

        const changeQty = (el, inc) => {
            const id = $(el).closest('.card')[0].dataset.id;
            const index = orderedList.findIndex(list => list.menu_id == id)
            orderedList[index].qty += orderedList[index].qty == 1 && inc == -1 ? 0 : inc

            const txt_subtotal = $(el).closest('.card').find('.subtotal')[0];
            const txt_qty = $(el).closest('.card').find('.qty-item')[0]
            txt_qty.innerText = parseInt(txt_qty.innerText) == 1 && inc == -1 ? 1 : parseInt(txt_qty.innerText) + inc
            txt_subtotal.innerHTML = orderedList[index].harga * orderedList[index].qty;

            $('#total').html(sum())
        }

        $('.menu-item').on('click', '.add-to-order', function() {
            const card = $(this).closest('.card');
            const menu_clicked = card.find('.card-title').text();
            const data = card[0].dataset;
            const harga = parseFloat(data.harga);
            const id = parseInt(data.id)
            const gambar = card.find('img').attr('src');
            console.log(this)
            if (orderedList.every(list => list.menu_id !== id)) {
                let dataN = {
                    'menu_id': id,
                    'menu': menu_clicked,
                    'harga': harga,
                    'qty': 1
                }
                orderedList.push(dataN);
                let listOrder = ` <div class="card ordered-item" style="border-radius:20px;  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);" data-id="${id}">
        <div class="card-body text-right" style="display: flex; flex-direction: column;">
            <div style="display: flex; align-items: center;">
                <img src="${gambar}" style="width:50px; height: 50px; border-radius: 10px;">
                <h6 style="margin-left:10px; margin-top:-20px;flex-grow: 1;">${menu_clicked}</h6></div>`
                listOrder += `<p class="card-text" style="margin-left:60px; margin-top:-25px;">Harga: Rp. ${harga}</p>`
                listOrder += ` <div class="kotak" style="display: flex; align-items: center; justify-content: space-between;"><button class='btn btn-secondary btn-dec' style="width:50px; height:25px;">-</button>`
                listOrder += `<span class="qty-item">1</span>`
                listOrder += `<button class="btn btn-secondary btn-inc" style="width:50px; height:25px;">+</button>`
                listOrder += `<button class='btn btn-danger remove-item' style="width:70px; height:25px;">hapus</button></div>`
                listOrder += `<h6 style="margin-top:10px;">Sub Total: <span class="subtotal">${harga*1}</span></h6></div></div>`

                $('.ordered-list').append(listOrder)
            }
            $('#total').html(sum())
        });

        $('.ordered-list').on('click', '.btn-dec', function() {
            changeQty(this, -1)
        })
        $('.ordered-list').on('click', '.btn-inc', function() {
            changeQty(this, 1)
        })

        $('.ordered-list').on('click', '.remove-item', function() {
            const card = $(this).closest('.card');
            const id = card[0].dataset.id;
            let index = orderedList.findIndex(list => list.menu_id == parseInt(id))
            orderedList.splice(index, 1)
            card.remove();
            $('#total').html(sum())
        })

        $('.select-pelanggan').on('click', function() {
            const idPelanggan = $(this).data('id');
            $('#pelanggan').val(idPelanggan);
        });


        $('#btn-bayar').on('click', function() {
            const idPelanggan = $('#pelanggan').val();
            $.ajax({
                url: "{{route('transaksi.store')}}",
                method: "POST",
                data: {
                    "_token": "{{csrf_token()}}",
                    orderedList: orderedList,
                    "pelanggan": idPelanggan,
                    total: sum()
                },
                success: function(data) {
                    console.log(data)
                    swal.fire({
                        title: data.message,
                        showDenyButton: true,
                        confirmButtonText: "Cetak Nota",
                        denyButtonText: "Ok"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.open("nota/" + data.notrans)
                            location.reload()
                        } else if (result.isDenied) {
                            location.reload()
                        }
                    });
                },
                error: function(request, status, error) {
                    console.log(status, error)
                    Swal.fire('Pemesanan Gagal!')
                }
            });
        });

        $(document).ready(function() {
            // Hide all menu items initially
            $('.menu-item').hide();

            // Toggle menu items when button is clicked
            $('.jenis-button').on('click', function() {
                const jenisId = $(this).data('id');
                $(`.jenis-${jenisId}`).slideToggle();
            });
        });

    });
</script>
@endpush