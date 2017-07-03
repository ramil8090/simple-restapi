<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Api extends \Codeception\Module
{
    public function seeJsonArrayWithCount($count)
    {
        $content = $this->getModule('PhpBrowser')->_getResponseContent();
        $content = \GuzzleHttp\json_decode($content);
        $this->assertCount($count, $content);
    }

}
