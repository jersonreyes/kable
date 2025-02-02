<!DOCTYPE HTML>
<!--         

	
	██╗  ██╗ █████╗ ██████╗ ██╗     ███████╗
	██║ ██╔╝██╔══██╗██╔══██╗██║     ██╔════╝
	█████╔╝ ███████║██████╔╝██║     █████╗  
	██╔═██╗ ██╔══██║██╔══██╗██║     ██╔══╝  
	██║  ██╗██║  ██║██████╔╝███████╗███████╗
	╚═╝  ╚═╝╚═╝  ╚═╝╚═════╝ ╚══════╝╚══════╝

	DEVELOPED, DESIGNED, AND HOSTED BY JERSON REYES
	PROPERTY ARTWORK | COPYRIGHT © JERSON REYES 2020
	
	KBOL.GA | CREATIVE COMMONS NC LICENSE

-->
<?php
include ('../php/handler.php');
$following = parseXML('../data/following.xml');

setcookie("user", 1, time() + (86400 * 30) , "/");
$title = '';

if(isset($_GET['id'])) {
	$user_id = $_GET['id'];
	foreach($following as $users){
		foreach($users as $user){
			if($user['id'] == $user_id) {
				$title = $user["name"];
			}
		}
	}
}

$conversing = '';
if (isset($_GET['id'])) {
    $conversing = $_GET['id'];
}	else {
	$found = true;
}

?>
<html>
<head>
	<title><?php if(!empty($title)) echo $title; else {echo 'Messages';}?></title>
	<link rel="SHORTCUT ICON" href="../images/KABLELogo.png"></link>
	<link rel="STYLESHEET" href="../css/main.css"></link>
	<meta property="og:url" content="https://www.kbol.ga/"/>
	<meta property="og:type" content="Social Network"/>
	<meta property="og:title" content="KABLE® Network | Let's Go Global"/>
	<meta property="og:description" content="Welcome to KABLE. Let's Go Global. Start reaching more people today. Sign-up and start sharing."/>
	<meta property="og:image" content="https://www.kbol.ga/images/KABLEBNR.jpg" />
	<meta charset="UTF-8"/>
