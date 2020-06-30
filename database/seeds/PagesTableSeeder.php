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
            'path' => '/about',
            'link_en' => 'About',
            'link_ru' => 'О проекте',
            'title_en' => 'About',
            'title_ru' => 'О проекте',
            'content_en' => '<h1 class="text-center"><b>NFSU Cup</b>&nbsp;for whose who like to play</span></h1><h1 class="text-center">Need for Speed Underground online.</h1><p style="text-align: left;">I\'m supporting community where people&nbsp;who consider NFS Underground the best ever game.&nbsp;The release of the game in 2003 made a splash. There were so many people that it was impossible to enter the room. Now is another time ...</p><p style="text-align: left;">More information can be found in the following sections:</p><p style="text-align: left;"><a href="/about/cup" class="link-text-info">About NFSU Cup</a></p><p style="text-align: left;"><a href="/about/server" class="link-text-info">About game server</a></p><p style="text-align: left;">You can also <a href="/contact" class="link-text-info">contact me</a> or <a href="/about/donate" class="link-text-info">support</a> the project.</p>',
            'content_ru' => '<h1 class="text-center"><b>NFSU Cup</b>&nbsp;&mdash; это для тех, кто любит играть</h1><h1 class="text-center">Need for Speed Underground онлайн.</h1><p style="text-align: left;">Я предоставляю возможность гонять онлайн и поддерживаю сообщество людей, для которых NFS Underground не просто старая игра, а незабываемая атмосфера, драйв или просто хорошее воспоминание. Выход этой игры в 2003 был настоящим фурором. На сервере в комнату не войти было, столько народа играло. Сейчас уже другое время...</p><p style="text-align: left;">Немного более информации можно найти:</p><p style="text-align: left;"><a href="/about/cup" class="link-text-info">О NFSU Cup</a></p><p style="text-align: left;"><a href="/about/server" class="link-text-info">О NFSU сервере</a></p><p style="text-align: left;">Можете еще <a href="/contact" class="link-text-info">связаться</a> со мной или <a href="/about/donate" class="link-text-info">поддержать</a> проект.</p>',
            'seo' => [
                'title' => 'About nfsu-cup.com',
                'keywords' => 'NFS underground, NFS Underground online',
                'description' => 'About NFSU Cup whole project'
            ],
        ]);

        // 2 help
        create(Page::class, [
            'parent_id' => null,
            'path' => '/help',
            'link_en' => 'Help',
            'link_ru' => 'Помощь',
            'title_en' => 'Help on NFSU Cup',
            'title_ru' => 'Помощь на NFSU Cup',
            'content_en' => '<h1 class="text-center">Help on NFSU Cup</h1><p style="text-align: left;">Under construction...</p>',
            'content_ru' => '<h1 class="text-center">Помощь на NFSU Cup</h1><p style="text-align: left;">Строится еще...</p>',
            'seo' => [
                'title' => 'Help on NFSU Cup',
                'keywords' => 'Help NFSU Cup, NFS underground, NFS Underground online, NFS Underground server',
                'description' => 'Help page on NFSU Cup portal'
            ],
        ]);

        // 3 download
        create(Page::class, [
            'parent_id' => null,
            'path' => '/download',
            'link_en' => 'Downloads',
            'link_ru' => 'Загрузки',
            'title_en' => 'Downloads on NFSU Cup',
            'title_ru' => 'Файлы для загрузки на NFSU Cup',
            'content_en' => '<h1 class="text-center">Downloads on NFSU Cup</h1><p style="text-align: left;">Under construction...</p>',
            'content_ru' => '<h1 class="text-center">Загрузки на NFSU Cup</h1><p style="text-align: left;">Строится еще...</p>',
            'seo' => [
                'title' => 'Downloads on NFSU Cup',
                'keywords' => 'download NFSU, download NFSU client, download NFSU save, download NFSU save patcher',
                'description' => 'Several files for downloading on NFSU Cup. Those files needs for playing NFS Underground online.'
            ],
        ]);

        // 4 about/cup
        create(Page::class, [
            'parent_id' => 1,
            'path' => '/about/cup',
            'link_en' => 'NFSU Cup',
            'link_ru' => 'О NFSU Cup',
            'title_en' => 'About NFSU Cup',
            'title_ru' => 'О NFSU Cup',
            'content_en' => '<h1 class="text-center"><b>NFSU Cup</b>&nbsp;is series of a tourneys</h1><p style="text-align: left;">NFS Underground tourneys have identified a significant portion of this site. Tourneys are run according to predefined <a href="#" class="link-text-info">Rules</a>. The leader of each tourney is the supervisor. Any questions, disputes, comments during the tourney are resolved by the supervisor. Tourneys are scheduled. Tourneys series are divided into seasons. According to the results of the performance of players in tourneys, ratings are formed. All types of ratings can be found in the <a href="#" class="link-text-info">Stats</a> section.</p><p style="text-align: left;">The NFSU Cup tourneys are based on the idea invented by the USSR Team players in 2004 and the competitions held on the official EA server in 2004-2006.</p>',
            'content_ru' => '<h1 class="text-center"><b>NFSU Cup</b>&nbsp;&mdash; это серия онлайн турниров</h1><p style="text-align: left;">Турнирам по  NFS Underground определена значительная часть этого сайта. Турниры проводятся по заранее определенным <a href="#" class="link-text-info">Правилам</a>. Рудоводителем каждого турнира является супервайзер. Любые вопросы, споры, замечания во время турнира разрешает супервайзер. Турниры проводятся по расписанию. Серии турниров делятся на сезоны. По результатам выступления игроков в турнирах формируются рейтинги. Все виды рейтингов можно посмотреть в разделе <a href="#" class="link-text-info">Статистика</a>.</p><p style="text-align: left;">Турниры на NFSU Cup основаны на идее, придуманной игроками команды USSR Team в 2004 году и соревнованиях, проходивших на официальном сервере  EA в 2004-2006 гг.</p>',
            'seo' => [
                'title' => 'About NFSU Cup tourneys series',
                'keywords' => 'NFS underground, NFS Underground online, NFS Underground tourney',
                'description' => 'About NFSU Cup tourneys series'
            ],
        ]);

        // 5 about/server
        create(Page::class, [
            'parent_id' => 1,
            'path' => '/about/server',
            'link_en' => 'NFSU Server',
            'link_ru' => 'О NFSU Сервере',
            'title_en' => 'About NFSU Server',
            'title_ru' => 'О NFSU Сервере',
            'content_en' => '<h1 class="text-center">About NFS Underground Servers</h1><p style="text-align: left;">Game Server&nbsp;is software providing the online game. Since 2003, when the game was published, official EA servers operated in several points of the world until 2007. Almost immediately after the release of the game, around December 2003, one good person with the nickname 3Priedez wrote his own version of the server for NFS Underground. The main task was to provide the ability to play on the local network. This version of the server also worked on the Internet on several portals and began to be conditionally called by the name of the portal or site where it was placed.</p><p>After EA closed its servers, all those who wanted to drive in the under were forced to switch to unofficial servers. A special client is used to connect to unofficial servers. It can be downloaded in the <a href="/download" class="link-text-info">Download</a> section.</p><p>At the moment, the server version 2.5 is running on the NFSU Cup. The server has been operating since June 1, 2013. This is my updated version of the server from 3Priedez. Some bugs fixed and some improvements added. However, there are still questions about the server, which it is desirable to solve. Specialists, ready to work, please respond. To do this, you can fill out the <a href="/contact" class="link-text-info">contact form</a>. The most ideal option is to find one of developers of the game and turn to him with those questions. But this is unlikely to happen. In any case, respect to developers of EA Black Box for creating the NFS Underground.</p>',
            'content_ru' => '<h1 class="text-center">NFS Underground Сервер</h1><p style="text-align: left;">В 2003 году вашла игра NFS Underground. Издатель игры&nbsp;&mdash; Electronic Arts запустил в нескольких точках мира игровые серверы. Эти серверы принято было называть официальными или просто EA. Где-то в начале 2007 года работы серверов EA была прекращена.</p><p>Почти сразу после выхода игры, где-то в декабре 2003 года, один хороший человек с ником 3Priedez написал собственную версии сервера для NFS Underground. Главной задачей было обеспечить возможность играть по локальной сети. Эта версия сервера также заработала в интернете на нескольких порталах и стали условно называться по названию портала или сайта, где были размещены.</p><p>После того, как EA прикрыл свои серверы, все те кто хотел погонять в андер были вынуждены перейти на неофициальные серверы. Для подключения к неофициальным серверам применяется специальный клиент. Его можно скачать в разделе <a href="/download" class="link-text-info">Загрузки</a>.</p><p>На данный момент на NFSU Cup работает версия сервера 2.5. Сервер работает с 1 июня 2013 года. Это дополненная мною версия сервера от 3Priedez. Исправлены некоторые баги и добавлены некоторые усовершенствования. Однако еще есть вопросы по работе сервера, которые желательно решить. Спецов, готовых поработать, прошу откликнуться. Для этого можно заполнить форму <a href="/contact" class="link-text-info">контакта</a>. Самый идеальный вариант&nbsp;&mdash; это найти одного из разработчиков игры и обратиться к нему с теми вопросами. Но такое вряд ли случится. В любом случае, респект разработчикам из EA Black Box за создание NFS Underground.</p>',
            'seo' => [
                'title' => 'About NFSU game server',
                'keywords' => 'NFS underground, NFS Underground online, NFS Underground server',
                'description' => 'About NFSU game server'
            ],
        ]);

        // 7 about/donate
        create(Page::class, [
            'parent_id' => 1,
            'path' => '/about/donate',
            'link_en' => 'Donate',
            'link_ru' => 'Контакт',
            'title_en' => 'Donate for NFSU Cup project',
            'title_ru' => 'Поддержите проект NFSU Cup',
            'content_en' => '<h1 class="text-center">Donate for NFSU Cup project</h1><p style="text-align: left;">Under construction...</p>',
            'content_ru' => '<h1 class="text-center">Поддержите проект NFSU Cup</h1><p style="text-align: left;">Строится еще...</p>',
            'seo' => [
                'title' => ' Donate for NFSU Cup project',
                'keywords' => 'Donate NFSU Cup, NFS underground, NFS Underground online, NFS Underground server',
                'description' => 'Donate for NFSU Cup project'
            ],
        ]);

        // 7 help/gameplay
        create(Page::class, [
            'parent_id' => 2,
            'path' => '/help/gameplay',
            'link_en' => 'Gameplay',
            'link_ru' => 'Геймплей',
            'title_en' => 'Gameplay help on NFSU Cup',
            'title_ru' => 'Помощь по геймплею на NFSU Cup',
            'content_en' => '<h1 class="text-center">Gameplay help on NFSU Cup</h1><p>There is Online Game information.<br>Underground and quick race modes are not covered in this article</p><p>Select in the main menu <strong>PLAY ONLINE</strong>. Next, create a new one or log into an existing account and select the type of race. At this stage we will stop and continue to consider the next steps.</p><p>1. At this step, you can create your own rooms. There are control buttons on the bottom left of the game interface::</p><p><img src="/images/create-room-btn.png" class="border border-info"></p><p>You can click on them, or use the keyboard shortcuts.</p><p>2. We went into the room on the server. Let consider now what controls are available in the game interface. In the upper part we can see the following.</p><p><img src="/images/online-room-top-elements.png" class="border border-info"></p><p>Yellow controls are marked. 1, 2&nbsp;— switch between the list of races and the list of players. These elements can be clicked with a mouse, but it\'s more convenient to use shortcuts: <strong>left</strong> и <strong>right</strong>. 3, 4&nbsp;— switching the type of information on the players. Shortcuts <strong>,</strong> (comma) and <strong>.</strong> (dot).</p><p>On the bottom left are the elements:</p><p><img src="/images/online-room-bottom-elements-head-to-head.png" class="border border-info"></p><p>The yellow circle is the line of the game chat. There you can write your messages. Go to it by clicking on the mouse or by pressing the <strong>tab</strong> key. <strong>Next</strong> calls the player\'s menu (if your entry is current in the list of players, the menu will not open). You can watch the player\'s statistics there, write a private message and so on.</p><div class="d-flex alert alert-warning"><div class="align-self-center"><span class="fa fa-exclamation-circle pr-3">&nbsp;</span></div><div>Never challenge a player. This will cause the game to hang on your computer. If you want to play online, invite the players in the game chat and create a race.</div></div><p>3. If you go to the race list, a new element appears at the bottom:</p><p><img src="/images/online-room-bottom-elements-games-list.png" class="border border-info"></p><p><strong>Create Game</strong>&nbsp;— it is command that creates a new race. Shortcut key is <strong>z</strong>. <strong>Next</strong> in this mode serves to join the created game. A good tone is an invitation to race via the game chat. The picture shows how <em>BalTazaZ</em> makes such an invitation. </p><p>So, there is how looks like the gameplay for the online game Need for Speed Underground in general.</p>',
            'content_ru' => '<h1 class="text-center">Помощь по геймплею на NFSU Cup</h1><p>На этой странице информация об онлайн режиме NFS Underground. Прохождение карьеры и "быстрые заезды" здесь не рассматриваются.</p><p>Выбираем в главном меню игры "<b>PLAY ONLINE</b>". Далее создаем новый или входим в существующий аккаунт и выбираем тип игры. На этом этапе остановимся и далее рассмотрим по пунктам.</p><p>На этом шаге можно создавать собственные комнаты. Внизу слева интерфейса игры есть кнопки управления:</p><p><img src="/images/create-room-btn.png" class="border border-info"></p><p>По ним можно кликать, либо пользоваться быстрыми клавишами. Желтым цветом выделена команда "<strong>Create Room</strong>" (рус.: "<strong>Создать комнату</strong>") Быстрая клавиша "<strong>z</strong>". Таким образом создается собственная комната на сервере. Остальные команды:</p><p>"<strong>Back</strong>" (рус.: "<strong>Назад</strong>") клавиша "<strong>backspace</strong>"&nbsp;— возврат к предыдущему окну.</p><p>"<strong>Quit</strong>" (рус.: "<strong>Выход</strong>") клавиша "<strong>q</strong>"&nbsp;— выход в Windows.</p><p>"<strong>Next</strong>" (рус.: "<strong>Далее</strong>") клавиша "<strong>enter</strong>"&nbsp;— вход в комнату.</p><p>2. Зашли в комнату на сервере. Рассмотрим теперь какие элементы управления доступны в интерфейсе игры. В верхней части видим следующее.</p><p><img src="/images/online-room-top-elements.png" class="border border-info"></p><p>Желтыми цветом отмечены элементы управления. 1, 2&nbsp;— переключение между списком заездов и списком игроков. По этим элементам можно кликать мышкой, но удобнее пользоваться быстрыми клавишами: "<strong>влево</strong> и <strong>вправо</strong>. 3, 4&nbsp;— переключение вида информации по игрокам. Быстрые клавиши "<strong>,</strong> и <strong>.</strong> (именно "<strong>запятая</strong> и <strong>точка</strong> в англ. раскладке).</p><p>Слева внизу будут элементы:</p><p><img src="/images/online-room-bottom-elements-head-to-head.png" class="border border-info"></p><p>Желтой окружностью выделена строка игрового чата. Там вы можете писать свои сообщения. Переход в нее по клику мышки или быстрой клавишей "<strong>tab</strong>". Команда "<strong>Next</strong>" (рус.: "<strong>Далее</strong>") вызывает меню другого игрока (если в списке игроков ваша запись текущая, то меню не откроется). Можете смотреть там статистику игрока, написать приватное сообщение и проч.</p><div class="d-flex alert alert-warning"><div class="align-self-center"><span class="fa fa-exclamation-circle pr-3">&nbsp;</span></div><div>Никогда не посылайте вызов игроку. Это приведет к зависаю игру у вас на компьютере. Если хотите прокатиться, пригласите игроков в чате и создайте гонку.</div></div><p>3. Если перейти в список заездов, то внизу появится новый элемент:</p><p><img src="/images/online-room-bottom-elements-games-list.png" class="border border-info"></p><p>"<strong>Create Game</strong>" (рус.: "<strong>Создать игру</strong>")&nbsp;— именно эта команда создает новую гонку. Быстрая клавиша "<strong>z</strong>". Команда "<strong>Next</strong>" ("<strong>Далее</strong>") в этом режиме служит для присоединения к созданной другим игроком игре. Хорошим тоном является приглашение в чате присоединиться к гонке. На картинке видно, как <em>BalTazaZ</em> делает такое приглашение.</p><p>Так, в общих чертах, выглядит геймплей для онлайн игры Need for Speed Underground.</p>',
            'seo' => [
                'title' => ' Gameplay help on NFSU Cup',
                'keywords' => 'Gameplay online NFS underground, NFS Underground server',
                'description' => 'Help about online gameplay NFS Underground'
            ],
        ]);

        // 8 help/faq
        create(Page::class, [
            'parent_id' => 2,
            'path' => '/help/faq',
            'link_en' => 'Faq',
            'link_ru' => 'FAQ',
            'title_en' => 'Frequency asked questions on NFSU Cup',
            'title_ru' => 'Часто задаваемые вопросы на NFSU Cup',
            'content_en' => '<h1 class="text-center">Frequency asked questions on NFSU Cup</h1><p><strong><a href="#q001" class="link-text-info">What is needed for playing Need for Speed Underground online?</a></strong></p><p><strong><a href="#q002" class="link-text-info">What version of Windows is suitable for the game?</a></strong></p><p><strong><a href="#q003" class="link-text-info">Where are Need for Speed Underground save files located?</a></strong></p><p><a href="#q004" class="link-text-info"><strong>Does Save Patcher not see save files?</strong></a></p><p><a href="#q005" class="link-text-info"><strong>When I click on "Use server", an error occurs in the client: "Could not write hosts file. Make sure that C:\windows\system32\drivers\etc\hosts is writable". What should I do?</strong></a></p><p><strong><a href="#q006" class="link-text-info">What is a RANKED / UNRANKED game?</a></strong></p><p><a href="#q007" class="link-text-info"><strong>What are rooms on the server? Can I create my own room?</strong></a></p><p><a href="#q008" class="link-text-info"><strong>Do I need to finish underground mode (career) to play online?</strong></a></p><p><a href="#q009" class="link-text-info"><strong>What is a TJ cheat?</strong></a></p><p><strong><a href="#q010" class="link-text-info">I enter to the room on the server. I see the players. I can chat. But when I enter to the race and race is started the connection is interrupted. What should I do?</a></strong></p>

<p id="q001" class="lead text-center border-top border-info pt-3"><strong>What is needed for playing Need for Speed Underground online?</strong></p><p>To play on the network, <a href="/download/nfsu" class="link-text-info">Need for Speed Underground</a> itself is needed, special <a href="/download/nfsu-client" class="link-text-info">client</a> and internet access. It\'s all!</p><p>In the client click "Add server" enter the address <em>nfsu-cup.com</em> or <em>31.131.19.86</em>. In the list that appears, highlight the line with the desired server. Click "Use server". Launch the game. In the game menu, select "PLAY ONLINE".</p><p class="alert alert-primary">It is recommended to download the client from this site.</p>
<p id="q002" class="lead text-center border-top border-info pt-3"><strong>What version of Windows is suitable for the game?</strong></p><p>Windows 98, Windows XP, Windows 7 and later are suitable for the game. For an online game&nbsp;— the main thing is the client be able to write information to the hosts file.</p>
<p id="q003" class="lead text-center border-top border-info pt-3">Where are Need for Speed Underground save files located?</p><p>Game saves are in the folder <strong>NFS Underground</strong>. And this folder is for Windows XP: <strong>c:\Documents and Settings\All users\Application Data</strong>. For Windows 7 and later: <strong>c:\Users\All Users</strong>. Often, Application Data and All Users folders are hidden. To see them you need to run in explorer"Service → Folder Settings → View" and set the "Show hidden files" flag.</p>
<p id="q004" class="lead text-center border-top border-info pt-3">Does Save Patcher not see save files?</p><p>Possible cause&nbsp;— The folder where the save files are located is hidden. How to see hidden files is indicated in <a href="#q003" class="link-text-info">previous</a> question.</p>
<p id="q005" class="lead text-center border-top border-info pt-3">When I click on "Use server", an error occurs in the client: "Could not write hosts file. Make sure that C:\windows\system32\drivers\etc\hosts is writable". What should I do?</p><p>This is usually not a problem in Windows XP. Only starting with Windows 7, where the User Account Control (UAC) appeared, did this become a small problem. The main task is to make the client.exe program modify the hosts file. There are several ways to do this. One of them run the client as administrator. This usually helps. If not, you can configure Windows UAC.</p><p>Additional information:</p><p>for access to folders and files Windows 7, 8 and later <a href="https://support.microsoft.com/help/2623670/access-denied-or-other-errors-when-you-access-or-work-with-files-and-f" class="link-text-info">https://support.microsoft.com/help/2623670/access-denied-or-other-errors-when-you-access-or-work-with-files-and-f</a></p><p>on the topic How to become an administrator: <a href="http://www.it-articles.ru/articles.php?id=7" class="link-text-info">http://www.it-articles.ru/articles.php?id=7</a></p>
<p id="q006" class="lead text-center border-top border-info pt-3">What is a RANKED / UNRANKED game?</p><p>There are two types of rooms on the game server: RANKED and UNRANKED. Because this version of the server keeps a complete record of player statistics, then all races in the RANKED rooms are persisted in statistics. Races in UNRANKED rooms do not change statistics. The statistics take into account REP points and all sorts of average indicators (average rank and REP of opponents), as well as the number of wins, losses and disconnections. Only 1st place is a victory. Based on the REP points, a player RANKING is compiled, which can be seen both in the game (in the ONLINE GAME menu, the RANKINGS item) and here on the site.  Also, the races in the RANKED rooms get into WEEK\'S TOP PERFORMERS (this is in the game) and in <a href="/server/best-performers" class="link-text-info">Best performers</a> (this is on the site).</p><p>In the days of EA (usually called the time when the official NFS Underground server was running), UNRANKED rooms were usually used for training or some special events. All the people were in the RANKED. One of the main tasks was to climb up the RANKING chain and get into WEEK\'S TOP PERFORMERS. For example, in the days of EA in the <strong>Circuit</strong>, to get into the first hundred you had to have 10&nbsp;000&nbsp;000+ REP (For reference: in the game interface RANKINGS shows only the first hundred players)</p>
<p id="q007" class="lead text-center border-top border-info pt-3">What are rooms on the server? Can I create my own room?</p><p>Room&nbsp;— is a place where online players can chat and create races. On the server 31.131.19.86 there are at least two rooms for each type of race. GLOBAL&nbsp;— for all players. SANDBOX&nbsp;— for newbies. Players can create their own rooms. To do this, press "Z" in the corresponding game menu (see <a href="/help/gameplay" class="link-text-info">Gameplay</a>). On the server version 2.5 and higher, a restriction can be set on the players creating their own rooms. You can check on the page <a href="/server/monitor" class="link-text-info">Monitor</a> <strong>Create rooms</strong> option.</p>
<p id="q008" class="lead text-center border-top border-info pt-3">Should I finish underground mode (career) to play online?</p><p>Yes you should! At least two times! <span class="fas fa-smile-beam"></span></p><p>In fact, finishing a career is not necessary, but very desirable. Firstly, it is very interesting and dynamic. Secondly, you can gradually get to know all the tracks. Thirdly, it’s best to feel the control of the car. In the course of a career, the car will gradually improve, and the speed on the tracks will also gradually increase. Fourth, you will understand how a player receives unique car parts from <strong>TJ</strong> and you can understand which car is cheating and which is not.</p>
<p id="q009" class="lead text-center border-top border-info pt-3">What is a TJ cheat?</p><p>TJ cheat&nbsp;— is a car setting with the wrong quantity or quality of unique parts from TJ. This cheat gives some advantage to the player (if, of course, he can cope with such power). In count&nbsp;— unique TJ parts should be only 3 and no more. By quality&nbsp;— refer to <a href="/rules" class="link-text-info">rules</a> because at tourneys cars with a TJ cheat are prohibited. You can manipulate with a combination of TJ parts in the program <a href="/download/nfsu-save-patcher" class="link-text-info">NFSU Save Patcher</a>.</p>
<p id="q010" class="lead text-center border-top border-info pt-3">I enter to the room on the server. I see the players. I can chat. But when I enter to the race and race is started the connection is interrupted. What should I do?</p><p>The most difficult situation to solve. Because there can be many reasons. Only one thing they have in common is the root of the problem with the connection. Rather, blocks it.</p><p>The first thing you can do in this situation. Either disable or make Windows Firewall, all third-party firewalls, and antivirus software exceptions for the game. If this does not help, then most likely the problem is in the router. This is such a device that provides the connection of your computer with the Internet. The so-called port forwarding must be configured on the router.</p><p>For a normal game over the internet, you need to configure the router and forward the following ports to the IP address of the computer with the game:</p><p><strong>TCP: 10800, 10900-10999<br>UDP: 10800, 3658, 3659</strong></p><p class="alert alert-warning">Attention! You should be aware that communication problems can occur not only on your computer, but also on the computer of the player with whom you are trying to play over the штеуктуе. See also a good <a href="/blog/1">post</a> on this subject.</p>',
            'content_ru' => '<h1 class="text-center">Часто задаваемые вопросы на NFSU Cup</h1><p><strong><a href="#q001" class="link-text-info">Что нужно для игры Need for Speed Underground по сети?</a></strong></p><p><strong><a href="#q002" class="link-text-info">Какая версия Windows подходит для игры?</a></strong></p><p><strong><a href="#q003" class="link-text-info">Где находятся сохранения Need for Speed Underground?</a></strong></p><p><a href="#q004" class="link-text-info"><strong>Save Patcher не видит файлов сохранения?</strong></a></p><p><a href="#q005" class="link-text-info"><strong>При нажатии на "Use server" в клиенте вылетает ошибка: "<span>Could not write hosts file. Make sure that C:\windows\system32\drivers\etc\hosts is writable</span>". Что делать?</strong></a></p><p><strong><a href="#q006" class="link-text-info">Что такое рейтинговая /нерейтинговая игра?</a></strong></p><p><a href="#q007" class="link-text-info"><strong>Что такое комнаты на сервере? Можно ли создать свою комнату?</strong></a></p><p><a href="#q008" class="link-text-info"><strong>Нужно ли проходить карьеру, чтобы играть по сети?</strong></a></p><p><a href="#q009" class="link-text-info"><strong>Что такое TJ-чит?</strong></a></p><p><strong><a href="#q010" class="link-text-info">Я захожу на сервер, в комнату. Вижу игроков, могу общаться в чате. Но когда захожу в гонку, при запуске обрыв связи. Что делать?</a></strong></p><p id="q001" class="lead text-center border-top border-info pt-3"><strong>Что нужно для игры Need for Speed Undergroun по сети?</strong></p><p>Для игры по сети необходима собственно сама игра <a href="/download/nfsu" class="link-text-info">Need for Speed Underground</a>, <a href="/download/nfsu-client" class="link-text-info">клиент</a> и выход в интернет. Всё!</p><p>В клиенте нажать "Add server" и ввести адрес nfsu-cup.com или IP 31.131.19.86. В появившемся списке выделить строку с желаемым сервером. Нажать "Use server". Запустить игру. В главном меню выбрать "PLAY ONLINE".</p><p class="alert alert-primary">Рекомендую скачать клиента именно с этого сайта.</p><p id="q002" class="lead text-center border-top border-info pt-3"><strong>Какая версия Windows подходит для игры?</strong></p><p>Для игры подходит Windows 98, Windows XP, Windows 7 и более поздние. Для игры онлайн главное, чтоб клиент имел возможность записать информацию в файл hosts.</p><p id="q003" class="lead text-center border-top border-info pt-3">Где находятся сохранения Need for Speed Underground?</p><p>Сохранения игры находятся в папке <strong>NFS Underground</strong>. А эта папка находится для Windows XP: <strong>c:\Documents and Settings\All users\Application Data</strong>. Для Windows 7 и более поздних: <strong>c:\Users\All Users</strong>. Часто папки Application Data и All Users являются скрытыми. Для того, чтобы увидеть их нужно выполнить в проводнике "Сервис → свойства папки → вид" и установить флаг "Показывать скрытые файлы".</p><p id="q004" class="lead text-center border-top border-info pt-3">Save Patcher не видит файлов сохранения?</p><p>Возможная причина&nbsp;— папка, где находятся файлы сохранения являются скрытыми. Как увидеть скрытые файлы указано в <a href="#q003" class="link-text-info">предыдущем</a> ответе.</p><p id="q005" class="lead text-center border-top border-info pt-3">При нажатии на "Use server" в клиенте вылетает ошибка: "<span>Could not write hosts file. Make sure that C:\windows\system32\drivers\etc\hosts is writable</span>". Что делать?</p><p>Эта фраза переводится как: "Невозможно сделать запись в файл hosts. Проверьте, является ли файл С:\...\etc\hosts доступным для записи." Обычно в Windows XP это не является проблемой. Только начиная с Windows 7, где появился так называемый контроль учетных записей, это стало небольшой проблемой. Основная задача, сделать так, чтобы программа client.exe могла изменить файл hosts. Это можно сделать несколькими способами. Один из них запустить клиента от имени администратора. Как правило, это помогает. Если нет, можно занятьcя настройкой Windows и более тонко настроить контроль учетных записей.</p><p>Дополнительная информация:</p><p>по теме Доступ к папкам и файлам Windows 7, 8  <a href="https://support.microsoft.com/ru-ru/help/2623670/access-denied-or-other-errors-when-you-access-or-work-with-files-and-f" class="link-text-info">https://support.microsoft.com/ru-ru/help/2623670/access-denied-or-other-errors-when-you-access-or-work-with-files-and-f</a></p><p>по теме Как стать администратором: <a href="http://www.it-articles.ru/articles.php?id=7" class="link-text-info">http://www.it-articles.ru/articles.php?id=7</a></p><p id="q006" class="lead text-center border-top border-info pt-3">Что такое рейтинговая/нерейтинговая игра?</p><p>На сервере игры есть два вида комнат: RANKED (т.е. Рейтинговая или Оцениваемая в русском переводе) и UNRANKED (нерейтинговая или неоцениваемая). Т.к. эта версия сервера ведет полный учет статистики игроков, то все заезды в рейтинговых комнатах попадают в статистику. Заезды в нерейтинговых комнатах статистику не изменяют. В статистике учитываются очки REP и всякие средние показатели (средний ранг и REP соперников), а также количество побед, поражений и отключений. Победой является только 1-е место. На основании очков REP составляется рейтинг игроков, который можно увидеть как в игре (в ONLINE GAME меню пункт RANKINGS), так и тут на сайте.  Также заезды в рейтинговых комнатах попадают в WEEK\'S TOP PERFORMERS (это в игре) и в <a href="/server/best-performers" class="link-text-info">Звезды треков</a> (это на сайте).</p><p>Во времена EA (обычно так называют время, когда работал официальный сервер NFS Underground) нерейтинговые комнаты использовались обычно для тренировок или каких-нибудь особых мероприятий. Весь народ сидел в рейтинге. Ведь одной из главных задач было подняться вверх по цепочке рейтинга и попасть в WEEK\'S TOP PERFORMERS. Например, во времена EA в дисциплине "кольцо", чтобы попасть в первую сотню нужно было иметь  10&nbsp;000&nbsp;000+ REP. (Для справки: в интерфейсе игры RANKINGS показывает только первую сотню игроков)</p><p id="q007" class="lead text-center border-top border-info pt-3">Что такое комнаты на сервере? Можно ли создать свою комнату?</p><p>Комната&nbsp;— это место, где онлайн игроки могут общаться в игровом чате и создавать гонки. На сервере 31.131.19.86 есть как минимум две комнаты для каждого вида гонок. GLOBAL&nbsp;— для всех игроков. SANDBOX&nbsp;— для новичков. Игроки могут создавать свои комнаты. Для этого нужно нажать "Z" в соответствующем меню игры (см. <a href="/help/gameplay" class="link-text-info">геймплей</a>). На сервере версии 2.5 и выше может быть установлено ограничение на создание собственных комнат игроками. Проверить можно на странице <a href="/server/monitor" class="link-text-info">мониторинга</a> сервера, параметр "Создание комнат".</p><p id="q008" class="lead text-center border-top border-info pt-3">Нужно ли проходить карьеру, чтобы играть по сети?</p><p>Да нужно! Не менее двух раз! <span class="fas fa-smile-beam"></span></p><p>На самой деле проходить карьеру вовсе не обязательно, но очень желательно. Во-первых, это очень интересно и динамично. Во-вторых, вы сможете постепенно познакомиться со всеми трассами. В-третьих, так лучше всего прочувствовать управление машиной. По ходу карьеры машина будет постепенно улучшаться, так же постепенно возрастут и скорости прохождения треков. В-четвертых, вы поймете, как игрок получает уникальные запчасти на автомобиль от <strong>TJ</strong> и сможете понять, какая машина является читерской а какая нет.</p><p id="q009" class="lead text-center border-top border-info pt-3">Что такое TJ-чит?</p><p>TJ-чит&nbsp;— это настройка автомобиля с неправильным количеством или качеством запчастей от TJ. Этот чит дает некоторое преимущество игроку (если он, конечно, сможет справиться с такой мощностью). По количеству&nbsp;— уникальных запчастей должно быть только 3 и не более. По качеству&nbsp;— хорошо описано в <a href="/rules" class="link-text-info">правилах</a>, т. к. на турнирах машины с TJ-читом запрещены. Манипулировать с комбинацией запчастей от TJ можно в программе <a href="/download/nfsu-save-patcher" class="link-text-info">NFSU Save Patcher</a>.</p><p id="q010" class="lead text-center border-top border-info pt-3">Я захожу на сервер, в комнату. Вижу игроков, могу общаться в чате. Но когда захожу в гонку, при запуске обрыв связи. Что делать?</p><p>Самая сложная для решения ситуация. Потому что причин может быть много. Только одно у них общее&nbsp;— в корне лежит проблема с коннектом. Вернее с тем, что его блокирует.</p><p>Первое, что можно сделать в такой ситуации. Либо отключить, либо внести в исключения для игры брандмауэр Windows, все сторонние файрволы, антивирусное ПО. Если это не помогло, то скорее всего проблема в роутере. Это такое устройство, которое обеспечивает связь вашего компьютера с интернет. На роутере должен быть настроен так называемый проброс портов (port forwarding).</p><p>Для нормальной игры по сети необходимо настроить роутер и пробросить следующий порты на ip-адрес компьютера с игрой:</p><p><strong>TCP: 10800, 10900-10999<br>UDP: 10800, 3658, 3659</strong></p><p class="alert alert-warning">Замечание! Следует знать, что проблемы со связью могут быть не только у вашего компьютера, но и на компьютере игрока, с которым вы пытаетесь играть по сети. Смотрите также хороший <a href="/blog/1">пост</a> на эту тему.</p>',
            'seo' => [
                'title' => 'Frequency asked questions on NFSU Cup',
                'keywords' => 'Faq on NFSU Cup, Faq online NFS underground, Faq NFS Underground server',
                'description' => 'Frequency asked questions about NFS Underground online'
            ],
        ]);

        // 9 download/nfsu
        create(Page::class, [
            'parent_id' => 8,
            'path' => '/download/nfsu',
            'link_en' => 'NFS Underground',
            'link_ru' => 'NFS Underground',
            'title_en' => 'Need for Speed Underground (PC 2003)',
            'title_ru' => 'Need for Speed Underground (PC 2003)',
            'content_en' => '<h1 class="text-center">Need for Speed Underground (PC 2003) on NFSU Cup</h1><p style="text-align: left;">Under construction...</p>',
            'content_ru' => '<h1 class="text-center">Need for Speed Underground (PC 2003) на NFSU Cup</h1><p style="text-align: left;">Строится еще...</p>',
            'seo' => [
                'title' => 'Need for Speed Underground (PC 2003)',
                'keywords' => 'download nfs underground on NFSU Cup, NFS Underground server',
                'description' => 'Download Need for Speed Underground (PC 2003) - the game'
            ],
        ]);

        // 10 download/nfsu-client
        create(Page::class, [
            'parent_id' => 3,
            'path' => '/download/nfsu-client',
            'link_en' => 'NFS client',
            'link_ru' => 'NFS клиент',
            'title_en' => 'NFS Underground Client',
            'title_ru' => 'NFS Underground клиент',
            'content_en' => '<h1 class="text-center">NFS Underground Client on NFSU Cup</h1><p style="text-align: left;">Under construction...</p>',
            'content_ru' => '<h1 class="text-center">NFS Underground клиент на NFSU Cup</h1><p style="text-align: left;">Строится еще...</p>',
            'seo' => [
                'title' => 'NFS Underground Client',
                'keywords' => 'download client nfs underground, NFS Underground server, NFS Underground client',
                'description' => 'Client for online playing NFS Underground'
            ],
        ]);

        // 11 download/nfsu-save
        create(Page::class, [
            'parent_id' => 3,
            'path' => '/download/nfsu-save',
            'link_en' => 'NFSU save',
            'link_ru' => 'NFSU сохранение',
            'title_en' => 'NFSU save files',
            'title_ru' => 'NFSU файлы сохранения',
            'content_en' => '<h1 class="text-center">NFSU save files on NFSU Cup</h1><p style="text-align: left;">Under construction...</p>',
            'content_ru' => '<h1 class="text-center">NFS Underground файлы сохранения на NFSU Cup</h1><p style="text-align: left;">Строится еще...</p>',
            'seo' => [
                'title' => 'NFSU save files',
                'keywords' => 'download nfs underground save files, NFS Underground server, NFS Underground career',
                'description' => 'Save files with full career passed for NFS Underground'
            ],
        ]);

        // 12 download/nfsu-save-patcher
        create(Page::class, [
            'parent_id' => 3,
            'path' => '/download/nfsu-save-patcher',
            'link_en' => 'NFSU Save Patcher',
            'link_ru' => 'NFSU Save Patcher',
            'title_en' => 'NFSU save files patcher',
            'title_ru' => 'NFSU Save Patcher',
            'content_en' => '<h1 class="text-center">NFSU Save Patcher on NFSU Cup</h1><p style="text-align: left;">Under construction...</p>',
            'content_ru' => '<h1 class="text-center">NFSU Save Patcher (редактор сохранений) на NFSU Cup</h1><p style="text-align: left;">Строится еще...</p>',
            'seo' => [
                'title' => 'NFSU save files patcher',
                'keywords' => 'download nfs underground save files patcher, NFS Underground career, NFS Underground tuning',
                'description' => 'Patcher for save files NFS Underground. Quick way to change TJ uniques set, career progress, money etc.'
            ],
        ]);
    }
}
