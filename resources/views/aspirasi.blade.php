@extends('layouts.main')

@section('container')
    <div class="container w-50 bg-secondary rounded py-4 text-white">
        <p class="fs-2 text-center fw-bold">Aspirasi</p>

        <div class="container w-75 mx-auto">
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{ session('error') }}
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{ session('success') }}
                </div>
            @endif

            <form action="/aspirasi-input" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-2">
                    <label for="">NIS</label>
                    <input type="text" name="nis_f" value="{{ old('nis_f') }}"
                        class="numeric form-control @error('nis_f') 'is-invalid' @enderror" required>
                    @error('nis_f')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="">Kategori</label>
                    <select name="IdKategori" id="" class="form-control @error('IdKategori') is-invalid @enderror">
                        <option selected disabled hidden>Pilih Kategori</option>
                        @foreach ($kategori as $k)
                            <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label for="">Laporan</label>
                    <textarea required class="form-control" name=laporan>{{ old('laporan') }}</textarea>
                </div>

                <div class="form-group mb-2">
                    <label for="">Lokasi</label>
                    <textarea required name="lokasi" id="" class="form-control">{{ old('lokasi') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input class="form-control" accept="image/jpg,image/png" name="image" type="file" id="formFile">
                </div>

                <div class="form-group mb-4 mx-auto">
                    <button type="submit" class="btn btn-primary form-control">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="my-5"></div>
    <div id="feedback"></div>
    <div class="container w-50 bg-secondary rounded py-4 text-white">
        <p class="fs-2 text-center fw-bold">Status Laporan</p>
        <div class="container">
            <form action="" method="get">
                <div class="input-group mb-3">
                    <input type="text" name="id" class="form-control numeric" placeholder="Masukan id laporan"
                        aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-light b-1" type="submit" id="button-addon2">Search</button>
                </div>
            </form>
        </div>
        @isset($aspirasi)
            @if ($aspirasi->count() > 0)
                <div class="container">
                    <div class="row fs-4">
                        @foreach ($aspirasi as $aspirasi)
                            <div class="col-3">Id Laporan</div>
                            <div class="col-9">{{ $aspirasi->IdLaporan }}</div>
                            <div class="col-3">Kategori</div>
                            <div class="col-9">{{ $aspirasi->kategori->kategori }}</div>
                            <div class="col-3">Status</div>
                            <div class="col-9">{{ $aspirasi->status }}</div>
                            @if ($aspirasi->status == 'Selesai')
                                @if ($aspirasi->feedback == null)
                                    <div class="container bg-dark rounded w-75">
                                        <form action="aspirasi/feedback/{{ $aspirasi->id }}" method="post">
                                            @csrf
                                            <label for="">Silahkan masukan nilai anda</label>
                                            <div class="form-group">
                                                <input type="range" name="feedback" class="form-control my-2" id=""
                                                    min="1" max="5" value="5">
                                                <button type="submit" class="btn btn-primary form-control mb-2">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <div class="alert alert-success" role="alert">
                                        Terimaksih sudah menggunakan aplikasi kami
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            @else
                <p class="fs-5 text-center">Data tidak ditemukan</p>
            @endif
        @endisset
    </div>
    <div class="mb-5"></div>

    <script>
        $(document).ready(function() {
            $('.numeric').keypress(function(e) {
                var charCode = (e.which) ? e.which : event.keyCode
                if (String.fromCharCode(charCode).match(/[^0-9]/g))
                    return false;
            });
        });
    </script>
@endsection
