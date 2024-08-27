<?php 
	session_start();
	if(!isset($_SESSION['IMS_user'])) header('location: login.php'); //if user session is closed it will return you to the login. Therefore, trying to manually access the dashboard without entering user details will result in you being redirected the login page.
	$role = $_SESSION['IMS_user'];
	$_SESSION['tables'] = 'users';
	$_SESSION['tables2'] = 'schedule';
	$viewtable1 = include('dbs/viewUsersFunction.php');
	$viewtable2 = include('dbs/viewScheduleFunction.php')





 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Mill House - Dashboard </title>

	<link rel="stylesheet" type="text/css" href="cssp1/dashboard-setting.css">
	<script src="https://kit.fontawesome.com/ffd6dc4165.js" crossorigin="anonymous"></script>
</head>
<body>
	<div id="sidebar_container">
		<div class="sidebar" id="sidebar">
			<h3 class="logo">Mill House IMS</h3>
			<div class="sidebar_user">
			<img src="./photos/barista.png" alt="User Image"/>
			<span><?= $role['role'] ?></span>	
			</div>
			<div class="siderbar_menu">
			<ul class="lists" >
				<li class="">
					<a href="./dashboard.php"><i class="fa-solid fa-gauge-high"></i> <span class="textMenu"> Dashboard</span></a>
				</li>
				<li>
					<a href="./analytics.php"><i class="fa-solid fa-chart-simple"></i> <span class="textMenu"> Analytics</span></a>
				</li>
				<li class="">
					<a href="./datamanagement.php"><i class="fa-solid fa-magnifying-glass-chart"></i> <span class="textMenu"> Data Management</span></a>
				</li>
				<li class="">
					<a href="./inventory.php"><i class="fa-solid fa-warehouse"></i> <span class="textMenu"> Inventory</span></a>
				</li>
				<li class="">
					<a href=""><i class="fa-solid fa-cart-shopping"></i> <span class="textMenu"> Point Of Sale</span></a>
				</li>
				<li class="">
					<a href="./inventoryreport.php"><i class="fa-solid fa-chart-pie"></i></i> <span class="textMenu"> Inventory Report</span></a>
				</li>
				<li>
					<a href="./salesreport.php"><i class="fa-solid fa-comment-dollar"></i> <span class="textMenu"> Sales Report</span></a>
				</li>
				<li class="">
					<a href=""><i class="fa-solid fa-users-viewfinder"></i></i> <span class="textMenu"> CRM</span></a>
				</li>
				<li class="">
					<a href=""><i class="fa-solid fa-fire"></i> <span class="textMenu"> Promotions</span></a>
				</li>
					</li>
				<li class="active">
					<a href="./setting.php"><i class="fa-solid fa-gears"></i> <span class="textMenu"> Settings</span></a>
				</li>
			</ul>	
			</div>
		</div>
		<div class="content_container" id="content_container">
			<div class="cont_top_navigation">
				<a href="" id="navB"><i class="fa-solid fa-bars"></i></a>
				<a href="dbs/loguserout.php" id="logoutB"><i class="fa-solid fa-right-from-bracket"></i> LOG OUT</a>
			</div>
			<div class="content">

				<div class="main_content">


				<div class="user-managementpt2">
							<h2> User List</h2>
							<div class="userstable">
								<table>
									<thead>
										<tr>
											<th>User ID</th>
											<th>Role</th>
											<th>First Name</th>
											<th>Last Name</th>
											<th>Email</th>
											<th>Password</th>
											<th>Created At</th>
											<th>Branch ID</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

										<?php $viewtable1;
										 foreach ($users as $user): ?>
										<tr>
											<td><?php echo htmlspecialchars($user['ID']); ?></td>
											<td><?php echo htmlspecialchars($user['role']); ?></td>
											<td><?php echo htmlspecialchars($user['first_name']); ?>											</td>
											<td><?php echo htmlspecialchars($user['last_name']); ?></td>
											<td><?php echo htmlspecialchars($user['email']); ?></td>
											<td><?php echo htmlspecialchars($user['password']); ?></td>
											<td><?php echo htmlspecialchars($user['created_at']); ?></td>
											<td><?php echo htmlspecialchars($user['branch_id']); ?></td>
											<td>
												 <button type="button" class="edit-action1" data-id="<?php echo $user['ID']; ?>"><i class="fa-solid fa-user-pen"></i> Edit</button>
  <button type="button" class="delete-action1" data-id="<?php echo $user['ID']; ?>"><i class="fa-solid fa-trash"></i> Delete</button>
											</td>

										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>

							<a class="Refreshbutt1" href="setting.php">
								<button >
	UPDATE         <i class="fa-solid fa-arrows-rotate"></i>
