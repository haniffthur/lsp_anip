@extends('layouts.dashboard')

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Tambah Data User</h5>
                </div>
                <div class="card-body px-4 py-4">
                    <form role="form" method="POST" action="{{ route('user.store') }}">
                        @csrf

                        <div class="mb-3">
                            <input type="text" class="form-control form-control-lg" placeholder="Nama User"
                                aria-label="Nama User" name="username" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" class="form-control form-control-lg" placeholder="Password"
                                aria-label="Password" name="password" required>
                        </div>

                        <div class="mb-3">
                            <select class="form-control form-control-lg" name="role" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="ADMIN">ADMIN</option>
                                <option value="KASIR">KASIR</option>
                                <option value="WAITER">WAITER</option>
                                <option value="OWNER">OWNER</option>
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-success w-100 mt-4 mb-0">Tambah</button>
                            <a href="{{ route('user.index') }}" class="btn btn-lg btn-primary w-100 mt-4 mb-0">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonText: 'OK'
        });
    </script>
@endif
@endsection