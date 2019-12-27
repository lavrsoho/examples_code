<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');
$el = new CIBlockElement;

 $PROP = array();
 $PROP['USER_ID'] = $_POST['USER_ID'];
// $PROP['HIPE'] = 0;
// $PROP['INST_NAME'] = $inst_login;
// $PROP['ID_USERS'] = '';
// $PROP['ID_CREATE'] = $USER->GetID();


$arLoadProductArray = Array(
  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
  "IBLOCK_SECTION_ID" => false,          // элемент лежит в предлооженном
  "IBLOCK_ID"      => 6,
 "PROPERTY_VALUES"=> $PROP,
  "NAME"           => 'сообщение',
  "ACTIVE"         => "Y",            // активен
  "PREVIEW_TEXT"   => $inst_text,
  "DETAIL_TEXT"    => $_POST['new-chat-message'],
 // "DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/image.gif")
  );
if($PRODUCT_ID = $el->Add($arLoadProductArray))
  echo "true";
else
  echo $el->LAST_ERROR;