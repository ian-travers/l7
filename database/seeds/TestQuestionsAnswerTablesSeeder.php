<?php

use App\Entities\Test\TestQuestion;
use Illuminate\Database\Seeder;

class TestQuestionsAnswerTablesSeeder extends Seeder
{
    public function run(): void
    {
        /** @var TestQuestion $question */
        $question = create(TestQuestion::class, [
            'question_en' => 'What is required in order to take part in the tourney?',
            'question_ru' => 'Что необходимо сделать для того, чтобы принять участие в турнире?',
            'correct_answer' => '1',
        ]);
        $question->addAnswer(
            'Fill out "Sign Up" form on this site.',
            '"Подать заявку" из меню на этом сайте.',
            '1'
        );
        $question->addAnswer(
            'Send email with request to tourney\'s supervisor.',
            'Отослать письмо с заявкой супервайзеру турнира.',
            '2'
        );
        $question->addAnswer(
            'Ask supervisor to let you take part in this tourney in game chat.',
            'В игровом чате попросить супервайзера разрешить мне участие в турнире.',
            '3'
        );

        // 2
        $question = create(TestQuestion::class, [
            'question_en' => 'How often you should sign up for tourneys?',
            'question_ru' => 'Как часто мне нужно подавать заявку на участие в турнирах?',
            'correct_answer' => '2',
        ]);
        $question->addAnswer(
            'Only once. After that I can take part in any future tourney without sign up.',
            'Один раз. В дальнейшем я смогу участвовать в турнирах без подачи заявок.',
            '1'
        );
        $question->addAnswer(
            'I should sign up for each tourney in which I want to take part.',
            'Я должен подавать заявку на каждый турнир, в котором хочу принять участие.',
            '2'
        );

        // 3
        $question = create(TestQuestion::class, [
            'question_en' => 'How do I find out who are my opponents?',
            'question_ru' => 'Как мне узнать, кто мои соперники?',
            'correct_answer' => '2',
        ]);
        $question->addAnswer(
            'From game chat.',
            'В игровом чате.',
            '1'
        );
        $question->addAnswer(
            'From tourney table on the site.',
            'В турнирной таблице на этом сайте.',
            '2'
        );
        $question->addAnswer(
            'I should ask supervisor.',
            'Спросить у супервайзера.',
            '3'
        );
        $question->addAnswer(
            'I should join to any group I can. If they told me to don\'t join wrong group, then abuse that losers who scared race with me and join to other group.',
            'Зайти в любую группу. Если мне скажут, что я зашел не в ту группу, назвать их сцыкунами, которые боятся со мной проехать, и зайти в какую-нибудь другую группу.',
            '4'
        );

        // 4
        $question = create(TestQuestion::class, [
            'question_en' => 'When the sign up period is finished?',
            'question_ru' => 'Когда заканчивается подача заявок на турнир?',
            'correct_answer' => '3',
        ]);
        $question->addAnswer(
            '5 minutes before the tourney.',
            'За 5 минут до турнира.',
            '1'
        );
        $question->addAnswer(
            '30 minutes before the tourney.',
            'За 30 минут до турнира.',
            '2'
        );
        $question->addAnswer(
            'I need to check information about this tourney on the site.',
            'Нужно проверить информацию о турнире на сайте. Там указан период подачи заявок.',
            '3'
        );

        // 5
        $question = create(TestQuestion::class, [
            'question_en' => 'When does tourney start?',
            'question_ru' => 'Когда начинается проведение турнира?',
            'correct_answer' => '3',
        ]);
        $question->addAnswer(
            'After Tourney table appearance on the site.',
            'Как только на сайте появятся турнирные таблицы.',
            '1'
        );
        $question->addAnswer(
            'After 5 minutes from start time on the site.',
            'Через 5 минут после указанного на сайте времени начала турнира.',
            '2'
        );
        $question->addAnswer(
            'When supervisor tells to start the tourney',
            'Когда супервайзер объявит старт турнира.',
            '3'
        );

        // 6
        $question = create(TestQuestion::class, [
            'question_en' => 'If I was disconnected from the game just on 5-th second after the game was started because of my internet provider, what should I do?',
            'question_ru' => 'Я вылетел из гонки на 5-й секунде после старта заезда из-за обрыва связи с интернетом. Что мне делать?',
            'correct_answer' => '3',
        ]);
        $question->addAnswer(
            'Ask supervisor to restart this game.',
            'Попросить супервайзера назначить перезаезд это гонки.',
            '1'
        );
        $question->addAnswer(
            'Abuse that bastards who did not stop the game because of my disconnect just on 5-th second, and demand restart from them.',
            'Пожаловаться на участников заезда, что они не остановили заезд, и потребовать рестарта.',
            '2'
        );
        $question->addAnswer(
            'According to the rules this game will not be replayed (who created this damn rule?)',
            'Согласно правил, такой заезд не переигрывается (вот такое дурацкое правило).',
            '3'
        );

        // 7
        $question = create(TestQuestion::class, [
            'question_en' => 'If I was assigned to host game, but somebody can not connect to me, what should I do?',
            'question_ru' => 'Я назначен хостом гонки, но один игрок не может присоединиться ко мне. Что я должен делать в таком случае?',
            'correct_answer' => '3',
        ]);
        $question->addAnswer(
            'Start game without this unlucky fellow.',
            'Стартовать и ехать до финиша без этого неудачника.',
            '1'
        );
        $question->addAnswer(
            'Keep trying to recreate game again and again during 30 minutes because nobody else allowed to host this game, and after that go without him.',
            'Пересоздавать гонку снова и снова в течение 30 мин, т.к. никто кроме меня не может быть хостом, затем ехать без него.',
            '2'
        );
        $question->addAnswer(
            'Try to change host. After all guys have tried to host and you still can\'t start all together, ask supervisor to help you.',
            'Сменить хост. Если все варианты с хостом опробованы и заезд все еще не состоялся, попросить помощи у супервайзера.',
            '3'
        );

        // 8
        $question = create(TestQuestion::class, [
            'question_en' => 'Should I remember places of all guys who race with me?',
            'question_ru' => 'Должен ли я запоминать места всех участников заезда?',
            'correct_answer' => '2',
        ]);
        $question->addAnswer(
            'Am I crazy?!',
            'Что!? Конечно нет!',
            '1'
        );
        $question->addAnswer(
            'Yes.',
            'Да.',
            '2'
        );
        $question->addAnswer(
            'Everybody should remember his own place.',
            'Каждый должен помнить только свое место.',
            '3'
        );

        // 9
        $question = create(TestQuestion::class, [
            'question_en' => 'Is 9 TJ\'s upgrades considered as cheat?',
            'question_ru' => '9 TJ уников - это чит?',
            'correct_answer' => '2',
        ]);
        $question->addAnswer(
            'Of course not! Everybody has 9 TJ\'s upgrades.',
            'Нет конечно! Все ездят на 9-ти униках.',
            '1'
        );
        $question->addAnswer(
            'Yes.',
            'Да.',
            '2'
        );

        // 10
        $question = create(TestQuestion::class, [
            'question_en' => 'Is such combination of TJ\'s upgrades as Engine, Weight and NOS considered as cheat?',
            'question_ru' => 'Является ли читом комбинация уников Engine, Weight и NOS?',
            'correct_answer' => '2',
        ]);
        $question->addAnswer(
            'No, it is allowed to have not more than any 3 TJ\'s upgrades.',
            'Нет. Эта комбинация правильная, т.к. только в ней 3 уника.',
            '1'
        );
        $question->addAnswer(
            'Yes, this combination is not allowed.',
            'Да. Такая комбинация невозможна и является читом.',
            '2'
        );

        // 11
        $question = create(TestQuestion::class, [
            'question_en' => 'When next round will be started?',
            'question_ru' => 'Когда начинаются заезды следующего раунда?',
            'correct_answer' => '3',
        ]);
        $question->addAnswer(
            'Right after I have finished one round, I should start play next one to don\'t waste my time.',
            'Сразу после окончания предыдущего раунда. Чего зря время терять!',
            '1'
        );
        $question->addAnswer(
            'When host player asks me to join his game from next round.',
            'Когда хост попросит меня вступить в его игру из следующего раунда.',
            '2'
        );
        $question->addAnswer(
            'When supervisor says to start next round.',
            'Когда супервайзер объявит начало следующего раунда.',
            '3'
        );

        // 12
        $question = create(TestQuestion::class, [
            'question_en' => 'In which tourney types the final round played 4 times?',
            'question_ru' => 'Финальный раунд какого типа гонок состоит из 4-х заездов?',
            'correct_answer' => '3',
        ]);
        $question->addAnswer(
            'Sprint, Drift.',
            'Спринт, дрифт.',
            '1'
        );
        $question->addAnswer(
            'Circuit.',
            'Кольцо.',
            '2'
        );
        $question->addAnswer(
            'Drag, Sprint.',
            'Дрэг, спринт.',
            '3'
        );
        $question->addAnswer(
            'In all 4 types.',
            'Во всех четырех типах.',
            '4'
        );

        // 13
        $question = create(TestQuestion::class, [
            'question_en' => 'How many points will be earned for 3-rd place in final game?',
            'question_ru' => 'Сколько очков дается за 3-е место в финальном раунде?',
            'correct_answer' => '3',
        ]);
        $question->addAnswer(
            '2',
            '2',
            '1'
        );
        $question->addAnswer(
            '3',
            '3',
            '2'
        );
        $question->addAnswer(
            '4',
            '4',
            '3'
        );
        $question->addAnswer(
            '6',
            '6',
            '4'
        );

        // 14
        $question = create(TestQuestion::class, [
            'question_en' => 'f I was first all the race, but right before finish line some bad guy on purpose crash me into the tree, what should I do?',
            'question_ru' => 'Я шел весь заезд на первом месте, как перед самым финишем, кто-то ударил меня и я угодил в отбойник (стену и т.п.). Что я могу сделать в такой ситуации?',
            'correct_answer' => '3',
        ]);
        $question->addAnswer(
            'Demand from supervisor to ban this bastard.',
            'Потребовать супервайзера забанить этого "нехорошего человека".',
            '1'
        );
        $question->addAnswer(
            'Demand restart of this game.',
            'Потребовать рестарта гонки.',
            '2'
        );
        $question->addAnswer(
            'Abuse this bastard, all others who don\'t support you and unfair supervisor, but mentally :) - according to goddamn rules this game will not be restarted.',
            'Послать эту сволочь, заодно всех участников заезда и супервайзера в придачу. Послать, но только мысленно :). А если серьезно, то по правилам, такой заезд не переигрывается.',
            '3'
        );

        // 15
        $question = create(TestQuestion::class, [
            'question_en' => 'How many laps in a regular round of the Drift or Circuit tourney?',
            'question_ru' => 'Из скольки кругов состоит обычный раунд турнира по Дрифту или Кольцу?',
            'correct_answer' => '4',
        ]);
        $question->addAnswer(
            '2',
            '2',
            '1'
        );
        $question->addAnswer(
            '3',
            '3',
            '2'
        );
        $question->addAnswer(
            '5',
            '5',
            '3'
        );
        $question->addAnswer(
            '6',
            '6',
            '4'
        );
        $question->addAnswer(
            '10',
            '10',
            '5'
        );
    }
}
