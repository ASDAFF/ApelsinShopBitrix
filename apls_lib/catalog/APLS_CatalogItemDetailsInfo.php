<?php

class APLS_CatalogItemDetailsInfo
{
    private $html = "";
    const FILLED_PRODUCT = "FILLED_PRODUCT"; // код свойства отвичающего за заполнение товара
    const YES_VALUE = array("true", "Y", "Да");
    const TEXT_TITLE = "Товар оформляется";
    const TEXT_MESAGE = "Характеристики, комплект поставки и внешний вид данного товара могут отличаться от указанных.";

    public function __construct(array $property)
    {
        if (
            !isset($property[self::FILLED_PRODUCT]["VALUE"]) ||
            $property[self::PROMO_TEXT]["VALUE"] == "" ||
            !in_array($property[self::FILLED_PRODUCT]["VALUE"], self::YES_VALUE)
        ) {
            $this->generateHTML();
        }
    }

    private function generateHTML() {
        $this->html = "<div class='not-filled-product'>";
        $this->html .= '<div class="CatalogItemWarningTitle">';
        $this->html .= '<i class="fa fa-warning CatalogItemWarningIcon"></i>';
        $this->html .= self::TEXT_TITLE;
        $this->html .= "</div>";
        $this->html .= '<div class="CatalogItemWarningText">';
        $this->html .= self::TEXT_MESAGE;
        $this->html .= "</div>";
        $this->html .= "</div>";
    }

    public function get() {
        echo $this->html;
    }

    public function getHtml() {
        return $this->html;
    }
}