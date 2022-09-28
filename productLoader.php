<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog.php");

if(!CModule::IncludeModule('iblock')) {
    return false;
}

global $USER;

define('IBLOCK_ID', 2);

$arPropertyIblock = [];

$el = new CIBlockElement;

$res = CIBlock::GetProperties(IBLOCK_ID, Array(), Array());
while($ob = $res->Fetch())
{
    $arPropertyIblock[$ob["NAME"]] = $ob["CODE"];
}

$arrItems = json_decode(file_get_contents('example.json'),$associative = true);

$arProperty = [];
foreach ($arrItems as $key => $arItem) {
    foreach ($arItem["Properties"] as $keyProp => $valProp) {
        if (!empty($valProp['Name'])) {
            $val = str_replace(":&nbsp;", "", $valProp['Name']);
            if (isset($arPropertyIblock[$val])) {
                $arrItems[$key]["PROPERTY"][$arPropertyIblock[$val]] = $valProp['Value'];
                $arItem["PROPERTY"][$arPropertyIblock[$val]] = $valProp['Value'];
            } else {
                $arFields = Array(
                    "NAME" => $val,
                    "ACTIVE" => "Y",
                    "CODE" => \CUtil::translit($val . "_" . rand(0, 9999), "ru", []),
                    "PROPERTY_TYPE" => "S",
                    "IBLOCK_ID" => IBLOCK_ID
                );
                $ibp = new CIBlockProperty;
                $PropID = $ibp->Add($arFields);
            }
        }
    }

    $arLoadProductArray = Array(
    "MODIFIED_BY"    => $USER->GetID(),
    "IBLOCK_SECTION_ID" => false,
    "IBLOCK_ID"      => IBLOCK_ID,
    "CODE" => \CUtil::translit($arItem["Name"], "ru", []),
    "PROPERTY_VALUES"=> $arItem["PROPERTY"],
    "NAME"           => $arItem["Name"],
    "ACTIVE"         => "Y",
    "PREVIEW_TEXT"   => "текст для списка элементов",
    "DETAIL_TEXT"    => "текст для детального просмотра",
    "DETAIL_PICTURE" => CFile::MakeFileArray($arItem['PrevPhoto'])
    );

    $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", 'CODE');
    $arFilter = Array("IBLOCK_ID"=>IBLOCK_ID, 'CODE' => $arLoadProductArray['CODE']);
    $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect)->Fetch();
    if($res) {
        $el->Update($res['ID'], $arLoadProductArray);
        $PRODUCT_ID = $res['ID'];
    } elseif($PRODUCT_ID = $el->Add($arLoadProductArray)) {
        echo "New ID: " . $PRODUCT_ID;
    } else {
        echo "Error: " . $el->LAST_ERROR;
    }

    $arFields = Array(
        "PRODUCT_ID" => $PRODUCT_ID,
        "CATALOG_GROUP_ID" => 1,
        "PRICE" => preg_replace("/[^,0-9]/", '', $arItem['priceType'][1]['Price']),
        "CURRENCY" => "RUB",
        "QUANTITY_FROM" => 1,
        "QUANTITY_TO" => 10
    );

    $res = \CPrice::GetList(
        array(),
        array(
            "PRODUCT_ID" => $PRODUCT_ID,
        )
    );

    if ($arr = $res->Fetch()) {
        $result = CPrice::Update($arr["ID"], $arFields);
    } else {
        $result = CPrice::Add($arFields);
    }
}
