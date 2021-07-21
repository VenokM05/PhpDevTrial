<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>
<?php 

$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM orders WHERE order_status = 1";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$totalRevenue = "";
while ($orderResult = $orderQuery->fetch_assoc()) {
      $totalRevenue = $orderResult['paid'];
}

$lowStockSql = "SELECT * FROM product WHERE quantity <= 3 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;
?>
<div class="row">
	<!-- Start Total Product -->
	<div class="col-md-4">
		<div class="panel panel-success">
			<div class="panel-heading">	
				<span style="text-decoration:none;color:black;">
					Total Product
					<span class="badge pull pull-right"><?php echo $countProduct; ?></span>	
				</span>
			</div>
		</div>
	</div>
	<!-- End Total Product -->
	<!-- Start Total Orders -->
	<div class="col-md-4">
		<div class="panel panel-info">
			<div class="panel-heading">
				<span style="text-decoration:none;color:black;">
					Total Orders
					<span class="badge pull pull-right"><?php echo $countOrder; ?></span>
				</span>
			</div> 
		</div> 
	</div>
	<!-- End Total Orders -->
	<!-- Start Out of Stock -->
	<div class="col-md-4">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<span style="text-decoration:none;color:black;">
					Out of Stock
					<span class="badge pull pull-right"><?php echo $countLowStock; ?></span>	
				</span>
			</div> 
		</div>  
	</div>
	<!-- End Out of Stock -->
	<!-- Start Total Sales and Date Now -->
	<div class="col-md-3">
		<!-- Date Now -->
		<div class="card">
		  <div class="cardHeader">
		    <h1><?php echo date('d'); ?></h1>
		  </div>
		  <div class="cardContainer">
		    <p><?php echo date('l') .' '.date('d').', '.date('Y'); ?></p>
		  </div>
		</div> 
		<br/>
		<!-- Total Sales -->
		<div class="card">
		  <div class="cardHeader" style="background-color:#245580;">
		    <h1><?php if($totalRevenue) {
		    	echo $totalRevenue;
		    	} else {
		    		echo '0';
		    		} ?></h1>
		  </div>
		  <div class="cardContainer">
		    <p> <i class="glyphicon glyphicon-usd"></i> Total Sales</p>
		  </div>
		</div> 
	</div>
	<!-- End Total Sales and Date Now -->
	<!-- Start Products -->
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i>
				 Manage Product
				</div>
			</div>
			<div class="panel-body">
				<div class="remove-messages"></div>
				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Product </button>
				</div> <!-- /div-action -->				
				<table class="table" id="manageProductTable">
					<thead>
						<tr>
							<th style="width:10%;">Photo</th>							
							<th>Product</th>
							<th>Stock</th>							
							<th>Price</th>
							<th style="width:15%;">Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<!-- End Products -->
</div> <!--/row-->
<!-- Start Add Product -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	<?php include('php_action/add_product.php'); ?>     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- End Add Product -->
<!-- Start Edit Product -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">	
	      <?php include('php_action/edit_product.php'); ?>
    </div>
  </div>
</div>
<!-- End Edit Product -->
<!-- Start Delete Product -->

<!-- End Delete Product -->
<script src="custom/js/product.js"></script>
<?php require_once 'includes/footer.php'; ?>