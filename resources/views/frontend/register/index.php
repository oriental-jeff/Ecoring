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
					<h4 class="mx-auto mb-4" style="max-width: 1000px;">สมัครสมาชิก</h4>
					<div class="box-paper border-top">
						<form action="#" method="post" accept-charset="utf-8">
							<div class="box-head text-left pb-2">
								<h5 style="color: #00b16b;"><i class="iClause">1</i> ข้อมูลบัญชี</h5>
								<div class="form-row">
									<div class="col-lg-5 col-md-6 mb-3">
										<label for="validationDefault01" style="color: #212529;">ชื่อบัญชี</label>
										<input type="text" class="form-control" id="validationDefault01" placeholder="กรอกชื่อบัญชี" required="">
									</div>
								</div>
								<div class="form-row">
									<div class="col-lg-5 col-md-6 mb-3">
										<label for="validationDefault02" style="color: #212529;">รหัสผ่าน</label>
										<input type="text" class="form-control" id="validationDefault02" placeholder="กรอกรหัสผ่าน" required="">
										<small class="form-text text-muted text-color">กรุณาใส่ 6 ตัวอักษรขึ้นไป</small>
									</div>
									<div class="col-lg-5 col-md-6 mb-3">
										<label for="validationDefault03" style="color: #212529;">ยืนยันรหัสผ่าน</label>
										<input type="tel" class="form-control" id="validationDefault03" placeholder="กรอกรหัสผ่าน" required="">
										<small class="form-text text-muted text-color">กรุณากรอกรหัสผ่านให้ตรงกัน</small>
									</div>
								</div>
							</div>
							<div class="box-body text-left" style="max-width:none;">
								<h5 style="color: #00b16b;"><i class="iClause">2</i> ข้อมูลส่วนบุคคล</h5>
								<div class="form-row">
									<div class="col-lg-5 col-md-6 mb-3">
										<label for="validationDefault04">ชื่อ</label>
										<input type="text" class="form-control" id="validationDefault04" required="">
									</div>
									<div class="col-lg-5 col-md-6 mb-3">
										<label for="validationDefault05">นามสกุล</label>
										<input type="tel" class="form-control" id="validationDefault05" required="">
									</div>
								</div>
								<div class="form-row">
									<div class="col-lg-5 col-md-6 mb-3">
										<label class="w-100">เพศ</label>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="ชาย" checked>
											<label class="form-check-label" for="inlineRadio1">ชาย</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="หญิง">
											<label class="form-check-label" for="inlineRadio2">หญิง</label>
										</div>
									</div>
									<div class="col-lg-5 col-md-6 mb-3">
										<label for="validationDefault06">วันเกิด</label>
										<input type="date" class="form-control" id="validationDefault06" required="">
									</div>
								</div>
								<div class="form-row">
									<div class="col-lg-5 col-md-6 mb-3">
										<label for="validationDefault07">เบอร์โทร</label>
										<input type="tel" class="form-control" id="validationDefault07" required="">
									</div>
									<div class="col-lg-5 col-md-6 mb-3">
										<label for="validationDefault08">อีเมล</label>
										<input type="email" class="form-control" id="validationDefault08" required="">
									</div>
								</div>
								<hr>
								
								<h5 style="color: #00b16b;"><i class="iClause">3</i> ข้อมูลที่อยู่</h5>
								<div class="form-row">
									<div class="col-lg-6 col-md-6 mb-3">
										<label for="validationDefault09">ที่อยู่</label>
										<input type="text" class="form-control" id="validationDefault09" required="">
									</div>
									<div class="col-lg-3 col-md-6 mb-3">
										<label for="exampleFormControlSelect1">แขวง/ตำบล</label>
										<select class="form-control" id="exampleFormControlSelect1">
											<option>เลือกแขวง/ตำบล</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
											<option>5</option>
										</select>
									</div>
									<div class="col-lg-3 col-md-6 mb-3">
										<label for="exampleFormControlSelect2">เขต/อำเภอ</label>
										<select class="form-control" id="exampleFormControlSelect2">
											<option>เลือกเขต/อำเภอ</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
											<option>5</option>
										</select>
									</div>
									<div class="col-lg-4 col-md-6 mb-3">
										<label for="exampleFormControlSelect3">จังหวัด</label>
										<select class="form-control" id="exampleFormControlSelect3">
											<option>เลือกจังหวัด</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
											<option>5</option>
										</select>
									</div>
									<div class="col-lg-4 col-md-6 mb-3">
										<label for="validationDefault10">รหัสไปรษณีย์</label>
										<input type="tel" class="form-control" id="validationDefault10" required="">
									</div>
								</div>
								<br>
								
								<h5 style="color: #00b16b;"><i class="iClause">4</i> ข้อมูลที่อยู่ในการจัดส่ง</h5>
								<div class="form-row" id="boxAddress2">
									<div class="col-12 mb-3">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="" checked>
											<label class="form-check-label font-weight-light" for="inlineCheckbox1"> ใช้ข้อมูลที่อยู่ปัจจุบัน</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 mb-3">
										<label for="validationDefault11">ที่อยู่</label>
										<input type="text" class="form-control readonly" id="validationDefault11" required="" readonly>
									</div>
									<div class="col-lg-3 col-md-6 mb-3">
										<label for="exampleFormControlSelect4">แขวง/ตำบล</label>
										<select class="form-control readonly" id="exampleFormControlSelect4" readonly>
											<option>เลือกแขวง/ตำบล</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
											<option>5</option>
										</select>
									</div>
									<div class="col-lg-3 col-md-6 mb-3">
										<label for="exampleFormControlSelect5">เขต/อำเภอ</label>
										<select class="form-control readonly" id="exampleFormControlSelect5" readonly>
											<option>เลือกเขต/อำเภอ</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
											<option>5</option>
										</select>
									</div>
									<div class="col-lg-4 col-md-6 mb-3">
										<label for="exampleFormControlSelect6">จังหวัด</label>
										<select class="form-control readonly" id="exampleFormControlSelect6" readonly>
											<option>เลือกจังหวัด</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
											<option>5</option>
										</select>
									</div>
									<div class="col-lg-4 col-md-6 mb-3">
										<label for="validationDefault12">รหัสไปรษณีย์</label>
										<input type="tel" class="form-control readonly" id="validationDefault12" required="" readonly>
									</div>
									<div class="col-lg-4 col-md-6 mb-3">
										<label for="validationDefault13">เบอร์โทร</label>
										<input type="tel" class="form-control" id="validationDefault13" required="">
										<small class="form-text text-muted text-color">กรุณากรอกเบอร์มือถือของท่าน เพื่อความสะดวกในการจัดส่งสินค้า</small>
									</div>
								</div>
								<hr>
								
								<div class="form-row">
									<div class="col-12 mb-3">
										<label class="align-top">จดหมายข่าวต้องการรับข่าวสารจากทางร้าน :</label>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="inlineRadioOptions2" id="inlineRadio3" value="ต้องการ" checked>
											<label class="form-check-label" for="inlineRadio3">ต้องการ</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="inlineRadioOptions2" id="inlineRadio4" value="ไม่ต้องการ">
											<label class="form-check-label" for="inlineRadio4">ไม่ต้องการ</label>
										</div>
									</div>
								</div>
								<div style="background: #393536;color: #fff;" class="px-4 py-2 mb-4">
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="checkbox" name="inlineRadioOptions3" id="inlineCheckbox2">
										<label class="form-check-label" for="inlineCheckbox2"> ฉันได้อ่านและยอมรับ เงื่อนไข-ข้อตกลง <a href="#" class="text-color"><b><u>Privacy Policy</u></b></a></label>
									</div>
								</div>
							</div>
							<div class="row px-3 py-4" style="background-color: #ffffff;">
								<div class="col-xl-4 offset-xl-4 col-lg-5 offset-lg-3 col-md-6 px-1 mb-3">
									<div class="g-recaptcha" data-sitekey="6Ldbdg0TAAAAAI7KAf72Q6uagbWzWecTeBWmrCpJ"></div>
								</div>
								<div class="col-xl-2 col-lg-2 col-md-3 col-6 px-1">
									<button type="reset" class="btn btn-secondary border-0 w-100">รีเซ็ตข้อมูล</button>
								</div>
								<div class=" col-xl-2 col-lg-2 col-md-3 col-6 px-1">
									<button type="submit" class="btn border-0 w-100">ยืนยันข้อมูล</button>
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
	    <script src='https://www.google.com/recaptcha/api.js'></script>
	    <script>
			$(document).ready(function() {
				
				$("#inlineCheckbox1").click(function() {
			    	if($('#inlineCheckbox1').is(':checked')) {
						$("#validationDefault11").val($("#validationDefault09").val());
						$("#exampleFormControlSelect4").val($("#exampleFormControlSelect1").val());
						$("#exampleFormControlSelect5").val($("#exampleFormControlSelect2").val());
						$("#exampleFormControlSelect6").val($("#exampleFormControlSelect3").val());
						$("#validationDefault12").val($("#validationDefault10").val());
					    $('#boxAddress2 .readonly').attr('readonly', true);
			    	} else {
					    $('#boxAddress2 .readonly').attr('readonly', false);
			    	}
				});
				
		    	$("#validationDefault09").on("input", function() {
			    	if($('#inlineCheckbox1').is(':checked')) {
						$("#validationDefault11").val(this.value);
			    	}
				});
		    	$("#exampleFormControlSelect1").on("input", function() {
			    	if($('#inlineCheckbox1').is(':checked')) {
						$("#exampleFormControlSelect4").val(this.value);
			    	}
				});
		    	$("#exampleFormControlSelect2").on("input", function() {
			    	if($('#inlineCheckbox1').is(':checked')) {
						$("#exampleFormControlSelect5").val(this.value);
			    	}
				});
		    	$("#exampleFormControlSelect3").on("input", function() {
			    	if($('#inlineCheckbox1').is(':checked')) {
						$("#exampleFormControlSelect6").val(this.value);
			    	}
				});
		    	$("#validationDefault10").on("input", function() {
			    	if($('#inlineCheckbox1').is(':checked')) {
						$("#validationDefault12").val(this.value);
			    	}
				});
				
			});
	    </script>
    </body>
</html>
