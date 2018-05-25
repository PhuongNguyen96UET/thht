<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<div class="row" id="nhanvien">
    <h3>Tìm kiếm</h3>
<!--    <form method="post" >-->
        <div class="row" >
            <div class="col-sm-4" >
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;"><label >Địa điểm</label></div>
                        <div class="col-sm-8"><input type="text" name="ID" class="form-control" value=""></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" >
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;"><label >Số người lớn</label></div>
                        <div class="col-sm-8"><input type="number" min="0" name="numAdults" class="form-control" value=1></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" >
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;"><label >Số trẻ em</label></div>
                        <div class="col-sm-8"><input type="number" min="0" name="numChildren" class="form-control" value=0></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-sm-4" >
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;"><label >Ngày đi</label></div>
                        <?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
                        <div class="col-sm-8"><input type="date" min="<?php echo date("Y-m-d");?>" name="startDate" id="startDate" class="form-control" value="<?php echo date("Y-m-d");?>"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" >
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;"><label >Số đêm</label></div>
                        <div class="col-sm-8"><input type="number" id="numDay" min="1" class="form-control" value=1></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" >
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;"><label >Ngày về</label></div>
                        <div class="col-sm-8"><input type="date" name="endDate" id="endDate" disabled  class="form-control" value="<?php
                            $date =  date("Y-m-d");
                            $date1 = str_replace('-', '/', $date);
                            $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));
                            echo $tomorrow;?>"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="height: 100%;display: flex;justify-content: center;align-items: center;">
            <button id="search" style="position: relative;left:1%;" class="btn btn-primary" >Tìm kiếm</button>
        </div>
<!--    </form>-->
</div>
<script>
    $('#search').click(function(){
        var data={
            "clientInterface": "desktop",
            "context": {},
            "data": {
                "backdate": "false",
                "basicFilterSortSpec": {
                    "accommodationTypeFilter": [],
                    "ascending": "false",
                    "basicSortType": "POPULARITY",
                    "skip": "0",
                    "starRatingFilter": [
                        "true",
                        "true",
                        "true",
                        "true",
                        "true"
                    ],
                    "top": "100"
                },
                "ccGuaranteeOptions": {
                    "ccGuaranteeRequirementOptions": [
                        "CC_GUARANTEE"
                    ],
                    "ccInfoPreferences": [
                        "CC_TOKEN",
                        "CC_FULL_INFO"
                    ]
                },
                "checkInDate": {
                    "day": "12",
                    "month": "6",
                    "year": "2018"
                },
                "checkOutDate": {
                    "day": "13",
                    "month": "6",
                    "year": "2018"
                },
                "currency": "VND",
                "geoId": "10009794",

                "locationName": "Thành phố Hồ Chí Minh, Việt Nam",
                "monitoringSpec": {
                    "lastKeyword": "Ha Noi City",
                    "referrer": "https://www.traveloka.com/vi-vn/"
                },
                "numAdults": "1",
                "numChildren": "0",
                "numInfants": "0",
                "numOfNights": "1",
                "numRooms": "1",
                "rateTypes": [
                    "PAY_NOW",
                    "PAY_AT_PROPERTY"
                ],
                "showHidden": "false",
                "sourceType": "HOTEL_GEO"
            },
            "fields": []
        }

        $.post({
            type: "POST",
            url: 'http://api.traveloka.com/vi-vn/v2/hotel/search',
            headers: {
                "Content-Type":"application/x-www-form-urlencoded",
                // "origin":"https://www.traveloka.com"
            },data:JSON.stringify(data),
            success : function(data) {
                console.log(data);
            }
            // dataType: dataType,
        });
    });

    $(document).ready(function() {
        $('#example').DataTable( {
            "ajax": "data/objects.txt",
            "columns": [
                { "data": "name" },
                { "data": "position" },
                { "data": "office" },
                { "data": "extn" },
                { "data": "start_date" },
                { "data": "salary" }
            ]
        } );
    } );

</script>
<div class="row" style="height: 1%" ></div>
<h3>Danh sách phòng</h3>
<table id="example" class="display" style="width:100%">
    <thead>
    <tr>
        <th>Name</th>
        <th>Position</th>
        <th>Office</th>
        <th>Extn.</th>
        <th>Start date</th>
        <th>Salary</th>
    </tr>
    </thead>

</table>
