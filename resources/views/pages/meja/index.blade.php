@extends('layouts.dashboard')

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Data Meja</h5>
                </div>
                <a href="{{ route('meja.create') }}" class="btn btn-success m-4">Tambah Meja Baru</a>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-2">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7">
                                        #
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 w-50">
                                        No Meja</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="text-center">
                                            {{ $no++ }}
                                        </td>
                                        <td class="">
                                            <p class="text-sm font-weight-bold mb-0">{{ $item->no_meja }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if ($item->status === 'DIGUNAKAN')
                                                <span class="badge bg-gradient-danger">{{ $item->status }}</span>
                                            @else
                                                <span class="badge bg-gradient-success">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center pt-4">
                                            <a href="{{ route('meja.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <a href="" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $item->id }}">Delete</a>

                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            @if ($item->status == 'TERSEDIA')
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="d-flex justify-content-center align-items-center"
                                                            style="height: 250px">
                                                            <i class="fa-solid fa-exclamation fa-bounce fa-2xl h-75"
                                                                style="color: #ea2e2e;"></i>
                                                        </div>

                                                        <div class="text-center">
                                                            <h4>Yakin ingin menghapus data ini?</h4>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ngga
                                                            jadi</button>
                                                        <form action="{{ route('meja.destroy', $item->id) }}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger">Yakin</button>
                                                        </form>

                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->status == 'DIGUNAKAN')
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="d-flex justify-content-center align-items-center"
                                                            style="height: 250px">
                                                            <i class="fa-solid fa-exclamation fa-bounce fa-2xl h-75"
                                                                style="color: #ea2e2e;"></i>
                                                        </div>

                                                        <div class="text-center">
                                                            <h4>Gagal menghapus meja karena meja sedang digunakan, tunggu
                                                                hingga meja selesai digunakan</h4>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-dismiss="modal">Oke</button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif
@endsection