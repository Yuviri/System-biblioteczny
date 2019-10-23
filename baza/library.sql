-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 23 Paź 2019, 12:57
-- Wersja serwera: 10.1.37-MariaDB
-- Wersja PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `library`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `egzemplarz`
--

CREATE TABLE `egzemplarz` (
  `id_egzemplarza` int(11) NOT NULL,
  `ISBN` varchar(13) COLLATE utf8_polish_ci NOT NULL,
  `czy_wyp` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `egzemplarz`
--

INSERT INTO `egzemplarz` (`id_egzemplarza`, `ISBN`, `czy_wyp`) VALUES
(1, '9788328020047', 0),
(2, '9788328020047', 0),
(3, '9788328020047', 0),
(4, '9788374809108', 0),
(5, '9788374809108', 0),
(6, '9788374809108', 0),
(7, '9788374809108', 0),
(8, '9788377582558', 1),
(9, '9788374809108', 0),
(10, '9788374809108', 0),
(11, '9788375080346', 1),
(12, '9788375080346', 0),
(13, '9788375080346', 0),
(14, '9788375749267', 0),
(15, '9788375749267', 0),
(16, '9788375749762', 0),
(17, '9788376592374', 0),
(18, '9788376592374', 0),
(19, '9788376597188', 0),
(20, '9788376597188', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `komentarze`
--

CREATE TABLE `komentarze` (
  `id_komentarza` int(11) NOT NULL,
  `autor` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `ksiazka` varchar(13) COLLATE utf8_polish_ci NOT NULL,
  `data_w` datetime NOT NULL,
  `za` int(11) NOT NULL,
  `tresc` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `komentarze`
--

INSERT INTO `komentarze` (`id_komentarza`, `autor`, `ksiazka`, `data_w`, `za`, `tresc`) VALUES
(1, 'quinn@gmail.com', '9788328020047', '2019-10-18 10:59:00', 0, 'Wspaniała to była książka, nie zapomnę jej nigdy.'),
(2, 'qwerty@interia.pl', '9788328020047', '2019-10-19 08:26:25', 3, 'Komentarz testowy'),
(3, 'op@wp.pl', '9788328020047', '2019-10-17 00:00:00', 132, 'Jeszcze jeden komentarz testowy'),
(4, 'op@wp.pl', '9788375080346', '2019-10-20 00:00:00', 5, 'Test komunikatów');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownik`
--

CREATE TABLE `pracownik` (
  `id_pracownika` int(11) NOT NULL,
  `imie` text COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` text COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `haslo` text COLLATE utf8_polish_ci NOT NULL,
  `adres` text COLLATE utf8_polish_ci NOT NULL,
  `data_ur` date NOT NULL,
  `plec` char(1) COLLATE utf8_polish_ci NOT NULL,
  `telefon` varchar(11) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pracownik`
--

INSERT INTO `pracownik` (`id_pracownika`, `imie`, `nazwisko`, `email`, `haslo`, `adres`, `data_ur`, `plec`, `telefon`) VALUES
(1, 'Anna', 'Kowalska', 'a_kowalska@gmail.com', '$2y$10$B8tdDCtQ/xqMbgB3YqqcjugRIh8r1M88OpzMtRnmtkNDVGxy1ryIi', 'Miodowa 23 09-383 Warszawa', '1972-02-02', 'K', '123-231-122');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezerwacja`
--

CREATE TABLE `rezerwacja` (
  `id_rez` int(11) NOT NULL,
  `czytelnik` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `egzemplarz` int(11) NOT NULL,
  `status` text COLLATE utf8_polish_ci,
  `od` datetime NOT NULL,
  `do` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `rezerwacja`
--

INSERT INTO `rezerwacja` (`id_rez`, `czytelnik`, `egzemplarz`, `status`, `od`, `do`) VALUES
(14, 'quinn@gmail.com', 4, 'zakonczona', '2019-09-25 14:52:51', '2019-09-26 14:52:51');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `szczegoly`
--

CREATE TABLE `szczegoly` (
  `ISBN` varchar(13) COLLATE utf8_polish_ci NOT NULL,
  `nazwa` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `autor` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `tytul_oryginalu` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `gatunek` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `opis` text COLLATE utf8_polish_ci NOT NULL,
  `wydawnictwo` int(11) NOT NULL,
  `cover` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `szczegoly`
--

INSERT INTO `szczegoly` (`ISBN`, `nazwa`, `autor`, `tytul_oryginalu`, `gatunek`, `opis`, `wydawnictwo`, `cover`) VALUES
('9788328020047', 'Zabójczyni', 'Sarah J. Maas', 'The Assassin and the Pirate Lord', 'Fantasy', '...', 1, 'img/covers/zabojczyni.jpg'),
('9788374809108', 'Bożogrobie', 'Jay Kristoff', 'Godsgrave', 'Fantasy', 'Mia Corvere, niszczycielka cesartw, znalazła sobie miejsce pośród Ostrzy Naszej Pani od Błogosławionego Morderstwa, ale wielu członów Duchowieństwa Czerwonego Kościoła uważa, że na to nie zasłużyła', 1, 'img/covers/bozogrobie.jpg'),
('9788375080346', 'Bractwo Tajemnego Znaku', 'Michael Peinkofer', 'DIE BRUDERSCHAFT DER RUNEN', 'Kryminał', 'Niezapomniana literacka wyprawa do bajkowej rezydencji samego Waltera Scotta. Znakomita powieść, która przyniosła Michaelowi Peinkoferowi międzynarodową sławę. Kiedy asystent znanego szkockiego pisarza Waltera Scotta umiera w tajemniczych okolicznościach, na miejsce przysłany zostaje z Londynu królewski inspektor, by wyjaśnić zagadkę jego śmierci. Szybko się jednak okazuje, że mężczyzna coś ukrywa i najpewniej prowadzi jakąś własną grę. Słynnemu autorowi powieści rycerskich, Walterowi Scottowi nie pozostaje nic innego, jak wszcząć dochodzenie na własną rękę. Z pomocą siostrzeńca, Quentina, natrafia wkrótce na ślad jednej z największych zagadek królów Szkocji sięgającej 1314 roku. Bractwo Tajemnego Znaku to fascynująca wędrówka po średniowiecznych, ponurych zamczyskach Szkocji, starych bibliotekach, zagadkowych podziemiach i tajemniczych zaułkach Edynburga. To również gwarancja niezapomnianej przygody.', 1, 'img/covers/bractwo.jpg'),
('9788375749267', 'Żarna niebios', 'Maja Lidia Kossakowska', 'Żarna niebios', 'Fantasy', 'Nic, co anielskie, diabelnie nie jest nam obce. Te żarna przemielą Waszą wiarę w zaświaty. Aniołowie paktują z diabłami. Grzeszą pychą. Piją, bywają w burdelach i kasynach. Knują, zabijają, umierają. Z niebiańskiej doskonałości pozostał im tylko doskonały wygląd. Stworzeni na obraz i podobieństwo człowieka, mają nasze słabości. Jak anioł ćpun uzależniony od trawki z Fatimy, anioł stróż czujący niechęć do człowieka, którym przyszło mu się opiekować czy anioł zagłady, który nieszczególnie lubi niszczyć. Nie inaczej z mieszkańcami piekieł. I oni są do bólu… ludzcy. Nic dziwnego, skoro wyszliśmy spod ręki tego samego Boga. Spis opowiadań: Światło w tunelu, Dopuszczalne straty, Sól na pastwiskach niebieskich, Zobaczyć czerwień, Kosz na śmierci, Smuga krwi, Żarna niebios, Wieża zapałek, Gringo, Beznogi tancerz.', 1, 'img/covers/zarna.jpg'),
('9788375749762', 'Zbieracz Burz Tom I', 'Maja Lidia Kossakowska', 'Zbieracz Burz Tom I', 'Fantasy', 'Oto on... Niszczyciel Światów,\r\nMiecz Pana, Lewa Ręka Boga.\r\n\r\nOto Królestwo Niebieskie... w którym nie ma Boga.\r\nOto miejsce, gdzie archanioł sprzymierza się z diabłem.\r\nOto Daimon Frey. Wiara, Nadzieja, Miłość...\r\nTo jego grzechy kardynalne.\r\nNad jego głową znów zawisły ciężkie chmury, a w Siódmym Niebie zaległa głucha cisza... cisza przed burzą.', 1, 'img/covers/zbieracz1.jpg'),
('9788376592374', 'Lewa Ręka Boga', 'Paul Hoffman', 'Left Hand of God', 'Fantasy', 'Niezwykła, wymykająca się klasyfikacjom powieść z elementami fantasy Paula Hoffmana, amerykańskiego pisarza i scenarzysty. „Lewa ręka Boga” otwiera epicką trylogię o młodym Thomasie Cale, niepokornym akolicie Powieszonego Odkupiciela.\r\n\r\nW Sanktuarium nie ma miejsca na litość i miłosierdzie. Ci, którzy trafiają do kamiennego labiryntu sal, mają tylko jedno zadanie: walczyć aż do śmierci o Jedynie Słuszną Wiarę. Tomas Cale ma piętnaście albo szesnaście lat – nie pamięta. Nie pamięta również tego, jak nazywał się, nim trafił w ręce okrutnych braci. Niezwykle utalentowany, zarówno czarujący, jak i zdolny do niebywałego okrucieństwa, w chwili słabości pozwala sobie na nieodpowiedzialny czyn. W odruchu litości zabija pastwiącego się nad młodą kobietą odkupiciela, podpisując na siebie wyrok śmierci. Tomas musi uciekać przed karzącą ręką Powieszonego Odkupiciela i jego fanatycznych wyznawców. Wraz z ocaloną dziewczyną i przyjaciółmi, Henrim i Kleistem, opuszcza Sanktuarium, by stawić czoła rzeczywistości poza jego murami. Niełatwy charakter, porywczość i budzące niepokój zdolności nie ułatwią mu ukrycia się pomiędzy normalnymi ludźmi…', 1, 'img/covers/lewa1.jpg'),
('9788376597188', 'Lewa ręka Boga II: Anioł śmierci', 'Paul Hoffman', 'The Last Four Things', 'Fantasy', 'Trzymająca w napięciu powieść fantasy, kontynuacja znakomitej \"Lewej Ręki Boga\". Po upadku Memphis Thomas Cale powraca do upiornego Sanktuarium. W ślad za nim podążają jego przyjaciele - Mętny Henri, Klais i Idrys Pukke. Jednak Klais szybko opuszcza kompanię, by spróbować ułożyć sobie na nowo życie wśród kleftów, zbójeckich górali. U boku chłopaka pozostaje tylko Henri. Zakon ma wobec Cale\'a dalekosiężne plany... Odkupiciel angażuje młodzieńca do realizacji swej wizji - Cale, niegdyś jedyny niepokorny i skłonny do współczucia uczeń zgromadzenia, teraz ma stać się Aniołem Śmierci, wcielonym boskim gniewem, ostatecznym narzędziem zniszczenia. Upadek ludzkości i krwawa łaźnia są konieczne, jak mówi Bosco. Jedynie poprzez zniszczenie możliwe są powtórne narodziny świata, powtórne stworzenie. Cale wydaje się akceptować swój los - przeznaczenie niszczyciela świata. Absolutna potęga jest w zasięgu jego ręki, chłopak ma pod swoim dowództwem potężny oddział przyboczny, dwustu czyśćcowych skazańców. Pierwsze zadanie kończy się spektakularnym sukcesem... Już niebawem Cale stanie na czele największej armii odkupicieli i rozpocznie krwawe dzieło zbawienia. Jednak dusza Cale\'a jest bardziej skomplikowana niż mogliby przypuszczać jego mentorzy. Miotany sprzecznymi odczuciami, zrozpaczony, chory z nienawiści młodzieniec nie jest narzędziem idealnym - wystarczy jeden błąd odkupicieli, by Cale zszedł z przeznaczonej mu ścieżki.', 1, 'img/covers/lewa2.jpg'),
('9788377582558', 'Władca Pierścieni', 'J.R.R Tolkien', 'The Lord of The Rings', 'Fantasy', 'Władca Pierścieni to jedna z najbardziej niezwykłych książek w całej współczesnej literaturze...', 1, 'img/covers/wladca.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `email` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `haslo` text COLLATE utf8_polish_ci NOT NULL,
  `imie` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `plec` char(1) COLLATE utf8_polish_ci NOT NULL,
  `telefon` varchar(9) COLLATE utf8_polish_ci NOT NULL,
  `awatar` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`email`, `haslo`, `imie`, `nazwisko`, `plec`, `telefon`, `awatar`) VALUES
('op@wp.pl', '$2y$10$mGKV8rc/yODHx3cXTGGm.ODI5edS.My1b3Oxeb.y5N/AY6y51qNZ6', 'Op', 'Op', 'M', '322224456', 'img/avatars/defaultM.png'),
('quinn@gmail.com', '$2y$10$B8tdDCtQ/xqMbgB3YqqcjugRIh8r1M88OpzMtRnmtkNDVGxy1ryIi', 'Quinn', 'Min', 'M', '698234909', 'img/avatars/defaultM.png'),
('qwerty@interia.pl', '$2y$10$YyOB6QkpYCJNffQeyXYXP.HZtkuIoqYB0nPNEeCzDAQ.3ENyhXZ9u', 'Abdula&#39;h&#39;h', 'Shakh-mamah', 'M', '123456789', 'img/avatars/defaultM.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wydawnictwo`
--

CREATE TABLE `wydawnictwo` (
  `id_wydawnictwa` int(11) NOT NULL,
  `nazwa_wydawnictwa` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `adres` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `telefon` varchar(9) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `wydawnictwo`
--

INSERT INTO `wydawnictwo` (`id_wydawnictwa`, `nazwa_wydawnictwa`, `adres`, `telefon`, `email`) VALUES
(1, 'Foksal', 'Foksal 17, 00-372 Warszawa', '6420510', 'biuro@gwfoksal.pl'),
(2, 'MUZA', 'Sienna 73, 00-833 Warszawa', '6211775', 'info@muza.com.pl'),
(3, 'Wydawnictwo MAG', 'Krypska 21 m. 63, 04-082 Warszawa', '228134743', ''),
(4, 'Sonia Draga', 'ul. Fitelberga 1\r\n40-588 Katowice', '327826477', 'info@soniadraga.pl'),
(5, 'Fabryka Słów', 'ul. Chmielna 28b/ 4 pietro\r\n00-020 Warszawa', '', 'biuro@fabrykaslow.com.pl'),
(6, 'Albatros', 'ul. Hlonda 2a/25\r\n02-972 Warszawa', '222512272', 'biuro@wydawnictwoalbatros.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypozyczenie`
--

CREATE TABLE `wypozyczenie` (
  `id_wyp` int(11) NOT NULL,
  `czytelnik` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `pracownik` int(11) NOT NULL,
  `id_egzemplarza` int(11) NOT NULL,
  `od` date NOT NULL,
  `do` date DEFAULT NULL,
  `data_zwrotu` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `wypozyczenie`
--

INSERT INTO `wypozyczenie` (`id_wyp`, `czytelnik`, `pracownik`, `id_egzemplarza`, `od`, `do`, `data_zwrotu`) VALUES
(37, 'quinn@gmail.com', 1, 1, '2019-09-21', '2019-10-21', '2019-09-23'),
(42, 'quinn@gmail.com', 1, 8, '2019-09-25', '2019-10-25', NULL),
(43, 'quinn@gmail.com', 1, 16, '2019-09-25', '2019-10-25', '2019-10-05'),
(44, 'qwerty@interia.pl', 1, 11, '2019-10-23', '2019-11-23', NULL);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `egzemplarz`
--
ALTER TABLE `egzemplarz`
  ADD PRIMARY KEY (`id_egzemplarza`),
  ADD KEY `ISBN` (`ISBN`);

--
-- Indeksy dla tabeli `komentarze`
--
ALTER TABLE `komentarze`
  ADD PRIMARY KEY (`id_komentarza`),
  ADD KEY `autor` (`autor`),
  ADD KEY `ksiazka` (`ksiazka`);

--
-- Indeksy dla tabeli `pracownik`
--
ALTER TABLE `pracownik`
  ADD PRIMARY KEY (`id_pracownika`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeksy dla tabeli `rezerwacja`
--
ALTER TABLE `rezerwacja`
  ADD PRIMARY KEY (`id_rez`),
  ADD KEY `czytelnik` (`czytelnik`),
  ADD KEY `egzemplarz` (`egzemplarz`);

--
-- Indeksy dla tabeli `szczegoly`
--
ALTER TABLE `szczegoly`
  ADD PRIMARY KEY (`ISBN`),
  ADD KEY `wydawnictwo` (`wydawnictwo`);

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`email`);

--
-- Indeksy dla tabeli `wydawnictwo`
--
ALTER TABLE `wydawnictwo`
  ADD PRIMARY KEY (`id_wydawnictwa`);

--
-- Indeksy dla tabeli `wypozyczenie`
--
ALTER TABLE `wypozyczenie`
  ADD PRIMARY KEY (`id_wyp`),
  ADD KEY `id_egzemplarza` (`id_egzemplarza`) USING BTREE,
  ADD KEY `pracownik` (`pracownik`),
  ADD KEY `czytelnik` (`czytelnik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `egzemplarz`
--
ALTER TABLE `egzemplarz`
  MODIFY `id_egzemplarza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `komentarze`
--
ALTER TABLE `komentarze`
  MODIFY `id_komentarza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `pracownik`
--
ALTER TABLE `pracownik`
  MODIFY `id_pracownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `rezerwacja`
--
ALTER TABLE `rezerwacja`
  MODIFY `id_rez` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `wydawnictwo`
--
ALTER TABLE `wydawnictwo`
  MODIFY `id_wydawnictwa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `wypozyczenie`
--
ALTER TABLE `wypozyczenie`
  MODIFY `id_wyp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `egzemplarz`
--
ALTER TABLE `egzemplarz`
  ADD CONSTRAINT `egzemplarz_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `szczegoly` (`ISBN`);

--
-- Ograniczenia dla tabeli `komentarze`
--
ALTER TABLE `komentarze`
  ADD CONSTRAINT `komentarze_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `uzytkownik` (`email`),
  ADD CONSTRAINT `komentarze_ibfk_2` FOREIGN KEY (`ksiazka`) REFERENCES `szczegoly` (`ISBN`);

--
-- Ograniczenia dla tabeli `rezerwacja`
--
ALTER TABLE `rezerwacja`
  ADD CONSTRAINT `rezerwacja_ibfk_1` FOREIGN KEY (`czytelnik`) REFERENCES `uzytkownik` (`email`),
  ADD CONSTRAINT `rezerwacja_ibfk_2` FOREIGN KEY (`egzemplarz`) REFERENCES `egzemplarz` (`id_egzemplarza`);

--
-- Ograniczenia dla tabeli `szczegoly`
--
ALTER TABLE `szczegoly`
  ADD CONSTRAINT `szczegoly_ibfk_1` FOREIGN KEY (`wydawnictwo`) REFERENCES `wydawnictwo` (`id_wydawnictwa`);

--
-- Ograniczenia dla tabeli `wypozyczenie`
--
ALTER TABLE `wypozyczenie`
  ADD CONSTRAINT `wypozyczenie_ibfk_2` FOREIGN KEY (`id_egzemplarza`) REFERENCES `egzemplarz` (`id_egzemplarza`),
  ADD CONSTRAINT `wypozyczenie_ibfk_3` FOREIGN KEY (`pracownik`) REFERENCES `pracownik` (`id_pracownika`),
  ADD CONSTRAINT `wypozyczenie_ibfk_4` FOREIGN KEY (`czytelnik`) REFERENCES `uzytkownik` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
