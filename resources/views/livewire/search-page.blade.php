<div>
    <input type="search" wire:model="search" placeholder="Поиск:" class="form-control w-50 form-control-dark mx-auto mt-5">
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

