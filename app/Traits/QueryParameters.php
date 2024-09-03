<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait QueryParameters
{
    protected string $thisTable = '';

    /**
     * 
     * @param Builder $query
     * return Void
     */
    public function setParameters(Builder $query): void
    {
        $this->setingQueryStrings($query);

        $this->setOrder($query);

        $this->setLimit($query);
    }

    public function getResults(Builder $query)
    {
        return $this->Paginated
            ? $query->paginate($this->limit)
            : $query->get();
    }

    public function handle(Builder $query)
    {
        $this->setParameters($query);
        return $this->getResults($query);
    }

    private function setingQueryStrings(Builder $query): void
    {
        foreach ($this->queryStrings as $key => $value) {
            if (is_array($value)) {
                if ($key === 'betweenDates') {
                    $this->setBetween($query, $value);
                } else {
                    $this->filtersByArray($query, $value, $key);
                }
            } else {
                $this->setWhereLike($query, $key, $value);
            }
        }
    }

    private function setOrder(Builder $query): void
    {
        $this->order_by && $query->orderBy($this->thisTable . $this->order_by, $this->order);
    }

    private function setLimit(Builder $query): void
    {
        $this->limit && $query->limit($this->limit);
    }

    protected function setBetween(Builder $query, array $array):void
    {
        foreach ($array as $field => $dates) {
            $query->whereBetween($this->thisTable . $field, [$dates['start'], $dates['end']]);
        }
    }

    private function filtersByArray(Builder $query, array $array, string $key):void
    {
        foreach ($array as $field => $string) {
            $query->whereHas($key, function ($query) use ($key, $field, $string) {
                $fieldSearch = $this->relations[$key] . '.' . $field;
                $this->setWhereLike($query, $fieldSearch, $string);
            });
        }
    }

    private function setWhereLike(Builder $query, string $field, $value):void
    {
        $field !== 'status' && $value = "%{$value}%";
        $query->where($this->thisTable . $field, 'like', $value);
    }

    

}