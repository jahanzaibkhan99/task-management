<?php

namespace App\Http\Livewire;

use App\Models\TaskGroup;
use Livewire\Component;

class CreateTaskGroup extends Component
{
    public $name;
    public $description;
    public function render()
    {
        return view('livewire.create-task-group');
    }

    public function createTaskGroup()
    {
        dd("asd");

        // $validatedData = $this->validate([
        //     'name' => 'required|unique:task_groups,name',
        //     'description' => 'required|string',
        // ]);

        TaskGroup::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        // Clear the input field
        $this->name = '';
        $this->description = '';

        // Show a success message
        session()->flash('message', 'Task group created successfully!');
    }
}
