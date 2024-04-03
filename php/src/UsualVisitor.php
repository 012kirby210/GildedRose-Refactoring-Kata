<?php

namespace GildedRose;

use GildedRose\VisitorInterface;

class UsualVisitor implements VisitorInterface
{

    public function visit(ItemAdapter $itemAdapter)
    {
        ( $this->isVisitable($itemAdapter->getItem()) ) && $this->updateQuality($itemAdapter->getItem());
    }

    // ! TODO découpler avec une chaine
    private function isVisitable(Item $item): bool
    {
        return (
            ! str_starts_with(trim($item->name), AgedBrieVisitor::NAME)
        && ! str_starts_with(trim($item->name), BackstageVisitor::NAME)
            && ! str_starts_with(trim($item->name), ConjuredVisitor::NAME)
            && ! str_starts_with(trim($item->name), SulfurasVisitor::NAME)
        );
    }

    private function updateQuality(Item $item): void
    {
        $item->sellIn -= 1;

        $quality_decrement = $item->sellIn >=0 ? 1 : 2;

        // ! TODO visiter la qualité en tant qu'objet et déterminer si on doit agir dessus
        $item->quality -= $item->quality >= ItemAdapter::MIN_QUALITY ? $quality_decrement : 0;
        $item->quality = max($item->quality,0);
    }

}