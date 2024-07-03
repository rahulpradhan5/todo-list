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