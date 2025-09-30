@extends('layouts.dashboard')

@section('title', $article->title)

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Artikel</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('articles.index') }}">Artikel</a></div>
                    <div class="breadcrumb-item">Detail</div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <article class="article-detail">
                                <header class="article-header mb-4">
                                    <h1 class="article-title">{{ $article->title }}</h1>
                                    
                                    <div class="article-meta mb-3">
                                        <small class="text-muted">
                                            <i class="fas fa-user"></i> {{ $article->author }} |
                                            <i class="fas fa-calendar"></i> {{ $article->created_at->format('d F Y, H:i') }}
                                        </small>
                                    </div>

                                    @if($article->image)
                                        <div class="article-image mb-4">
                                            <img src="{{ asset('storage/' . $article->image) }}" 
                                                 alt="{{ $article->title }}" 
                                                 class="img-fluid rounded shadow-sm">
                                        </div>
                                    @endif
                                </header>

                                <div class="article-content">
                                    {!! $article->content !!}
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-info-circle"></i> Informasi Artikel</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td><strong>Penulis:</strong></td>
                                    <td>{{ $article->author }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Dipublikasi:</strong></td>
                                    <td>{{ $article->created_at->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Terakhir diperbarui:</strong></td>
                                    <td>{{ $article->updated_at->format('d F Y') }}</td>
                                </tr>
                            </table>
                            
                            <hr>
                            
                            <div class="text-center">
                                <a href="{{ route('articles.index') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Artikel
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Share Article -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h4><i class="fas fa-share-alt"></i> Bagikan Artikel</h4>
                        </div>
                        <div class="card-body text-center">
                            <button class="btn btn-success btn-sm m-1" onclick="shareWhatsApp()">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </button>
                            <button class="btn btn-primary btn-sm m-1" onclick="shareFacebook()">
                                <i class="fab fa-facebook"></i> Facebook
                            </button>
                            <button class="btn btn-info btn-sm m-1" onclick="shareTwitter()">
                                <i class="fab fa-twitter"></i> Twitter
                            </button>
                            <button class="btn btn-secondary btn-sm m-1" onclick="copyLink()">
                                <i class="fas fa-link"></i> Copy Link
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
    <style>
        .article-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            line-height: 1.2;
            margin-bottom: 20px;
        }
        
        .article-meta {
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 15px;
        }
        
        .article-content {
            line-height: 1.8;
            font-size: 16px;
            color: #333;
        }
        
        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .article-content h1, 
        .article-content h2, 
        .article-content h3, 
        .article-content h4, 
        .article-content h5, 
        .article-content h6 {
            margin-top: 30px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .article-content p {
            margin-bottom: 18px;
            text-align: justify;
        }
        
        .article-content ul, 
        .article-content ol {
            margin-bottom: 18px;
            padding-left: 30px;
        }
        
        .article-content li {
            margin-bottom: 8px;
        }
        
        .article-content blockquote {
            border-left: 4px solid #007bff;
            background-color: #f8f9fa;
            padding: 15px 20px;
            margin: 20px 0;
            font-style: italic;
        }
        
        .article-image img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
        }
        
        @media (max-width: 768px) {
            .article-title {
                font-size: 2rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        function shareWhatsApp() {
            const text = `{{ $article->title }} - {{ url()->current() }}`;
            const url = `https://wa.me/?text=${encodeURIComponent(text)}`;
            window.open(url, '_blank');
        }
        
        function shareFacebook() {
            const url = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}`;
            window.open(url, '_blank');
        }
        
        function shareTwitter() {
            const text = `{{ $article->title }}`;
            const url = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(window.location.href)}`;
            window.open(url, '_blank');
        }
        
        function copyLink() {
            navigator.clipboard.writeText(window.location.href).then(function() {
                alert('Link berhasil disalin!');
            }, function(err) {
                console.error('Gagal menyalin link: ', err);
            });
        }
    </script>
@endpush