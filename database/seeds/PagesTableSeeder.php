<?php

use App\Entities\Page\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pages')->truncate();

        // 1 about
        create(Page::class, [
            'parent_id' => null,
            'path' => "/about",
            'link_en' => "About",
            'link_ru' => "О проекте",
            'title_en' => "About",
            'title_ru' => "О проекте",
            'content_en' => '<h1 class="text-center"><b>NFSU Cup</b>&nbsp;for whose who like to play</span></h1><h1 class="text-center">Need for Speed Underground online.</h1><p style="text-align: left;">I\'m supporting community where people&nbsp;who consider NFS Underground the best ever game.&nbsp;The release of the game in 2003 made a splash. There were so many people that it was impossible to enter the room. Now is another time ...</p><p style="text-align: left;">More information can be found in the following sections:</p><p style="text-align: left;"><a href="/about/cup" class="link-text-info">About NFSU Cup</a></p><p style="text-align: left;"><a href="/about/server" class="link-text-info">About game server</a></p><p style="text-align: left;">You can also <a href="/about/contact" class="link-text-info">contact me</a> or <a href="/about/donate" class="link-text-info">support</a> the project.</p>',
            'content_ru' => '<h1 class="text-center"><b>NFSU Cup</b>&nbsp;&mdash; это для тех, кто любит играть</h1><h1 class="text-center">Need for Speed Underground онлайн.</h1><p style="text-align: left;">Я предоставляю возможность гонять онлайн и поддерживаю сообщество людей, для которых NFS Underground не просто старая игра, а незабываемая атмосфера, драйв или просто хорошее воспоминание. Выход этой игры в 2003 был настоящим фурором. На сервере в комнату не войти было, столько народа играло. Сейчас уже другое время...</p><p style="text-align: left;">Немного более информации можно найти:</p><p style="text-align: left;"><a href="/about/cup" class="link-text-info">О NFSU Cup</a></p><p style="text-align: left;"><a href="/about/server" class="link-text-info">О NFSU сервере</a></p><p style="text-align: left;">Можете еще <a href="/about/contact" class="link-text-info">связаться</a> со мной или <a href="/about/donate" class="link-text-info">поддержать</a> проект.</p>',
            'seo' => [
                'title' => 'About nfsu-cup.com',
                'keywords' => 'NFS underground, NFS Underground online',
                'description' => 'About NFSU Cup whole project'
            ],
        ]);

        // 2 about/cup
        create(Page::class, [
            'parent_id' => 1,
            'path' => "/about/cup",
            'link_en' => "NFSU Cup",
            'link_ru' => "О NFSU Cup",
            'title_en' => "About NFSU Cup",
            'title_ru' => "О NFSU Cup",
            'content_en' => '<h1 class="text-center"><b>NFSU Cup</b>&nbsp;is series of a tourneys</h1><p style="text-align: left;">NFS Underground tourneys have identified a significant portion of this site. Tourneys are run according to predefined <a href="#" class="link-text-info">Rules</a>. The leader of each tourney is the supervisor. Any questions, disputes, comments during the tourney are resolved by the supervisor. Tourneys are scheduled. Tourneys series are divided into seasons. According to the results of the performance of players in tourneys, ratings are formed. All types of ratings can be found in the <a href="#" class="link-text-info">Stats</a> section.</p><p style="text-align: left;">The NFSU Cup tourneys are based on the idea invented by the USSR Team players in 2004 and the competitions held on the official EA server in 2004-2006.</p>',
            'content_ru' => '<h1 class="text-center"><b>NFSU Cup</b>&nbsp;&mdash; это серия онлайн турниров</h1><p style="text-align: left;">Турнирам по  NFS Underground определена значительная часть этого сайта. Турниры проводятся по заранее определенным <a href="#" class="link-text-info">Правилам</a>. Рудоводителем каждого турнира является супервайзер. Любые вопросы, споры, замечания во время турнира разрешает супервайзер. Турниры проводятся по расписанию. Серии турниров делятся на сезоны. По результатам выступления игроков в турнирах формируются рейтинги. Все виды рейтингов можно посмотреть в разделе <a href="#" class="link-text-info">Статистика</a>.</p><p style="text-align: left;">Турниры на NFSU Cup основаны на идее, придуманной игроками команды USSR Team в 2004 году и соревнованиях, проходивших на официальном сервере  EA в 2004-2006 гг.</p>',
            'seo' => [
                'title' => 'About NFSU Cup tourneys series',
                'keywords' => 'NFS underground, NFS Underground online, NFS Underground tourney',
                'description' => 'About NFSU Cup tourneys series'
            ],
        ]);

        // 3 about/server
        create(Page::class, [
            'parent_id' => 1,
            'path' => "/about/server",
            'link_en' => "NFSU Server",
            'link_ru' => "О NFSU Сервере",
            'title_en' => "About NFSU Server",
            'title_ru' => "О NFSU Сервере",
            'content_en' => '<h1 class="text-center">About NFS Underground Servers</h1><p style="text-align: left;">Game Server&nbsp;is software providing the online game. Since 2003, when the game was published, official EA servers operated in several points of the world until 2007. Almost immediately after the release of the game, around December 2003, one good person with the nickname 3Priedez wrote his own version of the server for NFS Underground. The main task was to provide the ability to play on the local network. This version of the server also worked on the Internet on several portals and began to be conditionally called by the name of the portal or site where it was placed.</p><p>After EA closed its servers, all those who wanted to drive in the under were forced to switch to unofficial servers. A special client is used to connect to unofficial servers. It can be downloaded in the <a href="/download" class="link-text-info">Download</a> section.</p><p>At the moment, the server version 2.5 is running on the NFSU Cup. The server has been operating since June 1, 2013. This is my updated version of the server from 3Priedez. Some bugs fixed and some improvements added. However, there are still questions about the server, which it is desirable to solve. Specialists, ready to work, please respond. To do this, you can fill out the <a href="/contact" class="link-text-info">contact form</a>. The most ideal option is to find one of developers of the game and turn to him with those questions. But this is unlikely to happen. In any case, respect to developers of EA Black Box for creating the NFS Underground.</p>',
            'content_ru' => '<h1 class="text-center">NFS Underground Сервер</h1><p style="text-align: left;">В 2003 году вашла игра NFS Underground. Издатель игры&nbsp;&mdash; Electronic Arts запустил в нескольких точках мира игровые серверы. Эти серверы принято было называть официальными или просто EA. Где-то в начале 2007 года работы серверов EA была прекращена.</p><p>Почти сразу после выхода игры, где-то в декабре 2003 года, один хороший человек с ником 3Priedez написал собственную версии сервера для NFS Underground. Главной задачей было обеспечить возможность играть по локальной сети. Эта версия сервера также заработала в интернете на нескольких порталах и стали условно называться по названию портала или сайта, где были размещены.</p><p>После того, как EA прикрыл свои серверы, все те кто хотел погонять в андер были вынуждены перейти на неофициальные серверы. Для подключения к неофициальным серверам применяется специальный клиент. Его можно скачать в разделе <a href="/download" class="link-text-info">Загрузки</a>.</p><p>На данный момент на NFSU Cup работает версия сервера 2.5. Сервер работает с 1 июня 2013 года. Это дополненная мною версия сервера от 3Priedez. Исправлены некоторые баги и добавлены некоторые усовершенствования. Однако еще есть вопросы по работе сервера, которые желательно решить. Спецов, готовых поработать, прошу откликнуться. Для этого можно заполнить форму <a href="/contact" class="link-text-info">контакта</a>. Самый идеальный вариант&nbsp;&mdash; это найти одного из разработчиков игры и обратиться к нему с теми вопросами. Но такое вряд ли случится. В любом случае, респект разработчикам из EA Black Box за создание NFS Underground.</p>',
            'seo' => [
                'title' => 'About NFSU game server',
                'keywords' => 'NFS underground, NFS Underground online, NFS Underground server',
                'description' => 'About NFSU game server'
            ],
        ]);

        // 4 about/contact
        create(Page::class, [
            'parent_id' => 1,
            'path' => "/about/contact",
            'link_en' => "Contact me",
            'link_ru' => "Контакт",
            'title_en' => "Contact me form",
            'title_ru' => "Форма для связи с разработчиком",
            'content_en' => '<h1 class="text-center">Contact me form</h1><p style="text-align: left;">Under construction...</p>',
            'content_ru' => '<h1 class="text-center">Форма связи с разработчиком</h1><p style="text-align: left;">Строится еще...</p>',
            'seo' => [
                'title' => 'Contact NFSU Cup developer',
                'keywords' => 'NFSU Cup developer, Contact form, NFS underground, NFS Underground online, NFS Underground server',
                'description' => 'Contact with NFSU Cup developer form'
            ],
        ]);

        // 5 about/donate
        create(Page::class, [
            'parent_id' => 1,
            'path' => "/about/donate",
            'link_en' => "Donate",
            'link_ru' => "Контакт",
            'title_en' => "Donate for NFSU Cup project",
            'title_ru' => "Поддержите проект NFSU Cup",
            'content_en' => '<h1 class="text-center">Donate for NFSU Cup project</h1><p style="text-align: left;">Under construction...</p>',
            'content_ru' => '<h1 class="text-center">Поддержите проект NFSU Cup</h1><p style="text-align: left;">Строится еще...</p>',
            'seo' => [
                'title' => ' Donate for NFSU Cup project',
                'keywords' => 'Donate NFSU Cup, NFS underground, NFS Underground online, NFS Underground server',
                'description' => 'Donate for NFSU Cup project'
            ],
        ]);

        // 6 help
        create(Page::class, [
            'parent_id' => null,
            'path' => "/help",
            'link_en' => "Help",
            'link_ru' => "Помощь",
            'title_en' => 'Help on NFSU Cup',
            'title_ru' => "Помощь на NFSU Cup",
            'content_en' => '<h1 class="text-center">Help on NFSU Cup</h1><p style="text-align: left;">Under construction...</p>',
            'content_ru' => '<h1 class="text-center">Помощь на NFSU Cup</h1><p style="text-align: left;">Строится еще...</p>',
            'seo' => [
                'title' => 'Help on NFSU Cup',
                'keywords' => 'Help NFSU Cup, NFS underground, NFS Underground online, NFS Underground server',
                'description' => 'Help page on NFSU Cup portal'
            ],
        ]);

        // 7 help/gameplay
        create(Page::class, [
            'parent_id' => 6,
            'path' => "/help/gameplay",
            'link_en' => "Gameplay",
            'link_ru' => "Геймплей",
            'title_en' => "Gameplay help on NFSU Cup",
            'title_ru' => "Помощь по геймплею на NFSU Cup",
            'content_en' => '<h1 class="text-center">Gameplay help on NFSU Cup</h1><p style="text-align: left;">Under construction...</p>',
            'content_ru' => '<h1 class="text-center">Помощь по геймплею на NFSU Cup</h1><p style="text-align: left;">Строится еще...</p>',
            'seo' => [
                'title' => ' Gameplay help on NFSU Cup',
                'keywords' => 'Gameplay online NFS underground, NFS Underground server',
                'description' => 'Help about online gameplay NFS Underground'
            ],
        ]);

        // 8 help/faq
        create(Page::class, [
            'parent_id' => 6,
            'path' => "/help/faq",
            'link_en' => "Faq",
            'link_ru' => "FAQ",
            'title_en' => "Frequency asked questions on NFSU Cup",
            'title_ru' => "Часто задаваемые вопросы на NFSU Cup",
            'content_en' => '<h1 class="text-center">Frequency asked questions on NFSU Cup</h1><p style="text-align: left;">Under construction...</p>',
            'content_ru' => '<h1 class="text-center">Часто задаваемые вопросы на NFSU Cup</h1><p style="text-align: left;">Строится еще...</p>',
            'seo' => [
                'title' => 'Frequency asked questions on NFSU Cup',
                'keywords' => 'Faq on NFSU Cup, Faq online NFS underground, Faq NFS Underground server',
                'description' => 'Frequency asked questions about NFS Underground online'
            ],
        ]);

        // 9 download
        create(Page::class, [
            'parent_id' => null,
            'path' => "/download",
            'link_en' => "Downloads",
            'link_ru' => "Загрузки",
            'title_en' => 'Downloads on NFSU Cup',
            'title_ru' => "Файлы для загрузки на NFSU Cup",
            'content_en' => '<h1 class="text-center">Downloads on NFSU Cup</h1><p style="text-align: left;">Under construction...</p>',
            'content_ru' => '<h1 class="text-center">Загрузки на NFSU Cup</h1><p style="text-align: left;">Строится еще...</p>',
            'seo' => [
                'title' => 'Downloads on NFSU Cup',
                'keywords' => 'download NFSU, download NFSU client, download NFSU save, download NFSU save patcher',
                'description' => 'Several files for downloading on NFSU Cup. Those files needs for playing NFS Underground online.'
            ],
        ]);

        // 10 download/nfsu
        create(Page::class, [
            'parent_id' => 9,
            'path' => "/download/nfsu",
            'link_en' => "NFS Underground",
            'link_ru' => "NFS Underground",
            'title_en' => "Need for Speed Underground (PC 2003)",
            'title_ru' => "Need for Speed Underground (PC 2003)",
            'content_en' => '<h1 class="text-center">Need for Speed Underground (PC 2003) on NFSU Cup</h1><p style="text-align: left;">Under construction...</p>',
            'content_ru' => '<h1 class="text-center">Need for Speed Underground (PC 2003) на NFSU Cup</h1><p style="text-align: left;">Строится еще...</p>',
            'seo' => [
                'title' => 'Need for Speed Underground (PC 2003)',
                'keywords' => 'download nfs underground on NFSU Cup, NFS Underground server',
                'description' => 'Download Need for Speed Underground (PC 2003) - the game'
            ],
        ]);

        // 11 download/nfsu-client
        create(Page::class, [
            'parent_id' => 9,
            'path' => "/download/nfsu-client",
            'link_en' => "NFS client",
            'link_ru' => "NFS клиент",
            'title_en' => "NFS Underground Client",
            'title_ru' => "NFS Underground клиент",
            'content_en' => '<h1 class="text-center">NFS Underground Client on NFSU Cup</h1><p style="text-align: left;">Under construction...</p>',
            'content_ru' => '<h1 class="text-center">NFS Underground клиент на NFSU Cup</h1><p style="text-align: left;">Строится еще...</p>',
            'seo' => [
                'title' => 'NFS Underground Client',
                'keywords' => 'download client nfs underground, NFS Underground server, NFS Underground client',
                'description' => 'Client for online playing NFS Underground'
            ],
        ]);

        // 12 download/nfsu-save
        create(Page::class, [
            'parent_id' => 9,
            'path' => "/download/nfsu-save",
            'link_en' => "NFSU save",
            'link_ru' => "NFSU сохранение",
            'title_en' => "NFSU save files",
            'title_ru' => "NFSU файлы сохранения",
            'content_en' => '<h1 class="text-center">NFSU save files on NFSU Cup</h1><p style="text-align: left;">Under construction...</p>',
            'content_ru' => '<h1 class="text-center">NFS Underground файлы сохранения на NFSU Cup</h1><p style="text-align: left;">Строится еще...</p>',
            'seo' => [
                'title' => 'NFSU save files',
                'keywords' => 'download nfs underground save files, NFS Underground server, NFS Underground career',
                'description' => 'Save files with full career passed for NFS Underground'
            ],
        ]);

        // 13 download/nfsu-save-patcher
        create(Page::class, [
            'parent_id' => 9,
            'path' => "/download/nfsu-save-patcher",
            'link_en' => "NFSU Save Patcher",
            'link_ru' => "NFSU Save Patcher",
            'title_en' => "NFSU save files patcher",
            'title_ru' => "NFSU Save Patcher",
            'content_en' => '<h1 class="text-center">NFSU Save Patcher on NFSU Cup</h1><p style="text-align: left;">Under construction...</p>',
            'content_ru' => '<h1 class="text-center">NFSU Save Patcher (редактор сохранений) на NFSU Cup</h1><p style="text-align: left;">Строится еще...</p>',
            'seo' => [
                'title' => 'NFSU save files patcher',
                'keywords' => 'download nfs underground save files patcher, NFS Underground career, NFS Underground tuning',
                'description' => 'Patcher for save files NFS Underground. Quick way to change TJ uniques set, career progress, money etc.'
            ],
        ]);

        // 14 rules
        create(Page::class, [
            'parent_id' => null,
            'path' => "/rules",
            'link_en' => "Rules",
            'link_ru' => "Правила",
            'title_en' => 'Rules of NFSU Cup',
            'title_ru' => "Правила турниров NFSU Cup",
            'content_en' => '<h1 class="text-center">Downloads on NFSU Cup</h1><p style="text-align: left;">Under construction...</p>',
            'content_ru' => '<h1 class="text-center">Загрузки на NFSU Cup</h1><p style="text-align: left;">Строится еще...</p>',
            'seo' => [
                'title' => 'Rules of NFSU Cup',
                'keywords' => 'rules NFSU Cup, tourneys NFSU Cup, tourney rules NFSU Cup',
                'description' => 'Rules of tourneys on NFSU Cup.'
            ],
        ]);
    }
}
