@if (! count($containers))
    <h3>Контейнеры не найдены</h3>
@else
    @foreach (array_chunk($containers, ceil(count($containers) / 3)) as $subcontainers)
        @php
            $firstItem = true
        @endphp

        <div class="col-md-4 news-grids-left">
            @foreach ($subcontainers as $container)
                <div class="news_top {{ $firstItem ? '' : 'mt-5' }}">
                    @php
                        $firstItem = false
                    @endphp
                    <h4>{{ $container->id }} {{ $container->name }}</h4>
                    <div class="products">
                        @foreach ($container->products as $product)
                            <div class="products-item {{ $product->selected ?? false ? 'products-item-selected' : '' }}">
                                {{ $product->id }} {{ $product->name }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endif
