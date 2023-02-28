@extends('layouts.main')

@section('container')
    <form action="" method="get">
        <div class="row row-cols-3">
            <div class="col">
                <div class="input-group ">
                    <input type="text" name="id" class="form-control" placeholder="Search by id"
                        aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submt" id="button-addon2">Search</button>
                </div>
            </div>

            <div class="col">
                <div class="input-group">
                    <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
                    <select name="kategori" class="form-select" id="inputGroupSelect01" onchange="this.form.submit()">
                        <option selected disabled hidden>Kategori</option>
                        <option value="1">Kebersihan</option>
                        <option value="2">Keamanan</option>
                        <option value="3">Penugasan</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Id laporan</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Laporan</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @if ($aspirasi->count() > 0)
                    @foreach ($aspirasi as $aspirasi)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $aspirasi->input_aspirasi->id }}</td>
                            <td>{{ $aspirasi->input_aspirasi->nis_f }}</td>
                            <td>{{ $aspirasi->input_aspirasi->siswa->nama }}</td>
                            <td>{{ $aspirasi->input_aspirasi->siswa->kelas }}</td>
                            <td>{{ $aspirasi->kategori->kategori }}</td>
                            <td>{{ $aspirasi->input_aspirasi->laporan }}</td>
                            <td>{{ $aspirasi->input_aspirasi->lokasi }}</td>
                            <td class="w-25">
                                @if ($aspirasi->input_aspirasi->image)
                                    <div type="button" class="container" data-bs-toggle="modal"
                                        data-bs-target="#image_{{ $aspirasi->id }}">
                                        <img src="{{ asset('storage/' . $aspirasi->input_aspirasi->image) }}" class="img-flex w-50" alt="">
                                    </div>

                                    <div class="modal fade" id="image_{{ $aspirasi->id }}" tabindex="-1"
                                        aria-labelledby="image_{{ $aspirasi->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="image_{{ $aspirasi->id }}Label">
                                                        Images</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
													<img src="{{ asset('storage/' . $aspirasi->input_aspirasi->image) }}" class="img-fluid" alt="">
                                                </div>
                                                <div class="modal-footer">
                                                    {{-- <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button> --}}
                                                    {{-- <button type="submit" class="btn btn-primary">Delete</button> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                @endif
                            </td>
                            <td>
                                <form action="/admin/edit/{{ $aspirasi->id }}" method="post">
                                    @csrf
                                    <select name="status" id="" class="form-control"
                                        onchange="this.form.submit()">
                                        @php($sts = ['Menunggu', 'Proses', 'Selesai'])

                                        @foreach ($sts as $s)
                                            @if ($s == $aspirasi->status)
                                                <option selected value="{{ $s }}">{{ $s }}
                                                </option>
                                            @else
                                                <option value="{{ $s }}">{{ $s }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal_{{ $aspirasi->id }}">
                                    <i class="bi bi-trash3"></i>
                                </button>

                                <div class="modal fade" id="deleteModal_{{ $aspirasi->id }}" tabindex="-1"
                                    aria-labelledby="deleteModal_{{ $aspirasi->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="deleteModal_{{ $aspirasi->id }}Label">
                                                    Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="/admin/delete/{{ $aspirasi->id }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    Yakin untuk menghapus data? dengan id: {{ $aspirasi->id }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <td colspan="9">
                        <div class="text-center">
                            <span class="fw-b">
                                Tidak ada data
                            </span>
                        </div>
                    </td>
                @endif
            </tbody>
        </table>
    </div>
@endsection
