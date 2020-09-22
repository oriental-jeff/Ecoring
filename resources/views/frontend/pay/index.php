<!DOCTYPE html>
<html lang="EN">
    <head>
		
		<?php include ('../layouts/inc-meta.php');?>
		
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
	        
	        <section class="box-history mt-2 mb-5">
				<div class="container">
					<h4 class="mx-auto mb-4">ตะกร้าสินค้า</h4>
					sdfsf
					<div class="row px-2">
						<div class="col-lg-2 offset-lg-8 col-md-3 offset-md-6 col-6 px-1">
							<button type="button" class="btn btn-secondary border-0 w-100" onclick="window.history.back()">ย้อนกลับ</button>
						</div>
						<div class="col-lg-2 col-md-3 col-6 px-1">
							<button type="button" class="btn border-0 w-100">ยืนยันการชำระเงิน</button>
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
