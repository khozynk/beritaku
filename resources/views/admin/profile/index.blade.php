@extends('admin.layouts.app')

@section('title', 'Pengaturan Profil')
@section('subtitle', 'Kelola informasi profil dan foto Anda')

@section('content')
    <div class="profile-grid">
        <!-- Profile Photo Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Foto Profil</h3>
            </div>
            <div class="card-body" style="text-align: center;">
                <div class="profile-photo-preview">
                    @if(auth()->user()->profile_photo)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile Photo" id="photoPreview">
                    @elseif(file_exists(public_path('images/admin-profile.jpg')))
                        <img src="{{ asset('images/admin-profile.jpg') }}" alt="Profile Photo" id="photoPreview">
                    @else
                        <div class="photo-placeholder" id="photoPlaceholder">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                
                <form action="{{ route('admin.profile.photo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group" style="margin-top: 1.5rem;">
                        <label for="photo" class="btn btn-secondary" style="cursor: pointer;">
                            <i class="fas fa-camera"></i> Pilih Foto
                        </label>
                        <input type="file" name="photo" id="photo" accept="image/*" style="display: none;" onchange="previewImage(this)">
                        @error('photo')
                            <div style="color: var(--danger); font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary" id="uploadBtn" style="display: none;">
                        <i class="fas fa-upload"></i> Upload Foto
                    </button>
                </form>
                
                <p style="color: var(--gray); font-size: 0.8rem; margin-top: 1rem;">
                    Format: JPG, PNG, GIF. Maksimal 2MB
                </p>
            </div>
        </div>

        <!-- Profile Info Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi Profil</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.profile.info') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="name">Nama Lengkap</label>
                        <input type="text" name="name" id="name" class="form-control" 
                               value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name')
                            <div style="color: var(--danger); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" 
                               value="{{ old('email', auth()->user()->email) }}" required>
                        @error('email')
                            <div style="color: var(--danger); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

        <!-- Change Password Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ubah Password</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.profile.password') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="current_password">Password Saat Ini</label>
                        <input type="password" name="current_password" id="current_password" class="form-control" required>
                        @error('current_password')
                            <div style="color: var(--danger); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password Baru</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        @error('password')
                            <div style="color: var(--danger); font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-key"></i> Ubah Password
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 2rem;
        }
        
        .profile-grid .card:last-child {
            grid-column: 1 / -1;
        }
        
        .profile-photo-preview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto;
            border: 4px solid var(--primary);
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.3);
        }
        
        .profile-photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .photo-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 4rem;
            font-weight: 700;
        }
        
        @media (max-width: 768px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }
            .profile-grid .card:last-child {
                grid-column: 1;
            }
        }
    </style>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('photoPreview');
                    const placeholder = document.getElementById('photoPlaceholder');
                    const uploadBtn = document.getElementById('uploadBtn');
                    
                    if (placeholder) {
                        placeholder.style.display = 'none';
                    }
                    
                    if (preview) {
                        preview.src = e.target.result;
                    } else {
                        const img = document.createElement('img');
                        img.id = 'photoPreview';
                        img.src = e.target.result;
                        document.querySelector('.profile-photo-preview').appendChild(img);
                    }
                    
                    uploadBtn.style.display = 'inline-flex';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
