import axios from 'axios';
window.$ = window.jQuery = require('jquery');

class Auth {
    constructor () {
        this.token = this.getCookie('__token');
        if (this.token) {
          axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token;
          this.user = this.UserSession();
        }

    }
    login (token, user) {
        this.setCookie('__token', token, 2)
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;

        this.token = token;

        window.location = '/';
    }
    check () {
        return !! this.token;
    }
    logout () {
      this.deleteCookie('__token');
      window.location = '/login';
    }

    setCookie(name, value, hours)
    {
        if (hours)
        {
            var date = new Date();
            date.setTime(date.getTime()+(hours*60*60*1000));
            var expires = "; expires="+date.toGMTString();
        }
        else
        {
            var expires = "";
        }

        document.cookie = name+"="+value+expires+"; path=/";
    }

    getCookie(cname)
    {
      let name = cname + "=";
      let ca = document.cookie.split(';');
      for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return "";
    }

    deleteCookie(cname)
    {
      if( this.getCookie( cname ) ) {
        document.cookie = cname+"=;expires=Thu, 01 Jan 1900 00:00:01 GMT; path=/";
      }
    }

    UserSession()
    {
      var data;
      const self = this;

      $.ajax({
          url: location.origin + "/api/auth",
          headers: {
              'Authorization': 'Bearer ' + this.token
          },
          async: false,
          method: "get",
          success: function (response) {
            data =  response;
          },
          error: function (response) {
            if (response.responseJSON.message == 'Unauthenticated.') {
              self.logout();
            }
          }
        });

        return data
    }
}
export default new Auth();
