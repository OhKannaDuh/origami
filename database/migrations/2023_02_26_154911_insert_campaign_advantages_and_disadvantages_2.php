<?php

use App\Models\Character\Advantage;
use App\Models\Character\Disadvantage;
use App\Models\Core\AdvantageCategory;
use App\Models\Core\DisadvantageCategory;
use App\Repositories\Character\AdvantageRepositoryInterface;
use App\Repositories\Character\DisadvantageRepositoryInterface;
use App\Repositories\Core\AdvantageCategoryRepositoryInterface;
use App\Repositories\Core\DisadvantageCategoryRepositoryInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\App;

return new class extends Migration
{
    private AdvantageRepositoryInterface $advantages;

    private DisadvantageRepositoryInterface $disadvantages;

    private AdvantageCategoryRepositoryInterface $advantageCategories;

    private DisadvantageCategoryRepositoryInterface $disadvantageCategories;


    public function __construct()
    {
        $this->advantages = App::make(AdvantageRepositoryInterface::class);
        $this->disadvantages = App::make(DisadvantageRepositoryInterface::class);
        $this->advantageCategories = App::make(AdvantageCategoryRepositoryInterface::class);
        $this->disadvantageCategories = App::make(DisadvantageCategoryRepositoryInterface::class);
    }


    public function up(): void
    {
        $this->updateAdvantage('ancestry', '<p>The following apply to a character with the Ancestry passion:</p><ul><li>The recollection of lineages comes easily to you. You know your own family history as far back as it has been recorded, and can swiftly recall the lineages of notable figures in Rokugan\'s history. With a few contextual cues, you can deduce the ancestry of those you meet and remember the great deeds of their forebears.</li><li>After performing a check to recall or determine the family history of another character (such as a Government [Earth] check to remember a past daimyō of a family, or a Command [Earth] check to remind a subordinate of the expectations their ancestors would have of them), you remove 3 strife.</li></ul>', ['mental']);
        $this->updateAdvantage('pot_stirrer', '<p>The following apply to a character with the Pot Stirrer passion:</p><ul><li>After spending a few minutes studying a room, you can extrapolate who might have a grudge against whom, which two people are on edge around each other, and other social pressure points you could exploit.</li><li>After performing a check to stir up social chaos (such as a Courtesy [Fire] check to incite anger in someone about a perceived insult or a Theology [Fire] check to encourage two people to argue about the finer points of their religious beliefs), you remove 3 strife.</li></ul>', ['interpersonal', 'mental']);
        $this->updateDisadvantage('adopted_peasant', '<p>The following apply to a character with the Adopted Peasant adversity:</p><ul><li>Although adopted by a samurai family, you were born a peasant. Other samurai who know this fact are likely to look down upon you and may use this fact against you socially.</li><li>When you make a check to deal authoritatively or collegially with a samurai who knows of your peasant birth (such as a Command [Fire] check to give an order to a subordinate or a Courtesy [Fire] check to impugn another\'s honor), you must choose and reroll two dice showing {{success}}or {{explosive-success}} results. After resolving the check, if you failed, you regain 1 Void point.</li></ul>', ['interpersonal']);
        $this->updateDisadvantage('cynicism', '<p>The following apply to a character with the Cynicism anxiety:</p><ul><li>When faced with a truly novel or unconventional idea, you always look for ways it can fail, and others must persuade you that it could work before you will try it (even if it is your idea).</li><li>After performing a check to think unconventionally (such as a Performance [Fire] check to improvise during a performance or a Tactics [Fire] check to develop a new strategy on the fly), you receive 3 strife. If this is the first time this has occurred this scene, gain 1 Void point.</li></ul>', ['interpersonal', 'mental']);
        $this->updateDisadvantage('isolation', '<p>The following apply to a character with the Adopted Peasant adversity:</p><ul><li>To best serve your clan\'s interests, you must ignore your own needs. You cannot sympathize with the people you intend to bring harm. Likewise, you cannot help people for selfish reasons. Your clan requires you to focus on the larger picture and to remove your individual wants from the equation. You are a tool for a greater purpose. The temptation to form genuine human connections is strong, and it can pull you away from your life\'s mission.</li><li>After performing a check related to interacting with people you care for (such as a Command [Earth] check to issue orders to family members or a Sentiment [Earth] check to recall the feelings of your friends concerning a particular subject), you receive 3 strife. If this is the first time this has occurred this scene, gain 1 Void point.</li></ul>', ['interpersonal', 'mental']);
    }


    private function updateAdvantage(string $key, string $effects, array $types): void
    {
        $changed = false;
        $advantage = $this->getAdvantage($key);
        if (!$advantage->effects) {
            $changed = true;
            $advantage->effects = $effects;
        }

        foreach ($types as $type) {
            $category = $this->getAdvantageCategory($type);

            if ($advantage->advantageCategories->contains($category->id)) {
                continue;
            }

            $changed = true;
            $advantage->advantageCategories()->attach($category->id);
        }

        if ($changed) {
            $advantage->save();
        }
    }


    private function updateDisadvantage(string $key, string $effects, array $types): void
    {
        $changed = false;
        $disadvantage = $this->getDisadvantage($key);
        if (!$disadvantage->effects) {
            $changed = true;
            $disadvantage->effects = $effects;
        }

        foreach ($types as $type) {
            $category = $this->getDisadvantageCategory($type);

            if ($disadvantage->disadvantageCategories->contains($category->id)) {
                continue;
            }

            $changed = true;
            $disadvantage->disadvantageCategories()->attach($category->id);
        }

        if ($changed) {
            $disadvantage->save();
        }
    }


    private function getAdvantage(string $key): Advantage
    {
        $model = $this->advantages->getByKey($key);
        assert($model instanceof Advantage);

        return $model;
    }


    private function getDisadvantage(string $key): Disadvantage
    {
        $model = $this->disadvantages->getByKey($key);
        assert($model instanceof Disadvantage);

        return $model;
    }


    private function getAdvantageCategory(string $key): AdvantageCategory
    {
        $model = $this->advantageCategories->getByKey($key);
        assert($model instanceof AdvantageCategory);

        return $model;
    }


    private function getDisadvantageCategory(string $key): DisadvantageCategory
    {
        $model = $this->disadvantageCategories->getByKey($key);
        assert($model instanceof DisadvantageCategory);

        return $model;
    }
};
