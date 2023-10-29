<?php
    include('function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <div class="container-fluid bg-dark p-5">
        <h1 class="text-center  text-white">Employee Information</h1>
        <!-- Button trigger modal -->
        <button type="button" id="btn-open-add" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        + Add Employee 
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="text" name="id" id="id">
                    <label for="">Name:</label>
                    <input type="text" name="name" id="name" placeholder="Name:" class="form-control my-2">
                    <label for="">Gender:</label>
                    <select name="gender" id="gender" class="form-select">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <label for="">Position:</label>
                    <select name="position" id="position" class="form-select my-2">
                        <option value="Web Developer">Web Developer</option>
                        <option value="Mobile Developer">Mobile Developer</option>
                        <option value="Design">Design</option>
                        <option value="Accountant">Acountant</option>
                    </select>
                    <label for="">Salary:</label>
                    <input type="text" name="salary" id="salary" class="form-control my-2" placeholder="Salary:">
                    <label for="">Profile:</label>
                    <input type="file" name="profile" id="profile" class="form-control my-2">
                    <input type="text" name="old-img" id="hidden-img">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="btn-add" name="btn-submit" class="btn btn-primary">Submit</button>
                        <button type="submit" id="btn-update" name="btn-update" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>

    <table class="table table-hover table-dark text-center align-middle">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Position</th>
            <th>Salary</th>
            <th>Profile</th>
            <th>Action</th>
        </tr>
        <?php GetData() ?>
    </table>






    <!-- Modal Delete -->
<div class="modal fade" id="modaldelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Are You sure you want to delete ?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
            <input type="text" name="del_id" id="del_id">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
            <button type="submit" name="btn-delete" class="btn btn-danger">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
</body>

<script>
    $(document).ready(function(){
        $('#btn-open-add').click(function(){
            $('#btn-add').show();
            $('#btn-update').hide();
        });
        $('body').on('click','#btn-open-update',function(){
            $('#btn-add').hide();
            $('#btn-update').show();
            
            var Id   = $(this).parents('tr').find('td').eq(0).text();
            var Name = $(this).parents('tr').find('td').eq(1).text();
            var Gender = $(this).parents('tr').find('td').eq(2).text();
            var Position = $(this).parents('tr').find('td').eq(3).text();
            var Salary = $(this).parents('tr').find('td').eq(4).text();
            var Image = $(this).parents('tr').find('td:eq(5) img').attr('alt');
           
            $('#id').val(Id);
            $('#name').val(Name);
            $('#gender').val(Gender);
            $('#position').val(Position);
            $('#salary').val(Salary);
            $('#hidden-img').val(Image);
        });
        $('body').on('click','#btn-open-delete',function(){
            var Id   = $(this).parents('tr').find('td').eq(0).text();
            $('#del_id').val(Id);
        })
    });
</script>

</html>