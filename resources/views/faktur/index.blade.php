<body>
    <h2>Cafe Indomart</h2>
    <h5>Jl. Mockingjay No. 45, 34234</h5>
    <hr>
    <h5>No. Faktur: {{ $transaksi->id }}</h5>
    <h5>{{ $transaksi->tanggal }}</h5>
    <table border="0">
        <thead>
            <tr>
                <td>Qty</td>
                <td>Item</td>
                <td>Harga</td>
                <td>Total</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi->detail_transaksi as $item)
            <tr>
                <td>{{ $item->jumlah ?? ''}}</td>
                <td>{{ $item->menu->nama ?? ''}}</td>
                <td>{{ $item->menu->harga ?? ''}}</td>
                <td>{{$item->subtotal ?? ''}}</td>
            </tr>
            @endforeach
        <tbody>
        <tfoot>
            <tr>
                <td colspan="3">Total</td>
                <td>{{$transaksi->total_harga}}</td>
            </tr>
        </tfoot>
    </table>
</body>