@extends('admin.layouts.app')

@section('title', 'Berita')
@section('subtitle', 'Kelola semua berita')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Daftar Berita</h2>
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Berita
            </a>
        </div>
        <div class="card-body" style="padding: 0;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Komentar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($news as $item)
                        <tr>
                            <td>
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="image-preview">
                                @else
                                    <div style="width: 80px; height: 60px; background: var(--light); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--gray);">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div style="font-weight: 500;">{{ Str::limit($item->title, 40) }}</div>
                                <small style="color: var(--gray);">{{ $item->created_at->format('d M Y, H:i') }}</small>
                            </td>
                            <td>
                                <span class="badge badge-info">{{ $item->category->name }}</span>
                            </td>
                            <td>{{ $item->user->name }}</td>
                            <td>
                                @if($item->is_published)
                                    <span class="badge badge-success">Terbit</span>
                                @else
                                    <span class="badge badge-warning">Draft</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-info">{{ $item->comments_count }}</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('news.show', $item) }}" class="btn btn-secondary btn-sm" target="_blank" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.news.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 2rem; color: var(--gray);">
                                Belum ada berita. <a href="{{ route('admin.news.create') }}">Tambah berita pertama</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($news->hasPages())
            <div class="pagination">
                {{ $news->links() }}
            </div>
        @endif
    </div>
@endsection
