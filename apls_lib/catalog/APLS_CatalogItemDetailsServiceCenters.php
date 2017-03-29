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

    public function __construct($property) {
        $this->imgPathServer = "http://".$_SERVER["SERVER_NAME"]."/apls_resources/service_centers/logos/";
        $this->imgPath = $_SERVER["DOCUMENT_ROOT"]."/apls_resources/service_centers/logos/";
        $this->property = $property;
    }

    public function getServiceCenters() {
        if (CModule::IncludeModule('iblock')) {
            $this->getDataServiceCentersHLBl();
            $this->getHTMLServiceCenters();
        }
    }

    public function getDataServiceCentersHLBl() {
        CModule::IncludeModule("highloadblock");
        $hlblock = HL\HighloadBlockTable::getById(self::HLBL_ID)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        $rsData = $entity_data_class::getList(
            array(
                'select' => array('*'),
                'filter' => array('UF_XML_ID' => $this->property)
            )
        );
        $this->dataServiceCenters = $rsData->fetch();
    }

    private function getStringText($adress) {
        $Adress = str_replace("---// ","",$adress);
        $Adress = str_replace("--- // ","",$Adress);
        $Adress = str_replace("// ","|",$Adress);
//        $Adress = str_replace("// ","<br />",$Adress);
        $adresServiceCenter = nl2br($Adress);
        return $adresServiceCenter;
    }

    public function GetUnitsIMG() {
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

    public function getHTMLServiceCenters() {
        $this->html = "";
        $this->html .= "<div class='productDetailsWrapper advantages'>";
        $this->html .= "<h3 class='elementServiceCenter'>Сервисный центр</h3>";
//        $this->html .= "<div class='availableServices'>".$this->dataServiceCenters["UF_NAME"]."</div>";
        $this->html .= "<div class=' elementServiceCenterText'>";
//        $this->html .= $this->dataServiceCenters["UF_ADRES"];
        $this->html .= $this->getStringText($this->dataServiceCenters["UF_ADRES"]);
        $this->html .= "</div>";
        $this->html .= "<div class=' elementServiceCenterText'>";
//        $this->html .= $this->GetUnitsIMG();
        $this->html .= "</div>";
        $this->html .= "</div>";
        echo $this->html;
    }

    private function getHtml() {
        return $this->html;
    }

}
