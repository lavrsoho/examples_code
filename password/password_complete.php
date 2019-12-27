<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context;

$context = Context::getCurrent();
$request = $context->getRequest();
$data = array_map('trim', $_POST);
if (!check_bitrix_sessid() || !$request->isAjaxRequest() || empty($data)) {
    die;
}


	$filter = Array("XML_ID" => $_POST['secret']);
	$sql = CUser::GetList(($by="id"), ($order="desc"), $filter);
	if($sql->NavNext(true, "f_"))
	{

	   $id_user = $f_ID;//id user
	  //далее надо записать его в пользовательское поле
		$user = new CUser;
		$fields = Array(
		  'XML_ID' 			 => '',
		  'PASSWORD'         => $_POST['password_new'], // минимум 6 символов
          'CONFIRM_PASSWORD' => $_POST['password_new'],
		  );
		$user->Update($id_user, $fields);
	   echo json_encode(['status' => true, 'msg' => 'Пароль был успешно изменен']);
	}
	else
	{
		echo json_encode(['status' => false, 'msg' => 'Ошибка, данная ссылка неактуальна']);
	}

	