@extends('layout')

@section('content')
    <section class="slide-wrapper" id="about">
        <h3 class="w3_head mb-5">Информация о решении и не только</h3>
        <p class="iner mt-5 text-left">
        	Изначально я не понял всей сложности решения данной задачи :)
        	<br>
        	Решил пойти в лоб и сделал жадный алгоритм, который довольствовался первым корректным решением. Посмотреть на его исполнение можно по этой <a href="/get-list">ссылке</a>
        	<br> 
        	Но потом понял, что тут не обойтись без алгоритмов из комбинаторики. Я долго и внимательно смотрел на <a href="https://ru.wikipedia.org/wiki/%D0%97%D0%B0%D0%B4%D0%B0%D1%87%D0%B0_%D0%BE_%D1%80%D1%8E%D0%BA%D0%B7%D0%B0%D0%BA%D0%B5">задачу о рюкзаке</a> но так и не нашел способа ее применить. Тогда я решил обойтись полным перебором(хотя это казалось чем-то сумасшедшим) с применением методе ветвей и границ. Полный перебор работает, как и ожидалось, долго =( Особенно на массиве из 1000 продуктов. В виде обходного пути перебор работает асинхронно, через очереди
        </p>
    </section>
@endsection