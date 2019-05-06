<?php 
require_once('header.php');
// Check if form submitted to insert user into table
if(isset($_POST['Submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $mobile = $_POST['email'];
    $query = "INSERT INTO user (firstname, lastname, email) VALUES ('$firstname','$lastname','$mobile')";
    // Insert user data into table
    $result = mysqli_query($conn, $query);
    if (! $result ) {
        die('Could not enter data: ' . mysqli_error($conn));
    }
    
    // redirect to users page
    header("Location:users.php?msg=USER_ADD");    
}
?>
<div class="page-header">
    <h1>Add User</h1>
</div>
<div class='row'>
    <div class='col-12-md'>
        <form action="<?php $_PHP_SELF ?>" method="post" name="add-user">
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="firstname" class="form-control" id="firstname" placeholder="First Name">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="lastname" class="form-control" id="lastname" placeholder="Last Name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="johndoe@gmail.com">
            </div>
            <button type="submit" class="btn btn-primary">Add User</button>
        </form>
    </div>
</div>
<?php require_once('footer.php'); ?>