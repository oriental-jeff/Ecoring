<!DOCTYPE html>
<html lang="EN">
    <head>
		
		<?php include ('../layouts/inc-meta.php');?>
		<link rel="stylesheet" type="text/css" href="../../public/css/history-detail.css">
		
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
					    <li class="breadcrumb-item active" aria-current="page">ประวัติการสั่งซื้อ</li>
					  </ol>
					</nav>
				</div>
	        </section>
	        
	        <section class="box-history">
				<div class="container">
					<h4>สถานะการสั่งสินค้า</h4>
					<div class="box-status">
						<div class="bTop">
							<h5 class="text-success">หมายเลขการสั่งซื้อ : UCM789456123</h5>
							วันที่สั่งสินค้า : 8 ก.พ. 2563   เวลา : 8.00น.
						</div>
						<div class="blist">
							<ul class="status" data-status="3">
								<li><img src="../../public/images/status1.svg">สั่งซื้อสินค้า</li>
								<li><img src="../../public/images/status2.svg">ชำระเงิน</li>
								<li><img src="../../public/images/status3.svg">กำลังจัดเตรียมสินค้า</li>
								<li><img src="../../public/images/status4.svg">จัดส่งสินค้า</li>
							</ul>
						</div>
					</div>
					
					<div class="box-detail">
						<h5 class="text-success">ข้อมูลการสั่งซื้อ</h5>
						<div>หมายเลขการสั่งซิ้อ : <span class="float-right">UCM789456123</span></div>
						<div>วันที่สั่งสินค้า : <span class="float-right">8 ก.พ. 2563</span></div>
						<div>สถานะ : <span class="float-right"><div class="Checkmark status3">ชำระเงินแล้ว</div></span></div>
						<div>การชำระเงิน : <span class="float-right">เครดิตการ์ด</span></div>
					</div>
					
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
					<div class="box-total">
						<div class="row">
							<div class="col-lg-3 col-sm-5 pt-4">
								<h5>ช่องทางการจัดส่ง</h5>
								<img src="../../public/images/Shipment-ems.jpg" class="img-Shipment">
<!--
								<img src="../../public/images/Shipment-kerry.jpg" class="img-Shipment">
								<img src="../../public/images/Shipment-flash.jpg" class="img-Shipment">
-->
								<h5>EMS - ไปรษณีย์ด่วนพิเศษ</h5>
								ระยะเวลาการส่ง : 3-5 วัน<br>
								อัตราค่าบริการ : 50 บาท<br>
							</div>
							<div class="col-lg-4 col-sm-7 pt-4 border-left">
								<h5>ที่อยู่ในการจัดส่ง</h5>
								<table class="w-100">
									<tr>
										<td class="w-45">ชื่อ :</td>
										<td>สมหมาย คอมเมิส</td>
									</tr>
									<tr>
										<td>เบอร์โทร :</td>
										<td>0567894567</td>
									</tr>
									<tr>
										<td>ที่อยู่ :</td>
										<td>181/93 ถ.พหลโยธิน 50</td>
									</tr>
									<tr>
										<td>แขวง/ตำบล :</td>
										<td>แขวงอนุสาวรีย์</td>
									</tr>
									<tr>
										<td>เขต/อำเภอ :</td>
										<td>บางเขน</td>
									</tr>
									<tr>
										<td>จังหวัด :</td>
										<td>กรุงเทพฯ</td>
									</tr>
									<tr>
										<td>รหัสไปรษณีย์ :</td>
										<td>10220</td>
									</tr>
								</table>
							</div>
							<div class="col-lg-5 col-sm-12 pt-4 border-left">
								<h5><br></h5>
								<table class="w-100 font-weight-normal" style="line-height: 1.8;">
									<tr>
										<td class="w-45">ราคาเต็ม</td>
										<td class="text-right">฿14,990.00</td>
									</tr>
									<tr class="text-danger">
										<td>ส่วนลด</td>
										<td class="text-right">- ฿ 990.00</td>
									</tr>
									<tr>
										<td>ค่าจัดส่ง</td>
										<td class="text-right">฿ 50.00</td>
									</tr>
									<tr>
										<td>ภาษี 7%</td>
										<td class="text-right">฿ 980.00</td>
									</tr>
								</table>
								<h3 class="text-right mt-3 text-success">ยอดรวมทั้งสิ้น : ฿ 15,030.00</h3>
							</div>
						</div>
					</div>
					
					<hr>
					<div class="row px-2">
						<div class="col-lg-2 offset-lg-8 col-md-3 offset-md-6 col-6 px-1">
							<a href="#" class="btn btn-secondary border-0 w-100" download="">ดาวน์โหลดใบเสร็จ</a>
						</div>
						<div class="col-lg-2 col-md-3 col-6 px-1">
							<button type="button" class="btn border-0 w-100">ยกเลิกคำสั่งซื้อ</button>
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
