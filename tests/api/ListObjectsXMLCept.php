<?php
$I = new ApiGuy($scenario);
$I->wantTo('get array of 30 objects');
$I->haveHttpHeader('Content-Type', 'application/xml');
$I->sendGET('objects/list');
$I->seeResponseCodeIs(200);
$I->seeResponseIsXml();
$I->amOnPage('objects/list/filter/neighborhood/equal/42/page/1/perpage/30');
$I->seeNumberOfElements('response',1);

$I->wantTo('get second page of array of 30 objects');
$I->haveHttpHeader('Content-Type', 'application/xml');
$I->sendGET('objects/list/page/2/perpage/30');
$I->seeResponseCodeIs(200);
$I->seeResponseIsXml();
$I->amOnPage('objects/list/filter/neighborhood/equal/42/page/1/perpage/30');
$I->seeNumberOfElements('response',1);

$I->wantTo('get list of items filtered by neighborhood');
$I->haveHttpHeader('Content-Type', 'application/xml');
$I->sendGET('objects/list/filter/neighborhood/equal/42/page/1/perpage/30');
$I->seeResponseCodeIs(200);
$I->seeResponseIsXml();
$I->amOnPage('objects/list/filter/neighborhood/equal/42/page/1/perpage/30');
$I->seeNumberOfElements('response',1);

$I->wantTo('get list of items filtered by room_id and order by id ASC');
$I->haveHttpHeader('Content-Type', 'application/xml');
$I->sendGET('objects/list/filter/room_id/like/10/page/1/perpage/30/orderby/-id');
$I->seeResponseCodeIs(200);
$I->seeResponseIsXml();
$I->amOnPage('objects/list/filter/room_id/like/10/page/1/perpage/30/orderby/-id');
$I->seeNumberOfElements('response',1);
