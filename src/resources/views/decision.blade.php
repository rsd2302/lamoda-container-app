@php
    function plural_form($n, $forms) {
        return $n%10==1&&$n%100!=11?$forms[0]:($n%10>=2&&$n%10<=4&&($n%100<10||$n%100>=20)?$forms[1]:$forms[2]);
    }
@endphp

@extends('layout')

@section('content')
    <div class="news" id="gallery">
        <h2 class="w3_head text-center">Решение задачи</h2>
        <p class="main_p mb-5 mx-auto">
            Ниже показаны контейнеры, которые нужно открыть<br>
            Жирным выделены продукты, которые нужно взять
            <br>
            Рекомендуется открыть <b>{{ count($containers) }}</b> {{ plural_form(count($containers), ['контейнер', 'контейнера', 'контейнеров']) }}
            <br>
            Найдено <b>{{ $productsCount }}</b> {{ plural_form($productsCount, ['товар', 'товара', 'товаров']) }}
        </p>
        <div class="row news-grids">
            @include('container-list', compact($containers))
        </div>  
    </div>
@endsection