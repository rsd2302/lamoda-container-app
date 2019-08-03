@extends('layout')

@section('content')
    <div class="news" id="gallery">
        <div class="text-center">
            <h2 class="w3_head">Контейнеры</h2>
            <p class="main_p mb-5 text-center mx-auto">
                На этой странице представлены все контейнеры
            </p>
        </div>
        <div class="row news-grids">
            @include('container-list', compact($containers))
        </div>  
    </div>
@endsection