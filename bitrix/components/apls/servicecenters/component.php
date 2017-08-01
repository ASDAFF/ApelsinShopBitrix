<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arResult['EXCEPTION_RODITEL'] = 'ec9371f2-f0be-11e5-80e2-00155d410357';
// подключаем модули
CModule::IncludeModule('iblock');
CModule::IncludeModule('highloadblock');

// необходимые классы
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

require_once($_SERVER["DOCUMENT_ROOT"]."/apls_lib/main/textgenerator/ID_GENERATOR.php");
$arResult['FORM_ID'] = ID_GENERATOR::generateID("APLS-SERVICECENTERS");

$hlbl = !$arParams['HIGHLOAD_ID'] ? 3 : $arParams['HIGHLOAD_ID'];
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$rsData = $entity_data_class::getList(array(
    "select" => array('ID','UF_NAME','UF_ADRES','UF_KOD','UF_RODITEL'),
    "order" => array("UF_NAME" => "ASC"),
    "filter" => array('UF_VYGRUZHATNASAYT'=>'да','UF_POMETKAUDALENIYA'=>'нет','!UF_RODITEL'=>$arResult['EXCEPTION_RODITEL'],'!UF_ADRES'=>"")
));

while($arData = $rsData->Fetch())
{
    $arResult['SERVICE_CENTERS'][$arData['UF_RODITEL']][$arData['ID']]['UF_NAME'] = $arData['UF_NAME'];
    $Adress = str_replace("---// ","",$arData['UF_ADRES']);
    $Adress = str_replace("--- // ","",$Adress);
    $Adress = str_replace("// ","<br />",$Adress);
    $arResult['SERVICE_CENTERS'][$arData['UF_RODITEL']][$arData['ID']]['UF_ADRES'] = nl2br($Adress);
    $arResult['SERVICE_CENTERS'][$arData['UF_RODITEL']][$arData['ID']]['UF_KOD'] = $arData['UF_KOD'];
}

$this->IncludeComponentTemplate();
?>