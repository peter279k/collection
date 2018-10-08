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
use Countable;
use IteratorAggregate;

/**
 * CollectionInterface
 *
 * @package Sunrise\Collection
 */
interface CollectionInterface extends Countable, IteratorAggregate
{

	/**
	 * Constructor of the class
	 */
	public function __construct(iterable $items = []);

	/**
	 * Adds the given value to the collection
	 */
	public function add($value) : CollectionInterface;

	/**
	 * Sets the given key/value pair to the collection
	 */
	public function set($key, $value) : CollectionInterface;

	/**
	 * Gets a value for the given key from the collection
	 *
	 * If the given key is not found in the collection, returns the given default value.
	 */
	public function get($key, $default = null);

	/**
	 * Removes a value for the given key from the collection
	 *
	 * If the given key is not found in the collection, returns the given default value.
	 */
	public function remove($key, $default = null);

	/**
	 * Searches the given value in the collection
	 *
	 * If the given value is found in the collection, returns its corresponding key.
	 *
	 * If the given value is not found in the collection, returns the given default value.
	 */
	public function search($value, $default = false);

	/**
	 * Checks if the given key exists in the collection
	 *
	 * If the given key is found in the collection, returns true.
	 *
	 * If the given key is not found in the collection, returns false.
	 */
	public function exists($key) : bool;

	/**
	 * Checks if the given value contains in the collection
	 *
	 * If the given value is found in the collection, returns true.
	 *
	 * If the given value is not found in the collection, returns false.
	 */
	public function contains($value) : bool;

	/**
	 * Updates the collection using the given items
	 *
	 * If an item is found in the collection, it will not be overwritten.
	 *
	 * If an item is not found in the collection, it will be added.
	 */
	public function update(array $items) : CollectionInterface;

	/**
	 * Upgrades the collection using the given items
	 *
	 * If an item is found in the collection, it will be overwritten.
	 *
	 * If an item is not found in the collection, it will be added.
	 */
	public function upgrade(array $items) : CollectionInterface;

	/**
	 * Clears the collection
	 */
	public function clear() : CollectionInterface;

	/**
	 * Gets the items of the collection as is
	 */
	public function all() : array;

	/**
	 * Converts the collection to an array
	 */
	public function toArray() : array;
}
