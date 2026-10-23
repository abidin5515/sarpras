<!DOCTYPE html>
<html>

<head>
    <title>Laporan Perbaikan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>LEMBAR LAPORAN DAN PERBAIKAN SARPRAS</h2>
        <p>Tanggal Cetak: {{ date('d-m-Y H:i') }}</p>
    </div>

    <h4>I. INFORMASI KERUSAKAN</h4>
    <table>
        <tr>
            <th width="30%">Tanggal Lapor</th>
            <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
        </tr>
        <tr>
            <th>Uraian Masalah</th>
            <td>{{ $data->masalah }}</td>
        </tr>
    </table>

    <h4>II. TINDAKAN PERBAIKAN</h4>
    <table>
        <tr>
            <th width="30%">Tindakan Sementara</th>
            <td>{{ $data->tindakan_sementara }}</td>
        </tr>
        <tr>
            <th>Tindakan Perbaikan</th>
            <td>{{ $data->tindakan_perbaikan }}</td>
        </tr>
        <tr>
            <th>Waktu Perbaikan</th>
            <td>
                Tanggal: {{ date('d-m-Y', strtotime($data->tanggal)) }} <br>
                Pukul: {{ date('H:i', strtotime($data->jam_mulai)) }} - {{ date('H:i', strtotime($data->jam_selesai)) }}
            </td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $data->status }}</td>
        </tr>
        <tr>
            <th>Teknisi Bertugas</th>
            <td>
                @php
                    $id_tek = explode(',', $data->id_teknisi);
                    foreach ($id_tek as $t) {
                        echo ambil_teknisi($t) . ', ';
                    }
                @endphp
            </td>
        </tr>
    </table>

    <br><br>
    <table style="border:none;">
        <tr style="border:none;">
            <td style="border:none; text-align:center; width:50%;">
                Mengetahui,<br>Kepala Bagian<br><br><br><br>( ............................ )
            </td>
            <td style="border:none; text-align:center; width:50%;">
                Teknisi,<br><br><br><br><br>( ............................ )
            </td>
        </tr>
    </table>
</body>

</html>
