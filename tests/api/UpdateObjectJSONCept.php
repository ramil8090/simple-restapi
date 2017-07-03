<?php
$I = new ApiGuy($scenario);
$I->wantTo('get 403 forbidden error when try update object anonymously');
$I->setHeader('Content-Type', 'application/json');
$I->sendPOST('/objects/update/1', json_encode(array(
    "room_id"=> 777,
    "survey_id"=> 777,
    "host_id"=> 777,
    "room_type"=> "Shared room",
    "country"=> "",
    "city"=> "Test City",
    "borough"=> "",
    "neighborhood"=> 42,
    "reviews"=> 10,
    "overall_satisfaction"=> "5.0",
    "accommodates"=> 16,
    "bedrooms"=> "1.0",
    "bathrooms"=> "",
    "price"=> "75.0",
    "minstay"=> "",
    "last_modified"=> "2017-05-15 03:41:59.260172",
    "latitude"=> "36.120369",
    "longitude"=> "-115.212566",
    "location"=> "0101000020E6100000758F6CAE9ACD5CC0E2395B40680F4240"
)));
$I->seeResponseCodeIs(403);