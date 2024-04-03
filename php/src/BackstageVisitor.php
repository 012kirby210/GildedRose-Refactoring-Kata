<?php

namespace GildedRose;

class BackstageVisitor implements VisitorInterface
{
    const NAME = "Backstage";

    public function visit(ItemAdapter $itemAdapter)
    {
        $this->isVisitable($itemAdapter->getItem())
            && $this->updateQuality($itemAdapter->getItem());
    }

    private function isVisitable(Item $item): bool
    {
        return str_starts_with(trim($item->name), static::NAME);
    }

    // ! TODO Utiliser un pattern spec pour déterminer la condition de mise à jour qualité
    private function updateQuality(Item $item): void
    {
        $item->sellIn -= 1;

        if ( 0 > $item->sellIn ){
            $item->quality = 0;
            return;
        }

        $quality_increment = 1;
        if ( 10 > $item->sellIn ){
            $quality_increment = 2;
        }
        if ( 5 > $item->sellIn ){
            $quality_increment = 3;
        }
        $item->quality += $quality_increment;
        $item->quality = min($item->quality, ItemAdapter::MAX_QUALITY);

    }
}