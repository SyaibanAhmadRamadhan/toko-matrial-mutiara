<style>
    #total {
        text-align: right;
    }
</style>
<table border="1" style="border-spacing: 0; margin: 0 auto;">
    <thead>
        <tr>
            <th scope="col" style="padding: 0.3rem; text-align: left">TANGGAL KELUAR</th>
            <th scope="col" style="padding: 0.3rem; text-align: left">DESKRIPSI</th>
            <th scope="col" style="padding: 0.3rem; text-align: left">KETERANGAN</th>
            <th scope="col" style="padding: 0.3rem; text-align: left">UANG KELUAR</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($pengeluaran as $key => $p)
            <tr>
                <td style="text-align: left">{{ $p->tanggal_keluar }}</td>
                <td style="text-align: left">{{ $p->deskripsi }}</td>
                <td style="text-align: left">{{ $p->keterangan }}</td>
                <td style="text-align: left">@currency($p->uang_keluar)</td>
            </tr>
        @endforeach
        <tr>
            <th id="total" colspan="3" scope="col" style="padding: 0.3rem; text-align: right">TOTAL</th>
            <td>@currency($total)</td>
        </tr>``
    </tbody>
</table>
