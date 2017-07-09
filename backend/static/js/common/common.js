var Common = {
    init: function () {
        this.initBreadCrumb();
    },
    preloadJS:[],
    sysloadJs:[],
    merge: function () {
        var arr = [];
        for(var i=0;i<arguments.length;i++){
            if(this.isArray(arguments[i])){
                arr = arr.concat(arguments[i]);
                arguments[i] = null;
            }else{
                arr.push(arguments[i])
            }
        }
        return arr;
    },
    isArray:function(o){
        return Object.prototype.toString.call(o)=='[object Array]';
    },
    loadJs: function () {
        var cmdStr = "$LAB";
        for(var i=0;i<this.preloadJS.length;i++){
            cmdStr += ".script('"+ this.preloadJS[i] +"').wait()";
        }
        for(var j=0;j<this.sysloadJs.length;j++){
            cmdStr += ".script('"+ this.sysloadJs[j] +"')";
        }
        this.preloadJS = [];
        this.sysloadJs = [];
        eval(cmdStr);
    },
    cajax : function (url, data, options) {
        var errmsg = "操作失败，请稍后再试",
            type = "POST", dataType = "json",async=true;
        if (!options) {
            options = {};
        }
        if (options.jsonp) {
            dataType = "jsonp";
        }
        if(options.type){
            type = options.type;
        }
        if(options.async){
            async = options.async;
        }
        var timeout = typeof options.timeout != 'undefined' && options.timeout > 0 ? options.timeout : 10000;
        $.ajax({
            url: url,
            data: data,
            type: type,
            timeout:timeout,
            dataType: dataType,
            async:async,
            success: function (result) {
                if (typeof options.success === "undefined" || typeof options.error == "undefined") {
                    if (typeof options.callback === "function") {
                        options.callback(result);
                    }
                    return;
                }
                if (result.code > 0) {
                    if (typeof options.success === "function") {
                        options.success(result.data, result.msg);
                        return true;
                    }
                }else{
                    if (typeof options.error === "function") {
                        options.error(result.data, result.msg);
                        return true;
                    }
                }
                alert(result.msg);
            },
            error: function () {
                if (typeof options.error === "function") {
                    options.error(-1,errmsg);
                }
            }
        })
    },
    initBreadCrumb: function () {
        var bread = [],html = "";
        $(".page-sidebar-menu").find(".active > a > .title").each(function () {
            bread.push($(this).html());
        });
        for(var i=0;i<bread.length;i++){
            if(i < bread.length-1){
                html += '<li><a href="#">'+bread[i]+'</a><i class="fa fa-angle-double-right"></i></li>';
            }else{
                html += '<li><span>'+bread[i]+'</span></li>';
            }
        }
        $(".page-breadcrumb").html(html);
    }
};
Common.init();
///**
// * 获取表单变量信息
// * @param fields
// * @param extend
// * @returns {*}
// */
//var paramsHandler = function(fields,extend){
//    if(typeof(extend) != "object" || extend instanceof Array){
//        extend={};
//    }
//    if(!Array.isArray(fields)){
//        return extend;
//    }
//    var params = {};
//    for(var i=0;i<fields.length;i++){
//        var key = fields[i];
//        params[key] = $("#"+key).val();
//    }
//    return $.extend(params,extend);
//};
///**
// * 整理请求的参数，将 & 链接的参数分割成对象
// * @param query
// * @returns {{}}
// */
//var parseQuery = function(query) {
//    var pairs = {};
//    if(!query || query.length<1) {
//        return pairs;
//    }
//    var queryInfo = query.split("&");
//    for(var i=0; i<queryInfo.length; i++) {
//        var q = queryInfo[i];
//        if(q) {
//            var arr = q.split("=");
//            if(arr.length == 2) {
//                pairs[arr[0]] = decodeURIComponent(arr[1]);
//            }
//        }
//    }
//    return pairs;
//};
///**
// *获取href hash的参数值
// * @param name
// * @returns {string}
// */
//var getUrlHashParams = function (name) {
//    var query = window.location.hash.split("#");
//    var queryMap = parseQuery(query[1]);
//    if(!name || name.length<1) {
//        return queryMap;
//    }
//    if(!queryMap[name]) {
//        return "";
//    } else {
//        return queryMap[name];
//    }
//};
///**
// * 更新链接的hash参数值
// * @param querys
// * @param refresh
// */
//var updateUrlHashParams = function (querys,refresh) {
//    if(refresh) {
//        querys = $.extend({}, querys);
//    } else {
//        querys = $.extend({}, getUrlHashParams(), querys);
//    }
//    var q = [];
//    for(var k in querys) {
//        q.push(k+"="+encodeURIComponent(querys[k]));
//    }
//    location.href = "#"+q.join("&");
//};
///**
// * 获取请求的参数对象列表GET请求
// * @returns {{}}
// */
//var getQueryParams = function () {
//    var query = window.location.search.substr(1);
//    return parseQuery(query);
//};
///**
// * 初始化/更新 表单参数的值
// * @param formIds
// */
//var initFormParams = function(formIds) {
//    if(!formIds) {
//        return;
//    }
//    var query = getUrlHashParams();
//    for(var i=0; i<formIds.length; i++) {
//        var id = formIds[i];
//        var $item = $('#'+id);
//        if(typeof query[id] != 'undefined') {
//            switch($item.prop('tagName').toLowerCase()) {
//                case 'select':
//                    var $options = $item.children();
//                    for(var j=0; j<$options.size(); j++) {
//                        if($options.eq(j).val() == query[id]) {
//                            $options.get(j).selected = true;
//                        }
//                    }
//                    break;
//                case 'input':
//                    var type = $item.attr('type');
//                    if(type == 'checkbox' || type == 'radio') {
//                        if(query[id]) {
//                            $item.prop('checked', true);
//                        } else {
//                            $item.prop('checked', false);
//                        }
//                    } else {
//                        $item.val(query[id]);
//                    }
//            }
//        }else{
//            var data = {};
//            data[id] = $item.val();
//            updateUrlHashParams(data)
//        }
//    }
//};
///**
// * 分页组件
// * @param total
// * @param page
// * @param pagesize
// * @param idPrefix 分页信息id的前缀 可以为空
// * @returns {string}
// * @private
// */
//var initPagenation = function(total,page,pagesize,idPrefix){
//    page = parseInt(page);pagesize=parseInt(pagesize);total=parseInt(total);
//    idPrefix = idPrefix=='undefined' ? "" : idPrefix;
//    var offset = 1;//page两侧显示的页码个数
//    var maxPage = Math.ceil(total/pagesize);//最大页码数
//    if(page < 1) { page = 1; }
//    if(page > maxPage) {  page = maxPage; }
//    var minIndex = Math.max(1,page-offset);//按照page当前页最小的可显示页码数
//    var maxIndex = Math.min(maxPage,(page+offset));//按照page当前页最大的可显示页码
//    var html = "";
//    if(page>1){//上一页标签
//        html += '<a href="javascript:void(0)" class="" data-page='+(page-1)+'>上一页</a></li>';
//    }
//    if(minIndex > 1){
//        html += '<a href="javascript:void(0)" data-page="1">1</a></li>';
//        if((page-offset) > 2){
//            html += '<span>...</span>';
//        }
//    }
//    for(var i=minIndex;i<=maxIndex;i++){
//        if(i==page){
//            html +=  '<a href="javascript:void(0)" class="on" data-page="'+i+'">'+i+'</a>';
//        }else{
//            html +=  '<a href="javascript:void(0)" data-page="'+i+'">'+i+'</a>';
//        }
//    }
//    if(maxIndex < maxPage){
//        if((page+offset) < (maxPage-1)){
//            html += '<span>...</span>';
//        }
//        html += '<a href="javascript:void(0)" data-page="'+maxPage+'" class="_click_log_page">'+maxPage+'</a>';
//    }
//    if(page<maxPage){//下一页标签
//        html += '<a href="javascript:void(0)" data-page='+(page+1)+' class="_click_log_page">下一页</a>';
//    }
//    //总条数标签
//    html += '<span> 共<b id="'+idPrefix+'_pagenation_info" data-total="'+total+'" data-pagesize="'+pagesize+'">'+total+'</b>条</span>';
//    return html;
//};