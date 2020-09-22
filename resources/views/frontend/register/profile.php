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
						<div class="col-lg-3">
							<div class="b-sticky text-center">
								<div class="img rounded-circle border border-light mx-auto mb-3" style="max-width: 200px;">
									<img src="../../public/images/img-profile.jpg">
								</div>
								<h4>สมหมาย คอมเมิส</h4>
								<p>
									กรุงเทพมหานคร<br>
									<br>
									เบอร์โทร : 056 789 4567<br>
									อีเมล : sommai@gmail.com<br>
								</p>
								<hr>
								<a class="btn font-weight-light radius-25 w-100" id="btnEdit" href="javascript:void(0)">
									<img class="m-0 mr-2" style="width: 23px;" src="../../public/images/icon-edit.svg"> 
									แก้ไขข้อมูลส่วนบุคคล
								</a>
								<hr>
								<a class="btn btn-secondary font-weight-light radius-25 w-100 mb-3" href="../history">
									<img class="m-0 mr-2" style="width: 23px;" src="../../public/images/icon-history.svg"> 
									ประวัติการสั่งซื้อสินค้า
								</a>
								<a class="btn btn-secondary font-weight-light radius-25 w-100 mb-3" href="../favorite">
									<i class="fa fa-heart-o"></i>
									รายการโปรด
								</a>
								<hr>
								<a class="btn btn-danger font-weight-light radius-25 w-100 mb-3" href="#">
									<img class="m-0 mr-2" style="width: 23px;" src="../../public/images/icon-logout.svg"> 
									ออกจากระบบ
								</a>
							</div>
						</div>
						<div class="col-lg-9">
							<div class="box-paper border-top">
								<form action="#" method="post" accept-charset="utf-8">
									<div class="box-head text-left pb-2">
										<h5 style="color: #00b16b;">ข้อมูลบัญชี</h5>
										<div class="form-row">
											<div class="col-lg-6 col-md-6 mb-3">
												<label for="validationDefault01" style="color: #212529;">ชื่อบัญชี</label>
												<input type="text" class="form-control" id="validationDefault01" placeholder="กรอกชื่อบัญชี" value="sommai" required="" readonly>
											</div>
											<div class="col-lg-6 col-md-6 mb-3">
												<label for="validationDefault02" style="color: #212529;">รหัสผ่าน</label>
												<input type="password" class="form-control" id="validationDefault02" placeholder="กรอกรหัสผ่าน" value="12345678" required="" readonly>
											</div>
											<div class="col-12 mb-3">
												<a class="float-right btn font-weight-light radius-25" href="../register/changepass.php">
													<img class="m-0 float-left mr-2" style="width: 23px;" src="../../public/images/icon-Password2.svg"> 
													เปลี่ยนรหัสผ่าน
												</a>
											</div>
										</div>
										<hr>
										<div class="pt-2 pb-3 m-auto row" style="max-width: 600px;">
											<div class="col-sm-6 p-1">
												<a href="#" class="btn-face"><img src="../../public/images/btn-face.jpg"> กดที่นี่เพื่อ ยืนยัน ผูกบัญชีนี้กับ Facebook</a>
											</div>
											<div class="col-sm-6 p-1">
												<a href="#" class="btn-line"><img src="../../public/images/btn-line.jpg"> กดที่นี่เพื่อ ยืนยัน ผูกบัญชีนี้กับ Line</a>
											</div>
										</div>
									</div>
									<div class="box-body text-left" style="max-width:none;">
										<h5 style="color: #00b16b;">ข้อมูลส่วนบุคคล</h5>
										<div class="form-row">
											<div class="col-lg-6 col-md-6 mb-3">
												<label for="validationDefault04">ชื่อ</label>
												<input type="text" class="form-control" id="validationDefault04" value="สมหมาย" required="" readonly>
											</div>
											<div class="col-lg-6 col-md-6 mb-3">
												<label for="validationDefault05">นามสกุล</label>
												<input type="tel" class="form-control" id="validationDefault05" value="คอมเมิส" required="" readonly>
											</div>
										</div>
										<div class="form-row">
											<div class="col-lg-6 col-md-6 mb-3">
												<label class="w-100">เพศ</label>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="ชาย" checked disabled>
													<label class="form-check-label" for="inlineRadio1">ชาย</label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="หญิง" disabled>
													<label class="form-check-label" for="inlineRadio2">หญิง</label>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 mb-3">
												<label for="validationDefault06">วันเกิด</label>
												<input type="date" class="form-control" id="validationDefault06" value="1993-09-07" required="" readonly>
											</div>
										</div>
										<div class="form-row">
											<div class="col-lg-6 col-md-6 mb-3">
												<label for="validationDefault07">เบอร์โทร</label>
												<input type="tel" class="form-control" id="validationDefault07" value="0567894567" required="" readonly>
											</div>
											<div class="col-lg-6 col-md-6 mb-3">
												<label for="validationDefault08">อีเมล</label>
												<input type="email" class="form-control" id="validationDefault08" value="sommai@gmail.com" required="" readonly>
											</div>
										</div>
										<hr>
										
										<h5 style="color: #00b16b;">ข้อมูลที่อยู่</h5>
										<div class="form-row">
											<div class="col-lg-6 col-md-6 mb-3">
												<label for="validationDefault09">ที่อยู่</label>
												<input type="text" class="form-control" id="validationDefault09" value="181/93 ถ.พหลโยธิน50" required="" readonly>
											</div>
											<div class="col-lg-3 col-md-6 mb-3">
												<label for="exampleFormControlSelect1">แขวง/ตำบล</label>
												<select class="form-control" id="exampleFormControlSelect1" readonly>
													<option>อนุสาวรีย์</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
													<option>5</option>
												</select>
											</div>
											<div class="col-lg-3 col-md-6 mb-3">
												<label for="exampleFormControlSelect2">เขต/อำเภอ</label>
												<select class="form-control" id="exampleFormControlSelect2" readonly>
													<option>บางเขน</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
													<option>5</option>
												</select>
											</div>
											<div class="col-lg-4 col-md-6 mb-3">
												<label for="exampleFormControlSelect3">จังหวัด</label>
												<select class="form-control" id="exampleFormControlSelect3" readonly>
													<option>กรุงเทพมหานคร</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
													<option>5</option>
												</select>
											</div>
											<div class="col-lg-4 col-md-6 mb-3">
												<label for="validationDefault10">รหัสไปรษณีย์</label>
												<input type="tel" class="form-control" id="validationDefault10" value="10220" required="" readonly>
											</div>
										</div>
										<br>
										
										<h5 style="color: #00b16b;">ข้อมูลที่อยู่ในการจัดส่ง</h5>
										<div class="form-row">
											<div class="col-lg-6 col-md-6 mb-3">
												<label for="validationDefault11">ที่อยู่</label>
												<input type="text" class="form-control" id="validationDefault11" value="181/93 ถ.พหลโยธิน50" required="" readonly>
											</div>
											<div class="col-lg-3 col-md-6 mb-3">
												<label for="exampleFormControlSelect4">แขวง/ตำบล</label>
												<select class="form-control" id="exampleFormControlSelect4" readonly>
													<option>อนุสาวรีย์</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
													<option>5</option>
												</select>
											</div>
											<div class="col-lg-3 col-md-6 mb-3">
												<label for="exampleFormControlSelect5">เขต/อำเภอ</label>
												<select class="form-control" id="exampleFormControlSelect5" readonly>
													<option>บางเขน</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
													<option>5</option>
												</select>
											</div>
											<div class="col-lg-4 col-md-6 mb-3">
												<label for="exampleFormControlSelect6">จังหวัด</label>
												<select class="form-control" id="exampleFormControlSelect6" readonly>
													<option>กรุงเทพมหานคร</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
													<option>5</option>
												</select>
											</div>
											<div class="col-lg-4 col-md-6 mb-3">
												<label for="validationDefault12">รหัสไปรษณีย์</label>
												<input type="tel" class="form-control" id="validationDefault12" value="10220" required="" readonly>
											</div>
											<div class="col-lg-4 col-md-6 mb-3">
												<label for="validationDefault13">เบอร์โทร</label>
												<input type="tel" class="form-control" id="validationDefault13" value="0567894567" required="" readonly>
											</div>
										</div>
										<hr>
										
										<div class="form-row">
											<div class="col-12 mb-3">
												<label class="align-top">จดหมายข่าวต้องการรับข่าวสารจากทางร้าน :</label>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inlineRadioOptions2" id="inlineRadio3" value="ต้องการ" checked disabled>
													<label class="form-check-label" for="inlineRadio3">ต้องการ</label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inlineRadioOptions2" id="inlineRadio4" value="ไม่ต้องการ" disabled>
													<label class="form-check-label" for="inlineRadio4">ไม่ต้องการ</label>
												</div>
											</div>
										</div>
									</div>
									<div class="row px-3 py-4" style="background-color: #ffffff;display: none;" id="boxBtn">
										<div class="col-xl-2 col-lg-2 offset-lg-8 col-md-3 offset-md-6 col-6 px-1">
											<button type="button" class="btn btn-secondary border-0 w-100" onclick="window.location.reload(true);">รีเซ็ตข้อมูล</button>
										</div>
										<div class=" col-xl-2 col-lg-2 col-md-3 col-6 px-1">
											<button type="submit" class="btn border-0 w-100">ยืนยันข้อมูล</button>
										</div>
									</div>
								</form>
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
	    <script>
			$(document).ready(function() {
				
				$(document).on("click","#btnEdit",function() {
					$(this).addClass('active');
				    $('.box-paper [readonly]').attr('readonly', false);
				    $('.box-paper [disabled]').attr('disabled', false);
				    $('#boxBtn').slideDown();
				});
				
			});
	    </script>
    </body>
</html>
