<?
//*******************Чат*************//
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
if (CModule::IncludeModule("iblock")):

	$iblock_id = 6;
	# show url my elements
	$my_elements = CIBlockElement::GetList (
	  Array("ID" => "ASC"),
	  Array("IBLOCK_ID" => $iblock_id),
	  false,
	  false,
	  Array('ID', 'NAME', 'PROPERTY_USER_ID', 'DETAIL_TEXT', 'DATE_CREATE', 'ACTIVE')
	);
	$day = '';//счетчик даты(для обозначения нового дня)
	while($ar_fields = $my_elements->GetNext())
	{
		if($ar_fields['ACTIVE']=='Y')//проверка на активность (удаленные сообщения сохраняются в базе, но неактивны)
		{
			$ID = (int)$ar_fields['PROPERTY_USER_ID_VALUE'];
			$arGroups = CUser::GetUserGroup($ID);
					
			$rsUser = CUser::GetByID($ID);
			$arUser = $rsUser->Fetch();
			$day_key = explode(' ', $ar_fields['DATE_CREATE']);//отделение дня от времени
			if ($day == $day_key[0])//сортировка сообщений по дням
			{
				
			}
			else
			{
				$day = $day_key[0];

				$day = explode('.', $day);//отделения дня,месяца и года
				/*Возможно нужно убрать 0 перед месяцами*/
				if($day[1]=='01') $day[1]='ЯНВ';
				if($day[1]=='02') $day[1]='ФЕВ';
				if($day[1]=='03') $day[1]='МАР';
				if($day[1]=='04') $day[1]='АПР';
				if($day[1]=='05') $day[1]='МАЙ';
				if($day[1]=='06') $day[1]='ИЮН';
				if($day[1]=='07') $day[1]='ИЮЛ';
				if($day[1]=='08') $day[1]='АВГ';
				if($day[1]=='09') $day[1]='СЕН';
				if($day[1]=='10') $day[1]='ОКТ';
				if($day[1]=='11') $day[1]='НОЯ';
				if($day[1]=='12') $day[1]='ДЕК';

				$day = $day[0].' '.$day[1].' '.$day[2].', '.$day_key[1];
				?>
					<div class="chat-new-day w-100 text-center">
						<?=$day?>							
					</div>
				<? 

				$day = $day_key[0];
			}

			global $USER;
			$user_category_id = $USER->GetParam("GROUPS");
			if ($ar_fields['PROPERTY_USER_ID_VALUE'] == ($USER->GetID()))
			{
				$class_user = 'chat-login-my';
			}
			else
			{
				if ($arGroups[0]==1)
				{
					$class_user = 'chat-login-admin';
				}
				else
				{
					$class_user = '';
				}
			}
			?>
			<div class="chat-login <?=$class_user?>" id="login-<?=$ar_fields['ID']?>">
				<img src="<?=SITE_TEMPLATE_PATH?>/img/chat-ico.png">
				<?echo $arUser['NAME'];//имя пользователя?>
			</div>
			<div class="chat-text" id="text-<?=$ar_fields['ID']?>">
				<?echo $ar_fields['DETAIL_TEXT'];//сообщение пользователя?>
				<span>
					<?echo $ar_fields['DATE_CREATE'];//дата создания сообщения?>
					<?if (($user_category_id[0] == 1) or ($ar_fields['PROPERTY_USER_ID_VALUE'] == ($USER->GetID())))
					{
						?>
							<img class="chat-delete" id="delete-<?=$ar_fields['ID']?>" src="<?=SITE_TEMPLATE_PATH?>/img/chat-delete.png">
						<?
					}?>
				</span>
			</div>
		
	<?}
	}
endif;
?>
<script type="text/javascript">
	//удаление сообщения чата
    $('.chat-delete').click(function(){
    	var id = this.id;
    	id = id.replace('delete-','');
    	$.ajax({
			  type: 'POST',
			  url: '<?=SITE_TEMPLATE_PATH?>/include/ajax/chat_delete_message.php',
			  data: 'id='+id,
			  success: function(html){
			    $('#login-'+id+', #text-'+id).hide("slow");    
			  }
			});
    });
</script>				
