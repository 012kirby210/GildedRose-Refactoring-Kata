<?php

namespace GildedRose;

class ItemAdapter
{

    const MAX_QUALITY = 50;
    const MIN_QUALITY = 0;

    public function __construct(private Item $item){

    }


    public function accept(VisitorInterface $visitor)
    {
        $visitor->visit($this);
    }

    public function getItem(): Item
    {
        return $this->item;
    }

}