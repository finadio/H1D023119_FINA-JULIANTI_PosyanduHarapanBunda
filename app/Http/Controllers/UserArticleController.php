<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class UserArticleController extends Controller
{
    public function index()
    {
        $articles = Article::published()
            ->latest()
            ->paginate(9);
            
        return view('articles.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::published()->findOrFail($id);
        return view('articles.show', compact('article'));
    }
}
