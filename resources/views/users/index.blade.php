@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Daftar User</h3>
            <p class="text-muted mb-0">Kelola data user beserta hobinya.</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah User
        </a>
    </div>

    <div class="app-card overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background:#f9fafb;">
                    <tr class="text-muted small text-uppercase">
                        <th class="ps-4 py-3" width="60">#</th>
                        <th class="py-3">User</th>
                        <th class="py-3">Hobi</th>
                        <th class="py-3 text-end pe-4" width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                        style="width:42px;height:42px;background:var(--primary-soft);color:var(--primary);">
                                        {{ strtoupper(mb_substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $user->name }}</div>
                                        <div class="text-muted small">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if ($user->hobbies->count())
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach ($user->hobbies as $hobby)
                                            <span class="badge rounded-pill fw-medium px-3 py-2"
                                                style="background:var(--primary-soft);color:var(--primary);">
                                                {{ $hobby->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <em class="text-muted small">Tidak ada hobi</em>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-soft" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin hapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
                                <div class="fw-semibold">Belum ada data</div>
                                <div class="text-muted small">Klik "Tambah User" untuk mulai menambahkan.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
