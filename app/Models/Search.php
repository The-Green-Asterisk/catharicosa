<?php

namespace App\Models;

trait Search
{
    private function buildWildCards($term){
        if ($term == ''){
            return $term;
        }

        $reservedSymbols = ['-', '+', '>', '<', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);
        foreach($words as $idx => $word) {
            $words[$idx] = '+' . $word . '*';
        }
        $term = implode(' ', $words);
        return $term;
    }

    protected function scopeSearch($query, $term) {
        $columns = implode(',', $this->searchable);
        $query->whereRaw(
            "MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)",
            $this->buildWildCards($term)
        );
        return $query;
    }
}
