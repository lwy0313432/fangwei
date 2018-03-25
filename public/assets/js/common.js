define(['jquery'], function ($) {
    var Common = {
        api: {
            //城市相关
            //获取1级城市数据
            getParCityData: function () {
                var json = '';
                $.ajax({
                    url: "/city/getParCityData",
                    async:false,
                    dataType: 'json',
                    success: function(data){
                        json = data;
                    }
                });
                return json;
            },

            //通过城市ID获取下级城市数据
            getDistrictByCid: function (cityid) {
                var json = '';
                $.ajax({
                    url: "/city/getDistrictByCid",
                    async:false,
                    dataType: 'json',
                    data: {cityid:cityid},
                    success: function(data){
                        json = data;
                    }
                });
                return json;
            },

            //商圈

            //通过城市ID获取商圈
            getTradingAreByCid: function (cityid) {
                var json = '';
                $.ajax({
                    url: "/city/getTradingAreByCid",
                    async:false,
                    dataType: 'json',
                    data: {cityid:cityid},
                    success: function(data){
                        json = data;
                    }
                });
                return json;
            },

            //商场
            //通过城市ID获取商场
            getMarketByCid: function (cityid) {
                var json = '';
                $.ajax({
                    url: "/city/getMarketByCid",
                    async:false,
                    dataType: 'json',
                    data: {cityid:cityid},
                    success: function(data){
                        json = data;
                    }
                });
                return json;
            },

            //品类
            //获取品类树状数据
            getBrandCategoryTree: function () {
                var json = '';
                $.ajax({
                    url: "/brandcategory/getBrandCategoryTree",
                    async:false,
                    dataType: 'json',
                    success: function(data){
                        json = data;
                    }
                });
                return json;
            },

            //品牌
            //通过分类ID获取品牌
            getBrandBycid: function (categoryid) {
                var json = '';
                $.ajax({
                    url: "/brand/getBrandBycid",
                    async:false,
                    dataType: 'json',
                    data: {categoryid:categoryid},
                    success: function(data){
                        json = data;
                    }
                });
                return json;
            },

            //供应商
            //通过分类ID,品牌ID获取供应商
            getSupplierBrandByCidBid: function (categoryid, brandid) {
                var json = '';
                $.ajax({
                    url: "/supplierbrand/getSupplierBrandByCidBid",
                    async:false,
                    dataType: 'json',
                    data: {categoryid: categoryid, brandid: brandid},
                    success: function(data){
                        json = data;
                    }
                });
                return json;
            },


            //门店

            //通过分类ID,品牌ID获取供应商
            getSupplierByCidBid: function (categoryid, brandid) {
                var json = '';
                $.ajax({
                    url: "/supplierstore/getSupplierByCidBid",
                    async:false,
                    dataType: 'json',
                    data: {categoryid: categoryid, brandid: brandid},
                    success: function(data){
                        json = data;
                    }
                });
                return json;
            },

            //通过分类ID,品牌ID,供应商ID获取门店
            getStoreBrandByCidBidSid: function (categoryid, brandid, supplierid) {
                var json = '';
                $.ajax({
                    url: "/supplierstore/getStoreBrandByCidBidSid",
                    async:false,
                    dataType: 'json',
                    data: {categoryid: categoryid, brandid: brandid, supplierid: supplierid},
                    success: function(data){
                        json = data;
                    }
                });
                return json;
            },
            //获取单个门店信息
            ajaxStoreById: function (storeid) {
                var str='';
                $.ajax({
                    url: "/Store/ajaxStoreById",
                    async:false,
                    dataType: 'json',
                    data: {id:storeid},
                    success: function(data){
                        str=data;
                    }
                });
                return str;
            },

            //通过门店id或名称获取所有门店
            getAllByIdName: function (searchName) {
                var json = '';
                $.ajax({
                    url: "/store/getAllByIdName",
                    async:false,
                    dataType: 'json',
                    data: {searchName: searchName},
                    success: function(data){
                        json = data;
                    }
                });
                return json;
            },
            //通过门店id或名称获取所有门店
            getSupplierAllByName: function (searchName) {
                var json = '';
                $.ajax({
                    url: "/Supplier/getSupplierAllByName",
                    async:false,
                    dataType: 'json',
                    data: {searchName: searchName},
                    success: function(data){
                        json = data;
                    }
                });
                return json;
            },

            //店员
            //获取店员分类数据
            getAssistantIdentity: function () {
                var json = '';
                $.ajax({
                    url: "/assistant/getAssistantIdentity",
                    async:false,
                    dataType: 'json',
                    success: function(data){
                        json = data;
                    }
                });

                return json;
            },

            //菜单
            //通过URL地址获取菜单信息
            getAuthRuleRowByUrl: function (url) {
                var str='';
                $.ajax({
                    url: "/auth/getAuthRuleRowByUrl",
                    async:false,
                    dataType: 'json',
                    data: {url:url},
                    success: function(data){
                        str=data;
                    }
                });
                return str;
            },

        },
    };
    Common.api = $.extend(Common.api);
    //将Common渲染至全局,以便于在子框架中调用
    window.Common = Common;
    return Common;
});
