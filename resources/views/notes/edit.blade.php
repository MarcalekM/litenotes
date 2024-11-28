<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Szerkesztés') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">            
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('notes.update', $note) }}" method="post">
                    @method('put')
                    @csrf

                    <!-- Cím input mező -->
                    <input 
                        type="text" 
                        name="title" 
                        placeholder="Cím" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        value="{{ old('title', $note->title) }}"/>
                    @error('title')
                        <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                    @enderror

                    <!-- Szöveg textarea mező -->
                    <textarea 
                        name="text" 
                        rows="10" 
                        placeholder="Kezdj el írni ide..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                    >{{ old('text', $note->text) }}</textarea>
                    @error('text')
                        <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                    @enderror

                    <!-- Mentés gomb -->
                    <x-primary-button class="mt-6">
                        Mentés
                    </x-primary-button>
                </form>
            </div> 
        </div>
    </div>          
</x-app-layout>
