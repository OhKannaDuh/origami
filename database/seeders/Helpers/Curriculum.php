<?php

namespace Database\Seeders\Helpers;

final class Curriculum extends BaseHelper
{


    public function withRank(int $rank, CurriculumRank $curriculumRank): self
    {
        $clone = clone $this;
        $clone->data[$rank] = $curriculumRank->toArray();

        return $clone;
    }
}
