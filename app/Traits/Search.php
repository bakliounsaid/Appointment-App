<?php

namespace App\Traits;

trait Search
{
    public function scopeSearch($query, $term)
    {
        if (!isset($this->searchable_attributes)) {
            $this->searchable_attributes = [];
        }


        for ($i = 0; $i < count($this->searchable_attributes); $i++) {
            if ($i === 0) {
                $query->where($this->searchable_attributes[$i], 'like', "%" . $term . "%");
            } else {
                $query->orWhere($this->searchable_attributes[$i], 'like', "%" . $term . "%");
            }
        }
        return $query;
    }

}
