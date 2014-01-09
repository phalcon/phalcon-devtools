<?php

class VersionTask extends \Phalcon\CLI\Task
{

    public function mainAction()
    {
        $config = $this->getDI()->get("config");
        echo $config["version"];
    }

}
