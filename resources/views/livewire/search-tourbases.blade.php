<div style="position:relative">
    <form action="{{route('search')}}" method="GET">
        <input type="search" wire:model="search" id="search" name="search" class="form-control form-control-dark" placeholder="Поиск" aria-label="Search">
    </form>
    @if($result == 'nothingall')
    @else
        <div class="text-dark rounded shadow" style="z-index:99;width:40vh;position:absolute;top:20px;background-color:white;opacity:0.8">
            @if($result == 'nothing')
                <p class="text-center mt-2">К сожалению мы ничего не нашли!</p>
            @else
                <div class="row">
                    <ul style="padding-left:12%">
                        @foreach($result as $tourbase)
                            <a class="text-decoration-none text-dark" href="{{route('page',$tourbase->id)}}">
                                <li>
                                    {{$tourbase->name}}
                                </li>
                            </a>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @endif
</div>
