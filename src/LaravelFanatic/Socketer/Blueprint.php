<?php
namespace LaravelFanatic\Socketer;

use Illuminate\Filesystem\Filesystem;

class Blueprint{
    function __construct(Filesystem $files){
        $this->files = $files;
    }
    function load()
    {
        $code = PHP_EOL.$this->files->get(app_path().'/blueprint.php');
        $code = preg_replace('/<\?php/', '', $code);
        return $code;
    }
}
