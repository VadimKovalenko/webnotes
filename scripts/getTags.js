!doctype html
<title>Onkeyup test</title>
<script>
function getTags() {
 if (login.length < 3) document.getElementById("e_login").style.display = "inline";
    else document.getElementById("e_login").style.display = "none";
}
</script>
<html>
<body>
<form name="myform" action="#" method="post">
  <p>?????: <input type="text" name="login" onkeyup="check(this.value)" /> <span id="e_login" style="display: none; color: #c00;">????? ?????? ???????????</span></p>
</form>
</body>
</html>