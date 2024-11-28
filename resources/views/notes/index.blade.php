<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feljegyzések') }}
            

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            <div class="flex justify-end mb-4">
                <a href="{{ route('notes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Új bejegyzés
                </a>
            </div>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Összes feljegyzés") }}
                    @forelse  ($notes as $note )
                    <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                        <h2 class="font-semibold text-xl"><a href="{{ route('notes.show', $note->id) }}"> {{ $note->title }} </a></h2>
                        <p class="mt-2">
                            {{ Str::limit($note->text, 200, ' ') }}
                            <a href="{{ route('notes.show', $note->id) }}" class="text-blue-500 hover:underline">[tovább...]</a>
                        </p>
                        
                        <span>Létrehozva: {{ $note->created_at ? $note->created_at->diffForHumans() : 'N/A' }}</span>
                    </div>
                        @empty
                            <p>Még nincsenek feljegyzései...</p>
                        @endforelse

                        @if ($note->updated_at && $note->updated_at != $note->created_at)
                            <span>Módosítva: {{ $note->updated_at ? $note->updated_at->diffForHumans() : 'N/A' }}</span>
                        @endif
                        {{ $notes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>