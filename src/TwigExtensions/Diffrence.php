<?php
namespace TwigExtensions;

class Diffrence {

	public function __construct($now, $then) {
		$this->diff = $this->getUnixDiffrence($now, $then);
		$this->doWork();
	}

	private  function getUnixDiffrence($now, $then) {
		list($now, $then) = array(strtotime($now), strtotime($then));
		return $now > $then ? ($now - $then) : ($then - $now);
	}

	private function doWork() {
		$this->years = intval($this->diff / (60 * 60 * 24 * 365));
		$remain = $this->diff % (60 * 60 * 24 * 365);

		$this->days = intval($remain / (60 * 60 * 24));
		$remain = $this->diff % (60 * 60 * 24);

		$this->hours = intval($remain / (60 * 60));
		$remain = $remain % (60 * 60);

		$this->minutes = intval($remain / 60);
		$this->seconds = $remain % 60;
	}

	public function niceTime() {
		if ($this->seconds >= 0) $timestring = sprintf("0 minutes %s seconds", $this->seconds);
		if ($this->minutes > 0) $timestring = sprintf("%s minutes %s seconds", $this->minutes, $this->seconds);
		if ($this->hours > 0) $timestring = sprintf("%s hours %s minutes", $this->hours, $this->minutes);
		if ($this->days > 0) $timestring = sprintf("%s days %s hours", $this->days, $this->hours);
		return $timestring . " ago"; 
	}
}
