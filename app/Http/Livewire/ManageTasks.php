<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\TaskGroup;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ManageTasks extends Component
{
    use WithPagination;

    public $task;
    public $confirmingTaskUpdate = false;
    public $confirmingTaskDeletion = false;

    protected $rules = [
        'task.name' => 'required|string|min:4',
        'task.description' => 'nullable|string',
        'task.due_date' => 'date|required',
        'task.frequency' => 'string|required',
        'task.duration' => 'numeric|required',
        'task.task_group' => 'exists:task_groups,id|required',
    ];
    public function render()
    {
        $task_groups = TaskGroup::all();
        $tasks = Task::where('status', '!=', 'completed')
            ->orderBy('due_date')
            ->paginate(10);
        return view('livewire.manage-tasks', ['tasks' => $tasks, 'task_groups' => $task_groups]);
    }


    public function confirmProductAdd()
    {
        $this->reset(['task']);
        $this->confirmingTaskUpdate = true;
    }

    public function confirmTaskEdit(Task $task)
    {
        $this->resetErrorBag();
        $this->task = $task;
        $this->confirmingTaskUpdate = true;
    }

    public function completeTask(Task $task)
    {
        $this->resetErrorBag();
        $task->update(['status' => 'complete']);
        $this->task = $task;
        session()->flash('message', 'Task marked as complete Successfully');
    }

    public function saveTask()
    {
        $this->validate();
        if (isset($this->task->id)) {
            $this->task->group()->sync([$this->task['task_group']], false);
            unset($this->task['task_group']);
            $this->task->save();
            session()->flash('message', 'Task Saved Successfully');
        } else {
            $created_task = Task::create([
                'name' => $this->task['name'],
                'description' => $this->task['description'],
                'due_date' => Carbon::parse($this->task['due_date'])->format("Y-m-d"),
                'frequency' => $this->task['frequency'],
                'duration' => $this->task['duration'],
            ]);
            $created_task->group()->sync([$this->task['task_group']]);
            session()->flash('message', 'Task Added Successfully');
        }

        $this->confirmingTaskUpdate = false;
    }


    public function confirmTaskDeletion($id)
    {
        $this->confirmingTaskDeletion = $id;
    }

    public function deleteTask(Task $task)
    {
        $task->delete();
        $this->confirmingTaskDeletion = false;
        session()->flash('message', 'Task Deleted Successfully');
    }
}
