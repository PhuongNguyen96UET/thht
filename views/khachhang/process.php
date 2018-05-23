<!DOCTYPE html><html><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,
initial-scale=1">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head><body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12" >
            <h3>Dịch vụ khách hàng đang sử dụng</h3>
            <span>Tên khách hàng: <b><?php echo $users[0]['customersName'] ?></b></span>
            <table class="table table-striped" style="font-size: 14px;">
                <thead>
                <tr>
                    <td>Tên dịch vụ</td>
                    <td>Loại dịch vụ</td>
                    <td>Giá</td>
                    <td>Ngày đăng ký</td>
                    <td>Mô tả</td>
                </thead>
                <tbody>
                <?php // VỊ TRÍ 02: CODE HIỂN THỊ NGƯỜI DÙNG ?>
                <?php
                foreach ($users as $item){ ?>
                    <tr>
                    <td><?php echo $item['Name']; ?></td>
                    <td><?php echo $item['type']; ?></td>
                    <td><?php echo $item['Unit_price']; ?></td>
                    <td><?php echo $item['start_date']; ?></td>
                    <td><?php echo $item['desciption']; ?></td>
                    </tr>

                <?php  }        ?>
                </tbody>
            </table>
        </div>
        </div>
</div>
</body></html>