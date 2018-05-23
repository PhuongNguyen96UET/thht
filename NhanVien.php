<!DOCTYPE html><html><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,
initial-scale=1">
    <link rel="stylesheet" href="bootstrap-4.0.0/css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
<!--    <script src="../jquery/jquery-3.2.1.js"></script>-->
<!--    <script src="../bootstrap-4.0.0/js/bootstrap.min.js"></script>-->
</head><body>
<div class="container-fluid">
    <div class="row" style="background-color: blue">
        <div class="col-xs-1 col-sm-2" >
            <img src="images/logo.png" id="logo" class="rounded-circle" alt="Cinque Terre">
        </div>
        <div class="col-xs-11 col-sm-10" >
            <button id="login" class="btn btn-default"><a href="index.php"> Đăng Nhập</a></button>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-1 col-sm-2" id="panel">

            <ul class="fordtreeview list-group">
                <li class="list-group-item"><a href="http://dantri.com.vn/">Danh sách nhân viên</a></li>
                <li class="list-group-item"><a href="http://dantri.com.vn/">Danh sách khách hàng</a></li>
                <li class="list-group-item"><a href="http://dantri.com.vn/">Danh sách đối tác</a></li>
                <li class="list-group-item"><a href="http://dantri.com.vn/">Dịch vụ</a></li>
                <li class="list-group-item"><a href="http://dantri.com.vn/">Lịch sử khách hàng</a></li>
            </ul>
            </div>
        <div class="col-xs-11 col-sm-10" id="main">
        <div class="row" id="nhanvien">
            <h3>Tìm kiếm</h3>
            <form class="form-inline"  method="get">
                <div class="form-group">
                    <label >Mã nhân viên:</label>
                    <input type="text" name="ma" class="form-control" >
                </div>
                <div class="form-group">
                    <label >Tên nhân viên:</label>
                    <input type="text" name="code" class="form-control">
                </div>
                <div class="form-group">
                    <label >Trạng thái:</label>
                    <input type="text" name="status" class="form-control">
                </div>
                <button id="search" type="submit" class="btn btn-default">Tìm kiếm</button>
            </form>
        </div>
            <div class="row" id="danhsach">

            </div>
        </div>
    </div>
    </div>

<script src="js/index.js"></script>

</body></html>