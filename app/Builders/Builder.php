<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder as DefaultBuilder;

class Builder extends DefaultBuilder {
    public function applyFilters($orderBy, $callback = null, $paginate = true) {
        $sql = $this->toSql();
        $type = 'desc';
        $search = '';
        $searchBy = [];
        $rowsByPage = 10;
        $url = '';

        $request = request()->query();
        if($request && isset($request['url'])) {
            $url = $request['url'];
            if($url) {
                unset($request['url']);
            }
        }

        if($request && isset($request['paginate'])) {
            $rowsByPage = intval($request['paginate']);
        }

        if($request && isset($request['order']) && strpos($sql, $request['order']) !== false) {
            $orderBy = $request['order'];
        }

        if($request && isset($request['type'])) {
            $type = $request['type'];
        }

        if($request && isset($request['search']) && isset($request['searchby'])) {
            $search = trim($request['search']);
            $search = !empty($search) ? $search : false;
            $searchBy = explode(',', trim($request['searchby']));
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


        if($paginate) {
            return $this->paginate($rowsByPage)
            ->appends($request)
            ->withPath("#" . $url);
        }

        return $this;
    }
}
