<?php

namespace Database\Seeders\SourceBooks\Core\Items;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\SourceBooks\ItemSeeder;

final class PersonalEffectsSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create('Bottle of Sake', 1, (new Cost())->withBu(1));
        $this->create('Bowyer\'s Kit', 1, (new Cost())->withBu(2));
        $this->create('Calligraphy Set', 3, (new Cost())->withBu(1));
        $this->create('Chopsticks', 1, (new Cost())->withZeni(1));
        $this->create('Daisho Stand', 4, (new Cost())->withKoku(1));

        $this->create('Dice and Cup', 2, (new Cost())->withZeni(25));
        $this->create('Divination Kit', 4, (new Cost())->withBu(1));
        $this->create('Finger of Jade', 6, (new Cost())->withKoku(6));
        $this->create('Games', 3, (new Cost())->withBu(1));
        $this->create('Kubi Bukuro', 2, (new Cost())->withZeni(2));
        $this->create('Luck Cricket', 4, (new Cost())->withBu(4));

        $this->create('Medicine Kit', 3, (new Cost())->withBu(1));
        $this->create('Musical Instrument', 2, (new Cost())->withBu(1));
        $this->create('Omamori', 2, (new Cost())->withBu(5));
        $this->create('Personal Seal or Chop', 6, (new Cost())->withBu(4));
        $this->create('Pillow Book', 2, (new Cost())->withZeni(3));

        $this->create('Poison (One Vial)', 5, (new Cost())->withZeni(30));
        $this->create('Quiver of Arrows', 1, (new Cost())->withZeni(20));
        $this->create('Rope (By the Foot)', 1, (new Cost())->withZeni(5));

        $this->create('Sake Cup', 2, (new Cost())->withBu(1));
        $this->create('Spices', 5, (new Cost())->withBu(1));
        $this->create('Sweets (Four Servings)', 1, (new Cost())->withBu(1));
        $this->create('Tattoo Needles', 4, (new Cost())->withBu(1));
        $this->create('Tea Set (Portable)', 6, (new Cost())->withKoku(1));
        $this->create('Tent (Chomchong)', 7, (new Cost())->withKoku(20));
        $this->create('Tent (Small)', 3, (new Cost())->withKoku(1));
        $this->create('Tent (Yurt)', 5, (new Cost())->withKoku(10));
        $this->create('Traveling Rations', 1, (new Cost())->withZeni(5));
        $this->create('Umbrella', 4, (new Cost())->withBu(2));
        $this->create('Whetstone', 1, (new Cost())->withZeni(1));

        // Traveling Pack
        $this->create('Blanket', 1, new Cost());
        $this->create('Bowl', 1, new Cost());
        $this->create('Flint and Tinder', 1, new Cost());

        // Schools
        $this->create('Makeup Kit', 1, new Cost());
        $this->create('Scroll Satchel', 1, new Cost());
        $this->create('Quiver of Bolts', 1, new Cost());
        $this->create('Set of Glass Vials', 1, new Cost());
        $this->create('Journal', 1, new Cost());
    }
}
