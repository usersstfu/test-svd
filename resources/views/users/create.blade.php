@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="mb-4">
                <h3 class="fw-bold mb-1">Tambah User Baru</h3>
                <p class="text-muted mb-0">Isi data di bawah ini dengan lengkap.</p>
            </div>

            <div class="app-card p-4 p-md-5">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" name="name" placeholder="Nama lengkap"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" placeholder="nama@email.com"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" placeholder="Minimal 8 karakter"
                                class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Hobi</label>
                        <div id="hobbies-container">
                            <div class="input-group mb-2 hobby-row">
                                <span class="input-group-text"><i class="bi bi-heart"></i></span>
                                <input type="text" name="hobbies[]" class="form-control" placeholder="Contoh: Membaca">
                                <button type="button" class="btn btn-outline-danger" onclick="removeHobby(this)">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-soft" onclick="addHobby()">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Hobi
                        </button>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('users.index') }}" class="btn btn-light border">Batal</a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-lg me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function addHobby() {
            const container = document.getElementById('hobbies-container');
            const row = document.createElement('div');
            row.className = 'input-group mb-2 hobby-row';
            row.innerHTML = `
                <span class="input-group-text"><i class="bi bi-heart"></i></span>
                <input type="text" name="hobbies[]" class="form-control" placeholder="Hobi baru">
                <button type="button" class="btn btn-outline-danger" onclick="removeHobby(this)">
                    <i class="bi bi-x-lg"></i>
                </button>`;
            container.appendChild(row);
            row.querySelector('input').focus();
        }

        function removeHobby(btn) {
            btn.closest('.hobby-row').remove();
        }
    </script>
@endsection
