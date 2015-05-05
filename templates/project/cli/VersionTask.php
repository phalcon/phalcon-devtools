<?php

class VersionTask extends \Phalcon\CLi\Task
{
    public function mainAction()
    {
        $config = $this->getDI()->get('config');

        echo $config['version'];
    }

}
