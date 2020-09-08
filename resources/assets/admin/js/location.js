function getFilters(filters){

    for(var key in filters){
        filters[key] = $('#' + key).val();
    }//end for

    return filters;
}


function update(url,filters,wrapperId, contentId){
    var filters = getFilters(filters);
    //console.log(filters);

    //initialize filters
    urlFilters ="?";
    //console.log(filters);
    for (var key in filters) {
        if (filters.hasOwnProperty(key) && filters[key]  ) {
            urlFilters += "&"+ key+"=" + encodeURIComponent(filters[key]);
        }

    }

    $(wrapperId).load(url+ urlFilters +  ' ' + contentId, function (){
        highlightFilter();
        //$('.table').dataTable();

    });
    // console.log(url+ urlFilters + contentId);
    //set url
    console.log(url+urlFilters);
    window.history.pushState("object or string", "Title", url+urlFilters);

}//end update function


function highlightFilter(){
    var urlValues = function () {
        // This function is anonymous, is executed immediately and
        // the return value is assigned to urlValues!
        var query_string = {};
        var query = window.location.search.substring(2);
        var vars = query.split("&");
        for (var i=0;i<vars.length;i++) {
            var pair = vars[i].split("=");
            // If first entry with this name
            if (typeof query_string[pair[0]] === "undefined") {
                query_string[pair[0]] = pair[1];
                // If second entry with this name
            } else if (typeof query_string[pair[0]] === "string") {
                var arr = [ query_string[pair[0]], pair[1] ];
                query_string[pair[0]] = arr;
                // If third or later entry with this name
            } else {
                query_string[pair[0]].push(pair[1]);
            }
        }
        return query_string;
    } ();

//console.log(urlValues);
    for (var key in urlValues){
        if(!urlValues[key])
            continue;

        var $select = $('#'+key);


        $value = urlValues[key];
        $value =    decodeURIComponent($value);

        //console.log($value);
        $option = $select.find('option[value="'+$value +'"]');
        $option.attr('selected','selected');
    }
}//end highlight filter

//get GET vars
$(document).ready(function (){
    highlightFilter();
});

function update_location(){
    url = window.location.href.split('?')[0];
    filters = {'country':"",'city':"",'town':""};
    wrapperId = "#location-w";
    contentId = '#location';
    update(url,filters,wrapperId,contentId);
}

function update_incs(){
    url = window.location.href.split('?')[0];
    filters = {'country':"",'city':"",'town':"",'type':"",'price':""};
    wrapperId = "#incs-w";
    contentId = '#inc';
    update(url,filters,wrapperId,contentId);
}

/**
 * Created by abdelrahman on 7/21/16.
 */
