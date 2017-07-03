<?php
$I = new ApiGuy($scenario);
$I->wantTo('select object by id by API in XML format');
$I->haveHttpHeader('Content-Type', 'application/xml');
$I->sendGET('objects/view/1');
$I->seeResponseCodeIs(200);
$I->seeResponseIsXml();