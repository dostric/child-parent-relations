<?php

use \Illuminate\Support\Collection;

/**
 * Class ControllerBaseSearchable
 *
 *
 */
class CollectionBase extends Collection {


    /**
     * @param mixed $item
     * @return $this
     */
    public function add($item) {

        $this->put($item->getId(), $item);
        return $this;

    }


    public function filter(Closure $closure) {

        // we`ll set the items to the filtered ones
        $this->items = Collection::make($this->items)->filter($closure)->all();

        return $this;

    }

}
