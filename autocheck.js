jQuery(document).ready(function ($) {
    'use strict';


    //to hook into the event that fires when the scripts are enabled, use script like this:
    $(document).on("cmplzCookieWarningLoaded", myScriptHandler);
    function myScriptHandler() {
        //tag manager
        if (complianz.tm_categories) {
            for (var i = 0; i < complianz.cat_num; i++) {
                if (cmplzGetCookie('cmplz_event_' + i) !== false) $('#cmplz_' + i).prop('checked', true);
            }
        }
        if (cmplzGetCookie('cmplz_all') !== false) $('#cmplz_all').prop('checked', true);
        if (cmplzGetCookie('cmplz_stats') !== false) $('#cmplz_stats').prop('checked', true);
    }

    function cmplzGetCookie(cname) {
        var name = cname + "="; //Create the cookie name variable with cookie name concatenate with = sign
        var cArr = window.document.cookie.split(';'); //Create cookie array by split the cookie by ';'

        //Loop through the cookies and return the cooki value if it find the cookie name
        for (var i = 0; i < cArr.length; i++) {
            var c = cArr[i].trim();
            //If the name is the cookie string at position 0, we found the cookie and return the cookie value
            if (c.indexOf(name) == 0)
                return c.substring(name.length, c.length);
        }

        //If we get to this point, that means the cookie wasn't found, we return an empty string.
        return "";
    }


});