</button>
</a>
<label class="Update">To edit a row again you must update</label>

						</div>		

					<div class="user-management">
						
						



    <h2>Add New User</h2>
    <div class="adduserform">
    <form action="functionCreateUser.php" method="POST">
        <select id="role" name="role">
            <option value="Employee">Employee</option>
            <option value="Manager">Manager</option>
            <option value="Barista">Barista</option>
            <option value="Cashier">Cashier</option>
            <option value="Chef">Chef</option>
        </select>
        <input type="text" id="first_name" name="first_name" placeholder="First Name" required>
        <input type="text" id="last_name" name="last_name" placeholder="Last Name" required>
        <input type="email" id="email" name="email" placeholder="Email" required>
        <input type="password" id="password" name="password" placeholder="Password" required>
         <input type="date" name="created_at" min="2024-01-01" max="2024-12-30" />
         <select id="branch" name="branch_id">
            <option value="1">1 - Downtown</option>
            <option value="2">2 - Uptown</option>
            <option value="3">3 - Midtown</option>
            <option value="4">4 - Eastside</option>
        </select>
        <button type="submit"><i class="fa-solid fa-user-plus"></i>  Add User</button>
    </form>
    </div>
</div>
							
<div class="shiftmanagementpt2">
	<a class=" DevButt" href=""> <button>
	Next Page         In <i class="fa-solid fa-hand-point-right"></i>
</button></a>
					<h2> Schedule</h2>
							<div class="schedulestable">
								<table>
									<thead>
										<tr>
											<th>Shift ID</th>
											<th>User ID</th>
											<th>Start Time</th>
											<th>End Time</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

										<?php $viewtable2;
										 foreach ($schedules as $shift): ?>
										<tr>
											<td><?php echo htmlspecialchars($shift['shift_id']); ?></td>
											<td><?php echo htmlspecialchars($shift['user_id']); ?></td>
											<td><?php echo htmlspecialchars($shift['start_time']); ?>											</td>
											<td><?php echo htmlspecialchars($shift['end_time']); ?></td>
											<td>
  <button type="button" class="edit-action" data-id="<?php echo $shift['shift_id']; ?>"><i class="fa-solid fa-user-pen"></i> Edit</button>
  <button type="button" class="delete-action" data-id="<?php echo $shift['shift_id']; ?>"><i class="fa-solid fa-trash"></i> Delete</button>
</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
<a class="Refreshbutt" href="setting.php">
								<button >
	UPDATE         <i class="fa-solid fa-arrows-rotate"></i>
</button>
</a>
						</div>				
							
						</div>


<div class="shift-management">

    <h2> Add a Shift </h2>
    <div class="addshiftform">
    <form action="createShift.php" method="POST">
    	<p>User ID:</p>
        <input type="number" id="user_id" name="user_id" min="1" max="99" value="1"  required/>
        <label>Make sure "User ID" exists!</label>
        <p>Start Time:</p>
        <input type="time" id="start_time" name="start_time" min="07:00" max="12:00" value="07:00" required />
        <p>End Time:</p>
        <input type="time" id="end_time" name="end_time" min="12:00" max="18:00" value="18:00" required />
        <button type="submit"><i class="fa-solid fa-bolt"></i>  Add Shift</button>
    </form>
    </div>
</div>



				</div>
			</div>
		</div>
	</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  // Edit Shift
  $('.edit-action').click(function() {
    var shift_id = $(this).data('id');
    var parentRow = $(this).closest('tr');
  var start_time = parentRow.find('td').eq(2).text().trim();
  var end_time = parentRow.find('td').eq(3).text().trim();

    parentRow.find('td').eq(2).html('<input type="time" name="start_time" value="' + start_time + '">');
    parentRow.find('td').eq(3).html('<input type="time" name="end_time" value="' + end_time + '">');
    $(this).siblings('.delete-action').hide(); // Hide the delete button
    $(this).after('<button type="button" class="save-action">Save</button>');
    $(this).remove(); 
  });

  // Save Edited Shift
$(document).on('click', '.save-action', function() {
    var parentRow = $(this).closest('tr');
    var shift_id = parentRow.find('.delete-action').data('id');
  var start_time = parentRow.find('input[name="start_time"]').val().trim();
var end_time = parentRow.find('input[name="end_time"]').val().trim();
var timeRegex = /^([01]\d|2[0-3]):([0-5]\d)(:[0-5]\d)?$/;

// Validate times before sending the AJAX request
if (!timeRegex.test(start_time) || !timeRegex.test(end_time)) {
    alert("Please enter a valid time in HH:mm:ss format.");
    return; 
}

    $.ajax({
        url: 'editShift.php', 
        type: 'POST',
        dataType: 'json', 
        data: {
            'shift_id': shift_id,
            'start_time': start_time,
            'end_time': end_time
        },
success: function(response) {
        if(response.success) {
           parentRow.find('td').eq(2).text(start_time);
                parentRow.find('td').eq(3).text(end_time);
                // Replace the 'Save' button with the 'Edit' button
                parentRow.find('.save-action').replaceWith('<button type="button" class="edit-action" data-id="'+shift_id+'"><i class="fa-solid fa-user-pen"></i> Edit</button>');
                parentRow.find('.delete-action').show(); // Show the delete button again
        } else {
            alert('Failed to update the shift: ' + response.message);
        }
    },
    error: function(xhr, status, error) {
        alert('An error occurred: ' + xhr.responseText);
    }
});
});

  // Delete Shift
