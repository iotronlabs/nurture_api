<?php


namespace App\Forum\Filters;


class ThreadFilters extends Filters
{
	
	protected $filters = ['by', 'popular', 'unanswered','latest'];


	protected function popular()
    {
        $this->builder->getQuery()->orders = [];

        return $this->builder->orderBy('replies_count', 'desc');
    }

    protected function latest()
    {
        $this->builder->getQuery()->orders = [];

        return $this->builder->orderBy('created_at', 'desc');
    }
}