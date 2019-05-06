<?php 
require_once('header.php');
// Fetch all users
$result = mysqli_query($conn, "SELECT * FROM user ORDER BY id DESC");
?>
<h3>Users <a class='btn btn-primary a-right' href="add-user.php">Add New User</a></h3>
<?php if (isset($_GET['msg'])): ?>
<div class="alert alert-success" role="alert"><?php echo constant($_GET['msg']); ?> </div>
<?php endif; ?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Mobile</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php  
    while($user_data = mysqli_fetch_array($result)) {    
        echo "<tr>";
        echo "<td>".$user_data['firstname']."</td>";
        echo "<td>".$user_data['lastname']."</td>";
        echo "<td>".$user_data['email']."</td>";    
        echo "<td><a href='edit-user.php?id=$user_data[id]'>Edit</a> | <a href='delete-user.php?id=$user_data[id]'>Delete</a></td></tr>";        
    }
    ?>
    </tbody>
</table>
<?php require_once('footer.php'); ?>