$(document).on('click', '.delete-action', function() {
    if (confirm('Are you sure you want to delete this shift?')) {
        var shift_id = $(this).data('id');
        var parentRow = $(this).closest('tr');
        
        $.ajax({
            url: 'deleteShift.php', 
            dataType: 'json',
            data: { 'shift_id': shift_id },
            success: function(response) {
                if (response.success) {
                    // If the deletion was successful, remove the row from the table
                    parentRow.fadeOut(300, function() {
                        $(this).remove();
                    });
                } else {
                    alert('Failed to delete the shift: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred while deleting the shift: ' + error);
            }
      });
    }
  });
$(document).on('click', '.delete-action1', function() {
    if (confirm('Are you sure you want to delete this user?')) {
        var user_id = $(this).data('id');
        var parentRow = $(this).closest('tr');
        
        $.ajax({
            url: 'dbs/deleteUser.php', 
            type: 'POST',
            dataType: 'json',
            data: { 'user_id': user_id },
            success: function(response) {
                if (response.success) {
                    parentRow.fadeOut(400, function() {
                        $(this).remove(); // Remove the row from the DOM
                    });
                } else {
                    alert('Failed to delete the user: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred: ' + error);
            }
        });
    }
});
$(document).on('click', '.edit-action1', function() {
    var user_id = $(this).data('id');
    var parentRow = $(this).closest('tr');
    // Extract current values
    var role = parentRow.find('td').eq(1).text().trim();
    var first_name = parentRow.find('td').eq(2).text().trim();
    var last_name = parentRow.find('td').eq(3).text().trim();
    var email = parentRow.find('td').eq(4).text().trim();
    var branch_id = parentRow.find('td').eq(7).text().trim(); 

    // Convert text to input fields with correct types and names
parentRow.find('td').eq(1).html('<input type="text" name="role" value="' + role + '" class="table-input">');
parentRow.find('td').eq(2).html('<input type="text" name="first_name" value="' + first_name + '" class="table-input">');
parentRow.find('td').eq(3).html('<input type="text" name="last_name" value="' + last_name + '" class="table-input">');
parentRow.find('td').eq(4).html('<input type="email" name="email" value="' + email + '" class="table-input">');
parentRow.find('td').eq(7).html('<input type="number" name="branch_id" value="' + branch_id + '" class="table-input">');

    // Replace the edit button with a save button and hide the delete button
    $(this).after('<button type="button" class="save-action1" data-id="' + user_id + '">Save</button>');
    $(this).siblings('.delete-action1').hide();
    $(this).remove();
});

$(document).on('click', '.save-action1', function() {
    var parentRow = $(this).closest('tr');
    var user_id = $(this).data('id');
    // Fetch values from input fields
    var role = parentRow.find('input[name="role"]').val().trim();
    var first_name = parentRow.find('input[name="first_name"]').val().trim();
    var last_name = parentRow.find('input[name="last_name"]').val().trim();
    var email = parentRow.find('input[name="email"]').val().trim();
    var branch_id = parentRow.find('input[name="branch_id"]').val().trim();

    // AJAX request to update the user data
    $.ajax({
        url: 'dbs/editUser.php',
        type: 'POST',
        dataType: 'json',
        data: {
            'user_id': user_id,
            'role': role,
            'first_name': first_name,
            'last_name': last_name,
            'email': email,
            'branch_id': branch_id
        },
        success: function(response) {
            if(response.success) {
                // Replace input fields with updated values
                parentRow.find('td').eq(1).text(role);
                parentRow.find('td').eq(2).text(first_name);
                parentRow.find('td').eq(3).text(last_name);
                parentRow.find('td').eq(4).text(email);
                parentRow.find('td').eq(7).text(branch_id);
                // Replace the save button with the edit button and show the delete button again
                parentRow.find('.save-action1').replaceWith('<button type="button" class="edit-action1" data-id="' + user_id + '"><i class="fa-solid fa-user-pen"></i> Edit</button>');
                parentRow.find('.delete-action1').show();
            } else {
                alert('Failed to update the user: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            alert('An error occurred: ' + xhr.responseText);
        }
    });
});
});
</script>
	<script>
		var navBO = true;


		navB.addEventListener( 'click', (event) => {
		event.preventDefault();

		if(navBO){
		sidebar.style.width	= '8%' ;
		sidebar.style.transition = '0.5s all';
		content_container.style.width = '100%' ;
		textMenu = document.getElementsByClassName('textMenu');
		for(var i=0; i < textMenu.length;i++){
			textMenu[i].style.display = 'none';	
		}

		
		navBO = false;
		} else {
		sidebar.style.width	= '20%' ;
		content_container.style.width = '80%' ;
		textMenu = document.getElementsByClassName('textMenu');
		for(var i=0; i < textMenu.length;i++){
			textMenu[i].style.display = 'inline-block';
		}
		navBO = true;
	}

		});
	</script>

</body>
</html>