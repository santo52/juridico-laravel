<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder as DefaultBuilder;

class Builder extends DefaultBuilder {
    public function applyFilters($orderBy, $request, $callback = null) {
        $sql = $this->toSql();
        $type = 'desc';
        $search = '';
        $searchBy = [];

        if($request && $request->has('order') && strpos($sql, $request->get('order')) !== false) {
            $orderBy = $request->get('order');
        }

        if($request && $request->has('type')) {
            $type = $request->get('type');
        }

        if($request && $request->has('search') && $request->has('searchby')) {
            $search = trim($request->get('search'));
            $search = !empty($search) ? $search : false;
            $searchBy = explode(',', trim($request->get('searchby')));
        }

        foreach($searchBy as $field) {
            if($field && strpos($sql, $field) !== false) {
                $this->orHavingRaw("{$field} like '%{$search}%'");
            }
        }

        if($callback) {
            $callback($this, $search, $searchBy);
        }

        $this->orderBy($orderBy, $type);
        return $this;
    }
}
