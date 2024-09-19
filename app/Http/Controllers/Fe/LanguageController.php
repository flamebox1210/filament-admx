<?php

namespace App\Http\Controllers\Fe;

use App\Models\Article;
use App\Models\Page as PageQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{

    public function index(Request $request)
    {
        $fallbackLocale = app()->getLocale() == 'en' ? 'id' : 'en';
        Session::put('locale', $request->locale);
        if (!request('slug')) {
            $page = PageQuery::where('is_active', 1)->where('is_default', 1)->first();
        } else {
            if (request('article')) {
                $page = PageQuery::where('is_active', 1)->where('slug->' . app()->getLocale(), request('slug'))->first();
                $article = Article::where('is_active', 1)->where('slug->' . app()->getLocale(), request('article'))->first();
                return redirect()->route('fe.article', [
                    $page->getTranslations()['slug'][$fallbackLocale], $article->getTranslations()['slug'][$fallbackLocale]
                ]);
            } else {
                $page = PageQuery::where('is_active', 1)->where('slug->' . app()->getLocale(), request('slug'))->first();
            }
        }

        return redirect()->route('fe.page', $page->getTranslations()['slug'][$fallbackLocale]);
    }
}
