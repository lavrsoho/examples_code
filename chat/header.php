<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">

		<?$APPLICATION->ShowHead();?>
		<title><?$APPLICATION->ShowTitle();?></title>
		
		<!--подключение файлов-->
		<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" /> 	
		<link href="<?=SITE_TEMPLATE_PATH?>/css/bootstrap.css" rel="stylesheet"><!-- bootstrap v4.0.0-alpha.6 -->
		<link href="<?=SITE_TEMPLATE_PATH?>/css/fonts.css" rel="stylesheet"><!--fonts-->
		<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 
		<!-- Основной файл стилей -->
		<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/owl-carousel/owl.carousel.css">

		
		<!--подключение скриптов-->
    	<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.min.js"></script><!--jQuery v3.3.1 -->
    	<script src="<?=SITE_TEMPLATE_PATH?>/js/bootstrap.min.js"></script>
    	<script src="<?=SITE_TEMPLATE_PATH?>/js/scripts.js"></script><!--Файл для кастомных скриптов-->
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script><!--AJAX 3.1.1-->
  
	</head>
	<body>
		<div class="chat-bg">
			
		</div>
		<div class="chat-n-bg">

		</div>
		<div class="chat-chat">
			<img class="text-center" id="chat-close" status="close" src="<?=SITE_TEMPLATE_PATH?>/img/burger-close.png" style="">
			<div class="chat-message-panel"  id="chat-content" style="overflow: auto;">
				
			</div>
			<div class="chat-message-panel-add" id="new-chat-message">
				<form action="<?=SITE_TEMPLATE_PATH?>/include/ajax/new_message_chat.php">
  					<?= bitrix_sessid_post(); ?>
					<input type="html" placeholder="Введите сообщение..." class="chat-message-input" id="new-chat-message2" name="new-chat-message" required>
					<!-- <input type="submit" name="submit_chat" value="Отправить"> -->
					<button type="submit" class="chat-submit text-center">
						<img src="<?=SITE_TEMPLATE_PATH?>/img/submit-chat.png" >
					</button>
					
					<input type="text" name="USER_ID" value="<?=$USER->GetID()?>" hidden>
				</form>
			</div>
		</div>
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>

		

		<!--Управление адресностью и пользовательскими параметрами-->
		<? require($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/headline.php'); ?>
		
		<!-- Вариант прелоадера <div id="loader-wrapper"> <div class="loader"> <div class="line"></div> <div class="line"></div> <div class="line"></div> <div class="line"></div> <div class="line"></div> <div class="line"></div> <div class="subline"></div> <div class="subline"></div> <div class="subline"></div> <div class="subline"></div> <div class="subline"></div> <div class="loader-circle-1"><div class="loader-circle-2"></div></div> <div class="needle"></div> <div class="loading">Загрузка</div> </div> </div> -->

		<header style="<?=$page_login?>">
			<div class="header-top">
				<div class="container">
					<div class="row">
						<div class="col-9 col-sm-7">
							<!--Логотип-->
							<div class="logo">
								<a href="/">
									<div class="logo-red">
										wasted
									</div>
									<div class="logo-white">
										club
									</div>
								</a>
							</div>
						</div>
						<div class="col-2  d-sm-none">
							<div class="row">
								<img class="burger-menu text-center" id="burger" status="close" src="<?=SITE_TEMPLATE_PATH?>/img/burger.png" >
								<img class="burger-menu text-center" id="burger-close" status="close" src="<?=SITE_TEMPLATE_PATH?>/img/burger-close.png" style="">
							</div>
						</div>
						<div class="col-5  d-sm-block d-none text-right">

							<a id="profil" href='/profil/' class=" text-right top-profil">
								<div>
									<img class="" src="<?=SITE_TEMPLATE_PATH?>/img/icons/Group%20319.svg">
								</div>
								<div>
									<p >
										<?
											global $USER;
											echo $USER->GetLogin();
										?>
									</p>
								</div>
							</a>
						</div>
					</div>
				</div>					
			</div>
			<div class="header-line d-sm-block d-none">

			</div>
			<div class="desctop-menu d-sm-block d-none">

			</div>
			<div class="desctop-menu-ul d-sm-block d-none">
				<div class="container">
					<div class="row">
						<ul class="col-12  text-center">
							<li>
								<a id="mission" href="/mission/" class="text-center">
									<img class="" src="<?=SITE_TEMPLATE_PATH?>/img/icons/main_menu/rfre.svg">
									<p>миссии</p>
								</a>
							</li>
							<li>
								<a id="shop" href="/shop/?sort=" class="text-center">
									<img src="<?=SITE_TEMPLATE_PATH?>/img/icons/main_menu/coin-stack.svg">
									<p>магазин</p>
								</a>
							</li>
							<li>
								<a id="content" href="/content/" class="text-center">
									<img src="<?=SITE_TEMPLATE_PATH?>/img/icons/main_menu/instagram.svg">
									<p>контент</p>
								</a>
							</li>
							<li>
								<a id="garage" href="/garage/" class="text-center">
									<img src="<?=SITE_TEMPLATE_PATH?>/img/icons/main_menu/car-in-garage.svg">
									<p>гараж</p>
								</a>
							</li>
							<li>
								<a id="event" href="/event/" class="text-center">
									<img src="<?=SITE_TEMPLATE_PATH?>/img/icons/main_menu/event.svg">
									<p>события</p>
								</a>
							</li>
							<li>
								<a id="help" href="/help/?name=Все вопросы" class="text-center">
									<img src="<?=SITE_TEMPLATE_PATH?>/img/icons/main_menu/icon.svg">
									<p>помощь</p>
								</a>
							</li>
							<li class="none-padding">
								<a id="top" href="/top/" class="text-center">
									<img src="<?=SITE_TEMPLATE_PATH?>/img/icons/main_menu/Page.svg">
									<p>рейтинг</p>
								</a>
							</li>
						</ul>
					</div>
				</div>					
			</div>
		</header>
		<div class="mobile-menu-bg">

		</div>
		<div class="mobile-menu-login">
			<div class="text-right">
				<a id="profil" href='/profil/' class=" text-right top-profil">
					<div>
						<img class="" src="<?=SITE_TEMPLATE_PATH?>/img/icons/Group%20319.svg">
					</div>
					<div>
						<p >
							<?
								global $USER;
								echo $USER->GetLogin();
							?>
						</p>
					</div>
				</a>
			</div>
		</div>
		<div class="mobile-menu-menu">
			<div class="row">
				<div class="col-12">
					<div class="row">
						<div class="col-6 text-center">
							<a id="mission" href="/mission/" class="text-center">
								<img class="" src="<?=SITE_TEMPLATE_PATH?>/img/icons/main_menu/rfre.svg">
								<p>миссии</p>
							</a>
						</div>
						<div class="col-6 text-center">
							<a id="shop" href="/shop/?sort=" class="text-center">
									<img src="<?=SITE_TEMPLATE_PATH?>/img/icons/main_menu/coin-stack.svg">
									<p>магазин</p>
								</a>
						</div>
					</div>
					<div class="row">
						<div class="col-4 text-center">
							<a id="content" href="/content/" class="text-center">
									<img src="<?=SITE_TEMPLATE_PATH?>/img/icons/main_menu/instagram.svg">
									<p>контент</p>
								</a>
						</div>
						<div class="col-4 text-center">
							<a id="garage" href="/garage/" class="text-center">
									<img src="<?=SITE_TEMPLATE_PATH?>/img/icons/main_menu/car-in-garage.svg">
									<p>гараж</p>
								</a>
						</div>
						<div class="col-4 text-center">
							<a id="event" href="/event/" class="text-center">
									<img src="<?=SITE_TEMPLATE_PATH?>/img/icons/main_menu/event.svg">
									<p>события</p>
								</a>
						</div>
					</div>
					<div class="row">
						<div class="col-6 text-center">
							<a id="help" href="/help/?name=Все вопросы" class="text-center">
									<img src="<?=SITE_TEMPLATE_PATH?>/img/icons/main_menu/icon.svg">
									<p>помощь</p>
								</a>
						</div>
						<div class="col-6 text-center">
							<a id="top" href="/top/" class="text-center">
									<img src="<?=SITE_TEMPLATE_PATH?>/img/icons/main_menu/Page.svg">
									<p>рейтинг</p>
								</a>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="body">		
