$(document).ready(function() {
    function loadTasks() {
        $.ajax({
            url: 'index.php',
            type: 'GET',
            success: function(data) {
                const tasks = JSON.parse(data); // Parse the JSON data
                $('#taskList').empty(); // Clear the existing list
                
                tasks.forEach(task => {
                    const taskHtml = `
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            ${task.description}
                            <button class="btn btn-danger btn-sm deleteBtn" data-id="${task.id}">Delete</button>
                        </li>`;
                    $('#taskList').append(taskHtml); // Append the task to the list
                });
            }
        });
    }

    $('#taskForm').submit(function(e) {
        e.preventDefault();
        const description = $('#taskInput').val();
        if (description) {
            $.ajax({
                url: 'index.php',
                type: 'POST',
                data: { description: description },
                success: function() {
                    $('#taskInput').val(''); // Clear the input field
                    loadTasks(); // Reload the task list
                }
            });
        }
    });

    $(document).on('click', '.deleteBtn', function() {
        const id = $(this).data('id');
        $.ajax({
            url: 'index.php',
            type: 'DELETE',
            data: { id: id },
            success: function() {
                loadTasks(); // Reload the task list after deletion
            }
        });
    });

    loadTasks(); // Initial load of tasks
});
