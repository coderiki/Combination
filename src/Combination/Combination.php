<?php
/**
 * Created by PhpStorm.
 * User: CoDe
 * Date: 04.03.2019
 * Time: 13:08
 */

namespace Combination;

set_time_limit(0);

abstract class Combination
{
    protected $results;     // all result (in recording range)
    protected $tempResult;  // temporary result

    protected $recordingRange;  // recording range

    protected $combinationSize; // Combination of size

    protected $numbers; // number list
    protected $start;   // range start
    protected $end;     // range end
    protected $step;    // range step

    public function __construct()
    {
        $this->results = [];
        $this->tempResult = [];
        $this->numbers = [];

        $this->setNumberRange();
        $this->setRecordingRange(100);
        $this->setCombinationOfSize(6);
    }

    public function setRecordingRange(int $number)
    {
        $this->recordingRange = $number;
        return $this;
    }

    public function setNumberRange($start = 1, $end = 100, $step = 1)
    {
        $this->start = $start;
        $this->end = $end;
        $this->step = $step;

        $this->setNumbers();

        return $this;
    }

    public function setNumbers()
    {
        $this->numbers = range($this->start, $this->end, $this->step);
    }

    public function setCombinationOfSize(int $size)
    {
        $this->combinationSize = $size;
        return $this;
    }

    public function startCombination()
    {
        $data = array();
        $this->combinationUtil($this->numbers, $data, 0, sizeof($this->numbers) - 1, 0, $this->combinationSize);

        $this->save($this->results);
    }

    public function combinationUtil($numbers, $data, $start, $end, $index, $r)
    {
        if ($index == $r) {
            for ($j = 0; $j < $r; $j++) {
                $this->tempResult[$j+1] = $data[$j];
            }
            array_push($this->results, $this->tempResult);
            $this->tempResult = [];
            return;
        }

        if(count($this->results) >= $this->recordingRange) {
            $this->save($this->results);
            $this->results = [];
        }

        for ($i = $start; $i <= $end && $end - $i + 1 >= $r - $index; $i++) {
            $data[$index] = $numbers[$i];
            $this->combinationUtil($numbers, $data, $i + 1, $end, $index + 1, $r);
        }
    }

    /**
     * @param array $results
     * @return mixed
     * Save method
     */
    abstract function save(array $results);
}
