@if ($type == 'pdf')
    <h3 style="text-align: center">REKAP PENGELUARAN KAS</h3>
    <h4 style="text-align: center">TGL {{ $dari }} s/d TGL {{ $sampai }}</h4>
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
                <th id="total" colspan="3" scope="col" style="padding: 0.3rem; text-align: right">
                    TOTAL
                </th>
                <td>@currency($total)</td>
            </tr>
        </tbody>
    </table>
    <br>

    <span style="float: left;">mengetahui</span>
    <span style="float: right;">ttd</span>
    <br>
    <br>
    <br>
    <br>
    <br>
    <span style="float: left;">_______________________</span>
    <span style="float: right;">_______________________</span>
@else
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            #total {
                text-align: right;
            }
        </style>
    </head>

    <body>
        <h3 style="text-align: center">REKAP PENGELUARAN KAS</h3>
        <h4 style="text-align: center">TGL {{ $dari }} s/d TGL {{ $sampai }}</h4>
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
                    <th id="total" colspan="3" scope="col" style="padding: 0.3rem; text-align: right">
                        TOTAL
                    </th>
                    <td>@currency($total)</td>
                </tr>
            </tbody>
        </table>

    </body>

    </html>

@endif
