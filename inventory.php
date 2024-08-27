<?php 
	session_start();
	if(!isset($_SESSION['IMS_user'])) header('location: login.php'); //if user session is closed it will return you to the login. Therefore, trying to manually access the dashboard without entering user details will result in you being redirected the login page.
	$role = $_SESSION['IMS_user'];
	$_SESSION['tables'] = 'product';
	$_SESSION['tables2'] = 'inventory';
	$viewtable1 = include('dbs/viewProductFunction.php');
	$viewtable2 = include('dbs/viewInventoryFunction.php')





 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Mill House - Dashboard </title>

	<link rel="stylesheet" type="text/css" href="cssp1/dashboard-inventory.css">
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
				<li class="active">
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
				<li class="">
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
							<h2> Product List</h2>
							<div class="userstable">
								<table>
									<thead>
										<tr>
											<th>Product ID</th>
											<th>Name</th>
											<th>Price</th>
											<th>Category ID</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

										<?php $viewtable1;
										 foreach ($users as $user): ?>
										<tr>
											<td><?php echo htmlspecialchars($user['product_id']); ?></td>
											<td><?php echo htmlspecialchars($user['name']); ?></td>
											<td><?php echo htmlspecialchars($user['price']); ?>											</td>
											<td><?php echo htmlspecialchars($user['category_id']); ?></td>
											<td>
												 <button type="button" class="edit-action1" data-id="<?php echo $user['product_id']; ?>"><i class="fa-solid fa-user-pen"></i> Edit</button>
  <button type="button" class="delete-action1" data-id="<?php echo $user['product_id']; ?>"><i class="fa-solid fa-trash"></i> Delete</button>
											</td>

										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>

							<a class="Refreshbutt1" href="inventory.php">
								<button >
	UPDATE         <i class="fa-solid fa-arrows-rotate"></i>
</button>
</a>
<label class="Update">   You cant delete products that exist in other tables, make sure you remove them first before removing the product. Products exist in Order Details accessable in the dashboard and they exist in Inventory accessable in the table below. </label>

						</div>		

					<div class="user-management">
						
						



    <h2>Create New Product</h2>
    <div class="adduserform">
    <form action="functionCreateProduct.php" method="POST">
        <input type="text" id="name" name="name" placeholder="Name of Product" required>
        <label class="price">Price:</label>
<input type="number" id="price" name="price" step="0.01" min="0"  max="99" value="0"  required>
<label class="catID">Catogory ID:</label>
         <select id="category_id" name="category_id">
            <option value="1">1 - Beverage</option>
            <option value="2">2 - Food</option>
        </select>
        <button type="submit"><i class="fa-solid fa-burger"></i>  Add Product</button>
    </form>
    </div>
</div>
							
<div class="shiftmanagementpt2">
	<a class=" DevButt" href=""> <button>
	Next Page         InDEV <i class="fa-solid fa-hand-point-right"></i>
</button></a>
					<h2> Inventory</h2>
							<div class="schedulestable">
								<table>
									<thead>
										<tr>
											<th>Inventory ID</th>
											<th>Product ID</th>
											<th>Quantity</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

										<?php $viewtable2;
										 foreach ($schedules as $shift): ?>
										<tr>
											<td><?php echo htmlspecialchars($shift['inventory_id']); ?></td>
											<td><?php echo htmlspecialchars($shift['product_id']); ?></td>
											<td><?php echo htmlspecialchars($shift['quantity']); ?>											</td>
											<td><?php echo htmlspecialchars($shift['status']); ?></td>
											<td>
  <button type="button" class="edit-action" data-id="<?php echo $shift['inventory_id']; ?>"><i class="fa-solid fa-user-pen"></i> Edit</button>
  <button type="button" class="delete-action" data-id="<?php echo $shift['inventory_id']; ?>"><i class="fa-solid fa-trash"></i> Delete</button>
</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
<a class="Refreshbutt" href="inventory.php">
								<button >
	UPDATE         <i class="fa-solid fa-arrows-rotate"></i>
</button>
</a>
<label class="Update">To edit a row again you must update</label>
						</div>				
							
						</div>


