@extends('layout.main')

@section('title', 'Riwayat')

@section('head_title', 'Riwayat')

@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Tabel Riwayat Pengaduan<h2><strong>Sudah diverifikasi</strong></h2>
                    </h3>
                    <Button class="btn btn-success mt-3" onclick="window.location.href='riwayat'">Sudah diverifikasi</Button>
                    <Button class="btn btn-danger mt-3" onclick="window.location.href='riwayatditolak'">Pengajuan Ditolak</Button>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="no">No</th>
                                <th scope="col" class="sort" data-sort="name">Nama Jalan</th>
                                <th scope="col" class="sort" data-sort="budget">Status Pengaduan</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php $no = 0; ?>
                            @foreach($data as $item)
                            <?php $no++; ?>
                            <tr>
                                <th scope="row">

                                    <div class="media align-items-center">
                                        <div class="media-body">

                                            <span class="name mb-0 text-sm">{{ $no }}</span>
                                        </div>
                                    </div>
                                </th>
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <!-- <a href="#" class="avatar rounded-circle mr-3">
                                            <img alt="Image placeholder" src="../assets/img/theme/bootstrap.jpg">
                                        </a> -->
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">{{$item['nama_jalan']}}</span>
                                        </div>
                                    </div>
                                </th>

                                <td class="budget">
                                    <button class="btn btn-success disabled">{{$item['status_pengaduan']}}</button>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="{{ url('riwayat/detail/' . $item['id']) }}">Detail</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection