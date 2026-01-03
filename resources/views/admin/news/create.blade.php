@extends('admin.layouts.app')

@section('title', 'Tambah Berita')
@section('subtitle', 'Buat berita baru')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Form Berita Baru</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
                    <div>
                        <div class="form-group">
                            <label class="form-label" for="title">Judul Berita <span style="color: var(--danger);">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="Masukkan judul berita..." required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="excerpt">Ringkasan</label>
                            <textarea name="excerpt" id="excerpt" class="form-control" rows="3" placeholder="Ringkasan singkat berita...">{{ old('excerpt') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="content">Konten <span style="color: var(--danger);">*</span></label>
                            <textarea name="content" id="content" class="form-control" rows="12" placeholder="Tulis konten berita di sini..." required>{{ old('content') }}</textarea>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label class="form-label" for="category_id">Kategori <span style="color: var(--danger);">*</span></label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="image">Gambar</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(this)">
                            <small style="color: var(--gray);">Format: JPG, PNG, GIF. Maks: 2MB</small>
                            <div id="imagePreview" style="margin-top: 1rem; display: none;">
                                <img id="preview" src="" alt="Preview" style="max-width: 100%; border-radius: 8px;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-check">
                                <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                                <span>Terbitkan sekarang</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap: 1rem; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--border);">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const previewDiv = document.getElementById('imagePreview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewDiv.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
