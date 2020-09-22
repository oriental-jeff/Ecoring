<!DOCTYPE html>
<html lang="EN">
    <head>
		
		<?php include ('../layouts/inc-meta.php');?>
		
		<link rel="stylesheet" type="text/css" href="../../public/css/detail.css">
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
					<div class="row" id="Boxheight">
						<div class="col-lg-9">
							<div class="row">
								<div class="col-md-6 box-showImg">
									<div class="img d-none d-md-block">
										<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')"  id="showImg2">
						        			<img src="../../public/images/size-img2.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
						        		</div>
						        		
										<a href="http://via.placeholder.com/500x350" data-fancybox="images" data-id="1" class="active"></a>
										<a href="http://via.placeholder.com/500x350/000000" data-fancybox="images" data-id="2"></a>
										<a href="http://via.placeholder.com/500x350/6f42c1" data-fancybox="images" data-id="3"></a>
										<a href="http://via.placeholder.com/500x350/ffc107" data-fancybox="images" data-id="4"></a>
										<a href="http://via.placeholder.com/500x350/007bff" data-fancybox="images" data-id="5"></a>
					                </div>
                		            <div class="owl-carousel">
	                		            
						                <div class="item img">
							                <a href="#" onclick="showImg(1,'http://via.placeholder.com/500x350');">
												<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350')">
								        			<img src="../../public/images/size-img2.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
								        		</div>
							                </a>
						                </div>
						                <div class="item img">
							                <a href="#" onclick="showImg(2,'http://via.placeholder.com/500x350/000000');">
												<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350/000000')">
								        			<img src="../../public/images/size-img2.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
								        		</div>
							                </a>
						                </div>
						                <div class="item img">
							                <a href="#" onclick="showImg(3,'http://via.placeholder.com/500x350/6f42c1');">
												<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350/6f42c1')">
								        			<img src="../../public/images/size-img2.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
								        		</div>
							                </a>
						                </div>
						                <div class="item img">
							                <a href="#" onclick="showImg(4,'http://via.placeholder.com/500x350/ffc107');">
												<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350/ffc107')">
								        			<img src="../../public/images/size-img2.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
								        		</div>
							                </a>
						                </div>
						                <div class="item img">
							                <a href="#" onclick="showImg(5,'http://via.placeholder.com/500x350/007bff');">
												<div class="src-img" style="background-image: url('http://via.placeholder.com/500x350/007bff')">
								        			<img src="../../public/images/size-img2.png" alt=""><!-- ช่องนี้ห้ามแก้ -->
								        		</div>
							                </a>
						                </div>
						                
                		            </div>
								</div>
								<div class="col-md-6">
									<h4>
										<!-- favorites mobile -->
										<div class="icon-Favorites float-right ml-2 d-block d-lg-none active" onclick="alert('click');">รายการโปรด</div>
										<!-- favorites mobile -->
										
										Charlotte Max - กระเป๋าสะพาย ทรงเหลี่ยมคลาสสิค สไตล์มินิมอล
									</h4>
									<hr>
									<div class="box-Toggle" id="b-Toggle">
										<p>
											<b>รายละเอียดสินค้า</b><br>
											- กระเป๋าสะพายหนัง PU คาเวียร์หนังดีมาก ด้านในมีซับอย่างดี<br>
											- ใส่ของได้จุกจิกปรับสายได้ ทรงสวย สีสันสดใสเป็นงานไล่สี สีจะออกไม่สหม่ำเสมอ ดีไซค์ เก๋<br>
											- ช่องซิป 1 ช่องใหญ่ด้านในไม่มีช่อง เพิ่มเติม เป็นช่องโล่งๆ<br>
											- สายผ้าไนล่อน ปรับสายได้ งานดี สายใหญ่<br>
											<br>
											ขนาด:<br>
											กว้างฐาน:20cm สุง 12 cm หนา 6cm<br>
											น้ำหนัก: 0.25kg.<br>
											สายสะพาย: สะพายข้าง<br>
											เนื้อผ้า:PU<br>
											ความยาวสายสะพายปรับสุด: 55 cm<br>
											ขนาดกระเป๋ามีคลาดเคลื่อน 1-5 cm (โปรดละเว้น)
										</p>
									</div>
									<button type="button" id="button-Toggle1" class="p-2 mt-2 border-0 w-100" onclick="$('#b-Toggle').toggleClass('open');$(this).hide();$('#button-Toggle2').show();">
										แสดงเพิ่มเติม <img src="../../public/images/icon-select.png">
									</button>
									<button type="button" id="button-Toggle2" class="p-2 mt-2 border-0 w-100" style="display: none" onclick="$('#b-Toggle').toggleClass('open');$(this).hide();$('#button-Toggle1').show();">
										แสดงน้อยลง <img id="button-Toggle2" src="../../public/images/icon-select.png" style="transform: rotate(180deg);">
									</button>

								</div>
							</div>
							<hr>
						</div>
						<div class="col-lg-3 box-left-sticky">
							<div class="b-sticky">
								<!-- favorites PC -->
								<div class="icon-Favorites d-none d-lg-block active" onclick="alert('click');">รายการโปรด</div>
								<!-- favorites PC -->
							
								<hr class="d-none d-lg-block">
								<div class="font-weight-bold mt-3 clearfix">สินค้าเกรด <h3 class="float-right">A</h3></div>
								<div class="font-weight-bold mt-3 clearfix"><b class="line-through">฿15,510</b> <h4 class="float-right">ราคา : ฿14,990</h4></div>
								<div class="font-weight-bold mt-3 clearfix">
									จำนวน 
									<div class="btn-group">
									    <button type="button" class="btn btn-delete disabled">-</button>
									    <input type="text" class="btn" value="1">
									    <button type="button" class="btn btn-plus">+</button>
									</div>
								</div>
								<br>
								<div class="mt-3" style="color: #00b16b;">มีสินค้าทั้งหมด : 455 ชิ้น</div>
								<br>
								<button type="button" class="btn border-0 w-100">หยิบลงตะกร้า</button>
								<br>
								<div class="mt-3" style="color: #00b16b;">ราคานี้ตั้งแต่ 16/03/2020 ถึง 16/03/2020 ราคานี้ใช้สำหรับการสั่งซื้อทางออนไลน์เท่านั้น</div>
								<br>
								
								<div class="box-icon-list">
									<div class="footer-box">
										<img src="../../public/images/icon-footer/box1.svg">
									</div>
									<b>ส่งฟรีทั่วไทยเมื่อช้อปครบ 2,500.- ขึ้นไป</b>
								</div>
								<div class="box-icon-list">
									<div class="footer-box">
										<img src="../../public/images/icon-footer/box2.svg">
									</div>
									<b>ของแท้ 100% พร้อมการรับประกัน</b>
								</div>
								<div class="box-icon-list">
									<div class="footer-box">
										<img src="../../public/images/icon-footer/box3.svg">
									</div>
									<b>รับประกันการติดตั้ง เป็นระยะเวลา 180 วัน</b>
								</div>
								
								<hr>
								<!-- social PC -->
								<div class="my-3 d-none d-xl-block" style="color: #00b16b;">มีแชร์ :
									<div class="box-social d-inline-block">
								        <a target="_blank" href="#">
								            <img src="../../public/images/icon-social-fb.png">
								        </a>
								        <a target="_blank" href="#">
								            <img src="../../public/images/icon-social-tw.png">
								        </a>
								        <a target="_blank" href="#">
								            <img src="../../public/images/icon-social-ig.png">
								        </a>
								        <a target="_blank" href="#">
								            <img src="../../public/images/icon-social-li.png">
								        </a>
								    </div>
								</div>
								<!-- social PC -->
							</div>
						</div>
						<div class="col-lg-9">
							<div class="box-Toggle" id="b-Toggle2">
								<p>
									<b>ข้อมูลสินค้า</b><br>
									- กระเป๋าสะพายหนัง PU คาเวียร์หนังดีมาก ด้านในมีซับอย่างดี ใส่โทรศัพพ์ได้ถึง IPHONE8+<br>
									- ใส่ของได้จุกจิกปรับสายได้ ทรงสวย สีสันสดใสเป็นงานไล่สี สีจะออกไม่สหม่ำเสมอ ดีไซค์ เก๋<br>
									- ช่องซิป 1 ช่องใหญ่ด้านในไม่มีช่อง เพิ่มเติม เป็นช่องโล่งๆ<br>
									- สายผ้าไนล่อน ปรับสายได้ งานดี สายใหญ่<br>
								</p>
								<p>
									<img src="http://via.placeholder.com/690x410" style="width: 100%">
								</p>
							</div>
							<button type="button" id="button-Toggle3" class="p-2 mt-2 border-0 w-100" onclick="$('#b-Toggle2').toggleClass('open');$(this).hide();$('#button-Toggle4').show();">
								แสดงเพิ่มเติม <img src="../../public/images/icon-select.png">
							</button>
							<button type="button" id="button-Toggle4" class="p-2 mt-2 border-0 w-100" style="display: none" onclick="$('#b-Toggle2').toggleClass('open');$(this).hide();$('#button-Toggle3').show();">
								แสดงน้อยลง <img id="button-Toggle2" src="../../public/images/icon-select.png" style="transform: rotate(180deg);">
							</button>
							<hr class="mt-4">
							<div class="tag">
								<h5>คำที่เกี่ยวข้อง :</h5>
								<a href="#">กระเป๋า</a>
								<a href="#">สีน้ำตาล</a>
							</div>
							
							<!-- social mobile -->
							<div class="d-block d-xl-none" style="color: #00b16b;">มีแชร์ :
								<div class="box-social d-inline-block">
							        <a target="_blank" href="#">
							            <img src="../../public/images/icon-social-fb.png">
							        </a>
							        <a target="_blank" href="#">
							            <img src="../../public/images/icon-social-tw.png">
							        </a>
							        <a target="_blank" href="#">
							            <img src="../../public/images/icon-social-ig.png">
							        </a>
							        <a target="_blank" href="#">
							            <img src="../../public/images/icon-social-li.png">
							        </a>
							    </div>
							</div>
							<!-- social mobile -->

						</div>
					</div>
				</div>
	        </section>
	        
	        <section class="box-relate box-products mt-2">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="arrow-default">
								<div class="o-prev"><img src="../../public/images/icon-arrow.png"></div>
								<div class="o-next"><img src="../../public/images/icon-arrow.png"></div>
							</div>
							<h5 class="my-1">สินค้าใหม่</h5>
						</div>
					</div>

		            <div class="owl-carousel box-List">
			            
		                <div class="item list">
							<div class="btn-heart active" onclick="alert('click');"></div>
							<a href="#">
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
		                <div class="item list">
							<div class="btn-heart active" onclick="alert('click');"></div>
							<a href="#">
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
		                <div class="item list">
							<div class="btn-heart active" onclick="alert('click');"></div>
							<a href="#">
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
		                <div class="item list">
							<div class="btn-heart active" onclick="alert('click');"></div>
							<a href="#">
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
		                <div class="item list">
							<div class="btn-heart active" onclick="alert('click');"></div>
							<a href="#">
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
		                <div class="item list">
							<div class="btn-heart active" onclick="alert('click');"></div>
							<a href="#">
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
	        </section>
		</div>
		<!-- end #content -->

        <!-- begin #footer -->
        <footer>
		    <?php include ('../layouts/inc-footer.php'); ?>
        </footer>
        <!-- end #footer -->
        
	    <?php include ('../layouts/inc-script.php');?>
        <script type="text/javascript" src="../../public/js/detail.js"></script>
	    <script>
		    function showImg(id,src) {
			    $('.box-showImg > .img > a[data-id='+id+']').addClass('active');
			    $('.box-showImg > .img > a:not([data-id='+id+'])').removeClass('active');
			    $('#showImg2').css('background-image','url('+src+')');
		    }
	    </script>
    </body>
</html>
