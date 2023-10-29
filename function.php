<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php 

    // $hostname = 'localhost';
    $hostname = '127.0.0.1';
    $username = 'root';
    $password = '';
    $database = 'db_employee';

    $connection = new mysqli($hostname,$username,$password,$database);
    // if($connection){
    //     echo 'Success';
    // }


    function Insert(){
        global $connection;
        if(isset($_POST['btn-submit'])){
            // echo 123;
            $name      = $_POST['name'];
            $gender    = $_POST['gender'];
            $position  = $_POST['position'];
            $salary    = $_POST['salary'];
            $profile   = $_FILES['profile']['name'];
            // var_dump($profile);

            if(!empty($name) && !empty($gender) && !empty($position) && !empty($salary) && !empty($profile)){
                
                $profile = rand(1,9999).'-'.$profile;
                $path = './Image/'.$profile;
                move_uploaded_file($_FILES['profile']['tmp_name'],$path);

                $sql = "INSERT INTO `tbl_empoyee`(`name`, `gender`, `position`, `salary`, `profile`) 
                                VALUES ('$name','$gender','$position','$salary','$profile')";

                $result = $connection->query($sql);

                if($result){
                    echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Done",
                                    text: "Data Insert Success",
                                    icon: "success",
                                    button: "Yes",
                                  });
                            });
                          </script>
                    ';
                }

            }
            else{
                echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Error",
                                    text: "Empty some field",
                                    icon: "error",
                                    button: "Yes",
                                  });
                            });
                          </script>
                    ';
            }
        }
    }
    Insert();


    function GetData(){
        global $connection;

        $sql = "SELECT * FROM `tbl_empoyee`";

        $rs = $connection->query($sql);

        while($row = mysqli_fetch_assoc($rs)){
            echo '
            
            <tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['gender'].'</td>
                <td>'.$row['position'].'</td>
                <td>'.$row['salary'].'</td>
                <td>
                    <img src="./Image/'.$row['profile'].'" alt="'.$row['profile'].'" width="120px" height="120px" >
                </td>
                <td>
                    <button class="btn btn-warning" id="btn-open-update" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-pen"></i> Update</button>
                    <button class="btn btn-danger" id="btn-open-delete" data-bs-toggle="modal" data-bs-target="#modaldelete"><i class="bi bi-trash"></i> Delete</button>
                </td>
            </tr>
            
            ';
        }

    }

    function Update(){
        global $connection;

        if(isset($_POST['btn-update'])){
            $id        = $_POST['id'];
            $name      = $_POST['name'];
            $gender    = $_POST['gender'];
            $position  = $_POST['position'];
            $salary    = $_POST['salary'];
            $profile   = $_FILES['profile']['name'];

            if(empty($profile)){
                $profile = $_POST['old-img'];
            }
            else{
                $profile = rand(1,9999).'-'.$profile;
                $path = './Image/'.$profile;
                move_uploaded_file($_FILES['profile']['tmp_name'],$path);
            }

            if(!empty($name) && !empty($gender) && !empty($position) && !empty($salary)){
                $sql = "UPDATE `tbl_empoyee` 
                            SET `name`='$name',`gender`='$gender',`position`='$position',`salary`='$salary',`profile`='$profile' WHERE `id` = '$id'";
                 
                 $result = $connection->query($sql);

                 if($result){
                     echo '
                         <script>
                             $(document).ready(function(){
                                 swal({
                                     title: "Done",
                                     text: "Data Update Success",
                                     icon: "success",
                                     button: "Yes",
                                   });
                             });
                           </script>
                     ';
                 }
            }
        }
    }

    Update();

    function Delete(){
        global $connection;
        if(isset($_POST['btn-delete'])){
            $id = $_POST['del_id'];
            $sql = "DELETE FROM `tbl_empoyee` WHERE `id` = '$id'";
            $rs = $connection->query($sql);
            if($rs){
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Done",
                            text: "Data Delete Success",
                            icon: "success",
                            button: "Yes",
                          });
                    });
                  </script>
            ';
            }
        }
    }
    Delete();

?>