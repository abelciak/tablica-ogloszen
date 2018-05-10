SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE IF NOT EXISTS `kategorie` (
  `idKategoria` int(11) NOT NULL AUTO_INCREMENT,
  `uprawnienia` int(11) DEFAULT '0',
  `nazwa` varchar(40) DEFAULT '0',
  PRIMARY KEY (`idKategoria`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`idKategoria`, `uprawnienia`, `nazwa`) VALUES
(1, 1, 'Wydarzenia'),
(2, 1, 'Korepetycje'),
(3, 1, 'Wynajem'),
(4, 5, 'Ogłoszenia administracyjne'),
(5, 4, 'Ogłoszenia dziekańskie'),
(6, 9, 'Ogłoszenia techniczne'),
(7, 3, 'Ogłoszenia ogólne');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `obrazki`
--

CREATE TABLE IF NOT EXISTS `obrazki` (
  `idObrazek` int(11) NOT NULL AUTO_INCREMENT,
  `sciezka` varchar(40) DEFAULT '0',
  `nazwa` varchar(40) NOT NULL,
  PRIMARY KEY (`idObrazek`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Zrzut danych tabeli `obrazki`
--

INSERT INTO `obrazki` (`idObrazek`, `sciezka`, `nazwa`) VALUES
(1, '0', 'Brak'),
(2, 'img/wykrzyknik.jpg', 'Ikona - wykrzyknik'),
(3, 'img/korepetycje.png', 'Ikona - korepetycje'),
(4, 'img/wynajem.png', 'Ikona - wynajem'),
(5, 'img/konserwacja.png', 'Ikona - konserwacja'),
(6, 'img/korepetycje2.png', 'Ikona - korepetycje2'),
(7, 'img/korepetycje3.png', 'Ikona - korepetycje3'),
(8, 'img/impreza.png', 'Ikona - impreza studencka'),
(9, 'img/ksiazka.png', 'Ikona - książka'),
(10, 'img/test.png', 'Ikona - egzamin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ogloszenia`
--

CREATE TABLE IF NOT EXISTS `ogloszenia` (
  `idOgloszenie` int(11) NOT NULL AUTO_INCREMENT,
  `autor` int(11) DEFAULT '0',
  `data` datetime DEFAULT '0000-00-00 00:00:00',
  `tytul` varchar(250) DEFAULT '0',
  `tresc` varchar(1000) DEFAULT '0',
  `przypiete` int(2) NOT NULL,
  `kategoria` int(2) NOT NULL,
  `zdjecie` varchar(250) DEFAULT '0',
  PRIMARY KEY (`idOgloszenie`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Zrzut danych tabeli `ogloszenia`
--

INSERT INTO `ogloszenia` (`idOgloszenie`, `autor`, `data`, `tytul`, `tresc`, `przypiete`, `kategoria`, `zdjecie`) VALUES
(18, 3, '2018-01-07 14:16:34', 'Zajęcia ''Prawo internetu'' nie odbędą się', 'Najbliższe zajęcia z Prawa Internetu dla kierunku informatyka w piątek,  30.01.2017 nie odbędą się z powodu choroby. Zastępstwo zostanie wyznaczone w późniejszym terminie.', 0, 7, 'img/wykrzyknik.jpg'),
(25, 5, '2018-01-09 10:40:11', 'Deklaracje wyboru przedmiotu', '31 stycznia mija termin składania deklaracji wyboru przedmiotu. Osoby, które nie złożył deklaracji, proszę o natychmiastowe złożenie. ', 1, 5, 'img/wykrzyknik.jpg'),
(56, 1, '2018-01-23 10:37:58', 'PILNE! Szukam pokoju jednoosobowego.', ' Wynajmę pokój jednoosobowy blisko Kampusu UJ, najlepiej do 700 zł. Oferty proszę przesyłać na adres jan.kowalski@student.uj.edu.pl', 0, 3, 'img/wynajem.png'),
(57, 1, '2018-01-23 10:39:04', 'Udzielę korepetycji z matematyki', ' Udzielę korepetycji z matematyki na każdym poziomie, cena 35 zł za godzinę zegarową. Proszę o kontakt po godz. 18. Telefon +48 867 123 456', 0, 2, 'img/korepetycje.png'),
(37, 1, '2018-01-09 12:30:26', 'Zakończenie sesji w klubie studenckim Kwadrat', 'Serdecznie zapraszamy na zakończenie sesji w klubie Kwadrat 10 lutego 2018r. Rezerwacja miejsc pod numerem telefonu +48 666 777 888', 0, 1, 'img/impreza.png'),
(43, 3, '2018-01-09 12:39:48', 'Kolokwium zaliczeniowe', ' W przyszłym tygodniu odbędzie się kolokwium zaliczeniowe.', 0, 7, 'img/wykrzyknik.jpg'),
(58, 2, '2018-01-23 10:40:23', 'Szukam korepetycji z Analizy Matematycznej', 'Szukam osoby, która pomoże mi obliczać całki z Analizy Matematycznej. Kontakt: +48 777 666 555 ', 0, 2, 'img/korepetycje2.png'),
(61, 4, '2018-01-23 11:18:45', 'Przerwa techniczna w dostępie do witryny', 'W najbliższą sobotę (27.01.2018) tablica ogłoszeń będzie nieczynna od godz. 02:00 - 06:00 z powodu aktualizacji oprogramowania. Przepraszamy. ', 1, 6, 'img/konserwacja.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE IF NOT EXISTS `uzytkownicy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) DEFAULT '0',
  `imie` varchar(20) NOT NULL,
  `nazwisko` varchar(20) NOT NULL,
  `uprawnienia` int(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `email`, `imie`, `nazwisko`, `uprawnienia`) VALUES
(1, 'jan.kowalski@student.uj.edu.pl', 'Jan', 'Kowalski', 1),
(2, 'andrzej.nowak@student.uj.edu.pl', 'Andrzej', 'Nowak', 1),
(3, 'karol.polak@uj.edu.pl', 'Karol', 'Polak', 3),
(4, 'admin.wfais@uj.edu.pl', 'Administrator', '', 9),
(5, 'dziekanat.fais@uj.edu.pl', 'Dziekanat', 'Fizyki', 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
