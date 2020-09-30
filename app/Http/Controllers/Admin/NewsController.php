<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\News;
use App\History;
use Carbon\Carbon;

class NewsController extends Controller
{
    public function add(){
      return view('admin.news.create');
  }
    
    public function create(Request $request){
      $this->validate($request, News::$rules);
      $news = new News;
      $form = $request->all();

      // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $news->image_path = basename($path);
      } else {
          $news->image_path = null;
      }

      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);

      // データベースに保存する
      $news->fill($form);
      $news->save();
      return redirect('admin/news/create');
  }
  
  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = News::where('title', $cond_title)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = News::all();
      }
      return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
  
  public function edit(Request $request){
    $news = News::find($request->id);
    if(empty($news)){
      abort(404);
    }
    return view('admin.news.edit',['news_form' => $news]);
  }
  
  public function update(Request $request)
    {
        $this->validate($request, News::$rules);
        $news = News::find($request->id);
        $news_form = $request->all();
        
        if ($request->remove == 'true') {
            $news_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $news_form['image_path'] = basename($path);
        } else {
            $news_form['image_path'] = $news->image_path;
        }
        //$news_form(フォームから送信されてきたリクエスト)内の_token、image、removeを削除
        unset($news_form['_token']);
        unset($news_form['image']);
        unset($news_form['remove']);
        
        //保存
        $news->fill($news_form)->save();

        // 以下を追記
        //$historyにHistoryテーブルのインスタンスを代入
        $history = new History;
        
        //Historyテーブルのnews_idにNewsテーブルのidを記録
        $history->news_id = $news->id;
        
        //Historyテーブルのedited_atに現在時刻を記録
        $history->edited_at = Carbon::now();
        
        //Historyテーブルを保存
        $history->save();

        return redirect('admin/news/');
    }
}
