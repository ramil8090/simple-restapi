<?php 
$I = new ApiGuy($scenario);
$I->wantTo('select object by id by API in JSON format');
$I->haveHttpHeader('Content-Type', 'application/json');
$I->sendGET('objects/view/1');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();