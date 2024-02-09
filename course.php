
<?php
// Include the template content
ob_start();

require_once 'config/db.php';

include('template.php');
$templateContent = ob_get_clean();

// Echo the entire HTML content of the template
echo $templateContent;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="assets/bootstrap-5.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Section</title>
</head>

<body>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add</button>
    <table>
        <thead>
            <tr>
                <th>Course</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Bsit</td>
                <td>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#editModal">Edit</button>
                </td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>

    <!-- Add Modal -->
    <div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add your add form fields here -->
                    <label for="addedCourse">Course Name:</label>
                    <input type="text" id="addedCourse" name="addedCourse" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Add Course</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add your edit form fields here -->
                    <label for="editedCourse">Course Name:</label>
                    <input type="text" id="editedCourse" name="editedCourse" class="form-control" value="Bsit">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>