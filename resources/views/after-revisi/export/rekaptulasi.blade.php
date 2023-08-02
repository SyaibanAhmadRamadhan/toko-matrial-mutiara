@if ($type == 'pdf')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            #judul {
                text-align: center;
            }

            #halaman {
                width: auto;
                height: auto;
                position: absolute;
                border: 1px solid;
                padding-top: 30px;
                padding-left: 30px;
                padding-right: 30px;
                padding-bottom: 80px;
            }

            #total {
                text-align: right;
            }
        </style>
    </head>

    <body>
        <div id="halaman">
            <center>
                <h3>REKAPTULASI KAS</h3>
                <h4>TGL {{ $dari }} s/d TGL {{ $sampai }}</h4>
            </center>
            <table border="1" style="border-spacing: 0; margin: 0 auto;">
                <thead>
                    <tr>
                        <th rowspan="2" style="text-align: center">TANGGAL</th>
                        <th rowspan="2" style="text-align: center">DESKRIPSI</th>
                        <th rowspan="2" style="text-align: center">KETERANGAN</th>
                        <th colspan="2" style="text-align: center">JENIS</th>
                    </tr>
                    <tr>
                        <th style="text-align: center">PEMASUKAN</th>
                        <th style="text-align: center">PENGELUARAN</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $k => $p)
                        <tr>
                            <td>{{ $p['tanggal'] }}</td>
                            <td>{{ $p['deskripsi'] }}</td>
                            <td>{{ $p['keterangan'] }}</td>
                            @isset($p['uang_masuk'])
                                <td style="text-align: center">@currency($p['uang_masuk'])</td>
                                <td style="text-align: center;color: red;"><strong>-</strong></td>
                            @endisset
                            @isset($p['uang_keluar'])
                                <td style="text-align: center;color: red;"><strong>-</strong></td>
                                <td style="text-align: center">@currency($p['uang_keluar'])</td>
                            @endisset
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="3" style="text-align: right">total</th>
                        <th colspan="1" style="text-align: center">@currency($totalPemasukan)</th>
                        <th colspan="1" style="text-align: center">@currency($totalPengeluaran)</th>
                    </tr>
                    <tr>
                        <th colspan="3" style="text-align: right">SALDO</th>
                        <th colspan="2" style="text-align: center">@currency($totalPemasukan - $totalPengeluaran)</th>
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
        </div>

    </body>

    </html>
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
        <center>
            <h3>REKAPTULASI KAS</h3>
            <h4>TGL {{ $dari }} s/d TGL {{ $sampai }}</h4>
        </center>
        <table border="1" style="border-spacing: 0; margin: 0 auto;">
            <thead>
                <tr>
                    <th rowspan="2" style="text-align: center">TANGGAL</th>
                    <th rowspan="2" style="text-align: center">DESKRIPSI</th>
                    <th rowspan="2" style="text-align: center">KETERANGAN</th>
                    <th colspan="2" style="text-align: center">JENIS</th>
                </tr>
                <tr>
                    <th style="text-align: center">PEMASUKAN</th>
                    <th style="text-align: center">PENGELUARAN</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $k => $p)
                    <tr>
                        <td>{{ $p['tanggal'] }}</td>
                        <td>{{ $p['deskripsi'] }}</td>
                        <td>{{ $p['keterangan'] }}</td>
                        @isset($p['uang_masuk'])
                            <td style="text-align: center">@currency($p['uang_masuk'])</td>
                            <td style="text-align: center;color: red;"><strong>-</strong></td>
                        @endisset
                        @isset($p['uang_keluar'])
                            <td style="text-align: center;color: red;"><strong>-</strong></td>
                            <td style="text-align: center">@currency($p['uang_keluar'])</td>
                        @endisset
                    </tr>
                @endforeach
                <tr>
                    <th colspan="3" style="text-align: right">TOTAL</th>
                    <th colspan="1" style="text-align: center">@currency($totalPemasukan)</th>
                    <th colspan="1" style="text-align: center">@currency($totalPengeluaran)</th>
                </tr>
                <tr>
                    <th colspan="3" style="text-align: right">SALDO</th>
                    <th colspan="2" style="text-align: center">@currency($totalPemasukan - $totalPengeluaran)</th>
                </tr>
            </tbody>
        </table>

    </body>

    </html>

@endif
