<{include file="header.tpl"}>
    <head>
        <script type="text/javascript" src="/js/highcharts.js"></script>
        <script type="text/javascript" src="/js/exporting.js"></script>
    </head>
    <div  class="i_18"
        <{include file="left_menu.tpl"}>
                <div  class="i_22">
                    <span class="title">首页 / 统计分析 </span>
                    <br/>
                    <form id='form1' action='/uc/statistics_date' method='post' >
                        <select name='user_product_id' onchange="change()">
                        <{foreach $data['user_product_list'] as $product}>
                            <option value=<{$product['id']}> <{if $product['id']== $data['user_product_id']}>selected<{/if}>><{$product['product_name']}></option>
                        <{/foreach}>
                        </select>
                    <div id="container" style="min-width: 310px; height: 800px; margin: 0 auto"></div>
                    </form>
                </div>
    </div>
    <script>
    function change(){
        $("#form1").submit();
    }
    $(document).ready(function(){
    var list = <{$list}>;
    x_arr=[];
    y_arr={'name':'','data':[]};
   temp=[];
   for(i=0;i<list.length;i++){
        x_arr.push(list[i]['scan_date']);
        temp[i]=parseInt(list[i]['count']);
    }
    y_arr={name:list[0]['product_name'],data:temp};
    Highcharts.chart('container', {
        chart: {
            type: 'line',
            //inverted: true
        },
        title: {
            text: '每天的扫码次数'
        },/*
        subtitle: {
            text: 'Source: WorldClimate.com'
        },*/
        xAxis: {
            //categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',]
            categories: x_arr,
            },
        yAxis: {
            title: {
                text: '扫码次数'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },

        series:[y_arr]
        /*[{
                name: 'Tokyo',
                data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
                }, 
            {
            name: 'London',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
            }]
            */
    });

   });
    </script>
<{include file="footer.tpl"}>

