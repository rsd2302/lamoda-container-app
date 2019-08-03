@extends('layout')

@section('content')
    <div class="news" id="gallery">
        <div class="text-center">
            <h2 class="w3_head">Решение задачи</h2>
            <p class="main_p mb-5 text-center mx-auto">
                Ниже показаны контейнеры, которые выбраны алгоритмом как те, что нужно открыть.<br>
                Жирным выделены продукты, которые нужно взять из каждого контейнера
            </p>
        </div>
        <div class="row news-grids">
            @include('container-list', compact($containers))
        </div>  
    </div>
@endsection