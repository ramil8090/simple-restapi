<?php
$I = new ApiGuy($scenario);
$I->wantTo('get 403 forbidden error when try to destroy object anonymously');
$I->setHeader('Content-Type', 'application/json');
$I->sendDELETE('/objects/delete/1');
$I->seeResponseCodeIs(403);