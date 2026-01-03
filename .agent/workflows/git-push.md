---
description: Push perubahan ke GitHub secara otomatis
---

# Git Push Otomatis ke GitHub

Workflow ini akan menambahkan semua perubahan, commit, dan push ke GitHub repository.

## Langkah-langkah:

// turbo-all

1. Pastikan berada di direktori proyek:
```bash
cd c:\xampp\htdocs\coba
```

2. Tambahkan semua perubahan ke staging:
```bash
git add .
```

3. Commit dengan pesan (ganti PESAN_COMMIT dengan deskripsi perubahan):
```bash
git commit -m "Update: perubahan terbaru"
```

4. Push ke GitHub:
```bash
git push origin main
```

## Cara Penggunaan Cepat:

Jalankan perintah ini di terminal untuk push cepat:

```bash
cd c:\xampp\htdocs\coba && git add . && git commit -m "Update" && git push origin main
```

## Repository:
- URL: https://github.com/khozynk/beritaku
- Branch: main
