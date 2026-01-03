@extends('admin.layouts.app')

@section('title', 'Komentar')
@section('subtitle', 'Kelola semua komentar')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Daftar Komentar</h2>
        </div>
        <div class="card-body" style="padding: 0;">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Komentar</th>
                        <th>Berita</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($comments as $index => $comment)
                        <tr>
                            <td>{{ $comments->firstItem() + $index }}</td>
                            <td style="font-weight: 500;">{{ $comment->name }}</td>
                            <td>
                                <a href="mailto:{{ $comment->email }}" style="color: var(--primary);">{{ $comment->email }}</a>
                            </td>
                            <td>
                                <div style="max-width: 250px;">{{ Str::limit($comment->content, 80) }}</div>
                            </td>
                            <td>
                                <a href="{{ route('news.show', $comment->news) }}" target="_blank" style="color: var(--primary); text-decoration: none;">
                                    {{ Str::limit($comment->news->title, 30) }}
                                </a>
                            </td>
                            <td>{{ $comment->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 2rem; color: var(--gray);">
                                Belum ada komentar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($comments->hasPages())
            <div class="pagination">
                {{ $comments->links() }}
            </div>
        @endif
    </div>
@endsection
