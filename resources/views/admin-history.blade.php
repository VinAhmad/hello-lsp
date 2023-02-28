@extends('layouts.main')

@section('container')

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
                    <th scope="col">Kategori</th>
                    <th scope="col">Laporan</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Status</th>
                    <th scope="col">Feedback</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($aspirasi as $aspirasi)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $aspirasi->input_aspirasi->id }}</td>
                        <td>{{ $aspirasi->input_aspirasi->nis_f }}</td>
                        <td>{{ $aspirasi->kategori->kategori }}</td>
                        <td>{{ $aspirasi->input_aspirasi->laporan }}</td>
                        <td>{{ $aspirasi->input_aspirasi->lokasi }}</td>
                        <td>{{$aspirasi->status}}</td>
                        <td>{{$aspirasi->feedback}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
