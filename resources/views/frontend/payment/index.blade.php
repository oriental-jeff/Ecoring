@extends('frontend.layouts.main')
@section('title')
@endsection

@section('content')
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
            <h4>แจ้งชำระเงิน</h4>
            <form action="success.php" method="post" accept-charset="utf-8">
                <div class="form-row">
                    <div class="col-lg-4 col-md-6 mb-3">
                        <label for="validationDefault01">หมายเลขสั่งซื้อ :</label>
                        <input type="text" class="form-control" id="validationDefault01" placeholder="First name"
                            value="UCM789456123" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-4 col-md-6 mb-3">
                        <label for="validationDefault02">ชื่อ-นามสกุล :</label>
                        <input type="text" class="form-control" id="validationDefault02" required>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <label for="validationDefault03">เบอร์ติดต่อ :</label>
                        <input type="tel" class="form-control" id="validationDefault03" required>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <label for="validationDefault04">อีเมล :</label>
                        <input type="email" class="form-control" id="validationDefault04" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-2 col-md-6 mb-3">
                        <label for="validationDefault05">วันที่ :</label>
                        <input type="date" class="form-control" id="validationDefault05" required>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-3">
                        <label for="validationDefault06">เวลา :</label>
                        <input type="time" class="form-control" id="validationDefault06" required>
                    </div>
                </div>
                <div class="form-group box2">
                    <h4>โอนเข้าบัญชี</h4>
                    <div class="form-row">
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label for="validationDefault07">ธนาคาร :</label>
                            <select class="form-control" id="validationDefault07">
                                <option>ธนาคารไทยพาณิชย์ - SCB</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 mb-3 align-self-end">
                            <div class="input-group">
                                <div class="input-group-prepend pr-3 align-self-center">หลักฐานการโอนเงิน : </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input d-none" id="exampleFormControlFile1">
                                    <label class="btn border-0 w-100 btn-FormControlFile"
                                        for="exampleFormControlFile1">อัพโหลดสลิป <i
                                            class="ml-2 fa fa-upload"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row px-2">
                    <div class="col-lg-2 offset-lg-8 col-md-3 offset-md-6 col-6 px-1">
                        <button type="button" class="btn btn-secondary border-0 w-100"
                            onclick="window.history.back()">ย้อนกลับ</button>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6 px-1">
                        <button type="submit" class="btn border-0 w-100">แจ้งการชำระเงิน</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<!-- end #content -->
@endsection

@push('after-scripts')
<script>
    $(function() {
    });
</script>
@endpush
