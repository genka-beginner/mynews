<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;
use Carbon\Carbon;
use App\ProfileHistory;

class ProfileController extends Controller
{
    public function add()
    {
        return view('admin.profile.create');
    }

     public function create(Request $request){
        $this->validate($request, Profile::$rules);
        $profile = new Profile;
        $form = $request->all();
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        
        // データベースに保存する
        $profile->fill($form);
        $profile->save();
        return redirect('admin/profile/create');
    }

    public function edit(Request $request){
        $profile = Profile::find($request->id);
        if(empty($profile)){
        abort(404);
        }
        return view('admin.profile.edit',['profile_form' => $profile]);
    }

    public function update(Request $request){
        //バリデーション
        $this->validate($request, Profile::$rules);
        
        //変数profileにフォームから送信されてきたリクエスト内のidがProfileテーブル内にあるかを検索結果を代入
        $profile = Profile::find($request->id);
        
        //変数profile_formにフォームから送信されてきた内容をすべて代入する
        $profile_form = $request->all();
        
	    // フォームから送信されてきた_tokenを削除する
        unset($profile_form['_token']);
	 
        // データベースに保存する
        $profile->fill($profile_form);
        $profile->save();

  	    //$historyにHistoryテーブルのインスタンスを代入
        $history = new ProfileHistory;
        
        //Historyテーブルのnews_idにNewsテーブルのidを記録
        $history->profile_id = $profile->id;
        
        //Historyテーブルのedited_atに現在時刻を記録
        $history->edited_at = Carbon::now();
        
        //Historyテーブルを保存
        $history->save();

        return redirect('admin/profile/');
  }
}