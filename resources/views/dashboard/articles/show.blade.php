@extends('layouts.dashboard')

@section('title', 'Detail Artikel')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>@yield('title')</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('article-data.index') }}">Manajemen Artikel</a></div>
                    <div class="breadcrumb-item">@yield('title')</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h2>{{ $article->title }}</h2>
                                    
                                    <div class="mb-3">
                                        <small class="text-muted">
                                            <i class="fas fa-user"></i> {{ $article->author }} |
                                            <i class="fas fa-calendar"></i> {{ $article->created_at->format('d F Y, H:i') }} |
                                            @if($article->status == 'published')
                                                <span class="badge badge-success">Dipublikasi</span>
                                            @else
                                                <span class="badge badge-warning">Draft</span>
                                            @endif
                                        </small>
                                    </div>

                                    @if($article->image)
                                        <div class="mb-4">
                                            <img src="{{ asset('storage/' . $article->image) }}" 
                                                 alt="{{ $article->title }}" 
                                                 class="img-fluid rounded">
                                        </div>
                                    @endif

                                    <div class="article-content">
                                        {!! $article->content !!}
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Informasi Artikel</h4>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>ID:</strong></td>
                                                    <td>{{ $article->id }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Judul:</strong></td>
                                                    <td>{{ $article->title }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Penulis:</strong></td>
                                                    <td>{{ $article->author }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status:</strong></td>
                                                    <td>
                                                        @if($article->status == 'published')
                                                            <span class="badge badge-success">Dipublikasi</span>
                                                        @else
                                                            <span class="badge badge-warning">Draft</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Dibuat:</strong></td>
                                                    <td>{{ $article->created_at->format('d/m/Y H:i') }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Diperbarui:</strong></td>
                                                    <td>{{ $article->updated_at->format('d/m/Y H:i') }}</td>
                                                </tr>
                                            </table>

                                            <div class="d-flex gap-2">
                                                <a href="{{ route('article-data.edit', $article->id) }}" 
                                                   class="btn btn-warning btn-sm flex-fill">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('article-data.destroy', $article->id) }}" 
                                                      method="POST" 
                                                      class="flex-fill"
                                                      onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm w-100">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <a href="{{ route('article-data.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
    <style>
        .article-content {
            line-height: 1.8;
            font-size: 16px;
        }
        
        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 15px 0;
        }
        
        .article-content h1, 
        .article-content h2, 
        .article-content h3, 
        .article-content h4, 
        .article-content h5, 
        .article-content h6 {
            margin-top: 25px;
            margin-bottom: 15px;
        }
        
        .article-content p {
            margin-bottom: 15px;
        }
        
        .article-content ul, 
        .article-content ol {
            margin-bottom: 15px;
            padding-left: 25px;
        }
        
        .article-content li {
            margin-bottom: 5px;
        }
    </style>
@endpush