<div class="shift-management">

    <h2> Product Quantity </h2>
    <div class="addshiftform">
    <form action="createinventory.php" method="POST">
    	<p>Product ID:</p>
        <input type="number" id="product_id" name="product_id" min="1" max="99" value="1"  required/>
        <label>Make sure "Product ID" exists!</label>
        <p>Quantity:</p>
        <input type="number" id="quantity" name="quantity" min="0" max="999" value="0" required />
        <button type="submit"><i class="fa-solid fa-cubes-stacked"></i>  Create Product Quantity</button>
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
    // Edit Inventory Item
    $(document).on('click', '.edit-action', function() {
        var inventory_id = $(this).data('id');
        var parentRow = $(this).closest('tr');
        var product_id = parentRow.find('td').eq(1).text().trim();
        var quantity = parentRow.find('td').eq(2).text().trim();

        // Convert text to input fields
        parentRow.find('td').eq(1).html(`<input type="text" name="product_id" value="${product_id}" class="table-input">`);
        parentRow.find('td').eq(2).html(`<input type="number" name="quantity" value="${quantity}" class="table-input">`);
       

        // Update the button setup
        $(this).siblings('.delete-action').hide(); // Hide the delete button
        $(this).after(`<button type="button" class="save-action" data-id="${inventory_id}">Save</button>`);
        $(this).remove(); // Remove the edit button
    });

    $(document).ready(function() {
    // Save Edited Inventory
    $(document).on('click', '.save-action', function() {
    var parentRow = $(this).closest('tr');
    var inventory_id = $(this).data('id'); 
    var product_id = parentRow.find('input[name="product_id"]').val().trim();
    var quantity = parentRow.find('input[name="quantity"]').val().trim();

        $.ajax({
            url: 'editInventory.php', 
            type: 'POST',
            dataType: 'json',
            data: {
                'inventory_id': inventory_id,
                'product_id': product_id,
                'quantity': quantity,
            },
            success: function(response) {
                if (response && response.success) {
                    // Update the table with the new values
                    parentRow.find('td').eq(1).text(product_id);
                    parentRow.find('td').eq(2).text(quantity);
                    // Replace 'Save' button with 'Edit' button
                    var editButtonHtml = `<button type="button" class="edit-action" data-id="${inventory_id}"><i class="fa-solid fa-user-pen"></i> Edit</button>`;
                    parentRow.find('.save-action').replaceWith(editButtonHtml);
                    parentRow.find('.delete-action').show(); // Show the delete button again
                } else {
                    
                    alert(`Failed to update the inventory: ${response.message || 'Unknown error occurred'}`);
                }
            },
            error: function(xhr, status, error) {
                // If there is an AJAX error, show an alert
                alert(`An error occurred: ${xhr.responseText || error}`);
            }
        });
    });

    // Delete Inventory
    $(document).on('click', '.delete-action', function() {
        var inventory_id = $(this).data('id'); 
        var parentRow = $(this).closest('tr');

        if (confirm('Are you sure you want to delete this inventory item?')) {
            $.ajax({
                url: 'dbs/deleteInventory.php', 
                type: 'POST',
                dataType: 'json',
                data: { 'inventory_id': inventory_id },
                success: function(response) {
                    if (response.success) {
                        parentRow.fadeOut(300, function() {
                            $(this).remove();
                        });
                    } else {
                        alert(`Failed to delete the inventory item: ${response.message}`);
                    }
                },
                error: function(xhr, status, error) {
                    alert(`An error occurred while deleting the inventory item: ${xhr.responseText}`);
                }
            });
        }
    });
});
$(document).ready(function() {
    // Delete Product
    $(document).on('click', '.delete-action1', function() {
        var product_id = $(this).data('id'); 
        var parentRow = $(this).closest('tr');

        if (confirm('Are you sure you want to delete this product?')) {
            $.ajax({
                url: 'dbs/deleteProduct.php', 
                type: 'POST',
                dataType: 'json',
                data: {
                    'product_id': product_id
                },
                success: function(response) {
                    if (response.success) {
                        parentRow.fadeOut(400, function() {
                            $(this).remove(); // Remove the row from the DOM
                        });
                    } else {
                        alert('Failed to delete the product: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        }
    });
});
// Edit Product
    $(document).on('click', '.edit-action1', function() {
        var product_id = $(this).data('id');  // This grabs the product ID.
        var parentRow = $(this).closest('tr');
        var name = parentRow.find('td').eq(1).text().trim();
        var price = parseFloat(parentRow.find('td').eq(2).text().trim()); 
        var category_id = parseInt(parentRow.find('td').eq(3).text().trim(), 10); 

        // Convert text to input fields
        parentRow.find('td').eq(1).html(`<input type="text" name="name" value="${name}" class="table-input">`);
        parentRow.find('td').eq(2).html(`<input type="number" name="price" value="${price.toFixed(2)}" class="table-input">`);  // toFixed(2) ensures two decimal places.
        parentRow.find('td').eq(3).html(`<input type="number" name="category_id" value="${category_id}" class="table-input">`);

        // Replace the edit button with a save button
 $(this).after(`<button type="button" class="save-action1" data-id="${product_id}">Save</button>`);
        $(this).siblings('.delete-action1').hide();
        $(this).remove();
    });

    // Save Edited Product
    $(document).on('click', '.save-action1', function() {
        var parentRow = $(this).closest('tr');
        var product_id = $(this).data('id');  
        var name = parentRow.find('input[name="name"]').val().trim();
        var price = parentRow.find('input[name="price"]').val().trim();
        var category_id = parentRow.find('input[name="category_id"]').val().trim();

        $.ajax({
            url: 'dbs/editProduct.php',
            type: 'POST',
            dataType: 'json',
            data: {
                'product_id': product_id,
                'name': name,
                'price': price,
                'category_id': category_id
            },
            success: function(response) {
                if (response && response.success) {
                    parentRow.find('td').eq(1).text(name);
                    parentRow.find('td').eq(2).text(price);
                    parentRow.find('td').eq(3).text(category_id);
                    // Correctly re-create the edit button
                    parentRow.find('.save-action1').replaceWith(`<button type="button" class="edit-action1" data-product_id="${product_id}"><i class="fa-solid fa-user-pen"></i> Edit</button>`);
                    parentRow.find('.delete-action1').show();
                } else {
                    alert(`Failed to update product: ${response.message || 'Unknown error'}`);
                }
            },
            error: function(xhr, status, error) {
                alert(`An error occurred: ${xhr.responseText || error}`);
            }
        });
    });
});

</script>
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