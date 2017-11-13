/**
 * Created by Administrator on 2017/10/30.
 */
/*  btn-primary */

$(function () {

    /*
     *url文件
     */
    $('.resour').click(function () {

        var formData = new FormData($(".url")[0]);
        $.ajax({
            url: '/index/Crawling/upload_url_file',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (returndata) {

                alert(returndata);
            },
            error: function (returndata) {

                alert(returndata);
            }

        });

    });
    /**
     * 正文主题特征文件
     */
    $('.features').click(function () {

        var formData = new FormData($(".subject")[0]);
        formData.append("texttype", 1);
        $.ajax({
            url: '/index/Crawling/replace_ruloes',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (returndata) {

                alert(returndata);
            },
            error: function (returndata) {

                alert(returndata);
            }

        });

    });

    /**
     * 右侧特征文件
     */

    $('.r_features').click(function () {

        var formData = new FormData($(".right")[0]);
        formData.append("texttype", 2);
        $.ajax({
            url: '/index/Crawling/replace_ruloes',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (returndata) {

                alert(returndata);
            },
            error: function (returndata) {

                alert(returndata);
            }

        });

    });

    /**
     * 左侧特征文件
     */
    $('.l_features').click(function () {

        var formData = new FormData($(".left")[0]);
        formData.append("texttype", 3);
        $.ajax({
            url: '/index/Crawling/replace_ruloes',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (returndata) {

                alert(returndata);
            },
            error: function (returndata) {

                alert(returndata);
            }

        });

    });

    /*
     *底部特征文件
     */
    $('.f_features').click(function () {

        var formData = new FormData($(".foot")[0]);
        formData.append("texttype", 4);
        $.ajax({
            url: '/index/Crawling/replace_ruloes',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (returndata) {

                alert(returndata);
            },
            error: function (returndata) {

                alert(returndata);
            }

        });

    });

    /*
     * 提交主体表单替换数据
     */
    $('.subject_sub').click(function () {
        $.ajax({
            type: "POST",
            url: '/index/Crawling/replace_src',
            data: $.param({'type_model[]':1}) + '&' + $('.subject').serialize(),
           // async: true,
            error: function (data) {
                alert(data);
            },
            success: function (data) {
                alert(data);
            }
        });

    });

    /*
     * 提交右侧表单替换数据
     */
    $('.right_sub').click(function () {

        $.ajax({
            type: "POST",
            url: '/index/Crawling/replace_src',
            data:  $.param({'type_model[]':2}) + '&' +$('.right').serialize(),
            // async: true,
            error: function (data) {
                alert(data);
            },
            success: function (data) {
                alert(data);
            }
        });

    });

    /*
     * 提交左侧表单替换数据
     */
    $('.left_sub').click(function () {

        $.ajax({
            type: "POST",
            url: '/index/Crawling/replace_src',
            data:  $.param({'type_model[]':3}) + '&' +$('.left').serialize(),
            // async: true,
            error: function (data) {
                alert(data);
            },
            success: function (data) {
                alert(data);
            }
        });

    });

    /*
     * 提交底部表单替换数据
     */
    $('.foot_sub').click(function () {

        $.ajax({
            type: "POST",
            url: '/index/Crawling/replace_src',
            data:  $.param({'type_model[]':4}) + '&' +$('.foot').serialize(),
            // async: true,
            error: function (data) {
                alert(data);
            },
            success: function (data) {
                alert(data);
            }
        });

    });

    /*
     * 预览
     */
    $('.previwes').click(function () {

        $.ajax({
            type: "POST",
            url: '/index/Crawling/previwe',
            error: function (data) {
                alert(data);
            },
            success: function (data) {
                if(data['success']==0)
                {
                    alert(data['msg']);

                }else
                {
                    window.open(data['msg']);
                }
                
            }
        });
    });
});