<!DOCTYPE html>
<html lang="EN">
    <head>
		
		<?php include ('../layouts/inc-meta.php');?>
		<link rel="stylesheet" type="text/css" href="../../public/css/cart-order.css">
		
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
					    <li class="breadcrumb-item active" aria-current="page">คำสั่งซื้อ</li>
					  </ol>
					</nav>
				</div>
	        </section>
	        
	        <section class="box-history">
				<div class="container">
					<h4>คำสั่งซื้อ</h4>
					<div class="box-order font-weight-normal">
						<div class="order-head row">
							<div class="col-md-6 d-none d-md-block">
								รายละเอียดสินค้า
							</div>
							<div class="col-md-2 d-none d-md-block text-center">
								จำนวน
							</div>
							<div class="col-md-2 d-none d-md-block text-center">
								ราคาต่อหน่วย
							</div>
							<div class="col-md-2 d-none d-md-block text-center">
								ราคารวม
							</div>
						</div>
						
						<div class="order-body row">
							<div class="col-md-8 d-flex align-items-center">
								<div class="img">
									<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
					        			<img src="../../public/images/size-img2.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
					        		</div>
								</div>
								Charlotte Max - กระเป๋าสะพายทรงเหลี่ยมคลาสสิค สไตล์มินิมอล
								<div class="Bnumber"> 
									<div class="d-block d-md-none float-left">จำนวน</div><span>1</span>
								</div>
							</div>
							<div class="col-md-2 col-6 text-center">
								<b class="line-through">฿15,510</b><br>
								฿14,990
							</div>
							<div class="col-md-2 col-6 text-center">
								฿14,990
							</div>
						</div>
						<div class="order-body row">
							<div class="col-md-8 d-flex align-items-center">
								<div class="img">
									<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
					        			<img src="../../public/images/size-img2.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
					        		</div>
								</div>
								Charlotte Max - กระเป๋าสะพายทรงเหลี่ยมคลาสสิค สไตล์มินิมอล
								<div class="Bnumber"> 
									<div class="d-block d-md-none float-left">จำนวน</div><span>1</span>
								</div>
							</div>
							<div class="col-md-2 col-6 text-center">
								<b class="line-through">฿15,510</b><br>
								฿14,990
							</div>
							<div class="col-md-2 col-6 text-center">
								฿14,990
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
					<hr>
					
					<div class="box-Shipment font-weight-normal t2">
						<h5>เลือกช่องทางการจัดส่ง</h5>
						<div class="row">
							<div class="col-md-4">
								<input class="box-check" type="radio" name="exampleRadios" id="exampleRadios1" value="EMS" checked>
								<label class="box-check-label" for="exampleRadios1">
									<img src="../../public/images/Shipment-ems.jpg" class="img-Shipment">
									<h5>EMS - ไปรษณีย์ด่วนพิเศษ</h5>
									ระยะเวลาการส่ง : 3-5 วัน<br>
									อัตราค่าบริการ : 50 บาท<br>
								</label>
							</div>
							<div class="col-md-4">
								<input class="box-check" type="radio" name="exampleRadios" id="exampleRadios2" value="KERRY">
								<label class="box-check-label" for="exampleRadios2">
									<img src="../../public/images/Shipment-kerry.jpg" class="img-Shipment">
									<h5>KERRY EXPRESS</h5>
									ระยะเวลาการส่ง : 1-2 วัน<br>
									อัตราค่าบริการ : 60 บาท<br>
								</label>
							</div>
							<div class="col-md-4">
								<input class="box-check" type="radio" name="exampleRadios" id="exampleRadios3" value="FLASH">
								<label class="box-check-label" for="exampleRadios3">
									<img src="../../public/images/Shipment-flash.jpg" class="img-Shipment">
									<h5>FLASH EXPRESS</h5>
									ระยะเวลาการส่ง : 1-2 วัน<br>
									อัตราค่าบริการ : 70 บาท<br>
								</label>
							</div>
						</div>
					</div>
					
					<div class="box-Shipment font-weight-normal">
						<h5>เลือกที่อยู่ในการจัดส่ง</h5>
						<div class="row">
							<div class="col-lg-6">
								<input class="box-check" type="radio" name="exampleRadios2" id="exampleRadios4" value="option1" checked>
								<label class="box-check-label" for="exampleRadios4">
								    ที่อยู่โปรไฟล์
								    <table>
							    		<tr>
							    			<td style="min-width: 100px;">ชื่อ :</td>
							    			<td><input type="text" value="สมหมาย คอมเมิส" readonly></td>
							    		</tr>
							    		<tr>
							    			<td>เบอร์โทร :</td>
							    			<td><input type="text" value="0567894567" readonly></td>
							    		</tr>
							    		<tr>
							    			<td>ที่อยู่ :</td>
							    			<td><input type="text" value="181/93 ถ.พหลโยธิน 50" readonly></td>
							    		</tr>
							    		<tr>
							    			<td>แขวง/ตำบล :</td>
							    			<td><input type="text" value="แขวงอนุสาวรีย์" readonly></td>
							    		</tr>
							    		<tr>
							    			<td>เขต/อำเภอ :</td>
							    			<td><input type="text" value="บางเขน" readonly></td>
							    		</tr>
							    		<tr>
							    			<td>จังหวัด :</td>
							    			<td><input type="text" value="กรุงเทพฯ" readonly></td>
							    		</tr>
							    		<tr>
							    			<td>รหัสไปรษณีย์ :</td>
							    			<td><input type="text" value="10220" readonly></td>
							    		</tr>
								    </table>

								</label>
							</div>
							<div class="col-lg-6">
								<input class="box-check" type="radio" name="exampleRadios2" id="exampleRadios5" value="option2">
								<label class="box-check-label" for="exampleRadios5">
								    แก้ไขที่อยู่ที่ต้องการจัดส่ง
								    <table>
							    		<tr>
							    			<td style="min-width: 100px;">ชื่อ :</td>
							    			<td><input type="text" value="สมหมาย คอมเมิส"></td>
							    		</tr>
							    		<tr>
							    			<td>เบอร์โทร :</td>
							    			<td><input type="text" value="0567894567"></td>
							    		</tr>
							    		<tr>
							    			<td>ที่อยู่ :</td>
							    			<td><input type="text" value="181/93 ถ.พหลโยธิน 50"></td>
							    		</tr>
							    		<tr>
							    			<td>แขวง/ตำบล :</td>
							    			<td>
								    			<select class="form-control" id="exampleFormControlSelect1">
													<option>แขวงอนุสาวรีย์</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
													<option>5</option>
												</select>
							    			</td>
							    		</tr>
							    		<tr>
							    			<td>เขต/อำเภอ :</td>
							    			<td>
								    			<select class="form-control" id="exampleFormControlSelect2">
													<option>บางเขน</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
													<option>5</option>
												</select>
							    			</td>
							    		</tr>
							    		<tr>
							    			<td>จังหวัด :</td>
							    			<td>
								    			<select class="form-control" id="exampleFormControlSelect3">
													<option>กรุงเทพฯ</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
													<option>5</option>
												</select>
							    			</td>
							    		</tr>
							    		<tr>
							    			<td>รหัสไปรษณีย์ :</td>
							    			<td><input type="text" value="10220"></td>
							    		</tr>
								    </table>
								</label>
							</div>
						</div>
					</div>
					
					<div class="row px-2">
						<div class="col-lg-2 offset-lg-8 col-md-3 offset-md-6 col-6 px-1">
							<a href="../home" class="btn btn-secondary border-0 w-100">ซื้อสินค้าเพิ่ม</a>
						</div>
						<div class="col-lg-2 col-md-3 col-6 px-1">
							<a href="../pay" class="btn border-0 w-100">ดำเนินการต่อ</a>
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
