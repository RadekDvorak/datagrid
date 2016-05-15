<?php

namespace Ublaboo\DataGrid\Filter\Mode;

use Ublaboo\DataGrid\DataGrid;
use Ublaboo\DataGrid\Exception\DataGridException;



class FilterAccessorClassMapFactory implements IFilterAccessorFactory
{

	const INNER_RENDER = 'INNER_RENDER';
	const OUTER_RENDER = 'OUTER_RENDER';
	const MIXED_RENDER = 'MIXED_RENDER';

	const DEFAULT_MODE_MAP = [
		self::OUTER_RENDER => OuterRenderedFilterAccessor::class,
		self::INNER_RENDER => InnerRenderedFilterAccessor::class,
		self::MIXED_RENDER => MixedRenderedFilterAccessor::class,
	];

	const DEFAULT_LEGACY_OUTER_MODE = self::OUTER_RENDER;
	const DEFAULT_LEGACY_INNER_MODE = self::INNER_RENDER;

	/**
	 * @var array|string[]
	 */
	private $modeClassMap;

	/**
	 * @var string
	 */
	private $legacyOuterMode;

	/**
	 * @var string
	 */
	private $legacyInnerMode;



	/**
	 * @param array|string[] $modeClassMap
	 * @param string $legacyOuterMode
	 * @param string $legacyInnerMode
	 */
	public function __construct(
		array $modeClassMap = self::DEFAULT_MODE_MAP,
		$legacyOuterMode = self::DEFAULT_LEGACY_OUTER_MODE,
		$legacyInnerMode = self::DEFAULT_LEGACY_INNER_MODE
	) {
		$this->modeClassMap = $modeClassMap;
		$this->legacyOuterMode = $legacyOuterMode;
		$this->legacyInnerMode = $legacyInnerMode;
	}



	/**
	 * @inheritdoc
	 */
	public function createAccessor($mode, DataGrid $grid)
	{
		if (!isset($this->modeClassMap[$mode])) {
			$message = sprintf('Filter rendering mode %s has not been found.', $mode);
			throw new DataGridException($message);
		}

		$className = $this->modeClassMap[$mode];
		$filters = $grid->assableFilters();
		$columns = $grid->getColumns();

		return new $className($filters, $columns);
	}



	/**
	 * @inheritdoc
	 */
	public function getLegacyOuterRenderingEquivalentMode()
	{
		return $this->legacyOuterMode;
	}



	/**
	 * @inheritdoc
	 */
	public function getLegacyInnerRenderingEquivalentMode()
	{
		return $this->legacyInnerMode;
	}

}
