<?php
function ShowLoginForm() {

?>

<b>Enter Your NickName</b>

<form name="chat" method="post" action="chat.php" target="_top">

<input type="text" name="nick" size="20">

<input type="hidden" name="action" value="enter">

<input type="hidden" name="chat" value="<font color=FF0000><b>Enters the Room</b></font>">

<input type="submit" name="Submit" value="Submit">

</form>

<?php

}

function Login() {

global $chat;

global $nick;



session_start();

session_register("nick", $nick);

?>

<frameset rows="563,62" cols="*">

<frame name="posts" src="chat.php?action=posts&nick=<?php echo $nick; ?>&chat=<?php echo $chat; ?>">

<frame name="form" src="chat.php?action=form&nick=<?php echo $nick; ?>">

</frameset>

<noframes>

<body>

<p>This page uses frames, but your browser doesn't support them.</p>

</body>

</noframes>

</frameset>

<?php

}

function doSubmit()

{

if(document.chatform.chat.value == '') {

alert('Please enter some text!');

document.chatform.chat.focus();

return false;

}

document.chatform.chat.value = '<font color="'+document.chatform.col[document.chatform.col.selectedIndex].text+'">'+document.chatform.chat.value+'</font>';

document.chatform.submit();

document.chatform.chat.value = '';

document.chatform.chat.focus();

return true;

}

function GetInput() {

global $HTTP_SESSION_VARS;

global $chat;

global $nick;

?>



<form onSubmit="return doSubmit" name="chatform" method="post" action="chat.php" target="posts">

<input type="text" name="chat">

<input type="hidden" name="nick" value="<?php echo $nick; ?>">

<input type="button" onClick="doSubmit()" name="Submit" value="Say">

<select name="col">

<option>Black</option>

<option>Red</option>

<option>Green</option>

<option>Blue</option>

<option>Orange</option>

</select>



<input type="button" name="DoFace1" value=" :) " onClick="sendFace(1)">

<input type="button" name="DoFace2" value=" :( " onClick="sendFace(2)">

<input type="button" name="DoFace3" value=" :D " onClick="sendFace(3)">

<input type="hidden" name="action" value="posts">

</form>

<script language="JavaScript">

function sendFace(faceNum)

{

switch(faceNum)

{

case 1:

document.chatform.chat.value = ':)';

break;

case 2:

document.chatform.chat.value = ':(';

break;

case 3:

document.chatform.chat.value = ':D';

break;

}



document.chatform.submit();

document.chatform.chat.value = '';

}

function doSubmit()

{

if(document.chatform.chat.value == '') {

alert('Please enter some text!');

document.chatform.chat.focus();

return false;

}

document.chatform.chat.value = '<font color="'+document.chatform.col[document.chatform.col.selectedIndex].text+'">'+document.chatform.chat.value+'</font>';

document.chatform.submit();

document.chatform.chat.value = '';

document.chatform.chat.focus();

return true;

}

</script>

<?php

}
global $HTTP_SESSION_VARS;

global $chat;

global $nick;

#To make sure our visitor sees all of the newest messages, we add a <meta> tag to the HTML page, which will cause it to refresh itself every ten seconds:

print '<meta http-equiv="refresh" content="10;URL=chat.php?action=posts&nick=<?php echo $nick; ?>">';

#Then we create a connection to the “chat” database and select the “chatScript” table. The results of these functions are stored in the $svrConn and $dbConn variables respectively:

$svrConn = mysql_connect("localhost", "root", "12345") or die("<b>Error:</b> Couldnt connect to database");

$dbConn = mysql_select_db("chat", $svrConn) or die ("<b>Error:</b> Couldnt connect to database");

#You should change the value of “admin” to a valid username for your database. Also, change the value of “password” to a valid password for your database.

#Next, the script checks to see whether or not the user is posting a message. If he/she is, then the $chat variable will hold the message. The $chat variable is automatically created by PHP from the <input type=”text” name=”chat”> form element, which is where we enter the message. An SQL query is executed, which inserts the new message into the database:

if(!empty($chat)) {

$strQuery = "insert into chatScript values(0, '$chat', '$nick')";

mysql_query($strQuery);

}

#Once the new message is inserted into the database, we run a SELECT query to get the twenty most recent posts, which will be ordered based on the “pk_Id’ field in descending order:

$strQuery = "select theText, theNick from chatScript order by pk_Id desc limit 20";

$chats = mysql_query($strQuery);

#The $chats variable will contain the result of the SQL query. We simply loop through those results, displaying each record one at a time:

while($chatline = mysql_fetch_array($chats)) {

print "<b>" . $chatline["theNick"] . ":</b> " . swapFaces($chatline["theText"]) . "<br>";

}

#The actual message is passed to the “swapFaces” function, which replaces “:)”, “:(“ and “:D” with an <img> tag to display the corresponding image for that icon-icon. The swapFaces function looks like this:

function swapFaces($chatLine) {

$chatLine = str_replace(":)", "<img src='smile.gif'>", $chatLine);

$chatLine = str_replace(":(", "<img src='frown.gif'>", $chatLine);

$chatLine = str_replace(":D", "<img src='bigsmile.gif'>", $chatLine);

return $chatLine;

}

#One last thing to mention is that each time a form is submitted, a hidden field named “action” is also passed along with it. This tells the PHP script which function to call. We use an if…else control to redirect our script to the appropriate function, like this:

if (empty($action))

ShowLoginForm();

elseif ($action == "posts")

ShowAddPosts();

elseif ($action == "form")

GetInput();

elseif ($action == "enter")

Login();
?>