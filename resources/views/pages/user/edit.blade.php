@extends('layouts.dashboard')

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Ubah Data User</h5>
                </div>
                <div class="card-body px-4 py-4">
                    <form role="form" method="POST" action="{{ route('user.update', $data->id) }}">
                        @method('PUT')
                        @csrf

                        <div class="mb-3">
                        <h6 style="font-size: 12px; color:; color:grey;">Username:</h6>                            <input type="text" class="form-control form-control-lg" placeholder="Nama User"
                                aria-label="Nama User" name="username" value="{{ old('username', $data->username) }}" required>
                        </div>

                        <div class="mb-3">
                        <h6 style="font-size: 12px; color:; color:grey;">Password:</h6>      
                            <input type="password" class="form-control form-control-lg" placeholder="Password (Kosongkan jika tidak ingin ubah)"
                                aria-label="Password" name="password">
                        </div>

                        <div class="mb-3">
                        <h6 style="font-size: 12px; color:; color:grey;">Role:</h6>      
                            <select class="form-control form-control-lg" name="role" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="ADMIN" {{ old('role', $data->role) == 'ADMIN' ? 'selected' : '' }}>ADMIN</option>
                                <option value="KASIR" {{ old('role', $data->role) == 'KASIR' ? 'selected' : '' }}>KASIR</option>
                                <option value="WAITER" {{ old('role', $data->role) == 'WAITER' ? 'selected' : '' }}>WAITER</option>
                                <option value="OWNER" {{ old('role', $data->role) == 'OWNER' ? 'selected' : '' }}>OWNER</option>
                            </select>
                        </div>

                        <div class="text-center">
                            <a href="" class="btn btn-lg btn-success w-100 mt-4 mb-0" data-bs-toggle="modal"
                                data-bs-target="#updateModal">Perbarui</a>
                            <a href="{{ route('user.index') }}" class="btn btn-lg btn-primary w-100 mt-4 mb-0">Kembali</a>
                        </div>

                        <!-- Modal Konfirmasi Update -->
                        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-center align-items-center" style="height: 250px">
                                            <i class="fa-solid fa-question fa-beat fa-2xl h-75" style="color: #ffae00;"></i>
                                        </div>

                                        <div class="text-center">
                                            <h4>Yakin ingin memperbarui data user ini?</h4>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-warning">Yakin</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
