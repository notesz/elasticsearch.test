<?php
namespace ElasticTest\Modules\Cli\Tasks;

class MainTask extends \Phalcon\Cli\Task
{
    public function mainAction()
    {
        echo PHP_EOL;
        echo '-----------------' . PHP_EOL;
        echo 'ElasticsearchTest' . PHP_EOL;
        echo '-----------------' . PHP_EOL;
        echo PHP_EOL;
        echo 'Available commands:' . PHP_EOL;
        echo '  run process          Generate contents';
        echo PHP_EOL;
    }

}
