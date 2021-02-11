<?php
namespace App\FibonacciClasses;

class FindFibonacci
{
	public $Fnprev;
	public $Fn;
	public $Fnnext;
	public $N;
	public $number;
	public $nearly;

	function __construct($number) {
		$this->number = $number;
		if ($this->number <= 0) {
			$this->nearly = 0;
		} else {
			$this->N = round(log($number * sqrt(5) + 1/2) / log((1 + sqrt(5)) / 2));
			$this->findFibonacci();
		}
	}

	public function findFibonacci($n = false) {
		if ($n) {
			$this->number = $n;
			$this->N = round(log($this->number * sqrt(5) + 1/2) / log((1 + sqrt(5)) / 2));
		}
		$n = $this->N;
		//Matrix A
		$a = 1;
		$b = 1;
		$c = 1;
		$d = 0;
		//Vector R
		$rc = 0;
		$rd = 1;
		while ($n > 0) {
			if ($n % 2 != 0) {
				//R * A
				$tc = $rc;
				$rc = $rc * $a + $rd * $c;
				$rd = $tc * $b + $rd * $d;
			}
			//A * A
			$ta = $a;
			$tb = $b;
			$tc = $c;
			$a = $a * $a + $b * $c;
			$b = $ta * $b + $b * $d;
			$c = $ta * $c + $c * $d;
			$d = $tc * $tb + $d * $d;
			$n = intdiv($n, 2);
		}
		//Fn-1, Fn, Fn+1
		$this->Fnprev = $rd;
		$this->Fn = $rc;
		$this->Fnnext = $rd + $rc;
		$this->nearlyFibonacci();
	}

	private function nearlyFibonacci() {
		if ($this->number > $this->Fn) {
            if (($this->Fnnext - $this->number) < ($this->number - $this->Fn)) {
                $this->nearly = $this->Fnnext;
            } else {
                $this->nearly = $this->Fn;
            }
        } else {
            if (($this->Fn - $this->number) < ($this->number - $this->Fnprev)) {
                $this->nearly = $this->Fn;
            } else {
                $this->nearly = $this->Fnprev;
            }
        }
	}
}