<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class ArticleSeeder extends AbstractSeed
{
    public function run(): void
    {
        $res = $this->fetchRow('select count(*) as count from `article`');
        dump($res);
    }
}
