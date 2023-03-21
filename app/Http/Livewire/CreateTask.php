<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\TaskGroup;
use Livewire\Component;

class CreateTask extends Component
{
    public $name;
    public $description;
    public $task_group;

    public function render()
    {
        return view('livewire.create-task');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'nullable|string',
        ]);

        $task = Task::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);
        $taskGroup = TaskGroup::find($this->task_group);
        $taskGroup->addTask($task);

        $this->name = '';
        $this->description = '';

        session()->flash('message', 'Task created successfully.');
    }
}
