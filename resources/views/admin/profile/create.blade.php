{{-- layouts/profile.blade.phpを読み込む --}}
@extends('layouts.profile')


{{-- profile.blade.phpの@yield('title')に'プロフィールの新規作成'を埋め込む --}}
@section('title', 'プロフィールの新規作成')

{{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィール新規作成</h2>
                <form action="{{ action('Admin\ProfileController@create') }}" method="post">
                    <input type="text" name="name" value="氏名">
                    <input type="text" name="gender" value="性別">
                    <input type="text" name="hobby" value="趣味">
                    <input type="text" name="introduction" value="自己紹介欄">
                    <input type="submit" name="送信">
                </form>
            </div>
        </div>
    </div>
@endsection