</head>
<body>
	<div class="wrapper">
		<div class="container">
			<!--
			SIDEBAR (TODO: DAPAT MAG TOGGLE ON MOBILE OR SMALLER SCREENS)
			-->
			<div id="sidebar" class="inline-block">
				<div id="main-sidebar" class="border-right">
					<div id="logo" class="inline-block align-middle">
						<img src="../images/KABLE.png" id="kable-logo-image" class="inline align-middle">
						<div class="inline" id="kable-logo" style="line-height:0;">
							<span class="align-middle logo-text">Kable</span><br/>
							<p id="kable-network">Network</p>
						</div>
					</div>
					<div id="hamburger" class="inline-block align-middle button active" title="Toggle Menu">
						<div></div><div></div>
					</div>
					<div class="spacer"></div>
					<div id="news-feed">
						<p class="small sidebar-section-title">New Feeds</p>
						<a href="../feed/">
							<div class="content">
								<img src="../images/feed.svg" class="sidebar-icons"></img>
								<span>New Feed</span>
							</div>
						</a>
						<a href="../trending/">
							<div class="content">
								<img src="../images/trend.svg" class="sidebar-icons"></img>
								<span>Trending</span>
							</div>
						</a>
						<a href="../following/">
							<div class="highlight content">
								<img src="../images/user.svg" class="sidebar-icons"></img>
								<span>Following</span>
							</div>
						</a>
						<a href="../my-videos/">
							<div class="content">
								<img src="../images/video.svg" class="sidebar-icons"></img>
								<span>Your Videos</span>
								<img src="../images/add.svg" class="sidebar-icons" id="add-video" title="Create Video"></img>
							</div>
						</a>
						<a href="../playlist/">
							<div class="content">
								<img src="../images/list.svg" class="sidebar-icons"></img>
								<span>Playlist</span>
							</div>
						</a>
					</div>
					<hr>
					<div id="following">
						<p class="small sidebar-section-title">Following</p>
						<?php

						foreach ($following as $users) {
							foreach ($users as $user) {
								$name = $user['name'];
								$profile_picture_url = $user['pictureurl'];

								echo ('<div class="content">
								<img src="../' . $profile_picture_url . '" class="story-person-image"></img>
								<span>' . $name . '</span>
								');

								if ($user['activestatus']) {
									echo ('<div class="circle-active inline-block active-status-online"></div>');
								}
								else {
									echo ('<img src="../images/wifi.svg" class="space-left active-status"></img>');
								}
								echo ('
								</div>
								');
							}
						}
						?>
					</div>
				</div>
			</div>
			<!--
			MAIN BODY (RIGHT SIDE)
			-->
			<div id="main-body" class="inline-block">
				<!--
				TOPBAR
				-->
				<div id="top-bar">
					<div class="inline" id="browse" title="Browse">
						<img src="../images/browse.svg" class="topbar-icons align-middle"></img>
						<span class="align-middle" id="browse-text">Browse</span>
						<img src="../images/down.svg" height="10px" class="align-middle button space-left" title="Click to toggle"></img>
					</div>
					<div class="inline" id="search">
						<img src="../images/search.svg" class="topbar-icons align-middle"></img>
						<input id="search-bar" class="align-middle" placeholder="Search Everything"></input>
					</div>
					<div class="inline" id="main-feat">
						<div class="right">
							<div class="inline button">
								<img src="../images/create.svg" class="topbar-icons align-middle" title="Create a new post"></img>
							</div>
							<div class="inline button top-icon">
								<img src="../images/message.svg" class="topbar-icons align-middle" title="Messages"></img>
							</div>
							<div class="inline button top-icon" title="Notifications">
								<img src="../images/bell.svg" class="topbar-icons align-middle"></img>
								<div id="notif-number">2</div>
							</div>
							<div class="inline button top-icon">
								<img src="../images/person.svg" height="40px" class="align-middle" title="Account"></img>
							</div>
						</div>
					</div>
				</div>
				<!--
				BODY CONTENT
				-->
				<div id="body-content" style="padding:0px">
					<div id="chat-container">
						<div id="side-chat" class="inline-block">
							<div class="side-chat-section">Direct Message</div>
							
							<?php 
							include('../php/showconversation.php'); 
							if(!$found)
								echo ('<div class="side-chat-user inline-block"><p class="side-chat-user-time" style="line-height:20px">You may have altered the url. Go to our main page.</p></div>');
							?>
							
						</div>
						
						<div id="main-chat" class="inline-block" style="vertical-align:top;">
							<div>
								<div class="main-chat-name inline">
								<?php
								if(!$found) {
									echo 'No conversations found';
								}	
								if (!isset($_GET['id'])) {
									echo 'Start a conversation';
									exit;
								} 	else {
									foreach ($users as $user) {
										foreach ($user as $person) {
											if ($person['id'] == $_GET['id']) {
												echo $person["first_name"] . ' ' . $person["last_name"];
											}
										}
									}
								}
								?>
								</div>
								<div class="inline-block" style="transform:translateX(300px)">
									<a href="../c/<?php if(isset($_GET['id'])) echo $_GET['id']; ?>">
										<div class="inline main-chat-user-profile button" style="margin-left:0px">
											<img src="../images/user.svg" height="20px">
										</div>
									</a>
									<div class="inline main-chat-user-settings button" style="margin-left:10px">
										<img src="../images/settings.svg" height="20px">
									</div>
								</div>
							</div>
							<div id="chat-area"style="color:White" senderid="<?php echo $_GET['id'];?>">

							<?php include('../php/showmessage.php'); ?>
								<div id="send-area">
									<div id="send-control">
										<form name="chat" id="chat" method="POST">
											<input placeholder="Send a message" name="message" id="message-input"></input>
											<input name="conversing" id="conversing" class="display-none" value="<?php echo $conversing ?>"></input>
											<button id="send-message-btn" name="chat-submit" onclick="SubmitFormData();" type="button">Send</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</body>
	<script src="../js/jquery.min.js"></script>
<script src="../js/main.js"></script>
<script src="../js/updatemessages.js"></script>
<?php
if ($_GET['id'] == $_COOKIE['user']) {
    echo "<script>$('#send-control, .main-chat-user-settings, .main-chat-user-profile').addClass('display-none');
	while (document.getElementsByClassName('main-chat-block')[0]) {
        document.getElementsByClassName('main-chat-block')[0].remove();
    };$('.main-chat-name').append('(You)');</script>";

}
?>
</html>
