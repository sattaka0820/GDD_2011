<?php
class Data
{
	public $data;
	public $left;
	public $right;

	public $dips = 0;

	public function __construct($data, $left = null, $right = null)
	{
		$this->data  = $data;
		$this->left  = $left;
		$this->right = $right;
	}
}

class Tree
{
	public $tree = array();

	public function main($buffer)
	{
		$root = explode(',', $buffer);

		$this->preorder($root);
		$result = $this->search();

		echo $result . "\n";
	}

	public function preorder($node, $dips = 0)
	{
		$data = new Data($node);
		$data->dips = $dips;
		$this->_add($data);

		if ($node) {
			$this->tree[] = $data;
		}

		$left  = $data->left;
		$right = $data->right;

		unset($data);

		if ($left !== null || $right !== null) {
			$dips++;
		}
		if ($left !== null) {
			$this->preorder($left, $dips);
		}
		if ($right !== null) {
			$this->preorder($right, $dips);
		}

		return;
	}

	public function search()
	{
		$array = array();
		$tmp   = array();
		foreach ($this->tree as $tree) {
			if ($tree->right === array()) {
				$tmp[] = $tree->dips;
			}
		}

		return min($tmp) + 1;
	}

	protected function _add(&$data)
	{
		$half = $this->_half($data->data);
		if ($half !== false) {
			$data->left = $half;
		}

		$del = $this->_del($data->data);
		if ($del !== false) {
			$data->right = $del;
		}
	}

	protected function _half(&$array)
	{
		if (array_sum($array) == 0) {
			return false;
		}

		$tmp = array();
		foreach ($array as $value) {
			$tmp[] = (int)floor($value/2);
		}

		return $tmp;
	}

	protected function _del(&$array)
	{
		$tmp = array();
		foreach ($array as $value) {
			if ($value % 5 != 0) {
				$tmp[] = $value;
			}
		}
		
		if ($array == $tmp) {
			return false;
		}

		return $tmp;
	}
}

$tree = new Tree();
$tree->main($argv[1]);
