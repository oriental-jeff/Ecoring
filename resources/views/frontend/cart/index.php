<!DOCTYPE html>
<html lang="EN">
    <head>
		
		<?php include ('../layouts/inc-meta.php');?>
		<link rel="stylesheet" type="text/css" href="../../public/css/cart.css">
		
    </head>
  	<body>

		<!-- begin #header -->
		<header>
		    <?php include ('../layouts/inc-header.php'); ?>
		</header>
		<div id="firstbox"></div>
        <!-- end #header -->

		<!-- begin #content -->
		<div id="content" class="content">
	        <section class="box-breadcrumb d-none d-md-block">
				<div class="container">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item"><a href="../home">Home</a></li>
					    <li class="breadcrumb-item active" aria-current="page">ตะกร้าสินค้า</li>
					  </ol>
					</nav>
				</div>
	        </section>
	        
	        <section class="box-history">
				<div class="container">
					<h4>ตะกร้าสินค้า</h4>
					
					<div class="box-order font-weight-normal">
						<div class="order-head row">
							<div class="col-xl-4 col-sm-5 d-none d-md-block">
								รายละเอียดสินค้า
							</div>
							<div class="col-xl-2 col-sm-1 d-none d-md-block text-center">
								จำนวน
							</div>
							<div class="col-xl-2 col-sm-2 d-none d-md-block text-center">
								ราคาต่อหน่วย
							</div>
							<div class="col-xl-2 col-sm-2 d-none d-md-block text-center">
								ราคารวม
							</div>
							<div class="col-xl-2 col-sm-2 d-none d-md-block text-center">
								จัดการสินค้า
							</div>
						</div>
						
						<div class="order-body row">
							<div class="col-md-6 col-ms-5 d-flex align-items-center">
								<div class="img">
									<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
					        			<img src="../../public/images/size-img2.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
					        		</div>
								</div>
								Charlotte Max - กระเป๋าสะพายทรงเหลี่ยมคลาสสิค สไตล์มินิมอล
								<div class="Bnumber"> 
									<div class="d-block d-md-none float-left">จำนวน</div>
									<span>
										<div class="btn-group">
										    <button type="button" class="btn btn-delete disabled">-</button>
										    <input type="text" class="btn" value="1">
										    <button type="button" class="btn btn-plus">+</button>
										</div>
									</span>
								</div>
							</div>
							<div class="col-md-2 col-ms-2 col-6 text-center">
								<b class="line-through">฿15,510</b><br>
								฿14,990
							</div>
							<div class="col-md-2 col-ms-2 col-6 text-center">
								฿14,990
							</div>
							<div class="col-md-2 col-ms-2 text-center border-left">
								<a class="btn btn-secondary font-weight-light radius-25 w-100" href="#">
									<img class="m-0 mr-2" style="width: 17px;" src="../../public/images/icon-delete.svg"> 
									ลบรายการนี้
								</a>
							</div>
						</div>
						<div class="order-body row">
							<div class="col-md-6 col-ms-5 d-flex align-items-center">
								<div class="img">
									<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
					        			<img src="../../public/images/size-img2.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
					        		</div>
								</div>
								Charlotte Max - กระเป๋าสะพายทรงเหลี่ยมคลาสสิค สไตล์มินิมอล
								<div class="Bnumber"> 
									<div class="d-block d-md-none float-left">จำนวน</div>
									<span>
										<div class="btn-group">
										    <button type="button" class="btn btn-delete disabled">-</button>
										    <input type="text" class="btn" value="1">
										    <button type="button" class="btn btn-plus">+</button>
										</div>
									</span>
								</div>
							</div>
							<div class="col-md-2 col-ms-2 col-6 text-center">
								<b class="line-through">฿15,510</b><br>
								฿14,990
							</div>
							<div class="col-md-2 col-ms-2 col-6 text-center">
								฿14,990
							</div>
							<div class="col-md-2 col-ms-2 text-center border-left">
								<a class="btn btn-secondary font-weight-light radius-25 w-100" href="#">
									<img class="m-0 mr-2" style="width: 17px;" src="../../public/images/icon-delete.svg"> 
									ลบรายการนี้
								</a>
							</div>
						</div>

					</div>
					
					<div class="row font-weight-normal mb-4">
						<div class="offset-lg-8 col-lg-2 offset-md-6 col-md-3 offset-2 col-5 text-center">
							<h5>ราคารวม</h5>
						</div>
						<div class="col-lg-2 col-md-3 col-5 text-center">
							<h5>฿ 44,970.00</h5>
						</div>
					</div>
					
					<div class="row px-2">
						<div class="col-lg-2 offset-lg-8 col-md-3 offset-md-6 col-6 px-1">
							<a href="#" class="btn btn-secondary border-0 w-100" download="">ซื้อสินค้าเพิ่ม</a>
						</div>
						<div class="col-lg-2 col-md-3 col-6 px-1">
							<a href="../cart/order.php" class="btn border-0 w-100">ดำเนินการต่อ</a>
						</div>
					</div>
				</div>
	        </section>
	        
		</div>
		<!-- end #content -->

        <!-- begin #footer -->
        <footer>
		    <?php include ('../layouts/inc-footer.php'); ?>
        </footer>
        <!-- end #footer -->

	    <?php include ('../layouts/inc-script.php');?>
    </body>
</html>
