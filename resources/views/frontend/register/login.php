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
					    <li class="breadcrumb-item active" aria-current="page">เข้าสู่ระบบ</li>
					  </ol>
					</nav>
				</div>
	        </section>
	        
	        <section class="mt-2 mb-5">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 p-0">
							<div class="box-paper border-top">
								<form action="#" class="px-5 pt-5 pb-3 m-auto" style="max-width: 500px;">
									<div class="form-group icon-User">
									    <label for="exampleInputEmail1">ชื่อบัญชี</label>
									    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="กรอกชื่อบัญชี">
									</div>
									<div class="form-group icon-Password">
									    <label for="exampleInputPassword1">รหัสผ่าน</label>
									    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="กรอกรหัสผ่าน">
									</div>
									<div class="form-check">
									    <input type="checkbox" class="form-check-input" id="exampleCheck1">
									    <label class="form-check-label" for="exampleCheck1">จดจำฉันไว้ในระบบ</label>
									    
									    <a href="forgetpass.php" class="float-right"><u>ลืมรหัสผ่าน ?</u></a>
									</div>
									<br>
									<button type="submit" class="btn btn-secondary border-0 d-block m-auto px-4">เข้าสู่ระบบ</button>
								</form>
								<hr class="w-75">
								<div class="px-5 pt-1 pb-5 m-auto row" style="max-width: 500px;">
									<div class="col-sm-6 p-1">
										<a href="#" class="btn-face"><img src="../../public/images/btn-face.jpg"> เข้าสู่ระบบด้วย Facebook</a>
									</div>
									<div class="col-sm-6 p-1">
										<a href="#" class="btn-line"><img src="../../public/images/btn-line.jpg"> เข้าสู่ระบบด้วย Line</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 p-0 box-register d-flex">
							<div class="text-center align-self-center m-auto py-5">
								<div class="footer-box">
									<img src="../../public/images/icon-footer/box4.svg">
								</div>
								<p>หากท่านยังไม่ได้เป็นสมาชิก กรุณาสมัครสมาชิก <br>ก่อนทำการซื้อสินค้า</p>
								<hr class="w-100 border-white my-4">
								<a href="../register" class="btn btn-secondary border-0 d-table m-auto px-4">สมัครสมาชิก</a>
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
