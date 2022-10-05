// GLOBAL ALERT
// must be include izi-toast plugin
window.notification = (arg) => {
    iziToast[arg.status]({
        timeout: arg.timeout ?? 3000,
        overlay: arg.overlay ?? true,
        close: arg.close ?? true,
        position: arg.position ?? 'topRight',
        title: '',
        message: arg.msg,
        onClosed: arg.onClosed ?? '',
        buttons: arg.button ?? '',
        theme: arg.theme ?? 'light',
        backgroundColor: arg.backgroundColor ?? '',
    });
}

window.setCookie = function(name, value, hours) {
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

window.getCookie = function(cname) {
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

window.UserSession = function(token) {
  var data;
  $.ajax({
      url: location.origin + "/api/auth",
      headers: {
          'Authorization': 'Bearer ' + token
      },
      async: false,
      method: "get",
      success: function (response) {
        data =  response;
      },
      error: function (response) {

      }
    });

    return data
}
