<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\TaskGroup;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ManageTaskGroups extends Component
{
    use WithPagination;

    public $task;
    public $confirmingTaskGroupUpdate = false;
    public $confirmingTaskGroupDeletion = false;

    protected $rules = [
        'task.name' => 'required|string|min:4',
        'task.description' => 'nullable|string',
    ];
    public function render()
    {
        $tasks = TaskGroup::orderBy('created_at', 'desc')
            ->paginate(10);
        return view('livewire.manage-task-groups', ['tasks' => $tasks]);
    }


    public function confirmTaskGroupAdd()
    {
        $this->reset(['task']);
        $this->confirmingTaskGroupUpdate = true;
    }

    public function confirmTaskGroupEdit(TaskGroup $task)
    {
        $this->resetErrorBag();
        $this->task = $task;
        $this->confirmingTaskGroupUpdate = true;
    }

    public function saveTaskGroup()
    {
        $this->validate();
        if (isset($this->task->id)) {
            $this->task->save();
            session()->flash('message', 'Task Group Saved Successfully');
        } else {
            TaskGroup::create([
                'name' => $this->task['name'],
                'description' => $this->task['description'],
            ]);
            session()->flash('message', 'Task Group Added Successfully');
        }

        $this->confirmingTaskGroupUpdate = false;
    }


    public function confirmTaskGroupDeletion($id)
    {
        $this->confirmingTaskGroupDeletion = $id;
    }

    public function deleteTaskGroup(TaskGroup $task)
    {
        $task->delete();
        $this->confirmingTaskGroupDeletion = false;
        session()->flash('message', 'Task Group Deleted Successfully');
    }
}
