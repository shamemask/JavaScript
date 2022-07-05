<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
 
        <title>Tuts+ Chat Application</title>
        <meta name="description" content="Tuts+ Chat Application" />
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
    <?php
    session_start();
 
    if(isset($_POST['enter'])){
        
        if($_POST['name'] != ""){
            
            $_SESSION['name'] = (htmlspecialchars($_POST['name']));
        }
        else{
            echo '<span class="error">Please type in a name</span>';
        }
    }
    
    if(isset($_GET['logout'])){ 
     
        //Simple exit message
        $logout_message = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>". $_SESSION['name'] ."</b> has left the chat session.</span><br></div>";
        file_put_contents("log.html", $logout_message, FILE_APPEND | LOCK_EX);
         
        session_destroy();
        header("Location: index.php"); //Redirect the user
    }
    
if(!isset($_SESSION['name'])){
    loginForm();
}
else{
    
?>
        <div id="wrapper">
            <div id="menu">
                <p class="welcome">Welcome, <b><?php echo $_SESSION['name']; ?></b></p>
                <p class="logout"><a id="exit" href="#">Exit Chat</a></p>
            </div>
 
            <div id="chatbox"><?php
    if(file_exists("log.html") && filesize("log.html") > 0){
        
        $contents = file_get_contents("log.html");
        echo $contents;
    }
    ?></div>

            <form name="message" action="">
                <input name="usermsg" type="text" id="usermsg" />
                <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
                
            </form>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            // jQuery Document
            $(document).ready(function () {
                
                $("#exit").click(function(){
        var exit = confirm("Are you sure you want to end the session?");
        if(exit==true){window.location = 'index.php?logout=true';}      
    });
            });
            $("#submitmsg").click(function () {
    var clientmsg = $("#usermsg").val();
    $.post("post.php", { text: clientmsg });
    $("#usermsg").val("");
    return false;
    <?php
session_start();
if(isset($_SESSION['name'])){
    $text = $_POST['text'];
     
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    fclose($fp);
}
?>
});
function loadLog(){		
		var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
		$.ajax({
			url: "log.html",
			cache: false,
			success: function(html){		
				$("#chatbox").html(html); //Insert chat log into the #chatbox div	
				
				//Auto-scroll			
				var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
				if(newscrollHeight > oldscrollHeight){
					$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
				}				
		  	},
		});
	}
    setInterval (loadLog, 2500);

        </script>
        <?php
}
?>
        

    </body>
</html>

<?php

 
function loginForm(){
    echo'
    <div id="loginform">
      <p>Please enter your name to continue!</p>
      <form action="index.php" method="post">
        <label for="name">Name &mdash;</label>
        <input type="text" name="name" id="name" />
        <input type="submit" name="enter" id="enter" value="Enter" />
      </form>
    </div>
    ';
}
?>
