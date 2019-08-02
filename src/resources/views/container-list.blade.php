@extends('layout')

@section('content')
    <div class="news" id="gallery">
        <div class="text-center">
            <h2 class="w3_head">Контейнеры</h2>
            <p class="main_p mb-5 text-center mx-auto">
                Ниже показаны контейнеры, которые выбраны алгоритмом как те, что нужно открыть.<br>
                Жирным выделены продукты, которые нужно взять из каждого контейнера
            </p>
        </div>
        <div class="row news-grids">
            @foreach ($containers as $container)
                <div class="container">
                    <div class="container__info"></div>
                </div>
            @endforeach
            @foreach (array_chunk($containers, 2) as $subcontainers)
                @php
                    $firstItem = true
                @endphp

                <div class="col-md-6 news-grids-left">
                    @foreach ($subcontainers as $container)
                        <div class="news_top {{ $firstItem ? '' : 'mt-5' }}">
                            @php
                                $firstItem = false
                            @endphp
                            <h4>{{ $container->id }} {{ $container->name }}</h4>
                            <div class="products">
                                @foreach ($container->products as $product)
                                    <div class="products-item {{ $product->selected ? 'products-item-selected' : '' }}">
                                        {{ $product->id }} {{ $product->name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>  
    </div>

@endsection