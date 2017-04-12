<?php
/**
 * Created by PhpStorm.
 * User: ryabchikova
 * Date: 28.03.2017
 * Time: 11:52
 */

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

class APLS_CatalogItemDetailsServiceCenters {

    private $property = array();
    private $imgPathServer;
    private $imgPath;
    private $dataServiceCenters;
    const HLBL_ID = "3";
    private $error = array();

    public function __construct($property) {
        $this->imgPathServer = "http://".$_SERVER["SERVER_NAME"]."/apls_resources/service_centers/logos/";
        $this->imgPath = $_SERVER["DOCUMENT_ROOT"]."/apls_resources/service_centers/logos/";
        $this->property = $property;
        $this->getServiceCenters();
    }

    private function getServiceCenters() {
        if (CModule::IncludeModule('iblock')) {
            $this->getDataServiceCentersHLBl();
            $this->getHTMLServiceCenters();
        }
    }

    private function getDataServiceCentersHLBl() {
        CModule::IncludeModule("highloadblock");
        $hlblock = HL\HighloadBlockTable::getById(self::HLBL_ID)->fetch();
        if (!empty($hlblock)) {
            $entity = HL\HighloadBlockTable::compileEntity($hlblock);
            $entity_data_class = $entity->getDataClass();
            try {
                $rsData = $entity_data_class::getList(
                    array(
                        'select' => array('*'),
                        'filter' => array('UF_XML_ID' => $this->property)
                    )
                );
                $this->dataServiceCenters = $rsData->fetch();
            } catch (Exception $e) {
                $this->error[] = "Выброшено исключение: ".  $e->getMessage(). "\n";
            }
        } else {
            $this->error[] = "Не найден Highload Block с ID ".HLBL_ID;
        }
    }

    private function getStringText($adress) {
        $Adress = str_replace("---// ","",$adress);
        $Adress = str_replace("--- // ","",$Adress);
        $Adress = str_replace("// ","|",$Adress);
//        $Adress = str_replace("// ","<br />",$Adress);
        $adresServiceCenter = nl2br($Adress);
        return $adresServiceCenter;
    }

    private function GetUnitsIMG() {
        $IMG_URL_exists = $this->imgPath.$this->dataServiceCenters["UF_KOD"];
        if(!file_exists($IMG_URL_exists.".png")) {
            if(!file_exists($IMG_URL_exists.".jpg")) {
                return "";
            } else {
                $ex = ".jpg";
            }
        } else {
            $ex = ".png";
        }
        return "<img class='ServiceCentersLogo_1' src='".$this->imgPathServer.$this->dataServiceCenters["UF_KOD"].$ex."'>";
    }

    private function getHTMLServiceCenters() {
        $this->html = "";
        if (empty($this->error) && $this->dataServiceCenters["UF_ADRES"] != "" && $this->dataServiceCenters["UF_ADRES"] != null) {
            $this->html .= "<div class='productDetailsWrapper advantages'>";
            $this->html .= "<h3 class='elementServiceCenter'>Сервисный центр</h3>";
//            $this->html .= "<div class='availableServices'>".$this->dataServiceCenters["UF_NAME"]."</div>";
            $this->html .= "<div class=' elementServiceCenterText'>";
//            $this->html .= $this->dataServiceCenters["UF_ADRES"];
            $this->html .= $this->getStringText($this->dataServiceCenters["UF_ADRES"]);
            $this->html .= "</div>";
            $this->html .= "<div class=' elementServiceCenterText'>";
//            $this->html .= $this->GetUnitsIMG();
            $this->html .= "</div>";
            $this->html .= "</div>";
        }
    }

    public function getHtml() {
        return $this->html;
    }

    public function get() {
        echo $this->html;
    }

    public function var_dump_error() {
        if(!empty($this->error)) {
            var_dump($this->error);
        }
    }

}
