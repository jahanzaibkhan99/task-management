<x-app-layout>
    <x-slot name="header">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Task
            </h2>
        </x-slot>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                <div>
                    <form wire:submit.prevent="store">
                        <div class="mb-4">
                            <h4 class="font-semibold text-xl text-gray-800 leading-tight">
                                Create Task
                            </h4>
                        </div>
                        @csrf
                        <div>
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 font-bold mb-2">Task Group:</label>
                                <select name="task_group" id="task_group" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('task_group') border-red-500 @enderror" wire:model="taskGroup">
                                    @foreach ($taskGroups as $taskGroup)
                                        <option value="{{$taskGroup->id}}">{{$taskGroup->name}}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" id="name" placeholder="Enter name" wire:model="name"> --}}
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                                <input type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" id="name" placeholder="Enter name" wire:model="name">
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                           
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 font-bold mb-2">Description:</label>
                                <input type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror" placeholder="Enter description" id="description" wire:model="description">
                                @error('description') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <button type="submit"class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Save</button>
                    </form>
                    @if (session()->has('message'))
                        <div>{{ session('message') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>