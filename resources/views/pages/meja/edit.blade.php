@extends('layouts.dashboard')

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Ubah Data Meja</h5>
                </div>
                <div class="card-body px-4 py-4">
                    <form role="form" method="POST" action="{{ route('meja.update', $data->id) }}">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control form-control-lg" placeholder="No Meja"
                                aria-label="no meja" name="no_meja" value="{{ $data->no_meja }}" required>
                        </div>
                        {{-- <div class="mb-3">
                            <input type="text" class="form-control form-control-lg" placeholder="Harga"
                                aria-label="Harga" name="harga" value="{{ $data->harga }}" required>
                        </div> --}}
                        <div class="text-center">
                            <a href="" class="btn btn-lg btn-success btn-lg w-100 mt-4 mb-0" data-bs-toggle="modal"
                                data-bs-target="#updateModal">Perbarui</a>
                            <a href="{{ route('meja.index') }}"
                                class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Kembali</a>
                        </div>
                        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                @if ($data->status == 'TERSEDIA')
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-center align-items-center"
                                                style="height: 250px">
                                                <i class="fa-solid fa-question fa-beat fa-2xl h-75"
                                                    style="color: #ffae00;"></i>
                                            </div>

                                            <div class="text-center">
                                                <h4>Yakin ingin memperbarui data ?</h4>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ngga
                                                jadi</button>

                                            <button type="submit" class="btn btn-warning">Yakin</button>

                                        </div>
                                    </div>
                                @endif
                                @if ($data->status == 'DIGUNAKAN')
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
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
