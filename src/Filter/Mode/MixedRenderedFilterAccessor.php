<?php

namespace Ublaboo\DataGrid\Filter\Mode;

use Ublaboo\DataGrid\Column\Column;
use Ublaboo\DataGrid\Exception\DataGridException;
use Ublaboo\DataGrid\Filter\Filter;



class MixedRenderedFilterAccessor implements IFilterAccessor
{

	/**
	 * @var array|Filter[]
	 */
	private $filters;

	/**
	 * @var Column[]
	 */
	private $columns;



	/**
	 * @param array|Filter[] $filters
	 * @param array|Column[] $columns
	 */
	public function __construct(array $filters, array $columns)
	{
		$this->filters = $filters;
		$this->columns = $columns;
	}



	/**
	 * @inheritdoc
	 */
	public function getOuterFilters()
	{
		return array_diff_key($this->filters, $this->columns);
	}



	/**
	 * @inheritdoc
	 */
	public function getInnerFilter($key)
	{
		if (!isset($this->filters[$key])) {
			$message = sprintf('Filter %s has not been found.', $key);
			throw new DataGridException($message);
		} elseif (!isset($this->columns[$key])) {
			$message = sprintf('Filter %s is not mapped to any column.', $key);
			throw new DataGridException($message);
		}

		return $this->filters[$key];
	}



	/**
	 * @inheritdoc
	 */
	public function hasInnerFilter($key)
	{
		return isset($this->filters[$key], $this->columns[$key]);
	}



	/**
	 * @return bool
	 */
	public function hasOuterFilters()
	{
		return array_diff_key($this->filters, $this->columns) !== [];
	}

}
