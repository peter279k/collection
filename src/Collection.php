<?php declare(strict_types=1);

/**
 * It's free open-source software released under the MIT License.
 *
 * @author Anatoly Fenric <anatoly@fenric.ru>
 * @copyright Copyright (c) 2018, Anatoly Fenric
 * @license https://github.com/sunrise-php/collection/blob/master/LICENSE
 * @link https://github.com/sunrise-php/collection
 */

namespace Sunrise\Collection;

/**
 * Import classes
 */
use ArrayIterator, Traversable;

/**
 * Import functions
 */
use function array_key_exists, array_map, array_replace_recursive, array_search, in_array, count;

/**
 * Collection
 */
class Collection implements CollectionInterface
{

	/**
	 * Items of the collection
	 *
	 * @var array
	 */
	protected $items = [];

	/**
	 * {@inheritDoc}
	 */
	public function __construct(iterable $items = [])
	{
		foreach ($items as $key => $value)
		{
			$this->set($key, $value);
		}
	}

	/**
	 * {@inheritDoc}
	 */
	public function add($value) : CollectionInterface
	{
		$this->items[] = $value;

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function set($key, $value) : CollectionInterface
	{
		$this->items[$key] = $value;

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function get($key, $default = null)
	{
		if (array_key_exists($key, $this->items))
		{
			return $this->items[$key];
		}

		return $default;
	}

	/**
	 * {@inheritDoc}
	 */
	public function remove($key, $default = null)
	{
		if (array_key_exists($key, $this->items))
		{
			$value = $this->items[$key];

			unset($this->items[$key]);

			return $value;
		}

		return $default;
	}

	/**
	 * {@inheritDoc}
	 */
	public function search($value, $default = false)
	{
		$offset = array_search($value, $this->items, false);

		if ($offset === false)
		{
			return $default;
		}

		return $offset;
	}

	/**
	 * {@inheritDoc}
	 */
	public function exists($key) : bool
	{
		return array_key_exists($key, $this->items);
	}

	/**
	 * {@inheritDoc}
	 */
	public function contains($value) : bool
	{
		return in_array($value, $this->items);
	}

	/**
	 * {@inheritDoc}
	 */
	public function update(array $items) : CollectionInterface
	{
		$this->items = array_replace_recursive($items, $this->items);

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function upgrade(array $items) : CollectionInterface
	{
		$this->items = array_replace_recursive($this->items, $items);

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function clear() : CollectionInterface
	{
		$this->items = [];

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function all() : array
	{
		return $this->items;
	}

	/**
	 * {@inheritDoc}
	 */
	public function toArray() : array
	{
		return array_map(function($item)
		{
			if ($item instanceof CollectionInterface)
			{
				return $item->toArray();
			}

			if ($item instanceof Traversable)
			{
				$item = new Collection($item);

				return $item->toArray();
			}

			return $item;

		}, $this->items);
	}

	/**
	 * Gets the number of items in the collection
	 *
	 * @return int
	 */
	public function count()
	{
		return count($this->items);
	}

	/**
	 * Gets an external iterator
	 *
	 * @return ArrayIterator
	 */
	public function getIterator()
	{
		return new ArrayIterator($this->items);
	}
}
