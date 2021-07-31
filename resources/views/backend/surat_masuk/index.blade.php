@extends('backend.template')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-right">
                        <a href="{{ route('suratmasuk.create') }}" class="btn btn-primary btn-sm"><i
                                class="ti-pencil-alt"></i>Tambah</a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover table-responsive">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th>Isi Ringkas</th>
                                <th>Asal Surat</th>
                                <th>Kode</th>
                                <th>No. Surat</th>
                                <th>Tgl. Surat</th>
                                <th>Tgl. Diterima</th>
                                <th>Keterangan</th>
                                <th>File</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    <script type="text/javascript">
        $(document).ready(function() {
            table = $('#example2').DataTable({
                processing: true,
                serverside: true,
                ajax: "{{ route('suratmasuk.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'isi',
                        name: 'isi'
                    },
                    {
                        data: 'asal_surat',
                        name: 'asal_surat'
                    },
                    {
                        data: 'kode',
                        name: 'kode'
                    },
                    {
                        data: 'no_surat',
                        name: 'no_surat'
                    },
                    {
                        data: 'tgl_surat',
                        name: 'tgl_surat'
                    },
                    {
                        data: 'tgl_terima',
                        name: 'tgl_terima'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'filemasuk',
                        name: 'filemasuk',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [0, 'asc']
                ]
            });
        });
    </script>


@endsection
