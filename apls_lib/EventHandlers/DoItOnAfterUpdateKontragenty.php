<?php
/**
 * Created by PhpStorm.
 * User: ryabchikova
 * Date: 21.04.2017
 * Time: 14:01
 */

$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler('', 'KontragentyOnAfterUpdate', 'KontragentyDoItOnAfterUpdate');

function KontragentyDoItOnAfterUpdate ($event) {
    $update = new DoItOnAfterUpdateKontragenty($event);
    $update->executeUpdate();
}

