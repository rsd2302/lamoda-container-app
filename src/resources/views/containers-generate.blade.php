@extends('layout')

@section('content')
     <section class="wedo" id="contact">
            <h3 class="w3_head mb-5">Генерация контейнеров</h3>
            <div class="contact_grid_right mt-5 mx-auto text-center">
                <form action="/containers/generate" method="post">
                    <div class="row contact_top">
                        <div class="col-sm-4">
                            <input type="text" name="containers-count" placeholder="Количество контейнеров" required="" pattern="[0-9]+">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="container-products-count" placeholder="Продуктов в контейнере" required="" pattern="[0-9]+">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="unique-products-count" placeholder="Уникальных продуктов" required="" pattern="[0-9]+">
                        </div>
                    </div>  
                    <br>
                    <input type="submit" value="Создать">
                </form>
            </div>
    </section>
@endsection