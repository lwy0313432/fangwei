<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<title>itcast</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<link href="/css/Public.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="/js/common.js"></script>
<script type="text/javascript" src="/js/jquery.SuperSlide.2.1.1.js"></script>
<script type="text/javascript" src="/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=6p8ntcRYALd18bXtjoG2GZowXqxNib59"></script>

<script type="text/javascript" src="https://developer.baidu.com/map/jsdemo/demo/convertor.js"></script>  

<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">

<head>

<script language="javascript">
    
    $(function(){
    
       $("body").height($(window).height()+"px");
    })

</script>

<body>

    <div  class="i_29">
       <img src="/images/c7.jpg" class='plogo'/>
       <span class="">杉世创意科技有限公司</span>
    </div>
    <div  class="i_30">
        <img src="/images/c8.jpg"/>
    </div>
    <div style='clear:both;height:20px;'></div>
    <input type='hidden' id='qrcode_id' value='<{$detail.qrcode_id}>'/>
    <div  class="i_31">
        <div  class="i_31-1">
            商品名称
        </div>
        <div  class="i_31-2">
            <{$detail.product_name}>
        </div>
    </div>

     <div  class="i_31">
        <div  class="i_31-1">
            生产日期
        </div>
        <div  class="i_31-2">
            <{$detail.qrcode_dt}>
        </div>
    </div>

     <div  class="i_31">
        <div  class="i_31-1">
          防伪验证
        </div>
        <div  class="i_31-2">
            <{if $detail['is_true']=='no'}>
                假
            <{else}>
             随机码：<{$detail.random_str}>； 当前是第<{$detail.scan_num}>次扫码
            <{/if}>
        </div>
    </div>
    <div style='clear:both;height:20px;'></div>

    <div  class="i_32">
        产品信息
    </div>
    <div  class="i_34">
  
              <textarea rows="" cols="" name='' class="i_33"></textarea>
              <span class="wz">输入您所扫描的产品信息</span>
   </div>
   <div style='clear:both;height:25px;'></div>

   <div  class="i_35">
      <div  class="hd">
         <ul>
          
         </ul>
      </div>
      <div  class="bd">
         <ul>
            <li><img src="/images/a8.png" /></li>
            <li><img src="/images/a8.png" /></li>
            <li><img src="/images/a8.png" /></li>
         </ul>
      </div>
   </div>
   <div style='clear:both;height:50px;'></div>
   <div  class="i_36">
      <div  class="i_36-1">
         <input type="text" name="mobile" id='mobile'  placeholder="&nbsp;&nbsp;&nbsp;请输入手机号码"/>
      </div>
      <div  class="i_36-2" style='border-radius: 15px'>
        获取验证码
      </div>
   </div>
   <div style='clear:both;height:13px;'></div>
   <div  class="i_36">
     <input type="text" name="" class='i_36-3'  placeholder="&nbsp;&nbsp;&nbsp;请输入6位手机验证码，点击抽奖"/>
   </div>
   <div style='clear:both;height:13px;'></div>
    <div  class="i_36">
       <input type='submit'  class="i_34-4" value="抽 奖">
    </div>
    <div style='clear:both;height:60px;'></div>
    <div id="allmap"></div>
    </body>

<script type='text/javascript'>


var geolocation = new BMap.Geolocation();
geolocation.getCurrentPosition(function(r){
        if(this.getStatus() == BMAP_STATUS_SUCCESS){
            var gpsPoint = new BMap.Point(r.point.lng,r.point.lat);

            BMap.Convertor.translate(gpsPoint, 0, function (point) {  
                var geoc = new BMap.Geocoder();  
                geoc.getLocation(point, function (rs) {  
                    console.log(rs);
                        var addComp = rs.addressComponents;  
                        $.ajax({
                                type: "POST",
                                url: "/api/qrcode_address_save",
                                data: {qrcode_id:$("#qrcode_id").val(), address:addComp},
                                dataType: "json",
                                success: function(data){
                                },
                         });
                        //alert(addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber);  
                        });  
                }); 
        }
        else {
            alert('failed'+this.getStatus());
        }        
        },{enableHighAccuracy: true});

</script>  
</html>


