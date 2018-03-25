<{include file="header.tpl"}>
    <head>
        <script type="text/javascript" src="/js/highcharts.js"></script>
        <script type="text/javascript" src="/js/exporting.js"></script>
    </head>
    <div  class="i_18"
        <{include file="left_menu.tpl"}>
                <div  class="i_22">
                    <span class="title">首页 / 统计分析 </span>
                    <div id="container" style="min-width: 310px; height: 800px; margin: 0 auto"></div>
                </div>
    </div>
    <script>
    $(document).ready(function(){
    var data = <{$count_list}>;
    start_date = data.start_date;
    list = data.list;
    x_arr=[];
    y_arr=[];
    product_name_arr=[];
    j=0;
    product_temp =[];
    for(i=0;i<list.length;i++){
        x_arr[i]= list[i].scan_date ;
        temp = list[i].product_name;
        index = $.inArray(temp,product_name_arr );
        if(index < 0){//不在数组中
            product_name_arr[j] = temp;
            y_arr[j]={name : temp,data:[]};
            product_temp[j]=[];
            product_temp[j].push(list[i].count);
            j++;
        }else{
            product_temp[index].push(list[i].count);
        }
    }
    j=0;
    for(i=0;i<list.length;i++){
        for(j=0;j< y_arr.length;j++){
            temp = list[i].product_name;
            index = $.inArray(temp,product_name_arr );
            if(index == j){
                y_arr[j].data.push(list[i].count);
            }else{
                y_arr[j].data.push(0);
            }
        }
    }
console.log(y_arr);
    Highcharts.chart('container', {
        chart: {
            type: 'line',
            inverted: true
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

        series:y_arr
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

