<?php

namespace Database\Seeders\SourceBooks\Core\Disadvantages;

use Database\Seeders\SourceBooks\DisadvantageSeeder;

final class AnxietySeeder extends DisadvantageSeeder
{


    public function run(): void
    {
        $this->create('Addiction', 'earth');
        $this->create('Battle Trauma', 'fire');
        $this->create('Cynicism', 'fire');
        $this->create('Dark Secret', 'void');
        $this->create('Delusions of Grandeur', 'void');
        $this->create('Fear of Death', 'earth');
        $this->create('Ferocity', 'air');
        $this->create('Impatience', 'earth');
        $this->create('Intelerance', 'water');
        $this->create('Irrepressible Flirtation', 'earth');
        $this->create('Jealousy', 'air');
        $this->create('Materialism', 'void');
        $this->create('Meekness', 'fire');
        $this->create('Painful Honesty', 'air');
        $this->create('Paranoia', 'water');
        $this->create('Perfectionism', 'water');
        $this->create('Phobia', 'water');
        $this->create('Softheartedness', 'fire');
        $this->create('Superstition', 'void');

        $this->create('Belligerent', 'earth');
    }
}
