<?php

namespace Tests\Unit\Http\Controllers\Api;

use App\Models\Character\Advantage;
use App\Models\Character\Clan;
use App\Models\Character\Disadvantage;
use App\Models\Character\Family;
use App\Models\Character\Item;
use App\Models\Character\School;
use App\Models\Character\Technique;
use App\Models\Core\AdvantageType;
use App\Models\Core\DisadvantageType;
use App\Models\Core\ItemSubtype;
use App\Models\Core\ItemType;
use App\Models\Core\Ring;
use App\Models\Core\Skill;
use App\Models\Core\TechniqueType;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

final class DataControllerTest extends TestCase
{


    public function testAll(): void
    {
        Ring::factory(5)->create();

        $adversity = DisadvantageType::factory()->create([
            'key' => 'adversity',
        ]);

        $anxiety = DisadvantageType::factory()->create([
            'key' => 'anxiety',
        ]);

        $distinction = AdvantageType::factory()->create([
            'key' => 'distinction',
        ]);

        $passion = AdvantageType::factory()->create([
            'key' => 'passion',
        ]);

        Disadvantage::factory(12)->create([
            'disadvantage_type_id' => $adversity->getKey(),
        ]);

        Disadvantage::factory(4)->create([
            'disadvantage_type_id' => $anxiety->getKey(),
        ]);

        Advantage::factory(3)->create([
            'advantage_type_id' => $distinction->getKey(),
        ]);

        Advantage::factory(15)->create([
            'advantage_type_id' => $passion->getKey(),
        ]);

        Skill::factory(26)->create();
        Clan::factory(5)->create();
        Family::factory(55)->create();
        ItemType::factory(4)->create();
        ItemSubtype::factory(12)->create();
        Item::factory(120)->create();
        TechniqueType::factory(8)->create();
        Technique::factory(99)->create();
        School::factory(34)->create();

        $this->get(route('api.character.data.all'))
            ->assertJson(function (AssertableJson $json) {
                $json->has('adversities', 12);
                $json->has('anxieties', 4);
                $json->has('distinctions', 3);
                $json->has('passions', 15);
                $json->has('clans', 5);
                $json->has('families', 55);
                $json->has('item_subtypes', 12);
                $json->has('item_types', 4);
                $json->has('items', 120);
                $json->has('rings', 5);
                $json->has('schools', 34);
                $json->has('skills', 26);
                $json->has('technique_types', 8);
                $json->has('techniques', 99);

                $data = $json->toArray();
                self::assertTrue(array_key_exists('ring', $data['adversities'][0]));
                self::assertTrue(array_key_exists('ring', $data['anxieties'][0]));
                self::assertTrue(array_key_exists('ring', $data['clans'][0]));
                self::assertTrue(array_key_exists('skill', $data['clans'][0]));
                self::assertTrue(array_key_exists('ring', $data['distinctions'][0]));
                self::assertTrue(array_key_exists('clan', $data['families'][0]));
                self::assertTrue(array_key_exists('ring_choice_one', $data['families'][0]));
                self::assertTrue(array_key_exists('ring_choice_two', $data['families'][0]));
                self::assertTrue(array_key_exists('skill_one', $data['families'][0]));
                self::assertTrue(array_key_exists('skill_two', $data['families'][0]));
                self::assertTrue(array_key_exists('item_subtype', $data['items'][0]));
                self::assertTrue(array_key_exists('item_type', $data['items'][0]['item_subtype']));
                self::assertTrue(array_key_exists('ring', $data['passions'][0]));
                self::assertTrue(array_key_exists('available_technique_subtypes', $data['schools'][0]));
                self::assertTrue(array_key_exists('available_technique_types', $data['schools'][0]));
                self::assertTrue(array_key_exists('family', $data['schools'][0]));
                self::assertTrue(array_key_exists('clan', $data['schools'][0]['family']));
                self::assertTrue(array_key_exists('ring_one', $data['schools'][0]));
                self::assertTrue(array_key_exists('ring_two', $data['schools'][0]));
                self::assertTrue(array_key_exists('school_types', $data['schools'][0]));
            });
    }
}
