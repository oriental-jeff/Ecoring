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
					<div class="box-paper border-top">
						<form action="#" method="post" accept-charset="utf-8">
							<div class="box-head">
								<h5>ลืมรหัสผ่าน</h5>
							</div>
							<div class="box-body">
								<p><b>ระบบจะทำการส่ง รหัสผ่านใหม่ ให้ท่านทางอีเมล <br>กรุณากรอกอีเมล ที่ท่านได้ทำการลงทะเบียนไว้</b></p>
								
								<input type="email" class="form-control my-3" placeholder="กรอกอีเมล" required="">
								
								<p>หากท่านยังไม่ได้รับรหัส กรุณกด <a href="#" class="text-color"><b><u>ขอรับรหัส</u></b></a> ระบบจะทำการส่งรหัสให้ท่านใหม่</p>
								<div class=" row pb-5">
									<div class="col-6 px-1">
										<a href="../home" class="btn btn-secondary border-0 w-100">กลับสู่หน้าหลัก</a>
									</div>
									<div class="col-6 px-1">
										<button type="submit" class="btn border-0 w-100">ขอรับรหัสผ่าน</button>
									</div>
								</div>
							</div>
						</form>
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
