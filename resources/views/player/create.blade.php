<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Jogador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('player.store') }}">
                        @csrf
                        <div class="inline-flex w-full" style="align-items: end">
                            <!-- Name -->
                            <div class="mt-1" style="width: 30%">
                                <label class="block font-medium text-sm text-gray-700" for="name">Nome</label>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                <input class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1" 
                                    id="name" type="text" name="name" required="required" autofocus="autofocus">
                            </div>
                            
                            <!-- Nível -->
                            <div class="mt-1 ms-4" style="width: 20%">
                                <label class="block font-medium text-sm text-gray-700" for="level">Nível</label>
                                <x-input-error :messages="$errors->get('level_id')" class="mt-2" />
                                <select id="level" name="level_id" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1" >
                                    <option value="">Selecione</option>
                                        @foreach ($levels as $level)
                                           <option value="{{ $level->id }}">{{ $level->name }}</option> 
                                        @endforeach
                                </select>
                            </div>
                            
                            <!-- É goleiro? -->
                            <div class="mt-1 ms-4 mb-3 pb-3" style="width: 20%">
                                <input type="checkbox" class="me-2" id="is_goalkeeper" name="is_goalkeeper" value="1" />
                                <label class="font-medium text-sm text-gray-700" for="is_goalkeeper" style="margin-left: .5em">É goleiro?</label>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ms-3">
                                Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>