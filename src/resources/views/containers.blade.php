@extends('layout')

@section('content')
    <div class="news" id="gallery">
        <div class="text-center">
            <h2 class="w3_head">Контейнеры</h2>
            <p class="main_p mb-5 text-center mx-auto">
                На этой странице представлены все контейнеры
            </p>
            <div class="contact_grid_right mt-5 mx-auto text-center">
                    <a href="/containers/generate">
                        <input type="submit" value="Создать новый список">
                    </a>
                    <br>
                    <br>
            </div>
        </div>
        <div class="row news-grids">
            @include('container-list', compact($containers))
        </div>  
    </div>
@endsection