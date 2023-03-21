
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

        @if (session()->has('message'))
            <div class="relative flex shadow bg-indigo-500 text-white text-sm font-bold p-4" role="alert"
                x-data="{show: true}" x-show="show">
                <p>{{ session('message') }}</p>
                <button role="button" aria-label="close alert" class="absolute top-0 bottom-0 right-0 p-4"
                    @click="show = false">
                    ×
                </button>
            </div>
        @endif
    
        {{-- Header Section --}}
        <div class="mt-8 pb-4 text-2xl flex justify-between">
            <div>Tasks List</div>
            {{-- Add Button Action --}}
            <div class="mr-2">
                <x-jet-button wire:click="confirmProductAdd" class="bg-indigo-700 hover:bg-indigo-900">
                    Add Task
                </x-jet-button>
            </div>
        </div>
    
        {{-- Table Section --}}
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left">
                                        Due Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="px-6 py-4">
                                            {{ $task->id }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $task->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $task->description }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $task->due_date->format('m/d/Y') }}
                                        </td>
                                       
                                        <td class="px-6 py-4">
                                            {{-- Edit Button Action --}}
                                            <x-jet-button wire:click="confirmProductEdit( {{ $task->id }})"
                                                class="bg-orange-500 hover:bg-orange-700">
                                                Edit
                                            </x-jet-button>
                                            {{-- Delete Button Action --}}
                                            <x-jet-danger-button wire:click="confirmProductDeletion( {{ $task->id }})"
                                                wire:loading.attr="disabled">
                                                Delete
                                            </x-jet-danger-button>
    
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
        {{-- Footer Section --}}
        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    
        {{-- Modal Section --}}
        <x-jet-confirmation-modal wire:model="confirmingProductDeletion">
            <x-slot name="title">
                {{ __('Delete Product') }}
            </x-slot>
    
            <x-slot name="content">
                {{ __('Are you sure you want to delete Product? ') }}
            </x-slot>
    
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmingProductDeletion', false)" wire:loading.attr="disabled">
                    {{ __('Conceal') }}
                </x-jet-secondary-button>
    
                <x-jet-danger-button class="ml-2" wire:click="deleteProduct({{ $confirmingProductDeletion }})"
                    wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-confirmation-modal>
    
        <x-jet-dialog-modal wire:model="confirmingProductUpdate">
            <x-slot name="title">
                {{ isset($this->task->id) ? 'Edit Task' : 'Add Task' }}
            </x-slot>
    
            <x-slot name="content">
                
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="name" value="{{ __('Task Group') }}" />
                    <select id="task_group" class="mt-1 block w-full" wire:model.defer="task.task_group">
                        @foreach ($task_groups as $task_group)
                        <option value="{{ $task_group->id }}">
                            {{ $task_group->name }}
                        </option>
                        @endforeach
                        
                    </select>
                    <x-jet-input-error for="task.name" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="task.name" />
                    <x-jet-input-error for="task.name" class="mt-2" />
                </div>
    
                <div class="col-span-6 sm:col-span-4 mt-4">
                    <x-jet-label for="description" value="{{ __('Description') }}" />
                    <x-jet-input id="description" type="text" class="mt-1 block w-full" wire:model.defer="task.description" />
                    <x-jet-input-error for="task.description" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4 mt-4">
                    <x-jet-label for="due_date" value="{{ __('Due Date') }}" />
                    <x-jet-input id="due_date" type="date" class="mt-1 block w-full" wire:model.defer="task.due_date" />
                    <x-jet-input-error for="task.due_date" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 mt-4">
                    <x-jet-label for="frequency" value="{{ __('Frequency') }}" />
                    <x-jet-input id="frequency" type="text" class="mt-1 block w-full" wire:model.defer="task.frequency" />
                    <x-jet-input-error for="task.frequency" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 mt-4">
                    <x-jet-label for="duration" value="{{ __('Duration') }}" />
                    <x-jet-input id="duration" type="number" class="mt-1 block w-full" wire:model.defer="task.duration" />
                    <x-jet-input-error for="task.duration" class="mt-2" />
                </div>
            </x-slot>
    
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmingProductUpdate', false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
    
                <x-jet-danger-button class="ml-2" wire:click="saveProduct()" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    
    </div>
    
