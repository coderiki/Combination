<?php

require_once __DIR__ . '/../src/Combination/Combination.php';

use Combination\Combination;

class SimpleExample extends Combination
{

    public function start()
    {
        self::startCombination();
    }

    public function setValues($start, $end, $step, $combinationSize, $recordingRange)
    {
        self::setNumberRange($start, $end, $step);
        self::setCombinationOfSize($combinationSize);
        self::setRecordingRange($recordingRange);
        return $this;
    }

    /**
     * @param array $results
     * @return mixed
     * Save method
     */
    function save(array $results)
    {
        echo '<pre>';
        print_r($results);
        echo '<hr>';
    }
}

$ex = new SimpleExample();
$ex->setValues(1, 10, 1, 3, 10)->start();