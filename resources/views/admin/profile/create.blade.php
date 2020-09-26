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
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    氏名：<input type="text" name="name" value="">
                    性別：<input type="text" name="gender" value="">
                    趣味：<input type="text" name="hobby" value="">
                    自己紹介欄：<textarea name="introduction" rows="4" cols="40"></textarea>
                    {{ csrf_field() }}
                    <input type="submit" value="投稿">
                </form>
            </div>
        </div>
    </div>
@endsection