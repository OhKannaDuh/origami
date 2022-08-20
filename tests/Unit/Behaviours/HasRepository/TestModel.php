<?php

namespace Tests\Unit\Behaviours\HasRepository;

use App\Behaviours\HasRepository;
use Illuminate\Database\Eloquent\Model;

final class TestModel extends Model
{
    use HasRepository;
}
