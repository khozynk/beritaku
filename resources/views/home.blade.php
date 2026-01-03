@extends('layouts.public')

@section('title', 'Beranda')
@section('description', 'Portal berita terkini dan terpercaya Indonesia')

@section('hero')
    @if($featuredNews)
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <a href="{{ route('news.show', $featuredNews) }}" class="featured-card">
                    @if($featuredNews->image)
                        <img src="{{ asset('storage/' . $featuredNews->image) }}" alt="{{ $featuredNews->title }}">
                    @else
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-newspaper" style="font-size: 4rem; color: rgba(255,255,255,0.3);"></i>
                        </div>
                    @endif
                    <div class="featured-overlay">
                        <span class="featured-category">{{ $featuredNews->category->name }}</span>
                        <h2 class="featured-title">{{ $featuredNews->title }}</h2>
                        <div class="featured-meta">
                            <span><i class="fas fa-user"></i> {{ $featuredNews->user->name }}</span>
                            <span><i class="fas fa-clock"></i> {{ $featuredNews->published_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </a>

                <div class="sidebar-news">
                    @foreach($latestNews->take(4) as $news)
                        <a href="{{ route('news.show', $news) }}" class="sidebar-card">
                            @if($news->image)
                                <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}">
                            @else
                                <div style="width: 80px; height: 60px; background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-newspaper" style="color: rgba(255,255,255,0.5);"></i>
                                </div>
                            @endif
                            <div class="sidebar-card-content">
                                <h4>{{ Str::limit($news->title, 50) }}</h4>
                                <span>{{ $news->published_at->diffForHumans() }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection

@section('content')
    <!-- Categories -->
    @if($categories->isNotEmpty())
    <div class="categories">
        <a href="{{ route('news.index') }}" class="category-pill active">Semua</a>
        @foreach($categories as $category)
            <a href="{{ route('news.index', ['kategori' => $category->slug]) }}" class="category-pill">
                {{ $category->name }} ({{ $category->news_count }})
            </a>
        @endforeach
    </div>
    @endif

    <!-- Latest News Section -->
    <div class="section-header">
        <h2 class="section-title">Berita Terbaru</h2>
        <a href="{{ route('news.index') }}" class="view-all">
            Lihat Semua <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <div class="news-grid">
        @forelse($latestNews as $news)
            <a href="{{ route('news.show', $news) }}" class="news-card">
                <div class="news-card-image">
                    @if($news->image)
                        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}">
                    @else
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-newspaper" style="font-size: 3rem; color: rgba(255,255,255,0.3);"></i>
                        </div>
                    @endif
                    <span class="news-card-category">{{ $news->category->name }}</span>
                </div>
                <div class="news-card-body">
                    <h3 class="news-card-title">{{ Str::limit($news->title, 60) }}</h3>
                    <p class="news-card-excerpt">{{ Str::limit($news->excerpt ?? strip_tags($news->content), 100) }}</p>
                    <div class="news-card-meta">
                        <div class="news-card-author">
                            <div class="author-avatar">{{ strtoupper(substr($news->user->name, 0, 1)) }}</div>
                            <span>{{ $news->user->name }}</span>
                        </div>
                        <span>{{ $news->published_at->format('d M Y') }}</span>
                    </div>
                </div>
            </a>
        @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 4rem; color: var(--gray);">
                <i class="fas fa-newspaper" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                <p>Belum ada berita yang dipublikasikan.</p>
            </div>
        @endforelse
    </div>
@endsection
