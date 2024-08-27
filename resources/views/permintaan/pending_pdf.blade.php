<html>
    <head>
        <title>Permintaan Pending</title>
        <style>
            * {
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <center>
            <h3 style="font-size: 18px;">Data Permintaan Pending</h3>
            @php
                $dari_tanggal = $_GET['dari_tanggal'];
                $sampai_tanggal = $_GET['sampai_tanggal'];
            @endphp
            Periode {{ date('d-m-Y', strtotime($dari_tanggal)).' sd '.date('d-m-Y', strtotime($sampai_tanggal)) }}
        </center>
        <br>
        <table width="100%" cellspacing="0" border="1" cellpadding="2">
            <tr>
                <td>Tanggal</td>
                <td>Ruang</td>
                <td>Masalah</td>
                <td>Foto</td>
                <td>Status</td>
            </tr>

            @if (@$data!=null)
            @foreach ($data as $d)
                <tr>
                    <td>{{ date('d-m-Y H:i', strtotime(@$d->created_at)) }}</td>
                    <td>{{ @$d->ruangan->nama }}</td>
                    <td>{{ @$d->masalah }}</td>
                    <td>
                        @if (@$d->foto)
                            <img src="{{ @$d->foto }}" width="100px" alt="">
                        @endif
                    </td>
                    <td>{{ @$d->status }}</td>
                </tr>
            @endforeach
                
            @endif    
        </table> 
    </body>
</html>