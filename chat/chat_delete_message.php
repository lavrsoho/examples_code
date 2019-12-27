<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$el_id = $_POST['id'];

CModule::IncludeModule('iblock');
$el = new CIBlockElement;


$arLoadProductArray = Array(
  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
  "IBLOCK_SECTION_ID" => false,          // элемент лежит в предлооженном
  "IBLOCK_ID"      => 6,
  "NAME"           => 'Удаленное сообщение',
  "ACTIVE"         => 'N',            // активен

  );

$PRODUCT_ID = $el_id;  // изменяем элемент с кодом (ID) 2
$res = $el->Update($PRODUCT_ID, $arLoadProductArray);
echo "true";