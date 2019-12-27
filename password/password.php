<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context;

$context = Context::getCurrent();
$request = $context->getRequest();
$data = array_map('trim', $_POST);
if (!check_bitrix_sessid() || !$request->isAjaxRequest() || empty($data)) {
    die;
}

global $USER;
 
$filter = Array(
    "ACTIVE" => "Y",
);
$email = Array();
$rsUsers = CUser::GetList(($by = "NAME"), ($order = "desc"), $filter);
while ($arUser = $rsUsers->Fetch()) {
    $email[] = $arUser['EMAIL'];
}

/**
 * Ищем если совпадение
 * @param  string $value Искомое значение
 * @param  Array $array Массив исключений
 * @return Boolean        Результат
 */
function strposArray($value, $array){
    $res = false;
 
    foreach ($array as $key) {
        $res = strpos($value, $key) ? true : $res;
    }
 
    return $res;
}
//var_dump($email);
if (in_array($_POST['password_email'], $email)) 
{	 
	$filter = Array("EMAIL" => $_POST['password_email']);
	$sql = CUser::GetList(($by="id"), ($order="desc"), $filter);
	if($sql->NavNext(true, "f_"))
	{

	   $id_user = $f_ID;//id user

	   //генерируем код для восстановления пароля
	   $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
		$permitted_chars = substr(str_shuffle($permitted_chars), 0, 10);
	   // echo $id_user;

		//далее надо записать его в пользовательское поле
		$user = new CUser;
		$fields = Array(
		  'XML_ID' => $permitted_chars,
		  );
		$user->Update($id_user, $fields);
		//$strError .= $user->LAST_ERROR;

		//Формируем ссылку для восстановления пароля
		$site_url="http://".$_SERVER['SERVER_NAME'];
		//$site_url = explode($site_url, '/bitrix/templates/wastedclub/include/ajax/password.php');
		$activation_href=$site_url.'/login/?fogot=pass&secret='.$permitted_chars;



		//Отправляем ссылку
		$subject = "Восстановление пароля на сайте".$site_url;  //тема сообщения
		$message = "Доброго времени суток!!\n
		Ссылка для восстановления пароля:".$activation_href."\n
		Пожалуйста не отвечайте на это письмо, если Вы не запрашивали смену пароля";//содержание сообщения
		mail($_POST['password_email'], "Восстановление пароля на сайте ".$site_url."", $message); 


	    echo json_encode(['status' => true, 'msg' => 'Ссылка для восстановления пароля отправлена на указанный имейл']);
	}
}
else
{
	echo json_encode(['status' => false, 'msg' => 'Введенный e-mail не зарегистрирован']);
}