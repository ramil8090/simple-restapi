<?php


namespace MySimple\RestApp\Core\Abstracts;


use Squire\Component\Yaml\Yaml;


abstract class AbstractConfiguration
{
    protected $config;
    protected $baseDir;

    function __construct(string $config, $baseDir = __DIR__)
    {
        try {
            $this->config = Yaml::parse(file_get_contents($config));
            $this->baseDir = $baseDir;
            $this->parse();
        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
        }
    }

    protected function parse()
    {
        throw new \Exception('No implementation');
    }

    protected function getBaseDir()
    {
        return $this->baseDir;
    }

    public function getParam($name)
    {
        $config = $this->config[APP_ENVIRONMENT];
        if(false === in_array($name, array_keys($config))) {
            return null;
        }

        return $config[$name];
    }

}