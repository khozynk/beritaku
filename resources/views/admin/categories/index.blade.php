@extends('admin.layouts.app')

@section('title', 'Kategori')
@section('subtitle', 'Kelola kategori berita')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Daftar Kategori</h2>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Kategori
            </a>
        </div>
        <div class="card-body" style="padding: 0;">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Slug</th>
                        <th>Jumlah Berita</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $index => $category)
                        <tr>
                            <td>{{ $categories->firstItem() + $index }}</td>
                            <td style="font-weight: 500;">{{ $category->name }}</td>
                            <td><code style="background: var(--light); padding: 0.25rem 0.5rem; border-radius: 4px;">{{ $category->slug }}</code></td>
                            <td>
                                <span class="badge badge-info">{{ $category->news_count }} berita</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 2rem; color: var(--gray);">
                                Belum ada kategori. <a href="{{ route('admin.categories.create') }}">Tambah kategori pertama</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($categories->hasPages())
            <div class="pagination">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
@endsection
