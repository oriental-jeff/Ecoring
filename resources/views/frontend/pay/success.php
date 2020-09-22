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
					    <li class="breadcrumb-item active" aria-current="page">Payment</li>
					  </ol>
					</nav>
				</div>
	        </section>
	        
	        <section class="mt-2 mb-5">
				<div class="container">
					<div class="box-paper border-top">
						<div class="box-head">
							<img src="../../public/images/I-Checkmark1.svg">
							<h5>บันทึกใบสั่งซื้อสำเร็จ</h5>
						</div>
						<div class="box-body">
							<h5 class="text-color">ยอดรวมทั้งสิ้น : ฿ 15,030.00</h5>
							<p>ระบบจะทำการส่งใบเสร็จ ไปยังอีเมลที่ท่านใช้สมัครสมาชิก เจ้าหน้าที่จะทำการตรวจสอบความถูกต้องและ จะทำการจัดส่งสินค้าให้ท่านเป็นลำดับถัดไป</p>
						</div>
						<div class="row pb-5 mx-auto" style="max-width: 500px;">
							<div class="col-6 px-1">
								<a href="../home" class="btn btn-secondary border-0 w-100">กลับสู่หน้าหลัก</a>
							</div>
							<div class="col-6 px-1">
								<button type="button" class="btn border-0 w-100">แจ้งการชำระเงิน</button>
							</div>
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
