<?php 
require_once('header.php');
// Check if form is submitted to user update
if(isset($_POST['update']))
{	
	$id = $_POST['id'];	
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
    $email=$_POST['email'];
    
    $query = "UPDATE user SET firstname='$firstname', lastname='$lastname', email='$email' WHERE id=$id";
	// update user data
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die('Could not update data: ' . mysqli_error($conn));
    }
    
    // redirect to users page
    header("Location:users.php?msg=USER_EDIT");    
}
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];
$query = "SELECT * FROM user WHERE id=$id";
// Fetech user data based on id
$result = mysqli_query($conn, $query);

while($user_data = mysqli_fetch_array($result))
{
	$firstname = $user_data['firstname'];
	$lastname = $user_data['lastname'];
	$email = $user_data['email'];
}
?>
<div class="page-header">
    <h1>Edit User</h1>
</div>
<div class='row'>
    <div class='col-12-md'>
        <form action="<?php $_PHP_SELF ?>" method="post" name="update-user">
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="firstname" class="form-control" id="firstname" value=<?php echo $firstname;?>>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="lastname" class="form-control" id="lastname" value=<?php echo $lastname;?>>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" value=<?php echo $email;?>>
            </div>
            <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
            <button type="submit" name="update" class="btn btn-primary">Update User</button>
        </form>
    </div>
</div>