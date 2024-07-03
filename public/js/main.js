var showall = false;
// add task
function addTask() {
    var task = $("#taskInput").val();

    // Check if the task input is empty
    if (!task) {
        $("#alert").removeClass("d-none").addClass("float-alert-danger").html("Please enter your task").fadeIn();
        hideAlert();
        return;
    }

    $.ajax({
        url: 'addTask',
        type: 'POST',
        data: {
            task: task,
            showall: showall ? 1 : 0, // Pass 1 for show all, 0 for incomplete tasks
            _token: $('meta[name="csrf-token"]').attr('content') // Assuming you are using Laravel and CSRF token
        },
        beforeSend: function () {
            $("#taskAddBtn").attr('disabled', true);
            $("#taskAddBtnLoader").removeClass('d-none');
        },
        success: function (data) {
            $("#taskAddBtnLoader").addClass('d-none');
            $("#taskAddBtn").attr('disabled', false);
            if (data == 'Failed') {
                $("#alert").removeClass("d-none").addClass("float-alert-danger").html("Adding task failed, Try again.").fadeIn();
                hideAlert();
            } else if (data == 'Task already exists') {
                $("#alert").removeClass("d-none").addClass("float-alert-danger").html(data).fadeIn();
                hideAlert();
            } else {
                $("#taskInput").val('');
                $("#tasks").html(data);
                $("#alert").removeClass("d-none").addClass("float-alert-success").html("Task added successfully").fadeIn();
                hideAlert();
            }

        },
        error: function (err) {
            console.log(err);
            $("#taskAddBtnLoader").addClass('d-none');
            $("#taskAddBtn").attr('disabled', false);
            $("#alert").removeClass("d-none").addClass("float-alert-danger").html("Adding task failed, Try again.").fadeIn();
            hideAlert();
        }
    });
}

// mark task
function markCompleted(taskId) {
    // Check if the task input is empty
    if (!taskId) {
        $("#alert").removeClass("d-none").addClass("float-alert-danger").html("Task id require for this action").fadeIn();
        hideAlert();
        return;
    }

    $.ajax({
        url: 'markTask',
        type: 'POST',
        data: {
            taskId: taskId,
            showall: showall ? 1 : 0, // Pass 1 for show all, 0 for incomplete tasks
            _token: $('meta[name="csrf-token"]').attr('content') // Assuming you are using Laravel and CSRF token
        },
        beforeSend: function () {
            $("#taskMarkBtnLoder" + taskId).attr('disabled', true);
            $("#taskMarkBtn" + taskId).removeClass('d-none');
        },
        success: function (data) {
            $("#taskMarkBtnLoder" + taskId).addClass('d-none');
            $("#taskMarkBtn" + taskId).attr('disabled', false);
            if (data == 'Failed') {
                $("#alert").removeClass("d-none").addClass("float-alert-danger").html("Marking completed task failed, Try again.").fadeIn();
                hideAlert();
            } else {
                $("#tasks").html(data);
                $("#alert").removeClass("d-none").addClass("float-alert-success").html("Task mark as completed successfully.").fadeIn();
                hideAlert();
            }

        },
        error: function (err) {
            console.log(err);
            $("#taskMarkBtnLoder" + taskId).addClass('d-none');
            $("#taskMarkBtn" + taskId).attr('disabled', false);
            $("#alert").removeClass("d-none").addClass("float-alert-danger").html("Marking completed task failed, Try again.").fadeIn();
            hideAlert();
        }
    });
}

// delete task
function taskDeletePopupOpen(taskId) {
    // Show the delete confirmation popup
    $("#deletePopup").removeClass("d-none");
    $("#deletePopup").addClass("flex");
    $("#deleteConfirmation").attr("data-task-id", taskId); // Set taskId as data attribute
}

function taskDeletePopupClose() {
    // Hide the delete confirmation popup
    $("#deletePopup").removeClass("flex");
    $("#deletePopup").addClass("d-none");
}

$(document).ready(function () {
    $("#deleteConfirmation").click(function () {
        var taskId = $(this).attr("data-task-id");

        $.ajax({
            url: 'deleteTask',
            type: 'POST',
            data: {
                taskId: taskId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                $("#taskDeleteBtnLoader" + taskId).removeClass('d-none');
                $("#taskDeleteBtn" + taskId).attr('disabled', true);
            },
            success: function (data) {
                $("#taskDeleteBtnLoader" + taskId).addClass('d-none');
                $("#taskDeleteBtn" + taskId).attr('disabled', false);

                if (data == 'Failed') {
                    $("#alert").removeClass("d-none").addClass("alert-danger").html("Deleting task failed. Please try again.").fadeIn();
                    hideAlert();
                } else {
                    taskDeletePopupClose();
                    $("#task" + taskId).remove(); // Remove the task div
                    $("#alert").removeClass("d-none").addClass("alert-success").html("Task deleted successfully.").fadeIn();
                    hideAlert();
                }
            },
            error: function (err) {
                console.log(err);
                $("#taskDeleteBtnLoader" + taskId).addClass('d-none');
                $("#taskDeleteBtn" + taskId).attr('disabled', false);
                $("#alert").removeClass("d-none").addClass("alert-danger").html("Deleting task failed. Please try again.").fadeIn();
                hideAlert();
            }
        });

        // Close the delete confirmation popup after action
        taskDeletePopupClose();
    });
});

// show all
function showAll(show) {
    var old = $("#tasks").html();
    if (show == 1) {
        $("#showAll").addClass('d-none')
        $("#hideAll").removeClass('d-none')
    } else {
        $("#hideAll").addClass('d-none')
        $("#showAll").removeClass('d-none')
    }

    showall = show;
    $.ajax({
        url: 'showAll',
        type: 'get',
        data: {
            showall: showall, // Pass 1 for show all, 0 for incomplete tasks
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            $("#tasks").html('Loading......');
            $("#showAll").attr('disabled', true);
        },
        success: function (data) {
            $("#showAll").attr('disabled', false);

            if (data == 'Failed') {
                $("#alert").removeClass("d-none").addClass("alert-danger").html("Loading task failed. Please try again.").fadeIn();
                hideAlert();
                $("#tasks").html(old);
            } else {
                $("#tasks").html(data);
            }
        },
        error: function (err) {
            console.log(err);
            $("#tasks").html(old);
            $("#alert").removeClass("d-none").addClass("alert-danger").html("Loading task failed. Please try again.").fadeIn();
            hideAlert();
        }
    });
}
// hide alert
function hideAlert() {
    setTimeout(function () {
        $("#alert").fadeOut('slow');
        $("#alert").addClass("d-none");
        if ($("#alert").hasClass('float-alert-success')) {
            $("#alert").removeClass("float-alert-success");
        } else if ($("#alert").hasClass('float-alert-danger')) {
            $("#alert").removeClass("float-alert-danger");
        }
    }, 5000);
}
