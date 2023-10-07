<?php
include('header.php'); 

?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Username </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control checking_email" placeholder="Enter Email">
                <small class="error_email" style="color: red"></small>
                <small class="right_email" style="color: green"></small>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<!-- <div class="container-fluid"> -->

<!-- DataTales Example -->
 <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Admin Profile 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Admin Profile 
            </button>
    </h6>
  </div>

  <div id="status_update">
    <?php 
      if(isset($_SESSION['status']) && isset($_SESSION['status_code'])){
        echo '<h2 class="bg-info"> '.$_SESSION['status'].'</h2>';
        unset($_SESSION['status_code']);
        unset($_SESSION['status']);
      }

      if(isset($_SESSION['stt_update']) && isset($_SESSION['stt_update_code'])){
        if($_SESSION['stt_update_code']=='success'){
          echo '<h2 class="bg-info"> '.$_SESSION['stt_update'].'</h2>';
        }else{
          echo '<h2 class="bg-danger"> '.$_SESSION['stt_update'].'</h2>';
        }
        
        unset($_SESSION['stt_update']);
        unset($_SESSION['stt_update_code']);
      }

    ?>
  </div>

  <div class="card-body">

    <div class="table-responsive">
      <?php
        $connection = mysqli_connect("localhost:3306", "root", "", "ban_sach");
        $query="select * from account";
        $query_run = mysqli_query($connection, $query);
      ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th> Username </th>
            <th>Email </th>
            <th>Password</th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
        <?php 
          if(mysqli_num_rows($query_run) > 0)
          {
            while($row=mysqli_fetch_assoc($query_run)){
              ?>
              <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><input style="border: none" type="password" value="<?php echo $row['password'];?>" readonly></td>
                <td>
                  <form action="register_edit.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-success" name="edit_btn">EDIT</button>
                  </form>
                </td>
                <td>
                  <form action="code.php" method="post">
                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" name="delete_btn">DELETE</button>
                  </form>
                  
                </td>
              </tr>
              <?php 
              }
            }else{
              echo "No record found";
            }
          
        ?>
          
        
        </tbody>
      </table>

    </div>
  </div>
</div>

</div> 
<!-- /.container-fluid -->

<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
       Add Admin Profile 
</button> -->

<!-- ajax -->

<script src="public/vendor/jquery/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('.checking_email').keyup(function(e){
      var email= $(".checking_email").val();
      $.ajax({
        type: "POST",
        url: "code.php",
        data:{
          "check_submit_btn" :1,
          "email_id": email,
        },
        success: function(response){
          // alert(response);
          if(response==0){
            $('.error_email').text("Email này đã tồn tại. Vui lòng chọn email khác");
            $('.right_email').text("");
          } else{
            $('.error_email').text("");
            $('.right_email').text("Email hợp lệ");
          }
          
        }
      });
    });
  });
</script>
<?php
include('footer.php');
?>