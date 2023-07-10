<!DOCTYPE html>
<html>

<head>
    <style type="text/css">
        body {
            font-family: Arial;
            color: black;
        }
    </style>
</head>

<body>
    <center>
        <h1>PT. Industri aja</h1>
        <h2>Daftar Gaji Pegawai</h2>
        <hr style="width: 50%; border-width: 5px; color: black">
    </center>


    <table style="width: 100%">
        <tr>
            <td width="20%">Nama Pegawai</td>
            <td width="2%">:</td>
            <td>{{ $employe->name }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $employe->nik }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $employe->position->name }}</td>
        </tr>
    </table>

    <table class="table table-striped table-bordered mt-3">
        <tr>
            <th class="text-center" width="5%">No</th>
            <th class="text-center">Keterangan</th>
            <th class="text-center">Jumlah</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Gaji Pokok</td>
            <td>@currency($employe->position->basic_salary)</td>
        </tr>


        <tr>
            <th colspan="2" style="text-align: right;">Total Gaji : </th>
            <th>@currency($employe->position->basic_salary)</th>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td></td>
            <td>
                <p>Pegawai</p>
                <br>
                <br>
                <p class="font-weight-bold">{{ $employe->name }}</p>
            </td>

            <td width="200px">
                <p>depok, <?php echo date('d M Y'); ?> <br> Finance,</p>
                <br>
                <br>
                <p>___________________</p>
            </td>
        </tr>
    </table>


</body>

</html>
