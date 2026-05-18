<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Opini;
use App\Models\Kategori;

class ArtikelController extends Controller
{
    // Homepage
    public function home(Request $request)
    {
        $keyword = $request->input('keyword');

        // Hero article
        $heroArticle = Berita::latest()->first();

        // Latest Articles (main + side)
        $latestArticlesQuery = Berita::with('kategori', 'user')
            ->when($keyword, function ($query, $keyword) {
                $query->where('judul', 'like', "%{$keyword}%")
                    ->orWhere('isi', 'like', "%{$keyword}%")
                    ->orWhereHas('user', fn($q) => $q->where('username', 'like', "%{$keyword}%"));
            })->latest();

        $latestArticle = $latestArticlesQuery->skip(0)->first();
        $latestArticlesSide = $latestArticlesQuery->skip(1)->take(3)->get();

        // Opini
        $opiniArticles = Opini::with('user')
            ->when($keyword, function ($query, $keyword) {
                $query->where('judul_opini', 'like', "%{$keyword}%")
                    ->orWhere('isi', 'like', "%{$keyword}%")
                    ->orWhereHas('user', fn($q) => $q->where('username', 'like', "%{$keyword}%"));
            })
            ->take(4)
            ->get();

        // Politik
        $politicsCategory = Kategori::where('nama_kategori', 'Politik')->first();
        $politicsMain = $politicsCategory ? $politicsCategory->beritas()->latest()->first() : null;
        $politicsArticles = $politicsCategory ? $politicsCategory->beritas()->latest()->skip(1)->take(4)->get() : collect();

        // Ekonomi
        $economyCategory = Kategori::where('nama_kategori', 'Ekonomi')->first();
        $economyMain = $economyCategory ? $economyCategory->beritas()->latest()->first() : null;
        $economyArticles = $economyCategory ? $economyCategory->beritas()->latest()->skip(1)->take(4)->get() : collect();

        // Kategori untuk navbar
        $categories = Kategori::all();

        return view('welcome', compact(
            'heroArticle',
            'latestArticle',
            'latestArticlesSide',
            'opiniArticles',
            'politicsMain',
            'politicsArticles',
            'economyMain',
            'economyArticles',
            'categories',
            'keyword'
        ));
    }

    // Detail Berita / Opini

    public function detail($slug)
    {
        $article = Berita::where('slug', $slug)->first() ?? Opini::where('slug', $slug)->firstOrFail();
        $relatedArticles = Berita::where('id_kategori', $article->id_kategori ?? 0)
            ->where('id_berita', '!=', $article->id ?? 0)
            ->take(3)
            ->get();

        return view('articles.app', compact('article', 'relatedArticles'));
    }
}
