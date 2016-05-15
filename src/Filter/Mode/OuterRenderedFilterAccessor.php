<?php

namespace Ublaboo\DataGrid\Filter\Mode;

use Ublaboo\DataGrid\Column\Column;
use Ublaboo\DataGrid\Exception\DataGridException;
use Ublaboo\DataGrid\Filter\Filter;



class OuterRenderedFilterAccessor implements IFilterAccessor
{

	/**
	 * @var array|Filter[]
	 */
	private $filters;



	/**
	 * @param array|Filter[] $filters
	 * @param array|Column[] $columns
	 */
	public function __construct(array $filters, array $columns)
	{
		$this->filters = $filters;
	}



	/**
	 * @inheritdoc
	 */
	public function getOuterFilters()
	{
		return $this->filters;
	}



	/**
	 * @inheritdoc
	 */
	public function getInnerFilter($key)
	{
		$message = sprintf('Outer renderer has no inner filter, filter %s requested.', $key);
		throw new DataGridException($message);
	}



	/**
	 * @inheritdoc
	 */
	public function hasInnerFilter($key)
	{
		return FALSE;
	}



	/**
	 * @return bool
	 */
	public function hasOuterFilters()
	{
		return $this->filters !== [];
	}
	
}
