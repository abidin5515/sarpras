@extends('layouts.app')
@section('title')
    <h1>{{ @$title }}</h1>
@endsection

@section('content')
    <style type="text/css">
        /*td {
          font-size: 14px;
        }*/
        span.select2-container {
            z-index: 0;
        }
    </style>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Master Barang</h3>
                            <div class="card-tools">
                                <button class="btn create-btn btn-primary" data-src="{{ url('master-barang/create') }}"
                                    data-title="Tambah">+ Tambah Barang</button>

                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">



                            <div class="table table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Kode</th>




                                        <th>Opsi</th>

                                    </thead>

                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.row -->
    </section>
@endsection



@push('scripts')
    <script>
        $(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('master-barang.json') !!}',
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'nama',
                        name: 'master_barang.nama'
                    },
                    {
                        data: 'kode',
                        name: 'master_barang.kode'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }

                ]
            });
        });
    </script>
@endpush
