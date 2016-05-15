<?php

namespace Ublaboo\DataGrid\Filter\Mode;



use Ublaboo\DataGrid\DataGrid;



interface IFilterAccessorFactory
{

	/**
	 * @param string $mode
	 * @param DataGrid $grid
	 * @return IFilterAccessor
	 */
	public function createAccessor($mode, DataGrid $grid);



	/**
	 * @return string
	 */
	public function getLegacyOuterRenderingEquivalentMode();

	/**
	 * @return string
	 */
	public function getLegacyInnerRenderingEquivalentMode();

}
