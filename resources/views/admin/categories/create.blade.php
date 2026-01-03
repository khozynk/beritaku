@extends('admin.layouts.app')

@section('title', 'Tambah Kategori')
@section('subtitle', 'Buat kategori baru')

@section('content')
    <div class="card" style="max-width: 600px;">
        <div class="card-header">
            <h2 class="card-title">Form Kategori Baru</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label class="form-label" for="name">Nama Kategori <span style="color: var(--danger);">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Contoh: Politik, Olahraga" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="description">Deskripsi</label>
                    <textarea name="description" id="description" class="form-control" rows="3" placeholder="Deskripsi singkat tentang kategori ini...">{{ old('description') }}</textarea>
                </div>

                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
