<?php 
	session_start();
	if(!isset($_SESSION['IMS_user'])) header('location: login.php'); //if user session is closed it will return you to the login. Therefore, trying to manually access the dashboard without entering user details will result in you being redirected the login page.
	$role = $_SESSION['IMS_user'];




 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Mill House - Dashboard </title>

	<link rel="stylesheet" type="text/css" href="cssp1/dashboard.css">
	<script src="https://kit.fontawesome.com/ffd6dc4165.js" crossorigin="anonymous"></script>
	<script src="https://cdn.tailwindcss.com"></script>
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
	<div id="sidebar_container">
		<div class="sidebar" id="sidebar">
<h1 class="text-4xl md:text-4xl lg:text-5xl font-bold text-white">
            MillHouse IMS
        </h1>
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
				<li class="active">
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
					 <body class="bg-gray-100">
    <div class="container mx-auto my-10 p-8 bg-white shadow-lg rounded-lg">
        <div class="flex justify-between">
           <h1 class="text-3xl font-bold leading-tight">
 <span class="text-red-500">S</span>
    <span class="text-yellow-500">A</span>
    <span class="text-green-500">L</span>
    <span class="text-blue-500">E</span>
    <span class="text-green-500">S</span>
    <span class="text-red-500"> |</span>
    <span class="text-yellow-500">R</span>
    <span class="text-green-500">E</span>
    <span class="text-blue-500">P</span>
    <span class="text-red-500">O</span>
    <span class="text-yellow-500">R</span>
    <span class="text-green-500">T</span>
</h1>
            <div class="flex items-center">
                <!-- Search and profile here -->
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Status cards -->
            <div class="bg-blue-500 text-white p-4 rounded-lg shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-600 mr-4">
                        <i class="fas fa-box fa-2x"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">YEARLY SALES</p>
                        <p class="text-3xl font-bold">85</p>
                    </div>
                </div>
            </div>
            <!-- Purchase Orders Card -->
            <div class="bg-yellow-500 text-white p-4 rounded-lg shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-600 mr-4">
                        <i class="fas fa-shopping-cart fa-2x"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">MONTHLY SALES</p>
                        <p class="text-3xl font-bold">45</p>
                    </div>
                </div>
            </div>
            <!-- Sales Orders Card -->
            <div class="bg-green-500 text-white p-4 rounded-lg shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-600 mr-4">
                        <i class="fas fa-chart-line fa-2x"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">RECENT ORDERS</p>
                        <p class="text-3xl font-bold">40</p>
                    </div>
                </div>
            </div>
            <!-- Inventory Alerts Card -->
            <div class="bg-red-500 text-white p-4 rounded-lg shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-600 mr-4">
                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">TOTAL SALES</p>
                        <p class="text-3xl font-bold">85</p>
                    </div>
                </div>
            </div>
        </div>

       <div class="flex flex-wrap -mx-6">
            <div class="w-full md:w-1/2 lg:w-1/3 px-6 mb-6">
                <div class="p-8 bg-white rounded-lg shadow-lg h-full">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Yearly Sales</h2>
                    <div class="w-full h-64 bg-gray-200 rounded"></div>
                </div>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/3 px-6 mb-6">
                <div class="p-8 bg-white rounded-lg shadow-lg h-full">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Monthly Sales</h2>
                    <div class="w-full h-64 bg-gray-200 rounded"></div>
                </div>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/3 px-6 mb-6">
                <div class="p-8 bg-white rounded-lg shadow-lg h-full">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Recent Sales</h2>
                    <div class="w-full h-64 bg-gray-200 rounded"></div>
                </div>
            </div>
        </div>
    </div>

	<script>
		var navBO = true;


		navB.addEventListener( 'click', (event) => {
		event.preventDefault();

		if(navBO){
		sidebar.style.width	= '8%' ;
		sidebar.style.transition = '0.5s all';
		content_container.style.width = '90%' ;
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