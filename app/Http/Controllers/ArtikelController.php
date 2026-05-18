<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Opini;
use App\Models\Kategori;

class ArtikelController extends Controller
{
    // Homepage
    public function home()
    {
        $heroArticle = Berita::latest()->first();
        $latestArticle = Berita::latest()->skip(0)->first();
        $latestArticlesSide = Berita::latest()->skip(1)->take(3)->get();
        $opiniArticles = Opini::latest()->take(4)->get();

        $politicsCategory = Kategori::where('nama_kategori', 'Politik')->first();
        $politicsMain = $politicsCategory ? $politicsCategory->beritas()->latest()->first() : null;
        $politicsArticles = $politicsCategory ? $politicsCategory->beritas()->latest()->skip(1)->take(4)->get() : collect();

        $economyCategory = Kategori::where('nama_kategori', 'Ekonomi')->first();
        $economyMain = $economyCategory ? $economyCategory->beritas()->latest()->first() : null;
        $economyArticles = $economyCategory ? $economyCategory->beritas()->latest()->skip(1)->take(4)->get() : collect();

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
            'categories'
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
