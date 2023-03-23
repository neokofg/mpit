<div>
    <input type="search" wire:model.debounce.300ms="searchInput" placeholder="Поиск:" class="form-control w-50 form-control-dark mx-auto mt-5">
    <br>
    <label for="classification1">На реке</label>
    <input type="checkbox" name="classification" id="classification1" value="На реке" wire:click="updateSearch('На реке')">
    <br>
    <label for="classification2">Рыбалка</label>
    <input type="checkbox" name="classification" id="classification2" value="Рыбалка" wire:click="updateSearch('Рыбалка')">
    <br>
    <label for="classification3">В горах</label>
    <input type="checkbox" name="classification" id="classification3" value="В горах" wire:click="updateSearch('В горах')">
    <br>
    <label for="classification4">Недалеко от города</label>
    <input type="checkbox" name="classification" id="classification4" value="Недалеко от города" wire:click="updateSearch('Недалеко от города')">
    <br>
    <h2 class="text-center mt-5">Результаты поиска:</h2>
    @if($result == 'nothing')
        <p class="text-center mt-5">К сожалению мы ничего не нашли!</p>
    @else
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-5">
            @foreach($result as $tourbase)
                <div style="border:1px solid black">
                    <a class="text-decoration-none text-dark" href="{{route('page',$tourbase->id)}}">
                        <p>
                            {{$tourbase->name}}
                        </p>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>

