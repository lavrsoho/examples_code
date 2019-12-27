<?php
# bitrix/admin/custom.php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
?>
    <?
    require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
    ?>
    <?

    ?>
    <h3>Файл
    <?
        echo ($_POST['part'])." ";
    ?>
     из
    <?
        echo $_POST['file_inputs']."<br>";
        $width = (100/$_POST['file_inputs'])*($_POST['part']).'%';
        echo $width;
    ?><br> 
    Не закрывайте страницу до окончания загрузки
    </h3>
    <div class="pr">
        <div class="progress-bar" style="width: <?=$width?>;">
            
         </div>
    </div>
    
    <style type="text/css">
        .progress-bar
        {
            background-color: #4953c0;
            height: 100%;
        }
        .pr
        {
            border: 2px solid grey;
            width: 300px;
            height: 30px;
        }
    </style>
    <!--<button id="pause">Пауза</button>-->
<?
if($_POST['file_inputs']>=($_POST['part']+1))
{
    $handle = fopen($_SERVER['DOCUMENT_ROOT']."/importcsv/somefile".($_POST['part']+1).".csv", "r");
    if ($handle) {
        $counter = 0;
        $keys = array();
        $data = array();
        while (($buffer = fgets($handle)) !== false) {
            $counter++; 

            //удаляем из прочитанной строки все символы переноса
            $buffer = str_replace(array('r\n', '\r', '\n'), ' ', $buffer);

            $str = str_getcsv($buffer, $delimiter = ';', $enclosure = '"');
            //print_r($a);
           //echo '<br>';
               // $str =explode(";", $buffer);
            if ($counter==1){
                
                $keys = $str;
            }
            else{
                
                $el = array();
                foreach ($str as $key=>$item){
                    $el[$keys[$key]] = $item;
                }
                $data[] = $el;
            }
                    }
                    // echo '<br>-)))';
                    // print_r($el);
        if (!feof($handle)) {
            echo "Error: unexpected fgets() fail\n";
        }
        fclose($handle);
        
        $intIblockDest = $_POST['IDIBLOCK'];


        $IBLOCK_ID    = $intIblockDest;
        $arFilter    = Array(
              'IBLOCK_ID'=>$IBLOCK_ID, 
              'GLOBAL_ACTIVE'=>'Y');
        $obSection    = CIBlockSection::GetTreeList($arFilter);

        while($arResult = $obSection->GetNext()){
           for($i=0;$i<=($arResult['DEPTH_LEVEL']);$i++)
            // echo "..";
            //  echo $arResult['NAME'].'<br>';
           
            $masiive_section[$arResult['DEPTH_LEVEL']][$arResult['NAME']][$arResult['SORT']] = $arResult['ID'];
            //echo $arResult['NAME'];
            

        }
        print_r($masiive_section);
        CModule::IncludeModule("iblock");
       // echo print_r($data)."<br>";
         $massive_name = array_keys($el);
            $massive_name_count = count($massive_name);
            $k = 6;
            $z = 0;
            $massive_zg = array();
            
            while ( $k <= $massive_name_count) 
            {
                // if ($el[$massive_name[$k]] != "")
                // {
                //     $el["harakteristik"] = $el["harakteristik"].'<br>'.$massive_name[$k].' ' .$el[$massive_name[$k]];
                // }
                //Выделение общих заголовков в массив
                $massive_name1[$k] = explode(' - ',$massive_name[$k]);
                if (in_array($massive_name1[$k][0], $massive_zg[0])) 
                {

                }
                else
                {
                   $massive_zg[0][$z] = $massive_name1[$k][0]; 
                   $z++;
                }

                $k++;
            }
            //print_r($massive_zg);
            $el['harakteristik'] = "";
         foreach ($data as $key=>$el)
         {
            // $el['page_cat_1'] = trim($el['page_cat_1'], '\n');
            // $el['page_cat_2'] = trim($el['page_cat_2'], '\n');
            // $el['page_cat_3'] = trim($el['page_cat_3'], '\n');
            // $el['device_desc'] = trim($el['device_desc'], '\n');
            // $el['device_name'] = trim($el['device_name'], '\n');
            
            $k = 6;
            $z = 0;
            $count_massive_zg = count($massive_zg[0]);
            $b = 0;
            while ( $k <= $massive_name_count) 
            {
                $massive_name2[$k] = explode(' - ', $massive_name[$k]);
                $l = 0;

                while ($l <= $count_massive_zg)
                {
                    
                    if ($massive_zg[0][$l] == $massive_name2[$k][0])
                    {
                        
                        $massive_zg[1][$l][$b] = $massive_name2[$k][1];
                        if ($el[$massive_name[$k]] != "")
                        {
                            $massive_zg[1][$l][$b] = '<strong>'.$massive_zg[1][$l][$b].':</strong> '.$el[$massive_name[$k]].'<br>';
                            //$el["harakteristik"] = $el["harakteristik"].'<br>'.$massive_name[$k].' ' .$el[$massive_name[$k]];
                        }
                        else
                        {
                           // $massive_zg[1][$l][$b] = '<strong style="display:none;">'.$massive_zg[1][$l][$b].':</strong><br>';
                            $massive_zg[1][$l][$b] = 'none';
                        }
                       
                        $b++;
                    }
                    $l++;
                }
                $k++;
            }
            


           // echo "<br>".$count_massive_zg;
            //print_r($massive_zg);
            //print_r($massive_name)."<br>";
            

            echo "<br>номер элемента: ".($key+1)."<br>";
            echo "id: ".$el['﻿device_id']."<br>";
            echo "название: ".$el['device_name']."<br>";
            echo "описание:".$el['device_desc']."<br>";
            echo "характеристики:".$el['harakteristik']."<br>";
            echo "название раздела 1-го(верхнего) уровня: ".$el['page_cat_1']."<br>";
            echo "название раздела 2-го(среднего) уровня: ".$el['page_cat_2']."<br>";
            echo "название раздела 3-го(нижнего) уровня: ".$el['page_cat_3']."<br>";

            $level_1 = 0;
            $level_2 = 0;
            $level_3 = 0;
            $level_level = 0;
            while ($level_1 <= $count_massive_zg)//проход по заголовкам
            {
                
                $level_2_max = count($massive_zg[1][$level_1]) + $level_level;
                $level_level = $level_2_max;
                $el['harakteristik']=$el['harakteristik'].'<div id="he'.$level_1.'" class="zg-har"><h3>'.$massive_zg[0][$level_1].'</h3><div class="zg-litle">';
                while ($level_2 <= $level_2_max)
                {
                    if (($massive_zg[1][$level_1][$level_2] != 'none')&&($massive_zg[1][$level_1][$level_2] != "") )
                    {
                        // echo '<h3>'.$massive_zg[0][$level_1].'</h3>';
                        // echo '<h4>'.$massive_zg[1][$level_1][$level_2].'</h4>';
                        $el['harakteristik'] = $el['harakteristik'].'<h4 id="e'.$level_1.'"  style="padding-left:15px">'.$massive_zg[1][$level_1][$level_2].'</h4>
                        <style>
                            #he'.$level_1.'
                            {
                                display:block !important;
                            }
                        </style>
                        ';
                       
                    }
                    $level_2++;
                }
                $el['harakteristik']=$el['harakteristik'].'</div></div>';
                $level_1++;
            }
             echo $el['harakteristik'];
             print_r($masiive_section);
            if ( $el['device_type_1'] != "")
            {
                if ((array_key_exists($el['device_type_1'], $masiive_section[1]))&&(array_key_exists(101, $masiive_section[1][$el['device_type_1']])))//проверка раздела верхнего уровня
                {
                    echo "родительский раздел элемента уже существовал<br>";
                }
                else
                {
                    $bs = new CIBlockSection;//добавление верхнего раздела
                    $arFields = Array(
                      "ACTIVE" => "Y",
                      "IBLOCK_SECTION_ID" => false, //создаем в корне ИБ
                      "IBLOCK_ID" => $intIblockDest,
                      "NAME" => $el['device_type_1'],//название секции, в данном случае == названию элемента ИБ
                      "SORT" => 101,
                      );
                 
                    //собственно само создание секции
                    $ID = $bs->Add($arFields);
                    $masiive_section[1][($el['device_type_1'])] = $ID;
                    echo "родительский раздел элемента был успешно создан<br>";
                }
                if ( $el['page_cat_1'] != "")
                {
                    if ((array_key_exists($el['page_cat_1'], $masiive_section[2]))&&(array_key_exists(102, $masiive_section[2][$el['page_cat_1']])))//проверка раздела среднего уровня
                    {
                        echo "средний раздел элемента уже существовал<br>";
                    }
                    else
                    {
                        $bs = new CIBlockSection;//добавление верхнего раздела
                        $arFields = Array(
                          "ACTIVE" => "Y",
                          "IBLOCK_SECTION_ID" => $masiive_section[1][($el['device_type_1'])], //создаем в корне ИБ
                          "IBLOCK_ID" => $intIblockDest,
                          "NAME" => $el['page_cat_1'],//название секции, в данном случае == названию элемента ИБ
                          "SORT" => 102,
                          );
                     
                        //собственно само создание секции
                        $ID = $bs->Add($arFields);
                        $masiive_section[2][($el['page_cat_1'])] = $ID;
                        echo "средний раздел элемента был успешно создан<br>";
                    }
                    if ( $el['page_cat_2'] != "")
                    {
                        if ((array_key_exists($el['page_cat_2'], $masiive_section[3]))&&(array_key_exists(103, $masiive_section[3][$el['page_cat_2']])))//проверка раздела нижнего уровня
                        {
                            echo "нижний раздел элемента уже существовал<br>";
                        }
                        else
                        {
                            // $arSection = Array
                            // (
                            //     1 => $masiive_section[1][($el['page_cat_1'])],
                            //     2 => $masiive_section[2][($el['page_cat_2'])]
                            // );
                            $bs = new CIBlockSection;//добавление верхнего раздела
                            $arFields = Array(
                              "ACTIVE" => "Y",
                              "IBLOCK_SECTION_ID" => $masiive_section[2][($el['page_cat_1'])], //создаем в корне ИБ
                              "IBLOCK_ID" => $intIblockDest,
                              "NAME" => $el['page_cat_2'],//название секции, в данном случае == названию элемента ИБ
                              "SORT" => 103,
                              );
                         
                            //собственно само создание секции
                            $ID = $bs->Add($arFields);
                            $masiive_section[3][($el['page_cat_2'])] = $ID;
                            echo "нижний раздел элемента был успешно создан<br>";
                        }
                        if ( $el['page_cat_3'] != "")
                        {
                            if ((array_key_exists($el['page_cat_3'], $masiive_section[4]))&&(array_key_exists(104, $masiive_section[4][$el['page_cat_3']])))//проверка раздела нижнего уровня
                            {
                                echo "нижний раздел элемента уже существовал<br>";
                            }
                            else
                            {
                                // $arSection = Array
                                // (
                                //     1 => $masiive_section[1][($el['page_cat_1'])],
                                //     2 => $masiive_section[2][($el['page_cat_2'])]
                                // );
                                $bs = new CIBlockSection;//добавление верхнего раздела
                                $arFields = Array(
                                  "ACTIVE" => "Y",
                                  "IBLOCK_SECTION_ID" => $masiive_section[3][($el['page_cat_2'])], //создаем в корне ИБ
                                  "IBLOCK_ID" => $intIblockDest,
                                  "NAME" => $el['page_cat_3'],//название секции, в данном случае == названию элемента ИБ
                                  "SORT" => 104,
                                  );
                             
                                //собственно само создание секции
                                $ID = $bs->Add($arFields);
                                $masiive_section[4][($el['page_cat_3'])] = $ID;
                                echo "нижний раздел элемента был успешно создан<br>";
                            }
                        }
                        else
                        {
                            $masiive_section[4][$el['page_cat_3']] = "";
                        }
                    }
                    else
                    {
                        $masiive_section[3][$el['page_cat_2']] = "";
                        $masiive_section[4][$el['page_cat_3']] = "";
                    }
                }
                else
                {
                    $masiive_section[2][$el['page_cat_1']] = "";
                    $masiive_section[3][$el['page_cat_2']] = "";
                    $masiive_section[4][$el['page_cat_3']] = "";
                }
            }
            else
            {
                $masiive_section[1][$el['device_type_1']] = "";
                $masiive_section[2][$el['page_cat_1']] = "";
                $masiive_section[3][$el['page_cat_2']] = "";
                $masiive_section[4][$el['page_cat_3']] = "";

            }
            

            $bs = new CIBlockElement;
        //     //значение "не показывать комментарий"
        //     $status = '1';
        //     if ($el['status_com']=='On'){
        //         //значение "показывать комментарий"
        //         $status = '2';
        //     }

             
        //     $PROP['DATE'] = $el['date_com'];
        //     $PROP['FIO'] = $el['name_com'];
        //     $PROP['MAIL'] = $el['email_com'];
            if ($masiive_section[4][$el['page_cat_3']] != "") 
            {
                $section_result_id = $masiive_section[4][$el['page_cat_3']];
            }
            elseif ($masiive_section[3][$el['page_cat_2']] != "") 
            {
                $section_result_id = $masiive_section[3][$el['page_cat_2']];
            }
            elseif ($masiive_section[2][$el['page_cat_1']] != "") 
            {
                $section_result_id = $masiive_section[2][$el['page_cat_1']];
            }
            elseif ($masiive_section[1][$el['device_type_1']] != "") 
            {
                $section_result_id = $masiive_section[1][$el['device_type_1']];
            }
            else
            {
                $section_result_id = false;
            }
            print_r($masiive_section);
            echo $section_result_id;
            echo 'hellow';
            $PROP = array();
            
            $PROP["TECH_PROP"] = $el['harakteristik'];
            $PROP["price"] = $el['price']; 

    CModule::IncludeModule('highloadblock'); // подключаем модуль HL блоков
    $hlblock_id = 3; // ID вашего Highload-блока
    $hlblock   = Bitrix\Highloadblock\HighloadBlockTable::getById( $hlblock_id )->fetch(); // получаем объект вашего HL блока
    $entity   = Bitrix\Highloadblock\HighloadBlockTable::compileEntity( $hlblock );  // получаем рабочую сущность
    $entity_data_class = $entity->getDataClass(); // получаем экземпляр класса
    $entity_table_name = $hlblock['TABLE_NAME']; // присваиваем переменной название HL таблицы
    $sTableID = 'tbl_'.$entity_table_name; // добавляем префикс и окончательно формируем название
    $arData = Array(
                'UF_XML_ID' => $el['﻿device_id'],
      'UF_NAME' => $el['device_vender'],
      'UF_FILE' => CFile::MakeFileArray($el['logo_img']),
            );
    $result = $entity_data_class::add($arData);
     
    if ($result->isSuccess()) {
      echo 'ID: ' . $result->getId() . "<br />";
      //$kos = $result->getId();
      echo $kos;
    } else {
      echo 'ERROR: ' . implode(', ', $result->getErrors()) . "<br />";
    }
    $PROP["MANUFACTURER"] = $el['﻿device_id'];
            $arFields = Array//параметры элемента
            ( 
               "ACTIVE" => 'Y',
               "IBLOCK_ID" => $intIblockDest,
               "IBLOCK_SECTION" => $section_result_id,
               "NAME" => $el['device_name'],
               "PREVIEW_TEXT" => $el['device_short_descr'],
               "XML_ID" => $el['﻿device_id'],
               "DETAIL_TEXT" => $el['device_desc'],
               "PROPERTY_VALUES"=> $PROP,
               "DETAIL_PICTURE" => CFile::MakeFileArray($el['device_img']),
               "PREVIEW_PICTURE" => CFile::MakeFileArray($el['device_img']),
            );
            $arFilter=Array("=XML_ID"=> $el['﻿device_id']); //Фильтр по внешнему коду



            if (CIBlockElement::GetList(array(), array('IBLOCK_ID' => $intIblockDest,  '=XML_ID' =>  $el['﻿device_id']))->Fetch()) 
            {
                $res = CIBlockElement::GetList(  Array(),   $arFilter,   false,   Array("nPageSize"=>50),   Array("ID"));

                while($ob = $res->GetNextElement())
                {
                 $arFields = $ob->GetFields();
                }
                $PRODUCT_ID = $arFields['ID'];
                //echo $arFields['ID'];
                //$res = $bs->Update($PRODUCT_ID, $arFields);
                //$PROP = array();
                //$PROP[12] = "Белый";  // свойству с кодом 12 присваиваем значение "Белый"
                //$PROP[3] = 38;        // свойству с кодом 3 присваиваем значение 38
                //$el = new CIBlockElement;
                $arLoadProductArray = Array(
                  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
                  "IBLOCK_SECTION" => $section_result_id,      // элемент лежит в корне раздела
                  "PROPERTY_VALUES"=> $PROP,
                  "DETAIL_TEXT" => $el['device_desc'],
                  "PREVIEW_TEXT" => $el['device_short_descr'],
                  "NAME"           => $el['device_name'],
                  "ACTIVE"         => "Y",            // активен
                  "DETAIL_PICTURE" => CFile::MakeFileArray($el['device_img']),
                  "PREVIEW_PICTURE" => CFile::MakeFileArray($el['device_img']),
                  );

                //$PRODUCT_ID = 2;  // изменяем элемент с кодом (ID) 2
                $res = $bs->Update($PRODUCT_ID, $arLoadProductArray);
               echo 'ЭЛЕМЕНТ СУЩЕСТВУЕТ - он был обновлен';
            }
            else
            {
                if($PRODUCT_ID = $bs->Add($arFields))
                {
                    echo $key.'.New ID: '.$PRODUCT_ID.'(XML_ID = '.$el['﻿device_id'].')<br>';
                }
                else
                {
                    echo $key.'.Error: '.$bs->LAST_ERROR.'<br>';
                }
                echo "<br>";
            }
         
         }



         // Вывод дерева разделов
        echo "<br>Дерево разделов инфоблока:<br>";
        $IBLOCK_ID    = $intIblockDest;
        $arFilter    = Array(
              'IBLOCK_ID'=>$IBLOCK_ID, 
              'GLOBAL_ACTIVE'=>'Y');
        $obSection    = CIBlockSection::GetTreeList($arFilter);

        while($arResult = $obSection->GetNext()){
            //echo $arResult['DEPTH_LEVEL'].")";
           for($i=0;$i<=($arResult['DEPTH_LEVEL']);$i++)
            echo "..";
            echo $arResult['DEPTH_LEVEL'].")";
             echo $arResult['NAME'].'<br>';
           
            //$masiive_section[$arResult['DEPTH_LEVEL']][$arResult['NAME']] = $arResult['ID'];
            //echo $arResult['NAME'];
            

        }
         //print_r($masiive_section);
        echo "<br><br>";
    }
    ?>
    <form method="POST" action="modulcsv2.php">
    <input style="display: none" type="text" value="<?=$_POST['file_inputs']?>" name="file_inputs" hidden required>
    <input style="display: none" type="text" value="<?=$_POST['filedirect']?>" name="filedirect" hidden required>
    <input style="display: none" type="text" value="<?=$_POST['part']+1?>" name="part" hidden required>
    <input style="display: none" type="text" name="IDIBLOCK" value="<?=$_POST['IDIBLOCK']?>" hidden required>
    <button id="submit" type="submit">Продолжить</button>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!--     <script type="text/javascript">
        $( document ).ready(function() {
            //$('#pause').click(function(){return false});
            $('#submit').trigger('click');

        });
    </script> -->

<?php

}
else
{
    echo "Импорт завершен";
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");