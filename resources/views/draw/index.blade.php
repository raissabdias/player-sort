<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sorteios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="row p-4">
                    <div class="col-6 d-flex align-items-end">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Lista') }}
                        </h2>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <a href="{{ route('draw.create') }}" class="btn btn-dark">
                            {{ __('Adicionar sorteio') }}
                        <a>
                    </div>
                    <div class="col-12 mt-3">
                        @foreach ($draws as $draw)
                            <div class="card my-4 p-4">
                                <div class="row">
                                    <div class="">
                                        <h3 class="font-semibold text-xl text-gray-800 mb-2">Sorteio {{ $draw->id }}</h3> 
                                        <hr>
                                    </div>
                                    @foreach ($draw->teams as $key => $team)
                                        <div class="col-4 my-2">
                                            <b>Time {{ $key +1 }}</b>
                                            @foreach ($team as $player)
                                                <p>- {{ $player->name }} @if ($player->is_goalkeeper) (Goleiro) @endif</p>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        <div class="text-center mt-4">
                            <small>{{ count($draws) }} sorteio(s) gerado(s).</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>