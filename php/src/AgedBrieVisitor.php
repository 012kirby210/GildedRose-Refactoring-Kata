<?php

namespace GildedRose;

use GildedRose\VisitorInterface;

class AgedBrieVisitor implements VisitorInterface
{

    const NAME = "Aged Brie";
    public function visit(ItemAdapter $itemAdapter)
    {
        $this->isVisitable($itemAdapter->getItem()) &&
            $this->updateQuality($itemAdapter->getItem());
    }


    private function isVisitable($item): bool
    {
        return str_starts_with(trim($item->name),static::NAME);
    }

    private function updateQuality(Item $item): void
    {
        $item->sellIn -= 1;
        $quality_increment = $item->sellIn >= 0 ? 1 : 2;
        $item->quality += $item->quality < ItemAdapter::MAX_QUALITY ? $quality_increment : 0;
        $item->quality = min($item->quality, ItemAdapter::MAX_QUALITY);
    }

}