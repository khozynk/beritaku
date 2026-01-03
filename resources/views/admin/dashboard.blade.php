@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('subtitle', 'Selamat datang di panel admin')

@section('content')
    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $stats['total_news'] }}</h3>
                <p>Total Berita</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $stats['published_news'] }}</h3>
                <p>Berita Terbit</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon warning">
                <i class="fas fa-folder"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $stats['total_categories'] }}</h3>
                <p>Kategori</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon info">
                <i class="fas fa-comments"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $stats['total_comments'] }}</h3>
                <p>Komentar</p>
            </div>
        </div>
    </div>

    <!-- Latest News -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Berita Terbaru</h2>
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Berita
            </a>
        </div>
        <div class="card-body" style="padding: 0;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestNews as $news)
                        <tr>
                            <td>
                                <a href="{{ route('admin.news.edit', $news) }}" style="color: var(--dark); text-decoration: none; font-weight: 500;">
                                    {{ Str::limit($news->title, 50) }}
                                </a>
                            </td>
                            <td>
                                <span class="badge badge-info">{{ $news->category->name }}</span>
                            </td>
                            <td>{{ $news->user->name }}</td>
                            <td>
                                @if($news->is_published)
                                    <span class="badge badge-success">Terbit</span>
                                @else
                                    <span class="badge badge-warning">Draft</span>
                                @endif
                            </td>
                            <td>{{ $news->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 2rem; color: var(--gray);">
                                Belum ada berita. <a href="{{ route('admin.news.create') }}">Tambah berita pertama</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
