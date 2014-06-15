<?php
//html code for creating an activity.
echo "
<form name='form1' method='post' action='change_password_go.php'>
<h2>Password Change</h2><br>
<hr>
<table width='400' border='0'>
<tr>
<td align='center'>your UserName</td>
<td><input name='username' type='text' id='username' size='20'></input></td>
</tr>
<tr>
<td align='center'>old password</td>
<td><input name='old' type='password' id='old' size='20'></input></td>
</tr>
<tr>
<td align='center'>new password</td>
<td><input name='new' type='password' id='new' size='20'></input></td>
</tr>
<tr>
<td align='center'>confirm new password</td>
<td><input name='confirm' type='password' id='confirm' size='20'></input></td>
</tr>
</table>
<button id='Change' type=submit class='btn btn-primary'>Save</button>
</form>"
?>