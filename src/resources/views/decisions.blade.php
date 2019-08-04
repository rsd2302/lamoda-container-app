@php
    function plural_form($n, $forms) {
        return $n%10==1&&$n%100!=11?$forms[0]:($n%10>=2&&$n%10<=4&&($n%100<10||$n%100>=20)?$forms[1]:$forms[2]);
    }
@endphp

@extends('layout')

@section('content')
     <section class="wedo" id="contact">
            <h3 class="w3_head mb-5">Решение задачи</h3>
            <div class="contact_grid_right mt-5 mx-auto text-center">
                @if ($calculateInfo['status'] == 'progress')
                    Просчет в процессе, но вы можете <a href="/decisions/best">посмотреть лучшее решение</a> на данный момент
                    <div class="progress" style="width: 100%">
                        <div class="progress-bar" role="progressbar" style="width: {{ $calculateInfo['percent'] < 10 ? 10 : $calculateInfo['percent'] }}%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">{{ $calculateInfo['percent'] }}%</div>
                    </div>
                @elseif ($calculateInfo['status'] == 'success')
                    Просчет закончился!
                    <a href="/decisions/best">
                        <input type="submit" value="Просмотреть лучшее решение">
                    </a>
                @else
                    <form action="/decisions/start-calculate" method="post">
                        <div class="row contact_top">
                            <div class="col-sm-8">
                                <p style="margin-top: 22px">
                                Количество уникальных товаров в контейнерах
                                </p>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" name="unique-products-count" placeholder="Уникальных продуктов" required="" pattern="[0-9]+" value="{{ $defaultUniqueProducts }}">
                            </div>
                        </div>  
                        <br>
                        <input type="submit" value="Начать просчет">
                    </form>
                @endif
            </div>
    </section>
@endsection
