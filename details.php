<?php
ob_start();
session_start();
?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="//www.htmlcommentbox.com/static/skins/bootstrap/twitter-bootstrap.css?v=0" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>Rate My Outfit</title>
<link rel="icon" type="image/png" href="img/colourRate.png" />
</head>
<body>

<img src="img/banner.png" alt="banner" id="banner">

<hr class="hr">
<div id="menu">
<a class="btn" href="index.php"><button type="button" class="menuButton" id="home">HOME</button></a>
<a class="btn" href="myUpload.php"><button type="button" class="menuButton" id="upload">UPLOAD</button></a>
<a class="btn" href="contactus.php"><button type="button" class="menuButton" id="contactus">CONTACT US</button></a>
<?php 
if(isset($_SESSION['loggedin'])) {
?>
<a class="btn" href="logout.php"><button type="button" class="menuButton" id="logout">LOGOUT</button></a>
<?php
} else {
?>
<a class="btn" href="login.php"><button type="button" class="menuButton" id="login">LOGIN</button></a>
<?php
}
?>

</div>
<hr class="hr">

<?php
$array = file("upload.txt");

foreach($array as $line) {
	$data = explode("~/0530/~", $line);
	$title[] = trim($data[1]);
	$description[] = trim($data[2]);
	$uploadImage[] = trim($data[3]);
}

	$id = $_GET['id'];
	echo '<h3 style="text-align:center; font-weight:bold">' . $title[$id] . '</h3></br>';
	echo '<img src="' . $uploadImage[$id]. '" alt="', $uploadImage[$id] , '" class = detailImages>';
	echo '</br></br>';
	echo '<h4 style="text-align:center; font-weight:bold">' . $description[$id] . '</h4></br></br>';


ob_end_flush();
?>

<script type="text/javascript">(function(d, t, e, m){
    
    // Async Rating-Widget initialization.
    window.RW_Async_Init = function(){
                
        RW.init({
            huid: "341562",
            uid: "13c11a416ee1fedccad03ce71ea580c0",
            options: { "style": "oxygen" } 
        });
        RW.render();
    };
        // Append Rating-Widget JavaScript library.
    var rw, s = d.getElementsByTagName(e)[0], id = "rw-js",
        l = d.location, ck = "Y" + t.getFullYear() + 
        "M" + t.getMonth() + "D" + t.getDate(), p = l.protocol,
        f = ((l.search.indexOf("DBG=") > -1) ? "" : ".min"),
        a = ("https:" == p ? "secure." + m + "js/" : "js." + m);
    if (d.getElementById(id)) return;              
    rw = d.createElement(e);
    rw.id = id; rw.async = true; rw.type = "text/javascript";
    rw.src = p + "//" + a + "external" + f + ".js?ck=" + ck;
    s.parentNode.insertBefore(rw, s);
    }(document, new Date(), "script", "rating-widget.com/"));</script>
	
<script>
// This code goes ABOVE the main HTML Comment Box code!
// replace the text in the single quotes below to customize labels.
hcb_user = {
    // L10N
    comments_header : 'Comments',
    name_label : 'Name',
    content_label: 'Enter your comment here',
    submit : 'Comment',
    logout_link : '<img title="log out" src="//www.htmlcommentbox.com/static/images/door_out.png" alt="[logout]" class="hcb-icon"/>',
    admin_link : '<img src="//www.htmlcommentbox.com/static/images/door_in.png" alt="[login]" class="hcb-icon"/>',
    no_comments_msg: 'No one has commented yet. Be the first!',
    add:'Add your comment',
    again: 'Post another comment',
    rss:'<img src="//www.htmlcommentbox.com/static/images/feed.png" class="hcb-icon" alt="rss"/> ',
    said:'said:',
    prev_page:'<img src="//www.htmlcommentbox.com/static/images/arrow_left.png" class="hcb-icon" title="previous page" alt="[prev]"/>',
    next_page:'<img src="//www.htmlcommentbox.com/static/images/arrow_right.png" class="hcb-icon" title="next page" alt="[next]"/>',
    showing:'Showing',
    to:'to',
    website_label:'website (optional)',
    email_label:'email',
    anonymous:'Anonymous',
    mod_label:'(mod)',
    subscribe:'email me replies',
    are_you_sure:'Do you want to flag this comment as inappropriate?',
    
    reply:'<img src="//www.htmlcommentbox.com/static/images/reply.png"/> reply',
    flag:'<img src="//www.htmlcommentbox.com/static/images/flag.png"/> flag',
    like:'<img src="//www.htmlcommentbox.com/static/images/like.png"/> like',
    
    //dates
    days_ago:'days ago',
    hours_ago:'hours ago',
    minutes_ago:'minutes ago',
    within_the_last_minute:'within the last minute',

    msg_thankyou:'Thank you for commenting!',
    msg_approval:'(this comment is not published until approved)',
    msg_approval_required:'Thank you for commenting! Your comment will appear once approved by a moderator.',
    
    err_bad_html:'Your comment contained bad html.',
    err_bad_email:'Please enter a valid email address.',
    err_too_frequent:'You must wait a few seconds between posting comments.',
    err_comment_empty:'Your comment was not posted because it was empty!',
    err_denied:'Your comment was not accepted.',

    //SETTINGS
    MAX_CHARS: 8192,
    PAGE:'', // ID of the webpage to show comments for. defaults to the webpage the user is currently visiting.
    RELATIVE_DATES:true // show dates in the form "X hours ago." etc.
};
</script>
 <div class="rw-ui-container"></div>
 <div id="HCB_comment_box"><a href="http://www.htmlcommentbox.com">Widget</a> is loading comments...</div>
 <link rel="stylesheet" type="text/css" href="//www.htmlcommentbox.com/static/skins/bootstrap/twitter-bootstrap.css?v=0" />
 <script type="text/javascript" id="hcb"> /*<!--*/ if(!window.hcb_user){hcb_user={comments_header:'Guestbook'};} (function(){var s=document.createElement("script"), l=hcb_user.PAGE || (""+window.location).replace(/'/g,"%27"), h="//www.htmlcommentbox.com";s.setAttribute("type","text/javascript");s.setAttribute("src", h+"/jread?page="+encodeURIComponent(l).replace("+","%2B")+"&opts=16862&num=10&ts=1481445535163");if (typeof s!="undefined") document.getElementsByTagName("head")[0].appendChild(s);})(); /*-->*/ </script>
<!-- end www.htmlcommentbox.com -->

</br></br>
</body>

</html>

