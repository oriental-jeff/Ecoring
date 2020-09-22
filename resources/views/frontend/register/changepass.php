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
								<h5>เปลี่ยนรหัสผ่าน</h5>
							</div>
							<div class="box-body text-left">
								<div class="form-group">
								    <label for="exampleInputPassword1">รหัสผ่านเดิม</label>
									<input type="password" class="form-control" id="exampleInputPassword1" required="">
									<hr>
								</div>
								<div class="form-group">
								    <label for="exampleInputPassword2">รหัสผ่านใหม่</label>
								    <div class="btn-eye-slash">
									    <i></i>
									    <input type="password" class="form-control" id="exampleInputPassword2" required="">
								    </div>
								    <small class="form-text text-muted text-color">กรุณาใส่ 6 ตัวอักษรขึ้นไป</small>
								</div>
								<div class="form-group">
								    <label for="exampleInputPassword3">ยืนยันรหัสผ่านใหม่</label>
								    <div class="btn-eye-slash">
									    <i></i>
									    <input type="password" class="form-control" id="exampleInputPassword3" required="">
								    </div>
								    <small class="form-text text-muted text-color">กรุณากรอกรหัสผ่านให้ตรงกัน</small>
								</div>
								<div class=" row px-2 pb-5">
									<div class="col-6 px-1">
										<a href="../home" class="btn btn-secondary border-0 w-100">ยกเลิก</a>
									</div>
									<div class="col-6 px-1">
										<button type="submit" class="btn border-0 w-100">ยืนยัน</button>
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
	    <script>
	    	$(document).ready(function() {
			    $(".btn-eye-slash i").click(function() {
				    $(this).toggleClass('active');
				    var pwdType = $(this).find('+input').attr("type");
					var newType = (pwdType === "password")?"text":"password";
					$(this).find('+input').attr("type", newType);
				});
	    	});
	    </script>
    </body>
</html>
