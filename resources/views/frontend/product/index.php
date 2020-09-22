<!DOCTYPE html>
<html lang="EN">
    <head>
		
		<?php include ('../layouts/inc-meta.php');?>
		
		<link rel="stylesheet" type="text/css" href="../../public/css/product.css">
	    <!-- Range slider style -->
	    <link href="../../plugins/rangeslider/d3RangeSlider.css" rel="stylesheet">
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
					    <li class="breadcrumb-item active" aria-current="page">Products</li>
					  </ol>
					</nav>
				</div>
	        </section>
	        
	        <section class="box-products mt-2">
				<div class="container">
					<div class="row">
						<div class="col-lg-3">
							<div class="b-sticky d-none d-lg-block">
								<form class="form-inline form-Search" action="#">
									<input class="form-control" type="text" placeholder="ค้นหาสินค้า.." aria-label="Search">
									<button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
								</form>
								<form action="#">
									<h5 class="mt-3">ประเภทสินค้า</h5>
									<label for="input_checkbox1" class="d-block">
										<input id="input_checkbox1" type="checkbox" value="1">
										เครื่องประดับ
										<span class="float-right">(48)</span>
									</label>
									<label for="input_checkbox2" class="d-block">
										<input id="input_checkbox2" type="checkbox" value="2">
										นาฬิกา
										<span class="float-right">(23)</span>
									</label>
									<label for="input_checkbox3" class="d-block">
										<input id="input_checkbox3" type="checkbox" value="3">
										จักรยาน
										<span class="float-right">(19)</span>
									</label>
									<label for="input_checkbox4" class="d-block">
										<input id="input_checkbox4" type="checkbox" value="4">
										กระเป๋า
										<span class="float-right">(17)</span>
									</label>
									<label for="input_checkbox5" class="d-block">
										<input id="input_checkbox5" type="checkbox" value="5">
										รองเท้า
										<span class="float-right">(12)</span>
									</label>
									<div class="box-Toggle" style="display: none;">
										<label for="input_checkbox7" class="d-block">
											<input id="input_checkbox7" type="checkbox" value="7">
											กางเกง
											<span class="float-right">(48)</span>
										</label>
										<label for="input_checkbox8" class="d-block">
											<input id="input_checkbox8" type="checkbox" value="8">
											เครื่องดนตรี
											<span class="float-right">(12)</span>
										</label>
										<label for="input_checkbox9" class="d-block">
											<input id="input_checkbox9" type="checkbox" value="9">
											เซรามิค
											<span class="float-right">(12)</span>
										</label>
										<label for="input_checkbox10" class="d-block">
											<input id="input_checkbox10" type="checkbox" value="10">
											เฟอร์นิเจอร์
											<span class="float-right">(12)</span>
										</label>
										<label for="input_checkbox11" class="d-block">
											<input id="input_checkbox11" type="checkbox" value="11">
											อื่นๆ
											<span class="float-right">(12)</span>
										</label>
									</div>
									<button type="button" id="button-Toggle1" class="p-2 mt-2 border-0 w-100" onclick="$('.box-Toggle').slideToggle();$(this).hide();$('#button-Toggle2').show();">
										แสดงผลมากขึ้น <img src="../../public/images/icon-select.png">
									</button>
									<button type="button" id="button-Toggle2" class="p-2 mt-2 border-0 w-100" style="display: none" onclick="$('.box-Toggle').slideToggle();$(this).hide();$('#button-Toggle1').show();">
										แสดงผลน้อยลง <img id="button-Toggle2" src="../../public/images/icon-select.png" style="transform: rotate(180deg);">
									</button>
									<hr>
									
									<h5 class="mt-3">เกรดสินค้า</h5>
									<label for="input_checkboxA" class="d-block">
										<input id="input_checkboxA" type="checkbox" value="A">
										A
										<span class="float-right">(48)</span>
									</label>
									<label for="input_checkboxB" class="d-block">
										<input id="input_checkboxB" type="checkbox" value="B">
										B
										<span class="float-right">(48)</span>
									</label>
									<label for="input_checkboxC" class="d-block">
										<input id="input_checkboxC" type="checkbox" value="C">
										C
										<span class="float-right">(48)</span>
									</label>
									<label for="input_checkboxD" class="d-block">
										<input id="input_checkboxD" type="checkbox" value="D">
										D
										<span class="float-right">(48)</span>
									</label>
									<hr>
									
									<h5 class="mt-3">ราคา</h5>
									<div class="slider-price">
									    <input type="text" id="s1">
									    <input type="text" id="s2">
									</div>
									<div id="slider-container" class="sliderContainer"></div>

									<hr>
									<button type="submit" class="btn border-0 w-100">ค้นหา</button>
								</form>
							</div>
						</div>
						<div class="col-lg-9">
							<div class="row border-bottom pb-1">
								<div class="col-lg-7">
									<h5 class="my-1">Products <span style="font-size: 0.8em;">(116 รายการ)</span></h5>
								</div>
								<div class="col-lg-5 d-none d-lg-block">
									<div class="dropdown show float-right w-100">
									  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									    สินค้าแนะนำ
									  </a>
									
									  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
										<a class="dropdown-item" href="#">สินค้าแนะนำ</a>
										<a class="dropdown-item" href="#">สินค้ามาใหม่</a>
										<a class="dropdown-item" href="#">เกรดสินค้า A > D</a>
										<a class="dropdown-item" href="#">เกรดสินค้า D > A</a>
										<a class="dropdown-item" href="#">ราคาน้อย > มาก</a>
										<a class="dropdown-item" href="#">ราคามาก > น้อย</a>
									  </div>
									</div>
								</div>
								<div class="col-12 d-block d-lg-none px-2">
									<button type="button" class="float-left" data-toggle="modal" data-target="#exampleModalLong" id="menuModal">
										<img src="../../public/images/filter.svg">
										ตัวกรองสินค้า
										<img src="../../public/images/filter2.svg" class="float-right mt-1">
									</button>
								</div>
							</div>
							<div class="row box-List pt-3">
								
								<div class="col-xl-3 col-lg-3 col-sm-4 col-6 list">
									<div class="btn-heart active" onclick="alert('click');"></div>
									<a href="detail.php">
										<div class="img">
											<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
							        			<img src="../../public/images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
							        		</div>
						                </div>
						                <div class="box-text">
						                	<h6>ชุดอาหาร 10 ชิ้น - แบบที่ 1-RETRO RITZ-GOLD</h6>
						                	<span>สินค้าเกรด - A</span>
						                </div>
									</a>
				                	<span class="price">ราคา : ฿6,990<b>฿8,990</b></span>
				                	<a href="#" class="btn">หยิบลงตะกร้า</a>
				                </div>
								<div class="col-xl-3 col-lg-3 col-sm-4 col-6 list">
									<div class="btn-heart active" onclick="alert('click');"></div>
									<a href="detail.php">
										<div class="img">
											<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
							        			<img src="../../public/images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
							        		</div>
						                </div>
						                <div class="box-text">
						                	<h6>ชุดอาหาร 10 ชิ้น - แบบที่ 1-RETRO RITZ-GOLD</h6>
						                	<span>สินค้าเกรด - A</span>
						                </div>
									</a>
				                	<span class="price">ราคา : ฿6,990<b>฿8,990</b></span>
				                	<a href="#" class="btn">หยิบลงตะกร้า</a>
				                </div>
								<div class="col-xl-3 col-lg-3 col-sm-4 col-6 list">
									<div class="btn-heart active" onclick="alert('click');"></div>
									<a href="detail.php">
										<div class="img">
											<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
							        			<img src="../../public/images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
							        		</div>
						                </div>
						                <div class="box-text">
						                	<h6>ชุดอาหาร 10 ชิ้น - แบบที่ 1-RETRO RITZ-GOLD</h6>
						                	<span>สินค้าเกรด - A</span>
						                </div>
									</a>
				                	<span class="price">ราคา : ฿6,990<b>฿8,990</b></span>
				                	<a href="#" class="btn">หยิบลงตะกร้า</a>
				                </div>
								<div class="col-xl-3 col-lg-3 col-sm-4 col-6 list">
									<div class="btn-heart" onclick="alert('click');"></div>
									<a href="detail.php">
										<div class="img">
											<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
							        			<img src="../../public/images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
							        		</div>
						                </div>
						                <div class="box-text">
						                	<h6>ชุดอาหาร 10 ชิ้น - แบบที่ 1-RETRO RITZ-GOLD</h6>
						                	<span>สินค้าเกรด - A</span>
						                </div>
									</a>
				                	<span class="price">ราคา : ฿6,990<b>฿8,990</b></span>
				                	<a href="#" class="btn">หยิบลงตะกร้า</a>
				                </div>
								<div class="col-xl-3 col-lg-3 col-sm-4 col-6 list">
									<div class="btn-heart" onclick="alert('click');"></div>
									<a href="detail.php">
										<div class="img">
											<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
							        			<img src="../../public/images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
							        		</div>
						                </div>
						                <div class="box-text">
						                	<h6>ชุดอาหาร 10 ชิ้น - แบบที่ 1-RETRO RITZ-GOLD</h6>
						                	<span>สินค้าเกรด - A</span>
						                </div>
									</a>
				                	<span class="price">ราคา : ฿6,990<b>฿8,990</b></span>
				                	<a href="#" class="btn">หยิบลงตะกร้า</a>
				                </div>
								<div class="col-xl-3 col-lg-3 col-sm-4 col-6 list">
									<div class="btn-heart active" onclick="alert('click');"></div>
									<a href="detail.php">
										<div class="img">
											<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
							        			<img src="../../public/images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
							        		</div>
						                </div>
						                <div class="box-text">
						                	<h6>ชุดอาหาร 10 ชิ้น - แบบที่ 1-RETRO RITZ-GOLD</h6>
						                	<span>สินค้าเกรด - A</span>
						                </div>
									</a>
				                	<span class="price">ราคา : ฿6,990<b>฿8,990</b></span>
				                	<a href="#" class="btn">หยิบลงตะกร้า</a>
				                </div>
								<div class="col-xl-3 col-lg-3 col-sm-4 col-6 list">
									<div class="btn-heart active" onclick="alert('click');"></div>
									<a href="detail.php">
										<div class="img">
											<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
							        			<img src="../../public/images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
							        		</div>
						                </div>
						                <div class="box-text">
						                	<h6>ชุดอาหาร 10 ชิ้น - แบบที่ 1-RETRO RITZ-GOLD</h6>
						                	<span>สินค้าเกรด - A</span>
						                </div>
									</a>
				                	<span class="price">ราคา : ฿6,990<b>฿8,990</b></span>
				                	<a href="#" class="btn">หยิบลงตะกร้า</a>
				                </div>
								<div class="col-xl-3 col-lg-3 col-sm-4 col-6 list">
									<div class="btn-heart active" onclick="alert('click');"></div>
									<a href="detail.php">
										<div class="img">
											<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
							        			<img src="../../public/images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
							        		</div>
						                </div>
						                <div class="box-text">
						                	<h6>ชุดอาหาร 10 ชิ้น - แบบที่ 1-RETRO RITZ-GOLD</h6>
						                	<span>สินค้าเกรด - A</span>
						                </div>
									</a>
				                	<span class="price">ราคา : ฿6,990<b>฿8,990</b></span>
				                	<a href="#" class="btn">หยิบลงตะกร้า</a>
				                </div>
								<div class="col-xl-3 col-lg-3 col-sm-4 col-6 list">
									<div class="btn-heart active" onclick="alert('click');"></div>
									<a href="detail.php">
										<div class="img">
											<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
							        			<img src="../../public/images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
							        		</div>
						                </div>
						                <div class="box-text">
						                	<h6>ชุดอาหาร 10 ชิ้น - แบบที่ 1-RETRO RITZ-GOLD</h6>
						                	<span>สินค้าเกรด - A</span>
						                </div>
									</a>
				                	<span class="price">ราคา : ฿6,990<b>฿8,990</b></span>
				                	<a href="#" class="btn">หยิบลงตะกร้า</a>
				                </div>
								<div class="col-xl-3 col-lg-3 col-sm-4 col-6 list">
									<div class="btn-heart" onclick="alert('click');"></div>
									<a href="detail.php">
										<div class="img">
											<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
							        			<img src="../../public/images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
							        		</div>
						                </div>
						                <div class="box-text">
						                	<h6>ชุดอาหาร 10 ชิ้น - แบบที่ 1-RETRO RITZ-GOLD</h6>
						                	<span>สินค้าเกรด - A</span>
						                </div>
									</a>
				                	<span class="price">ราคา : ฿6,990<b>฿8,990</b></span>
				                	<a href="#" class="btn">หยิบลงตะกร้า</a>
				                </div>
								<div class="col-xl-3 col-lg-3 col-sm-4 col-6 list">
									<div class="btn-heart" onclick="alert('click');"></div>
									<a href="detail.php">
										<div class="img">
											<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
							        			<img src="../../public/images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
							        		</div>
						                </div>
						                <div class="box-text">
						                	<h6>ชุดอาหาร 10 ชิ้น - แบบที่ 1-RETRO RITZ-GOLD</h6>
						                	<span>สินค้าเกรด - A</span>
						                </div>
									</a>
				                	<span class="price">ราคา : ฿6,990<b>฿8,990</b></span>
				                	<a href="#" class="btn">หยิบลงตะกร้า</a>
				                </div>
								<div class="col-xl-3 col-lg-3 col-sm-4 col-6 list">
									<div class="btn-heart active" onclick="alert('click');"></div>
									<a href="detail.php">
										<div class="img">
											<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
							        			<img src="../../public/images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
							        		</div>
						                </div>
						                <div class="box-text">
						                	<h6>ชุดอาหาร 10 ชิ้น - แบบที่ 1-RETRO RITZ-GOLD</h6>
						                	<span>สินค้าเกรด - A</span>
						                </div>
									</a>
				                	<span class="price">ราคา : ฿6,990<b>฿8,990</b></span>
				                	<a href="#" class="btn">หยิบลงตะกร้า</a>
				                </div>
								<div class="col-xl-3 col-lg-3 col-sm-4 col-6 list">
									<div class="btn-heart active" onclick="alert('click');"></div>
									<a href="detail.php">
										<div class="img">
											<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
							        			<img src="../../public/images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
							        		</div>
						                </div>
						                <div class="box-text">
						                	<h6>ชุดอาหาร 10 ชิ้น - แบบที่ 1-RETRO RITZ-GOLD</h6>
						                	<span>สินค้าเกรด - A</span>
						                </div>
									</a>
				                	<span class="price">ราคา : ฿6,990<b>฿8,990</b></span>
				                	<a href="#" class="btn">หยิบลงตะกร้า</a>
				                </div>
								<div class="col-xl-3 col-lg-3 col-sm-4 col-6 list">
									<div class="btn-heart active" onclick="alert('click');"></div>
									<a href="detail.php">
										<div class="img">
											<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
							        			<img src="../../public/images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
							        		</div>
						                </div>
						                <div class="box-text">
						                	<h6>ชุดอาหาร 10 ชิ้น - แบบที่ 1-RETRO RITZ-GOLD</h6>
						                	<span>สินค้าเกรด - A</span>
						                </div>
									</a>
				                	<span class="price">ราคา : ฿6,990<b>฿8,990</b></span>
				                	<a href="#" class="btn">หยิบลงตะกร้า</a>
				                </div>
								<div class="col-xl-3 col-lg-3 col-sm-4 col-6 list">
									<div class="btn-heart active" onclick="alert('click');"></div>
									<a href="detail.php">
										<div class="img">
											<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
							        			<img src="../../public/images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
							        		</div>
						                </div>
						                <div class="box-text">
						                	<h6>ชุดอาหาร 10 ชิ้น - แบบที่ 1-RETRO RITZ-GOLD</h6>
						                	<span>สินค้าเกรด - A</span>
						                </div>
									</a>
				                	<span class="price">ราคา : ฿6,990<b>฿8,990</b></span>
				                	<a href="#" class="btn">หยิบลงตะกร้า</a>
				                </div>
								<div class="col-xl-3 col-lg-3 col-sm-4 col-6 list">
									<div class="btn-heart" onclick="alert('click');"></div>
									<a href="detail.php">
										<div class="img">
											<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
							        			<img src="../../public/images/size-img.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
							        		</div>
						                </div>
						                <div class="box-text">
						                	<h6>ชุดอาหาร 10 ชิ้น - แบบที่ 1-RETRO RITZ-GOLD</h6>
						                	<span>สินค้าเกรด - A</span>
						                </div>
									</a>
				                	<span class="price">ราคา : ฿6,990<b>฿8,990</b></span>
				                	<a href="#" class="btn">หยิบลงตะกร้า</a>
				                </div>
								
							</div>				
						</div>
					</div>
				</div>
	        </section>
	        
	        <section class="box-navigation pb-4">
				<div class="container">
					<nav aria-label="Page navigation example">
					  <ul class="pagination">
					    <li class="page-item disabled">
					      <a class="page-link" href="#" aria-label="Previous">
					        <span aria-hidden="true">&laquo;</span>
					        <span class="sr-only">Previous</span>
					      </a>
					    </li>
					    <li class="page-item"><a class="page-link" href="#">1</a></li>
					    <li class="page-item active"><a class="page-link" href="#">2</a></li>
					    <li class="page-item"><a class="page-link" href="javascript:void(0)">...</a></li>
					    <li class="page-item"><a class="page-link" href="#">8</a></li>
					    <li class="page-item">
					      <a class="page-link" href="#" aria-label="Next">
					        <span aria-hidden="true">&raquo;</span>
					        <span class="sr-only">Next</span>
					      </a>
					    </li>
					  </ul>
					</nav>
				</div>
	        </section>
		</div>
		<!-- end #content -->

        <!-- begin #footer -->
        <footer>
		    <?php include ('../layouts/inc-footer.php'); ?>
        </footer>
        <!-- end #footer -->
        
		<!-- Modal -->
		<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-body">

				<form class="form-inline form-Search" action="#">
					<input class="form-control" type="text" placeholder="ค้นหาสินค้า.." aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
				</form>
				<form action="#">
					<h5 class="mt-3">เรียงลำดับ</h5>
					<div class="dropdown show w-100">
					  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    เรียงลำดับ น้อย > มาก
					  </a>
					
					  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					    <a class="dropdown-item" href="#">เรียงลำดับ น้อย > มาก</a>
					    <a class="dropdown-item" href="#">เรียงลำดับ มาก > น้อย</a>
					  </div>
					</div>

					<h5 class="mt-3">ประเภทสินค้า</h5>
					<label for="Minput_checkbox1" class="d-block">
						<input id="Minput_checkbox1" type="checkbox" value="1">
						เครื่องประดับ
						<span class="float-right">(48)</span>
					</label>
					<label for="Minput_checkbox2" class="d-block">
						<input id="Minput_checkbox2" type="checkbox" value="2">
						นาฬิกา
						<span class="float-right">(23)</span>
					</label>
					<label for="Minput_checkbox3" class="d-block">
						<input id="Minput_checkbox3" type="checkbox" value="3">
						จักรยาน
						<span class="float-right">(19)</span>
					</label>
					<label for="Minput_checkbox4" class="d-block">
						<input id="Minput_checkbox4" type="checkbox" value="4">
						กระเป๋า
						<span class="float-right">(17)</span>
					</label>
					<label for="Minput_checkbox5" class="d-block">
						<input id="Minput_checkbox5" type="checkbox" value="5">
						รองเท้า
						<span class="float-right">(12)</span>
					</label>
					<label for="Minput_checkbox7" class="d-block">
						<input id="Minput_checkbox7" type="checkbox" value="7">
						กางเกง
						<span class="float-right">(48)</span>
					</label>
					<label for="Minput_checkbox8" class="d-block">
						<input id="Minput_checkbox8" type="checkbox" value="8">
						เครื่องดนตรี
						<span class="float-right">(12)</span>
					</label>
					<label for="Minput_checkbox9" class="d-block">
						<input id="Minput_checkbox9" type="checkbox" value="9">
						เซรามิค
						<span class="float-right">(12)</span>
					</label>
					<label for="Minput_checkbox10" class="d-block">
						<input id="Minput_checkbox10" type="checkbox" value="10">
						เฟอร์นิเจอร์
						<span class="float-right">(12)</span>
					</label>
					<label for="Minput_checkbox11" class="d-block">
						<input id="Minput_checkbox11" type="checkbox" value="11">
						อื่นๆ
						<span class="float-right">(12)</span>
					</label>
					<hr>
					
					<h5 class="mt-3">เกรดสินค้า</h5>
					<label for="Minput_checkboxA" class="d-block">
						<input id="Minput_checkboxA" type="checkbox" value="A">
						A
						<span class="float-right">(48)</span>
					</label>
					<label for="Minput_checkboxB" class="d-block">
						<input id="Minput_checkboxB" type="checkbox" value="B">
						B
						<span class="float-right">(48)</span>
					</label>
					<label for="Minput_checkboxC" class="d-block">
						<input id="Minput_checkboxC" type="checkbox" value="C">
						C
						<span class="float-right">(48)</span>
					</label>
					<label for="Minput_checkboxD" class="d-block">
						<input id="Minput_checkboxD" type="checkbox" value="D">
						D
						<span class="float-right">(48)</span>
					</label>
					<hr>
					
					<h5 class="mt-3">ราคา</h5>
					<div class="slider-price">
					    <input type="text" id="s21">
					    <input type="text" id="s22">
					</div>
					<div id="slider-container2" class="sliderContainer"></div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary w-50" data-dismiss="modal">ปิด</button>
						<button type="submit" class="btn w-50">ค้นหา</button>
					</div>
				</form>

		      </div>
		    </div>
		  </div>
		</div>
		<!-- Modal -->

	    <?php include ('../layouts/inc-script.php');?>
	    
	    <!-- Range slider code -->
	    <script src="https://d3js.org/d3.v5.min.js"></script>
	    <script src="../../plugins/rangeslider/d3RangeSlider.js"></script>
        <script>
			// ช่วงราคาเริ่มต้น default
			var s1 = 1500;
			var s2 = 15000;
			
			var mi = 0;
			var ma = 16500;
			
			var slider = createD3RangeSlider(mi, ma, "#slider-container");
			    slider.onChange(function(newRange){
			    $("#s1").val(newRange.begin);
			    $("#s2").val(newRange.end);
			});
			slider.range(s1,s2);
			$( "#s1" ).val(s1);
			$( "#s2" ).val(s2);
			
			// Range mobile
			var slider2 = createD3RangeSlider(mi, ma, "#slider-container2");
			    slider2.onChange(function(newRange2){
			    $("#s21").val(newRange2.begin);
			    $("#s22").val(newRange2.end);
			    $('#menuModal').attr('onclick','RangeSlider('+newRange2.begin+','+newRange2.end+');');
			});
			$( "#s21" ).val(s1);
			$( "#s22" ).val(s2);
			$('#menuModal').attr('onclick','RangeSlider('+s1+','+s2+');');
			
			function RangeSlider(i1,i2) {
			    setTimeout(function(){ slider2.range(i1,i2); }, 500);
			}
        </script>
    </body>
</html>
