<?php 
$I = new ApiGuy($scenario);
$I->wantTo('get array of 30 objects');
$I->haveHttpHeader('Content-Type', 'application/json');
$I->sendGET('objects/list');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeJsonArrayWithCount(30);

$I->wantTo('get second page of array of 30 objects');
$I->haveHttpHeader('Content-Type', 'application/json');
$I->sendGET('objects/list/page/2/perpage/30');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeJsonArrayWithCount(30);

$I->wantTo('get array of objects filtered by neighborhood and get first 30 objects');
$I->haveHttpHeader('Content-Type', 'application/json');
$I->sendGET('objects/list/filter/neighborhood/equal/42/page/1/perpage/30');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeJsonArrayWithCount(30);

$I->wantTo('get array of objects filtered by room_id and order by id DESC');
$I->haveHttpHeader('Content-Type', 'application/json');
$I->sendGET('objects/list/filter/neighborhood/equal/42/page/1/perpage/30/orderby/id');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeJsonArrayWithCount(30);