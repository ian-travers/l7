<?php

use App\Entities\Page\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pages')->truncate();

        create(Page::class, [
            'parent_id' => null,
            'path' => "/about",
            'link_en' => "About",
            'link_ru' => "О проекте",
            'title_en' => "About",
            'title_ru' => "О проекте",
            'content_en' => '<h1 style="text-align: center;"><span style="font-size: 2.25rem; font-weight: bolder;">NFSU Cup</span><span style="font-size: 2.25rem;">&nbsp;for whose who like to play</span></h1><h1 style="text-align: center;"><span style="font-size: 2.25rem;"> Need for Speed Underground online.</span></h1><p style="text-align: left;">I\'m supporting community where people&nbsp;who consider NFS Underground the best ever game.&nbsp;The release of the game in 2003 made a splash. There were so many people that it was impossible to enter the room. Now is another time ...</p><p style="text-align: left;">More information can be found in the following sections:</p><p style="text-align: left;"><a href="/about/cup" class="link-text-info">About NFSU Cup</a></p><p style="text-align: left;"><a href="/about/server" class="link-text-info">About game server</a></p><p style="text-align: left;"><span style="font-size: 14.4px;">You can also <a href="/about/contact" class="link-text-info">contact me</a> or <a href="/about/donate" class="link-text-info">support</a> the project.</span><br></p><p style="text-align: left;"><br></p>',
            'content_ru' => '<h1 style="text-align: center;"><b>NFSU Cup</b>&nbsp;&mdash; это для тех, кто любит играть</h1><h1 style="text-align: center;"> Need for Speed Underground онлайн.</h1><p style="text-align: left;">Я предоставляю возможность гонять онлайн и&nbsp;<span style="font-size: 0.9rem;">поддерживаю сообщество людей, для которых NFS Underground не просто старая игра, а незабываемая атмосфера, драйв или просто хорошее воспоминание. Выход этой игры в 2003 был настоящим фурором. На сервере в комнату не войти было, столько народа играло. Сейчас уже другое время...</span></p><p style="text-align: left;"><span style="font-size: 0.9rem;">Немного более информации можно найти:</span></p><p style="text-align: left;"><span style="font-size: 0.9rem;"><a href="/about/cup" class="link-text-info">О NFSU Cup</a></span></p><p style="text-align: left;"><span style="font-size: 0.9rem;"><a href="/about/server" class="link-text-info">О NFSU сервере</a></span></p><p style="text-align: left;"><span style="font-size: 0.9rem;">Можете еще <a href="/about/contact" class="link-text-info">связаться</a> со мной или <a href="/about/donate" class="link-text-info">поддержать</a> проект.</span></p>',
            'seo' => [
                'title' => 'About nfsu-cup.com',
                'keywords' => 'NFS underground, NFS Underground online',
                'description' => 'About NFSU Cup whole project'
            ],
        ]);

        create(Page::class, [
            'parent_id' => null,
            'path' => "/about/cup",
            'link_en' => "NFSU Cup",
            'link_ru' => "О NFSU Cup",
            'title_en' => "About NFSU Cup",
            'title_ru' => "О NFSU Cup",
            'content_en' => '<h1 style="text-align: center;"><b>NFSU Cup</b>&nbsp;is series of a tourneys</h1><p style="text-align: left;">NFS Underground tourneys have identified a significant portion of this site. Tourneys are run according to predefined <a href="#" class="link-text-info">Rules</a>. The leader of each tourney is the supervisor. Any questions, disputes, comments during the tourney are resolved by the supervisor. Tourneys are scheduled. Tourneys series are divided into seasons. According to the results of the performance of players in tourneys, ratings are formed. All types of ratings can be found in the <a href="#" class="link-text-info">Stats</a> section.</p><p style="text-align: left;">The NFSU Cup tourneys are based on the idea invented by the USSR Team players in 2004 and the competitions held on the official EA server in 2004-2006.</p>',
            'content_ru' => '<h1 style="text-align: center;"><b>NFSU Cup</b>&nbsp;&mdash; это серия онлайн турниров</h1><p style="text-align: left;">Турнирам по  NFS Underground определена значительная часть этого сайта. Турниры проводятся по заранее определенным <a href="#" class="link-text-info">Правилам</a>. Рудоводителем каждого турнира является супервайзер. Любые вопросы, споры, замечания во время турнира разрешает супервайзер. Турниры проводятся по расписанию. Серии турниров делятся на сезоны. По результатам выступления игроков в турнирах формируются рейтинги. Все виды рейтингов можно посмотреть в разделе <a href="#" class="link-text-info">Статистика</a>.</p><p style="text-align: left;">Турниры на NFSU Cup основаны на идее, придуманной игроками команды USSR Team в 2004 году и соревнованиях, проходивших на официальном сервере  EA в 2004-2006 гг.</p>',
            'seo' => [
                'title' => 'About NFSU Cup tourneys series',
                'keywords' => 'NFS underground, NFS Underground online, NFS Underground tourney',
                'description' => 'About NFSU Cup tourneys series'
            ],
        ]);

        create(Page::class, [
            'parent_id' => null,
            'path' => "/about/server",
            'link_en' => "NFSU Server",
            'link_ru' => "О NFSU Сервере",
            'title_en' => "About NFSU Server",
            'title_ru' => "О NFSU Сервере",
            'content_en' => '<h1 style="text-align: center;"><b>NFSU Cup</b>&nbsp;is series of a tourneys</h1><p style="text-align: left;">NFS Underground tourneys have identified a significant portion of this site. Tourneys are run according to predefined <a href="#" class="link-text-info">Rules</a>. The leader of each tourney is the supervisor. Any questions, disputes, comments during the tourney are resolved by the supervisor. Tourneys are scheduled. Tourneys series are divided into seasons. According to the results of the performance of players in tourneys, ratings are formed. All types of ratings can be found in the <a href="#" class="link-text-info">Stats</a> section.</p><p style="text-align: left;">The NFSU Cup tourneys are based on the idea invented by the USSR Team players in 2004 and the competitions held on the official EA server in 2004-2006.</p>',
            'content_ru' => '<h1 style="text-align: center;"><b>NFSU Cup</b>&nbsp;&mdash; это серия онлайн турниров</h1><p style="text-align: left;">Турнирам по  NFS Underground определена значительная часть этого сайта. Турниры проводятся по заранее определенным <a href="#" class="link-text-info">Правилам</a>. Рудоводителем каждого турнира является супервайзер. Любые вопросы, споры, замечания во время турнира разрешает супервайзер. Турниры проводятся по расписанию. Серии турниров делятся на сезоны. По результатам выступления игроков в турнирах формируются рейтинги. Все виды рейтингов можно посмотреть в разделе <a href="#" class="link-text-info">Статистика</a>.</p><p style="text-align: left;">Турниры на NFSU Cup основаны на идее, придуманной игроками команды USSR Team в 2004 году и соревнованиях, проходивших на официальном сервере  EA в 2004-2006 гг.</p>',
            'seo' => [
                'title' => 'About NFSU game server',
                'keywords' => 'NFS underground, NFS Underground online, NFS Underground server',
                'description' => 'About NFSU game server'
            ],
        ]);
    }
}
