function get_url_msg_value(){
    var QueryString = function () {
        // This function is anonymous, is executed immediately and
        // the return value is assigned to QueryString!
        var query_string = {};
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            // If first entry with this name
            if (typeof query_string[pair[0]] === "undefined") {
                query_string[pair[0]] = decodeURIComponent(pair[1]);
                // If second entry with this name
            } else if (typeof query_string[pair[0]] === "string") {
                var arr = [query_string[pair[0]], decodeURIComponent(pair[1])];
                query_string[pair[0]] = arr;
                // If third or later entry with this name
            } else {
                query_string[pair[0]].push(decodeURIComponent(pair[1]));
            }
        }
        return query_string;
    }();
    return QueryString.msg;
}

function show_notification($msg, $className){
    if( $msg == null || $className == null){
        return;
    }
    $.notify($msg, {
        className:$className,
        clickToHide: true,
        autoHide: true,
        globalPosition: 'top center'
    });
}


$(document).ready(function() {
    var $msg_value = get_url_msg_value();
    var $msg = null;
    var $className = null;
    switch ($msg_value){
        case '1':
            $msg = "تم تعديل بيانات الموقع بنجاح";
            $className = "success";
            break;
        case '2':
            $msg = "تم تعديل بيانات الحساب الشخصي بنجاح";
            $className = "success";
            break;
     case '11':
            $msg = "تم الإضافة بنجاح";
            $className = "success";
            break;

    case '12':
            $msg = "تم التعديل بنجاح";
            $className = "success";
            break;

    case '13':
            $msg = "تم الحذف بنجاح";
            $className = "danger";
            break;

    case '100':
            $msg = "تم تعديل حالة خدمة العملاء";
            $className = "danger";
            break;



    }
    //console.log($msg);
    //console.log($msg_value);
    show_notification($msg, $className);


});