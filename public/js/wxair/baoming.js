/**
 * Created by jsbfec on 16/7/25.
 */
$(function(){
    $("#baomingForm").validate({
        rules: {
            "name": {
                required: true,
                chinese:"中文",
                minlength:2,
                maxlength: 10
            },
            company:{
                required: true,
                chinese:"中文",
                minlength:2,
                maxlength: 20
            },
            zhiwu:{
                required: true,
                txt:"职务",
                minlength:2,
                maxlength: 20
            },
            tel:{
                required: true,
                tel:"号码",
                minlength:7,
                maxlength: 11
            }
        },messages: {
            "name": {
                required: "不能为空",
                minlength:"请输入至少2个汉字",
                maxlength:"名字长度不能多于10个汉字"
            },
            company:{
                required: "不能为空",
                minlength:"请输入至少2个汉字",
                maxlength:"名字长度不能多于20个汉字"
            },
            zhiwu:{
                required: "不能为空",
            },
            tel:{
                required: "不能为空"
            }
        },
        errorPlacement: function(error, element) {
            element.parent().after(error);
        }
    });
    $.validator.addMethod("txt", function(value, element, params){
        var txt = /[\u4e00-\u9fa5_a-zA-Z0-9]{2,20}/;
        return this.optional(element) || (txt.test(value));
    }, $.validator.format("{0}格式不正确！"));
    $.validator.addMethod("chinese", function(value, element, params){
        var chinese = /[\u4E00-\u9FA5]{2,4}/;
        return this.optional(element) || (chinese.test(value));
    }, $.validator.format("请输入{0}"));
    $.validator.addMethod("tel", function(value, element, params){
        var tel = /[0-9]{7,11}/;
        return this.optional(element) || (tel.test(value));
    }, $.validator.format("{0}格式不正确"));
});