<?php

namespace BlockFactory\BlockBuilder\Contracts;

abstract class ListTable extends \WP_List_Table
{
	private array $filters = [];

	private int $perPage = 10;

	public function __construct($args = array())
	{
		parent::__construct($args);
	}

	public function setItems(array $items)
	{
		$this->_column_headers = [
			$this->get_columns(),
			$this->get_hidden_columns(),
			$this->get_sortable_columns()
		];

		$this->set_pagination_args([
			'total_items' => count($items),
			'per_page'    => $this->perPage
		]);

		$this->items = array_slice($items, (($this->get_pagenum() - 1) * $this->perPage), $this->perPage);
	}

	public function perPage(int $perPage)
	{
		$this->perPage = $perPage;
	}

	public function filterColumn(string $column, callable $filter)
	{
		$this->filters[ $column ] = $filter;
	}

	public function column_default($item, $column_name)
	{
		if (isset($this->filters[ $column_name ])) {
			return call_user_func($this->filters[ $column_name ], $item);
		}

		return $item[ $column_name ];
	}
}
