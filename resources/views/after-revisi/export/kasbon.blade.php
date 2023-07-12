<style>
    #total {
        text-align: right;
    }
</style>
<table border="1" style="border-spacing: 0; margin: 0 auto;">
    <thead>
        <tr>
            <th scope="col" style="padding: 0.3rem; text-align: left">TANGGAL KASBON</th>
            <th scope="col" style="padding: 0.3rem; text-align: left">NAMA</th>
            <th scope="col" style="padding: 0.3rem; text-align: left">NO TELEPON</th>
            <th scope="col" style="padding: 0.3rem; text-align: left">KETERANGAN</th>
            <th scope="col" style="padding: 0.3rem; text-align: left">UANG KASBON</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($kasbon as $key => $p)
            <tr>
                <td style="text-align: left">{{ $p->tanggal_kasbon }}</td>
                <td style="text-align: left">{{ $p->nama }}</td>
                <td style="text-align: left">{{ $p->no_telepon }}</td>
                <td style="text-align: left">{{ $p->keterangan }}</td>
                <td style="text-align: left">@currency($p->uang_kasbon)</td>
            </tr>
        @endforeach
        <tr>
            <th id="total" colspan="4" scope="col" style="padding: 0.3rem; text-align: right">TOTAL</th>
            <td>@currency($total)</td>
        </tr>
    </tbody>
</table>
