@extends('layouts.public')

@section('title', $news->title)
@section('description', Str::limit($news->excerpt ?? strip_tags($news->content), 160))

@section('content')
    <style>
        .article-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 3rem;
        }

        .article {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .article-header {
            padding: 2rem 2rem 0;
        }

        .article-category {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 0.375rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .article-title {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.3;
            margin-bottom: 1.5rem;
            color: var(--dark);
        }

        .article-meta {
            display: flex;
            gap: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border);
            color: var(--gray);
            font-size: 0.9rem;
        }

        .article-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .article-author-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .article-image {
            margin: 1.5rem 0;
        }

        .article-image img {
            width: 100%;
            border-radius: 12px;
        }

        .article-content {
            padding: 0 2rem 2rem;
            font-size: 1.1rem;
            line-height: 1.8;
            color: #374151;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        /* Comments Section */
        .comments-section {
            margin-top: 2rem;
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .comments-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .comment-form {
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid var(--border);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .comment-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .comment-item {
            display: flex;
            gap: 1rem;
        }

        .comment-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: 600;
            flex-shrink: 0;
        }

        .comment-body {
            flex: 1;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .comment-author {
            font-weight: 600;
            color: var(--dark);
        }

        .comment-date {
            font-size: 0.8rem;
            color: var(--gray);
        }

        .comment-content {
            color: #4b5563;
            line-height: 1.6;
        }

        /* Sidebar */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .sidebar-widget {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .widget-title {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--primary);
            display: inline-block;
        }

        .related-news {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .related-item {
            display: flex;
            gap: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }

        .related-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .related-item img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .related-item-content h4 {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.25rem;
            line-height: 1.4;
        }

        .related-item-content span {
            font-size: 0.75rem;
            color: var(--gray);
        }

        .related-item:hover h4 {
            color: var(--primary);
        }

        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        @media (max-width: 1024px) {
            .article-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .article-title {
                font-size: 1.5rem;
            }
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="article-container">
        <div>
            <article class="article">
                <div class="article-header">
                    <a href="{{ route('news.index', ['kategori' => $news->category->slug]) }}" class="article-category">
                        {{ $news->category->name }}
                    </a>
                    <h1 class="article-title">{{ $news->title }}</h1>
                    <div class="article-meta">
                        <div class="article-meta-item">
                            <div class="article-author-avatar">{{ strtoupper(substr($news->user->name, 0, 1)) }}</div>
                            <div>
                                <div style="font-weight: 600; color: var(--dark);">{{ $news->user->name }}</div>
                                <div style="font-size: 0.8rem;">Penulis</div>
                            </div>
                        </div>
                        <div class="article-meta-item">
                            <i class="fas fa-calendar"></i>
                            {{ $news->published_at->format('d F Y') }}
                        </div>
                        <div class="article-meta-item">
                            <i class="fas fa-comments"></i>
                            {{ $news->comments->count() }} Komentar
                        </div>
                    </div>
                </div>

                @if($news->image)
                    <div class="article-image" style="padding: 0 2rem;">
                        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}">
                    </div>
                @endif

                <div class="article-content">
                    {!! nl2br(e($news->content)) !!}
                </div>
            </article>

            <!-- Comments Section -->
            <div class="comments-section">
                <h3 class="comments-title">
                    <i class="fas fa-comments"></i>
                    Komentar ({{ $news->comments->count() }})
                </h3>

                <!-- Comment Form -->
                <form action="{{ route('comments.store', $news) }}" method="POST" class="comment-form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="name">Nama <span style="color: red;">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Nama Anda" required>
                            @error('name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email <span style="color: red;">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="email@contoh.com" required>
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="content">Komentar <span style="color: red;">*</span></label>
                        <textarea name="content" id="content" class="form-control" placeholder="Tulis komentar Anda..." required>{{ old('content') }}</textarea>
                        @error('content')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Kirim Komentar
                    </button>
                </form>

                <!-- Comment List -->
                <div class="comment-list">
                    @forelse($news->comments as $comment)
                        <div class="comment-item">
                            <div class="comment-avatar">
                                {{ strtoupper(substr($comment->name, 0, 1)) }}
                            </div>
                            <div class="comment-body">
                                <div class="comment-header">
                                    <span class="comment-author">{{ $comment->name }}</span>
                                    <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="comment-content">{{ $comment->content }}</p>
                            </div>
                        </div>
                    @empty
                        <div style="text-align: center; padding: 2rem; color: var(--gray);">
                            <i class="fas fa-comment-slash" style="font-size: 2rem; margin-bottom: 0.5rem; opacity: 0.3;"></i>
                            <p>Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <aside class="sidebar">
            @if($relatedNews->isNotEmpty())
            <div class="sidebar-widget">
                <h3 class="widget-title">Berita Terkait</h3>
                <div class="related-news">
                    @foreach($relatedNews as $related)
                        <a href="{{ route('news.show', $related) }}" class="related-item">
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}">
                            @else
                                <div style="width: 80px; height: 60px; background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-newspaper" style="color: rgba(255,255,255,0.5);"></i>
                                </div>
                            @endif
                            <div class="related-item-content">
                                <h4>{{ Str::limit($related->title, 50) }}</h4>
                                <span>{{ $related->published_at->diffForHumans() }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="sidebar-widget">
                <h3 class="widget-title">Bagikan</h3>
                <div style="display: flex; gap: 0.75rem;">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" 
                       style="width: 40px; height: 40px; background: #1877f2; color: white; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}" target="_blank"
                       style="width: 40px; height: 40px; background: #1da1f2; color: white; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . request()->url()) }}" target="_blank"
                       style="width: 40px; height: 40px; background: #25d366; color: white; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </aside>
    </div>
@endsection
