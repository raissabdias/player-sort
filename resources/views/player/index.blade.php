<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jogadores') }}
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
                        <a href="{{ route('player.create') }}" class="btn btn-dark">
                            {{ __('Adicionar jogador') }}
                        <a>
                    </div>
                    <div class="col-12 mt-3">
                        <table class="table table-bordered text-center">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Nível</th>
                                    <th scope="col">Goleiro</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($players as $player)
                                    <tr>
                                        <th scope="row">{{ $player->id }}</th>
                                        <td>{{ $player->name }}</td>
                                        <td>{{ $player->level }}</td>
                                        <td>{{ $player->is_goalkeeper ? 'Sim' : 'Não' }}</td>
                                    </tr> 
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            <small>{{ count($players) }} jogador(es) cadastrado(s).</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>