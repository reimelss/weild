(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/" + besclwp_fb_vars.besclwp_fb_language + "/sdk.js#xfbml=1&version=v2.8&appId=" + besclwp_fb_vars.besclwp_fb_id;
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));