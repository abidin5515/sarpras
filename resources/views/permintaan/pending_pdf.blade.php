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
                <td valign="top" width="15%">Tanggal</td>
                <td valign="top">Ruang</td>
                <td valign="top">Masalah</td>
                <td valign="top">Foto</td>
                <td valign="top">Status</td>
            </tr>

            @if (@$data!=null)
            @foreach ($data as $d)
                <tr>
                    <td valign="top">{{ date('d-m-Y H:i', strtotime(@$d->created_at)) }}</td>
                    <td valign="top">{{ @$d->ruangan->nama }}</td>
                    <td valign="top">{{ @$d->masalah }}</td>
                    <td valign="top">
                        @if (@$d->foto)
                            <img src="{{ @$d->foto }}" width="100px" alt="">
                        @endif
                    </td>
                    <td valign="top">{{ @$d->status }}</td>
                </tr>
            @endforeach
                
            @endif    
        </table> 
    </body>
</html>