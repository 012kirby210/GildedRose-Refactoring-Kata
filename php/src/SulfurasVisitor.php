<?php

namespace GildedRose;

class SulfurasVisitor implements VisitorInterface
{
    const MAX_QUALITY = 80;
    const NAME = "Sulfuras";

    public function visit(ItemAdapter $itemAdapter)
    {
        ( $this->isVisitable($itemAdapter->getItem()) )
            && $this->updateQuality($itemAdapter->getItem());
    }

    private function isVisitable(Item $item): bool
    {
        return str_starts_with(trim($item->name), static::NAME);
    }

    // ! TODO faire une commande avec un method factory pour la gestion commune du compteur sellin
    private function updateQuality(Item $item): void
    {
        $item->quality += $item->quality<static::MAX_QUALITY ? 1 : 0;
    }
}