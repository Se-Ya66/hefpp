<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return $articles;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request, Article $article)
    {
        $article = new Article;
        $article->fill($request->all());
        $article->user_id = $request->user()->id;
        $article->save();
        return redirect('api/articles');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        return $article;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        $article->fill($request->all())->save();
        return $article;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect('api/articles');
    }

    public function like(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);
        $article->likes()->attach($request->user()->id);

        return [
            'id' => $article->id,
            'count' => $article->count_likes,
        ];
    }
    public function unlike(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);

        return [
            'id' => $article->id,
            'count' => $article->count_likes,
        ];
    }
    public function count ($id)
    {

        $article = Article::find($id);
        return [
            'count' => $article->count_likes,
        ];
    }

    public function hasfavorite (Request $request, $id)
    {
        $article = Article::find($id);
        $id = $request->user()->id;
        if ($article->likes()->where('user_id', $id)->exists()) {
            $result = true;
        } else {
            $result = false;
        }
        return [
            'result' => $result,
        ];

    }

}
