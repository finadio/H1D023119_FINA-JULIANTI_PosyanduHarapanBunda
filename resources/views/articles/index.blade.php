@extends('layouts.dashboard')

@section('title', 'Artikel')

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
                            <div class="mb-4">
                                <h6 class="text-muted">Baca artikel terbaru dan informasi penting dari Posyandu</h6>
                            </div>

                            @if($articles->count() > 0)
                                <div class="row">
                                    @foreach($articles as $article)
                                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                            <div class="card border-0 shadow-sm h-100">
                                                @if($article->image)
                                                    <img src="{{ asset('storage/' . $article->image) }}" 
                                                         class="card-img-top" 
                                                         alt="{{ $article->title }}"
                                                         style="height: 200px; object-fit: cover;">
                                                @else
                                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                                         style="height: 200px;">
                                                        <i class="fas fa-image fa-3x text-muted"></i>
                                                    </div>
                                                @endif
                                                
                                                <div class="card-body d-flex flex-column">
                                                    <h5 class="card-title">{{ Str::limit($article->title, 50) }}</h5>
                                                    <p class="card-text text-muted flex-grow-1">
                                                        {{ Str::limit(strip_tags($article->content), 100) }}
                                                    </p>
                                                    
                                                    <div class="mt-auto">
                                                        <small class="text-muted">
                                                            <i class="fas fa-user"></i> {{ $article->author }} |
                                                            <i class="fas fa-calendar"></i> {{ $article->created_at->format('d M Y') }}
                                                        </small>
                                                        <div class="mt-2">
                                                            <a href="{{ route('articles.show', $article->id) }}" 
                                                               class="btn btn-primary btn-sm">
                                                                <i class="fas fa-eye"></i> Baca Selengkapnya
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <!-- Pagination -->
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $articles->links() }}
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-newspaper fa-5x text-muted mb-3"></i>
                                    <h4 class="text-muted">Belum ada artikel</h4>
                                    <p class="text-muted">Artikel akan ditampilkan di sini ketika tersedia.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
        }
        
        .card-img-top {
            border-radius: 0.375rem 0.375rem 0 0;
        }
        
        .card-title {
            font-weight: 600;
            color: #2c3e50;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #007bff, #0056b3);
            border: none;
            border-radius: 20px;
            padding: 6px 15px;
            font-size: 12px;
        }
        
        .btn-primary:hover {
            background: linear-gradient(45deg, #0056b3, #004085);
            transform: translateY(-2px);
        }
    </style>
@endpush