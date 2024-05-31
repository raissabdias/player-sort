<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title font-semibold text-xl">Novo sorteio</h5>
                                    <hr>
                                    <form class="row mt-3">
                                        <div class="col-6">
                                            @if (count($players) > 0)
                                                Jogadores que confirmaram presença:
                                                <ul class="list-group mt-2">
                                                    @foreach ($players as $player)
                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-2 mb-1" type="checkbox" name="players" value="{{ $player->id }}" id="player{{ $player->id }}" checked>
                                                            <label class="form-check-label" for="player{{ $player->id }}">{{ $player->name }} @if ($player->is_goalkeeper) (Goleiro) @endif </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                Não há jogadores para exibir. 
                                                <a href="{{ route('player.create') }}">
                                                    Clique aqui e cadastre!
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col-6 text-center">
                                            <div class="form-group">
                                                <label class="w-full" for="players_quantity">Quantidade de jogadores por time</label>
                                                <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-2" id="players_quantity" value="">
                                            </div>
                                            <button type="submit" class="btn btn-dark my-3">Sortear</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
