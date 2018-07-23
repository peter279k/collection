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
use ArrayIterator, IteratorAggregate, Traversable;

/**
 * Collection
 *
 * @package Sunrise\Collection
 */
class Collection implements IteratorAggregate
{

	/**
	 * Items of the collection
	 *
	 * @var array
	 */
	protected $items = [];

	/**
	 * Constructor of the class
	 */
	public function __construct(iterable $items = [])
	{
		foreach ($items as $key => $value)
		{
			$this->set($key, $value);
		}
	}

	/**
	 * Gets an external iterator
	 */
	public function getIterator() : ArrayIterator
	{
		return new ArrayIterator($this->items);
	}

	/**
	 * Adds the given value to the collection
	 */
	public function add($value) : self
	{
		$this->items[] = $value;

		return $this;
	}

	/**
	 * Sets the given key/value pair to the collection
	 */
	public function set($key, $value) : self
	{
		$this->items[$key] = $value;

		return $this;
	}

	/**
	 * Gets a value for the given key from the collection
	 *
	 * If the given key is not found in the collection, returns the given default value.
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
	 * Removes a value for the given key from the collection
	 *
	 * If the given key is not found in the collection, returns the given default value.
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
	 * Searches the given value in the collection
	 *
	 * If the given value is found in the collection, returns its corresponding key.
	 *
	 * If the given value is not found in the collection, returns false.
	 */
	public function search($value)
	{
		return array_search($value, $this->items);
	}

	/**
	 * Checks if the given key exists in the collection
	 *
	 * If the given key is found in the collection, returns true.
	 *
	 * If the given key is not found in the collection, returns false.
	 */
	public function exists($key) : bool
	{
		return array_key_exists($key, $this->items);
	}

	/**
	 * Checks if the given value contains in the collection
	 *
	 * If the given value is found in the collection, returns true.
	 *
	 * If the given value is not found in the collection, returns false.
	 */
	public function contains($value) : bool
	{
		return in_array($value, $this->items);
	}

	/**
	 * Updates the collection using the given items
	 *
	 * If an item is found in the collection, it will not be overwritten.
	 *
	 * If an item is not found in the collection, it will be added.
	 */
	public function update(array $items) : self
	{
		$this->items = array_replace_recursive($items, $this->items);

		return $this;
	}

	/**
	 * Upgrades the collection using the given items
	 *
	 * If an item is found in the collection, it will be overwritten.
	 *
	 * If an item is not found in the collection, it will be added.
	 */
	public function upgrade(array $items) : self
	{
		$this->items = array_replace_recursive($this->items, $items);

		return $this;
	}

	/**
	 * Clears the collection
	 */
	public function clear() : self
	{
		$this->items = [];

		return $this;
	}

	/**
	 * Gets the number of items in the collection
	 */
	public function count() : int
	{
		return count($this->items);
	}

	/**
	 * Gets the items of the collection as is
	 */
	public function all() : array
	{
		return $this->items;
	}

	/**
	 * Converts the collection to an array
	 */
	public function toArray() : array
	{
		return array_map(function($item)
		{
			if ($item instanceof Collection)
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
}
