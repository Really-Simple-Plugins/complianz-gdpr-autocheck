    'use strict';
    //to hook into the event that fires when the scripts are enabled, use script like this:
    document.addEventListener("cmplz_cookie_warning_loaded", function() {
        if (cmplzGetCookie('cmplz_marketing') === '') {
            document.querySelectorAll('input.cmplz-marketing').forEach(obj => {
                obj.checked = true;
            });
        }

        if (cmplzGetCookie('cmplz_statistics') === '') {
            document.querySelectorAll('input.cmplz-statistics').forEach(obj => {
                obj.checked = true;
            });
        }

        if (cmplzGetCookie('cmplz_preferences') === '') {
            document.querySelectorAll('input.cmplz-preferences').forEach(obj => {
                obj.checked = true;
            });
        }
    });

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