@extends('layouts.dashboard')

@section('title', 'Manajemen Artikel')

@push('styles')
    <link rel="stylesheet" href="{{ asset('modules/datatables/dataTables.min.css') }}">
    <style>
        .table {
            white-space: nowrap !important;
        }
        .btn-group .btn {
            margin-right: 2px;
        }
        .btn-group .btn:last-child {
            margin-right: 0;
        }
        .table td {
            vertical-align: middle;
        }
        .img-thumbnail {
            border-radius: 8px;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>@yield('title')</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">@yield('title')</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h6 class="text-muted">Kelola artikel untuk ditampilkan kepada pengguna</h6>
                                    @if(auth()->user()->role == 'admin')
                                        <small class="text-info">Sebagai Admin, Anda dapat mengelola semua artikel</small>
                                    @else
                                        <small class="text-info">Sebagai {{ ucfirst(auth()->user()->role) }}, Anda dapat mengelola artikel</small>
                                    @endif
                                </div>
                                <a href="{{ route('article-data.create') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-plus"></i> Tambah Artikel Baru
                                </a>
                            </div>

                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <!-- Info Panel -->
                            <div class="alert alert-info mb-4">
                                <h6><i class="fas fa-info-circle"></i> Fitur Manajemen Artikel</h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        <small><strong><i class="fas fa-plus text-primary"></i> Tambah:</strong> Buat artikel baru dengan gambar</small>
                                    </div>
                                    <div class="col-md-3">
                                        <small><strong><i class="fas fa-eye text-info"></i> Lihat:</strong> Detail artikel lengkap</small>
                                    </div>
                                    <div class="col-md-3">
                                        <small><strong><i class="fas fa-edit text-warning"></i> Edit:</strong> Ubah konten & status artikel</small>
                                    </div>
                                    <div class="col-md-3">
                                        <small><strong><i class="fas fa-trash text-danger"></i> Hapus:</strong> Menghapus artikel permanen</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Stats Panel -->
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <div class="card card-primary">
                                        <div class="card-body text-center">
                                            <h4>{{ $totalArticles ?? $articles->total() }}</h4>
                                            <small>Total Artikel</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-success">
                                        <div class="card-body text-center">
                                            <h4>{{ $publishedArticles ?? $articles->where('status', 'published')->count() }}</h4>
                                            <small>Published</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-warning">
                                        <div class="card-body text-center">
                                            <h4>{{ $draftArticles ?? $articles->where('status', 'draft')->count() }}</h4>
                                            <small>Draft</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-info">
                                        <div class="card-body text-center">
                                            <h4>{{ $articlesWithImage ?? $articles->whereNotNull('image')->count() }}</h4>
                                            <small>Dengan Gambar</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped" id="articleTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Judul</th>
                                            <th>Penulis</th>
                                            <th>Status</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($articles as $index => $article)
                                            <tr>
                                                <td>{{ $loop->iteration + ($articles->currentPage() - 1) * $articles->perPage() }}</td>
                                                <td>
                                                    @if($article->image)
                                                        <img src="{{ asset('storage/' . $article->image) }}" 
                                                             alt="{{ $article->title }}" 
                                                             class="img-thumbnail" 
                                                             style="width: 60px; height: 60px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-light d-flex align-items-center justify-content-center" 
                                                             style="width: 60px; height: 60px;">
                                                            <i class="fas fa-image text-muted"></i>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>{{ Str::limit($article->title, 30) }}</td>
                                                <td>{{ $article->author }}</td>
                                                <td>
                                                    @if($article->status == 'published')
                                                        <span class="badge badge-success">Dipublikasi</span>
                                                    @else
                                                        <span class="badge badge-warning">Draft</span>
                                                    @endif
                                                </td>
                                                <td>{{ $article->created_at->format('d/m/Y H:i') }}</td>
                                                <td style="min-width: 120px;">
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('article-data.show', $article->id) }}" 
                                                           class="btn btn-info btn-sm" 
                                                           title="Lihat Detail">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('article-data.edit', $article->id) }}" 
                                                           class="btn btn-warning btn-sm" 
                                                           title="Edit Artikel">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('article-data.destroy', $article->id) }}" 
                                                              method="POST" 
                                                              class="d-inline"
                                                              onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus Artikel">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="d-flex justify-content-center mt-4">
                                {{ $articles->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('modules/datatables/dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#articleTable').DataTable({
                "paging": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Data tidak ditemukan",
                    "infoEmpty": "Tidak ada data",
                    "infoFiltered": "(disaring dari _MAX_ total data)"
                }
            });
        });
    </script>
@endpush