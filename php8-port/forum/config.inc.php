<?php
require_once __DIR__ . "/compat.php";
 
#показывать смайлики ('yes'=да , 'no'=нет)
$smiles = "yes";

#Допускать до форума неопределенный Ip  ('yes'=да , 'no'=нет)
$ip_unknown = "no";

#Включить подсветку для текста Php ('yes'=да , 'no'=нет)
$podsvet = "yes";

#Интервал в секундах, по которому определяется сколько одновременно на сайте человек.
$time_sait = 120;

#Ваше название
$title = "ФОРУМ";

#Название форума
$titl = "для начинающих";

#Ваш начальный url (поставить правильно, без последнего слеша, очень важно)
$url_admin = "/forum";

#Папка с шаблонами htm
$dtemplates = "templates";

#Файл, где хранятся данные о посетителях форума, их Ip адреса
$user_ip_dat = "logs/user_ip.dat";    

#Файл, где хранятся данные о посетителях форума с cookie
$user_id_dat = "logs/user_id.dat";    

# Пароль админа
$password = "mc0992300";

#Слова на кнопке добавления сообщения
$add_b = "добавить";

#Файл-база форума
$baseforum = "data/baseforum.dat";

#На сколько обрезать строку в сообщениях
$obrez_cons = 75;

#На сколько обрезать $title в обрезанных строках
$obrez_cons_title = 700;

#Ограничитель вывода номеров страниц навигации по сколько штук показывать
$addpage=4;

#Сколько показывать сообщений на одной странице юзера форума
$onlygforum = 5;

#При разбиении на странички выводить...
$perp = "Перейти на страницу:";

#Использовать автозамену матов в сообщении пользователя? ('yes' - да и 'no' - нет)
$auchmessage = "yes";

#Использовать автозамену матов в имени пользователя? ('yes' - да и 'no' - нет)  
$auchname = "yes";

#Шаблон сообщения, по которому отсылается новое сообщение админу на e-mail
$nmig_forum = "
<font color=de0000 face=verdana size=2>Новое сообщение. %titl%!</font><br>
<font color=000080 face=verdana size=2>----------------------------------------</font><br>
<font color=green face=verdana size=2>Информация о пользователе:<br>
<font color=green face=verdana size=2>Имя пользователя:</font> <font color=de0000 face=verdana size=2>%name%</font> (<font face=verdana size=2 color=blue>%ip%</font>)<br>
<font color=green face=verdana size=2>E-mail:</font> <font color=de0000 face=verdana size=2>%mail%</font><br>
<font color=green face=verdana size=2>Дата сообщения:</font> <font color=de0000 face=verdana size=2>%date%</font><br>
<font color=000080 face=verdana size=2>----------------------------------------</font><br><br>
<font color=green face=verdana size=2>Сообщение:</font><br><font face=verdana size=2>%message%</font><br>
<font color=000080 face=verdana size=2>----------------------------------------</font><br><br>
<font face=verdana size=2 font color=000080><a href=%adres_mail% target=_blank>Посмотреть новое сообщение</a></font>
";

#Шаблон сообщения, по которому отсылается ответ на сообщение админу и пользователю e-mail
$nmig_forum_otvet = "
<font color=ff0000 face=verdana size=2>Ответ на Ваше сообщение! %titl%</font><br>
<font color=000080 face=verdana size=2>----------------------------------------</font><br>
<font color=ff0000 face=verdana size=2>Информация о Вас:<br></font>
<font color=000080 face=verdana size=2>Имя:</font> <font face=verdana size=2>%name_absolut%</font><br>
<font color=000080 face=verdana size=2>Email:</font> <font face=verdana size=2>%mail_absolut%</font><br>
<font color=000080 face=verdana size=2>Дата сообщения:</font> <font face=verdana size=2>%date_absolut%</font><br>
<font color=000080 face=verdana size=2>Ваше сообщение:</font><br><font face=verdana size=2>%message_absolut%</font><br>
<font color=000080 face=verdana size=2>----------------------------------------</font><br><br>
<font color=ff0000 face=verdana size=2>Отправил ответ:<br></font>
<font color=000080 face=verdana size=2>Имя:</font> <font face=verdana size=2>%name% (IP - %ip%)</font><br>
<font color=000080 face=verdana size=2>Дата ответа:</font> <font face=verdana size=2>%date%</font><br>
<font color=000080 face=verdana size=2>Ответ:</font><br><font face=verdana size=2>%message%</font><br><br>
<font color=000080 face=verdana size=2>----------------------------------------</font><br>
<font face=verdana size=2 font color=000080><a href=%adres_mail% target=_blank>Посмотреть все ответы на Ваше сообщение. %titl%.</a></font>
"; 

#Файл автозамены матов на другие слова
$autochange= "data/autochange.dat";

#Папка 'logs', где хранится лог файл, временный файл и файлы Ip и Id юзер
$dlogs = "logs";

#Цвет ошибок
$error_color = "ff0000";

#Максимальная длинна слова в сообщении
$mlwim = "85";

#Файл-бан-лист, для запрета ip
$banlist = "data/banlist.dat";

#E-mail админа, ваш email, куда вам будут приходить сообщения из форума
$moa = "beginneradmin@tut.by";

#Посылать новые сообщения на e-mail админа? ('yes' - да или 'no' - нет)
$iwe = "yes";

#Максимальная длинна слова в имени
$mlwimn = 40;

# Максимальная длина e-mail
$mmail = 45;

# Максимальная длина сообщения
$mmessageforum = 3000;

# Ошибки
$e1 = "Заполнены не все обязательные поля.";
$e6 = "Ваше сообщение превышает $mmessageforum сим.";
$e7 = "Вы указали некорректный e-mail.";
$e8 = "Такое сообщение уже есть в базе.";
$e9 = "Вам закрыли доступ!";

#Цвет страницы админа
$color_body = "bgcolor=FDFDFF";
#Цвет сетки таблицы админа
$color_table = "bgcolor=ooccff";
#Цвет ячеек таблицы админа
$color_td = "bgcolor=FDFDFF";
#цвет выделенных слов админа
$word = "color=000080";
#цвет очень выделенных слов админа
$word_s = "color=ff0000";
#цвет не очень выделенных слов админа
$word_a = "color=808080";
?>