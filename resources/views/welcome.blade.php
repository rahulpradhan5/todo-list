@extends('layout.layout')
@section('content')
<!-- task body -->
<div class="flex flex-col task-body width100">
    <p class=" d-none" id="alert"></p>
    <div class="section tasks width100 flex-col align-center j-start">
        <div class="flex align-center j-between width80 task-heading">
            <h3 class="width80 flex j-start ">Your Tasks</h3>
            <button id="showAll" onclick="showAll(1)">Show all</button>
            <button class="d-none" id="hideAll" onclick="showAll(0)">Hide completed</button>
        </div>

        <!-- task rows container -->
        <div class="tasks width100 flex-col align-center j-start gap5" id="tasks">
            <?php
            if ($tasks->count() > 0) {
                foreach ($tasks as $task) {
            ?>
                    <div class="flex j-between task j-between width80 gap20" id="task{{ $task->id }}">
                        @if($task->completed_status == 1)
                        <p class="text-trough">{{$task->task}}</p>
                        @endif
                        @if($task->completed_status == 0)
                        <p>{{$task->task}}</p>
                        @endif
                        <div class="actions flex j-end align-center gap10">
                            @if($task->completed_status == 1)
                            <p class="text-success">Completed</p>
                            @endif
                            @if($task->completed_status == 0)
                            <button class="success-button" id="taskMarkBtn{{ $task->id }}" onclick="markCompleted(taskId='{{ $task->id }}')">
                                <div class="loadingio-spinner-rolling-fh89dhatsgb d-none" id="taskMarkBtnLoder{{ $task->id }}">
                                    <div class="ldio-55p6nv4e0l2">
                                        <div></div>
                                    </div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-check">
                                    <path d="M18 6 7 17l-5-5" />
                                    <path d="m22 10-7.5 7.5L13 16" />
                                </svg>
                            </button>
                            @endif
                            <button class="danger-button" id="taskDelteBtn{{ $task->id }}" onclick="taskDeletePopupOpen(taskId='{{ $task->id }}')">
                                <div class="loadingio-spinner-rolling-fh89dhatsgb d-none" id="taskDelteBtnLoder{{ $task->id }}">
                                    <div class="ldio-55p6nv4e0l2">
                                        <div></div>
                                    </div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                                    <path d="M18 6 6 18" />
                                    <path d="m6 6 12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="flex j-between task j-between width80 gap20">
                    <p>No task found </p>
                </div>
            <?php
            }
            ?>
        </div>

    </div>
</div>

<!-- delete comfirmation popup -->
<div class="popup d-none" id="deletePopup">
    <div class="popup-wrapper gap20">
        <p>Are you sure you want to delete this task?</p>
        <div class="flex width100 j-between gap20">
            <button class="secondary-button width100" onclick="taskDeletePopupClose()">No</button>
            <button class="secondary-button danger-button width100" id="deleteConfirmation">Yes</button>
        </div>
    </div>
</div>
<!--task adder -->
<div class="task-adder margin-t40 flex width100 align-center j-center gap20">
    <div class="flex width80 align-center j-center gap10">
        <!-- add input -->
        <div class="flex-col width100">
            <input type="text" placeholder="Add new task" id="taskInput">

        </div>
        <!-- addbutton -->
        <button type="button" class="secondary-button" onclick="addTask()" id="taskAddBtn">
            <div class="loadingio-spinner-rolling-fh89dhatsgb d-none" id="taskAddBtnLoder">
                <div class="ldio-55p6nv4e0l2">
                    <div></div>
                </div>
            </div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus">
                <circle cx="12" cy="12" r="10" />
                <path d="M8 12h8" />
                <path d="M12 8v8" />
            </svg>
        </button>

    </div>
</div>


@endsection