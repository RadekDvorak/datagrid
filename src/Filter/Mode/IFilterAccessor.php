<?php

namespace Ublaboo\DataGrid\Filter\Mode;

use Ublaboo\DataGrid\Exception\DataGridException;
use Ublaboo\DataGrid\Filter\Filter;



interface IFilterAccessor
{

	/**
	 * @param string $key
	 * @return Filter
	 * @throws DataGridException
	 */
	public function getInnerFilter($key);



	/**
	 * @param string $key
	 * @return bool
	 */
	public function hasInnerFilter($key);



	/**
	 * @return array|Filter[] Filters in sorted array<string,Filter> collection
	 */
	public function getOuterFilters();



	/**
	 * @return bool
	 */
	public function hasOuterFilters();

}
