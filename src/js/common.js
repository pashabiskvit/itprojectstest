$(document).ready(function() {
    //устанавливаем локализацию
    var lang = window.navigator.language || navigator.userLanguage
    var cookies = $.cookie();
    var language = Object.keys(cookies).some(function (key) {
        return 	key.indexOf("language") == 0
    });
    if (!language) {
        if(lang  != "ru-RU"){
            LangSelect(lang);
        }
    }
    //смена локализации
    $("#changeLanguage").change(function() {
        var select = $("#changeLanguage option:selected" ).val();
        LangSelect(select);
    });
    $( "#logout" ).click(function() {
        var login = $.cookie('login');
        if(confirmAct(confirmActText)) {
            $.ajax({
                data: {
                    login: login
                },
                type: "POST",
                url: "/api/user/logout",
                success: function(data){
                    var status = jQuery.parseJSON(data);
                    if(status["status"] == true){
                        $.cookie("", status.login);
                        $.cookie("", status.token);
                        $.notify({
                            title: NotifyHeadSuccess,
                            message: status["Text"]
                        },{
                            type: 'success'
                        });
                        redirect(status["request"]);
                    }else{
                        $.notify({
                            title: NotifyHeadWarning,
                            message: status["errorText"]
                        },{
                            type: 'warning'
                        });
                    }

                }
            });
        }
    });
    if($.validate) {
        $.validate({
            validateOnBlur : false,
            scrollToTopOnError : false,
            borderColorOnError : false,
            modules : 'security,file',
            lang : 'ru',
            onSuccess : function(form) {
                if(form.data("type-send") == "ajaxLogin") {
                    $.ajax({
                        data: form.serialize(),
                        type: form.attr("method") || "POST",
                        url: form.attr("action"),
                        success: function(data){
                            var status = jQuery.parseJSON(data);
                            if(status["status"] == true){
                                $.cookie("login", status.login, { expires: 1, path: '/'});
                                $.cookie("token", status.token, { expires: 1, path: '/'});
                                $.notify({
                                    title: NotifyHeadSuccess,
                                    message: status["Text"]
                                },{
                                    type: 'success'
                                });
                                redirect(status["request"]);
                            }else{
                                $.notify({
                                    title: NotifyHeadWarning,
                                    message: status["errorText"]
                                },{
                                    type: 'warning'
                                });
                            }

                        }
                    });
                    return false;
                }
                if(form.data("type-send") === "ajax") {
                    var $that = form;
                    formData = new FormData($that.get(0));
                    files = $("input[type=file]")[0].files;
                    if(typeof files != "undefine"){
                        formData.append("avatar", files);
                    }
                    $.ajax({
                        url: form.attr("action"),
                        type: "POST",
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(data){
                            var status = jQuery.parseJSON(data);
                            if(status["status"] == true){
                                $.notify({
                                    title: NotifyHeadSuccess,
                                    message: status["Text"]
                                },{
                                    type: 'success'
                                });
                                redirect(status["request"]);
                            }else{
                                $.notify({
                                    title: NotifyHeadWarning,
                                    message: status["errorText"]
                                },{
                                    type: 'warning'
                                });
                            }
                        }
                    });
                    return false;
                }
            }
        });
    }
});
function LangSelect(lang) {
    if(lang  != "en" && lang  != "ru"){
        lang = "en"
    }
    $.cookie('language', lang);
    location.reload();
}
function redirect (url) {
    var ua        = navigator.userAgent.toLowerCase(),
        isIE      = ua.indexOf("msie") !== -1,
        version   = parseInt(ua.substr(4, 2), 10);

    // Internet Explorer 8 and lower
    if (isIE && version < 9) {
        var link = document.createElement("a");
        link.href = url;
        document.body.appendChild(link);
        link.click();
    }

    // All other browsers can use the standard window.location.href (they don"t lose HTTP_REFERER like Internet Explorer 8 & lower does)
    else {
        window.location.href = url;
    }
}
function confirmAct(text) {
    if (confirm(text)) {
        return true;
    } else {
        return false;
    }
}