<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
			<div style="<?=$page_login?>">
						<img class="chat-click " src="<?=SITE_TEMPLATE_PATH?>/img/icons/chatbg.png">
						<img class="chat-click chat-ico" src="<?=SITE_TEMPLATE_PATH?>/img/icons/chatico.png">
			</div>	
		</div>

		<footer style="<?=$page_login?>">
			<div class="container">
				<div class="row">
					<div class="col-12 text center">
						<h3 class="text-center">(C) WASTED CLUB</h3>
					</div>
				</div>
			</div>
		</footer>

<script type="text/javascript">
	//открытие мобильного меню
	$('#burger-close').hide();
	$('#burger').click(function(){
		$('#burger-close').show();
		$('#burger').hide();
		$('.mobile-menu-bg').show("slow");
		$('.mobile-menu-login, .mobile-menu-menu').show("slow");
	});
	//close
	$('#burger-close').click(function(){
		$('#burger').show();
		$('#burger-close').hide();
		$('.mobile-menu-login, .mobile-menu-menu').hide();
		$('.mobile-menu-bg').hide("slow");
	});
	//открытие чата
	$('.chat-click').click(function(){
		$('.chat-click').hide("slow");
		$('.chat-n-bg, .chat-chat, .chat-message-panel, .chat-login, .chat-text').show();
		$('.chat-bg').show("slow");
		$('body').css('overflow', 'hidden');
		var div = $("#chat-content");
		div.scrollTop(div.prop('scrollHeight'));
	});
	//закрытие чата
	$('#chat-close').click(function(){
		$('.chat-click').show("slow");
		$('.chat-n-bg, .chat-chat, .chat-message-panel, .chat-login, .chat-text').hide();
		$('.chat-bg').hide("slow");
		$('body').css('overflow', 'auto');
	});
		
	

	//Подсветка текущего раздела меню
	function svg(page) {
		page = page.replace('/', '');
		page = page.replace('/', '');
		$('#' + page + ' img').attr('class', 'svg-active');
		$('#' + page + ' p').attr('class', 'svg-active-p');
	}
	svg('<?=$page?>');
	jQuery('img.svg-active').each(function() {
		var $img = jQuery(this);
		var imgID = $img.attr('id');
		var imgClass = $img.attr('class');
		var imgURL = $img.attr('src');
		jQuery.get(imgURL, function(data) {
			var $svg = jQuery(data).find('svg');
			if(typeof imgID !== 'undefined') {
				$svg = $svg.attr('id', imgID);
			}
			if(typeof imgClass !== 'undefined') {
				$svg = $svg.attr('class', imgClass + ' replaced-svg');
			}
			$svg = $svg.removeAttr('xmlns:a');
			$img.replaceWith($svg);
		}, 'xml');
	});
	// ----------------------------------------------------------------

	//Поля форм
		var $inputItem = $(".js-inputWrapper");
		$inputItem.length && $inputItem.each(function() {
		  var $this = $(this),
		      $input = $this.find(".formRow--input"),
		      placeholderTxt = $input.attr("placeholder"),
		      $placeholder;
		  
		  $input.after('<span class="placeholder">' + placeholderTxt + "</span>"),
		  $input.attr("placeholder", ""),
		  $placeholder = $this.find(".placeholder"),
		  
		  $input.val().length ? $this.addClass("active") : $this.removeClass("active"),
		      
		  $input.on("focusout", function() {
		      $input.val().length ? $this.addClass("active") : $this.removeClass("active");
		  }).on("focus", function() {
		      $this.addClass("active");
		  });
		});
</script>
<? 
	$fogot = $_GET['fogot'];
	$secret = $_GET['secret'];
	if ($fogot == 'pass') 
	{
		?>
			<script type="text/javascript">
				//считывание секретного кода ссылки для восстановления пароля
					$('.password_email').click(); 
					$('.form-password_email_complete').show(); 
					$('.form-password_email').hide(); 
					$('#secret_code').val("<?=$secret?>");
				//---------------------------------------------------------------- 
			</script>
		<?
	}

?>

<script type="text/javascript">
	//ajax загрузка сообщений чата
	function chat_get_mes() //подключение связи с файлом php получения сообщений
	{
		$.ajax({
		url: "<?=SITE_TEMPLATE_PATH?>/include/ajax/chat_get_content.php", // откуда берем данные
		cache: false,  // не кэшируем
		success: function(html)
			{  
				$("#chat-content").html(html);  
			}  
		});  
	}
	function chat_get_mes2() //подключение связи с файлом php получения сообщений
	{
		$.ajax({
		url: "<?=SITE_TEMPLATE_PATH?>/include/ajax/chat_get_content.php", // откуда берем данные
		cache: false,  // не кэшируем
		success: function(html)
			{  
				$("#chat-content").html(html);  
				//прокрутка вниз
				var div = $("#chat-content");
				div.scrollTop(div.prop('scrollHeight'));
			}  
		});  		
	}
	function ajax_chat_repeat()//повторение функции вызова чата
	{
	 setInterval(chat_get_mes, 10000);
	}
	chat_get_mes();//первая загрузка при открытии страницы

	ajax_chat_repeat();//постоянное обновление чата (раз в 5 секунд)
	//----------------------------
	//отправка сообщений чата
	$('#new-chat-message form').on('submit', function (event) {
        event.preventDefault();
        var t = $(this);
        var action = t.attr('action');
        var data = t.serialize();
        $.ajax({
            type: "POST",
            url: action,
            data: data,
            success: function (html) {
            $('#new-chat-message2').val(''); 

               chat_get_mes2();                              
            }
        });
        
    });

</script>
	</body>
</html>