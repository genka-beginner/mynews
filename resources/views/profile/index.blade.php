@extends('layouts.front')

@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        @if (!is_null($headline))
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                    <div class="row">
                       <div class="title">
                           <h2>プロフィール一覧</h2>
                               
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
                @foreach($posts as $post)
                    <div class="post">
                        <div class="row">
                            <div class="text col-md-6">
                                <div class="date">
                                    {{ $post->updated_at->format('Y年m月d日') }}
                                </div>
                                <div class="name">
                                    {{ "名前：".str_limit($post->name, 150) }}
                                </div>
                                <div class="name">
                                    {{ "趣味：".str_limit($post->hobby, 150) }}
                                </div>
                                <div class="gender">
                                    {{ "性別：".str_limit($post->gender, 1500) }}
                                </div>
                                <div class="created_at">
                                    {{ "登録日時：".str_limit($post->created_at, 1500) }}
                                </div>
                                <div class="updated_at">
                                    {{ "更新日時：".str_limit($post->updated_at, 1500) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr color="#c0c0c0">
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection