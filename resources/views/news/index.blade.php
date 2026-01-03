@extends('layouts.public')

@section('title', 'Semua Berita')
@section('description', 'Daftar berita terkini dari berbagai kategori')

@section('content')
    <div class="section-header">
        <h2 class="section-title">
            @if(request('kategori'))
                Berita: {{ ucfirst(request('kategori')) }}
            @elseif(request('cari'))
                Hasil Pencarian: "{{ request('cari') }}"
            @else
                Semua Berita
            @endif
        </h2>
    </div>

    <!-- Categories Filter -->
    <div class="categories">
        <a href="{{ route('news.index') }}" class="category-pill {{ !request('kategori') ? 'active' : '' }}">Semua</a>
        @foreach($categories as $category)
            <a href="{{ route('news.index', ['kategori' => $category->slug]) }}" 
               class="category-pill {{ request('kategori') == $category->slug ? 'active' : '' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <div class="news-grid">
        @forelse($news as $item)
            <a href="{{ route('news.show', $item) }}" class="news-card">
                <div class="news-card-image">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                    @else
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-newspaper" style="font-size: 3rem; color: rgba(255,255,255,0.3);"></i>
                        </div>
                    @endif
                    <span class="news-card-category">{{ $item->category->name }}</span>
                </div>
                <div class="news-card-body">
                    <h3 class="news-card-title">{{ Str::limit($item->title, 60) }}</h3>
                    <p class="news-card-excerpt">{{ Str::limit($item->excerpt ?? strip_tags($item->content), 100) }}</p>
                    <div class="news-card-meta">
                        <div class="news-card-author">
                            <div class="author-avatar">{{ strtoupper(substr($item->user->name, 0, 1)) }}</div>
                            <span>{{ $item->user->name }}</span>
                        </div>
                        <span>{{ $item->published_at->format('d M Y') }}</span>
                    </div>
                </div>
            </a>
        @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 4rem; color: var(--gray);">
                <i class="fas fa-search" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                <p>Tidak ada berita ditemukan.</p>
                <a href="{{ route('news.index') }}" class="btn btn-primary" style="margin-top: 1rem;">Lihat Semua Berita</a>
            </div>
        @endforelse
    </div>

    @if($news->hasPages())
        <div style="display: flex; justify-content: center; margin-top: 3rem;">
            {{ $news->appends(request()->query())->links() }}
        </div>
    @endif
@endsection
