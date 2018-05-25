<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>-->
<!---->
<!--<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>-->
<div class="row" id="nhanvien">
    <h3>Tìm kiếm</h3>
<!--    <form method="post" >-->
        <div class="row" >
            <div class="col-sm-4" >
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;"><label >Địa điểm</label></div>
                        <div class="col-sm-8">
                            <select id="city">
                                <option value="0">-- Chọn TP --</option>
                                <option value="10009843">TP Hà Nội</option>
                                <option value="10010311">TP Huế</option>
                                <option value="10009794">TP HCM</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" >
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;"><label >Số người lớn</label></div>
                        <div class="col-sm-8"><input type="number" min="0" id="numAdults" class="form-control" value=1></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" >
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="text-align: right;"><label >Số trẻ em</label></div>
                        <div class="col-sm-8"><input type="number" min="0" id="numChildren" class="form-control" value=0></div>
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
        $('.data').html("");
        var startDate=new Date($('#startDate').val());
        var endDate=new Date($('#endDate').val());
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
                    "top": "50"
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
                    "day": startDate.getDate(),
                    "month": startDate.getMonth()+1,
                    "year": startDate.getFullYear()
                },
                "checkOutDate": {
                    "day": endDate.getDate(),
                    "month": endDate.getMonth()+1,
                    "year": endDate.getFullYear()
                },
                "currency": "VND",
                "geoId": $("#city").val(),

                "locationName": "Thành phố Hồ Chí Minh, Việt Nam",
                "monitoringSpec": {
                    "lastKeyword": "Ha Noi City",
                    "referrer": "https://www.traveloka.com/vi-vn/"
                },
                "numAdults": $("#numAdults").val(),
                "numChildren": $("#numChildren").val(),
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
        console.log(data);

        $.post({
            type: "POST",
            url: 'http://api.traveloka.com/vi-vn/v2/hotel/search',
            headers: {
                "Content-Type":"application/x-www-form-urlencoded",
                // "origin":"https://www.traveloka.com"
            },data:JSON.stringify(data),
            success : function(data) {
                // console.log(data);
                var obj=data.data.entries;
                var i;
                 for(i=0;i<obj.length;i++){
                     var html="<div class=\"row\" style=\"margin-top: 20px; \">\n" +
                         "    <div class=\"col-md-4 img\" style=\"display: block; \">\n" +
                         "        <img style=\"width: 250px; height: 160px\" src=\""+obj[i].imageUrl+"\">\n" +
                         "    </div>\n" +
                         "    <div class=\"col-md-4 content\" style=\"display: inline-block;\">\n" +
                         "        <h3>"+obj[i].displayName+"</h3>\n" +
                         "        <p>Đánh giá: "+obj[i].starRating+" sao</p>\n" +
                         "        <p>"+obj[i].region+"</p>\n" +
                         "        <p>"+obj[i].userRatingInfo+" - "+obj[i].userRating+"</p>\n" +
                         "    </div>\n" +
                         "        <div class=\"col-md-4 price\" style=\"display: inline-block;\" ><h4>Giá: "+obj[i].lowRate+" VND</h4></div>\n" +
                         "    </div>" +
                            "<hr>";
                     // console.log(html);
                     $('.data').append(html);
                 }
            }
        });
    });


</script>
<!--<div class="row" style="height: 1%" ></div>-->
<h3>Danh sách phòng</h3>
<div class="data">
<!--    <div class="row" style="margin-top: 10px; border: 1px solid #cccccc">-->
<!--    <div class="col-md-4 img" style="display: block; ">-->
<!--        <img style="width: 60%; height: 60%" src="https://d1nabgopwop1kh.cloudfront.net/hotel-asset/30000002000128554_dm_3">-->
<!--    </div>-->
<!--    <div class="col-md-4 content" style="display: inline-block;">-->
<!--        <h3>Khách sạn Rosabella</h3>-->
<!--        <p>Đánh giá: 3 sao</p>-->
<!--        <p>Quận 1, Thành phố Hồ Chí Minh</p>-->
<!--        <p>Ấn tượng - 8.5</p>-->
<!--    </div>-->
<!--        <div class="col-md-4 price" style="display: inline-block;" ><h4>Giá: 493000 VND</h4></div>-->
<!--    </div>-->
</div>

