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
if (in_array($_POST['email_form'], $email)) 
{
    echo json_encode(['status' => false, 'msg' => 'Пользователь с e-mail "'.$_POST['email_form'].'" уже существует.']);
}
elseif($_POST['category_form']== 'none')
{
    echo json_encode(['status' => false, 'msg' => 'Необходимо выбрать категорию пользователя']);
}
else
{
    $user = new CUser;
        $arFields = array(
            'NAME'             => $_POST['name_form'],
            'UF_BREND'         => $_POST['brend_form'],
            'UF_SOCIAL_HREF'   => $_POST['social_form'],
            'UF_PHONE'         => $_POST['phone_form'],
            'UF_PRED'          => $_POST['part_p_form'],
            'UF_CATEGORY'      => $_POST['category_cont_form'],
            'LAST_NAME'        => $_POST['surname_form'],
            'EMAIL'            => $_POST['email_form'],
            'UF_CITY'          => $_POST['city_form'],
            'UF_INSTA'         => $_POST['insta_form'],
            'UF_UP'            => $_POST['up_form'],
            'UF_HOBBY'         => $_POST['hobby_form'],
            'UF_SKILLS'        => $_POST['skills_form'],
            'LOGIN'            => $_POST['login_form'], // минимум 3 символа
            'LID'              => 'ru',
            'ACTIVE'           => 'Y',
            'PASSWORD'         => $_POST['password_form'], // минимум 6 символов
            'CONFIRM_PASSWORD' => $_POST['password_form'],
            'GROUP_ID'         => array($_POST['category_form']),
        );


    $ID = $user->Add($arFields);

    if ((int)$ID > 0) 
    {
        echo json_encode(['status' => true, 'msg' => 'Пользователь '.$_POST['login_form'].' успешно зарегистрирован!']);
            CModule::IncludeModule('highloadblock'); // подключаем модуль HL блоков
            $hlblock_id = 2; // ID вашего Highload-блока, TOP
            $hlblock   = Bitrix\Highloadblock\HighloadBlockTable::getById( $hlblock_id )->fetch(); // получаем объект вашего HL блока
            $entity   = Bitrix\Highloadblock\HighloadBlockTable::compileEntity( $hlblock );  // получаем рабочую сущность
            $entity_data_class = $entity->getDataClass(); // получаем экземпляр класса
            $entity_table_name = $hlblock['TABLE_NAME']; // присваиваем переменной название HL таблицы
            $sTableID = 'tbl_'.$entity_table_name; // добавляем префикс и окончательно формируем название
            $arData = Array(
                'UF_TOP_USER_ID' => (int)$ID,
                'UF_TOP_MEAN' => 0,
                // 'UF_FILE' => CFile::MakeFileArray($el['logo_img']),
                    );
            $result = $entity_data_class::add($arData);
    } 
    else 
    {
        echo json_encode(['status' => false, 'msg' => 'Не удалось добавить пользователя. Причина — '.$user->LAST_ERROR]);
    }
}

