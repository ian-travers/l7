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
            'content_ru' => '<h1 style="text-align: center;"><b>NFSU Cup</b> - это для тех, кто любит играть</h1><h1 style="text-align: center;"> Need for Speed Underground онлайн.</h1><p style="text-align: left;">Я предоставляю возможность гонять онлайн и&nbsp;<span style="font-size: 0.9rem;">поддерживаю сообщество людей, для которых NFS Underground не просто старая игра, а незабываемая атмосфера, драйв или просто хорошее воспоминание. Выход этой игры в 2003 был настоящим фурором. На сервере в комнату не войти было, столько народа играло. Сейчас уже другое время...</span></p><p style="text-align: left;"><span style="font-size: 0.9rem;">Немного более информации можно найти:</span></p><p style="text-align: left;"><span style="font-size: 0.9rem;"><a href="/about/cup" class="link-text-info">О NFSU Cup</a></span></p><p style="text-align: left;"><span style="font-size: 0.9rem;"><a href="/about/server" class="link-text-info">О NFSU сервере</a></span></p><p style="text-align: left;"><span style="font-size: 0.9rem;">Можете еще <a href="/about/contact" class="link-text-info">связаться</a> со мной или <a href="/about/donate" class="link-text-info">поддержать</a> проект.</span></p>',
            'seo' => [
                'title' => 'About nfsu-cup.com',
                'keywords' => 'NFS underground, NFS Underground online',
                'description' => 'About NFSU Cup whole project'
            ],
        ]);
    }
}
