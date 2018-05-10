<?
	include('includes/config.php');
	header('Content-Type: text/html; charset=utf-8'); 
	session_cache_limiter("must-revalidate");
	$nick = $_SESSION['email'];
	$user = mysql_fetch_array(mysql_query("SELECT * FROM uzytkownicy WHERE `email`='{$nick}' LIMIT 1"));
	
	function osobanazwa($idosoba)
	{
		if ($idosoba=='1') {	$str="student";	}
		else if ($idosoba=='2') {	$str="doktorant";	}
		else if ($idosoba=='3') {	$str="prowadzący";	}
		else if ($idosoba=='4') {	$str="dziekanat";	}
		else if ($idosoba=='5') {	$str="pracownik administracyjny";	}
		else if ($idosoba=='9') {	$str="administrator";	}
		return $str;
	}

	if (!empty($nick))
	{
		
		$upr=osobanazwa($user['uprawnienia']);
		echo "<div id='hello'>Zalogowany użytkownik <b>{$user[imie]} {$user[nazwisko]} ({$upr})</b> !";
		if ($user['uprawnienia']==9)
		{
			echo " <a href='panel.php'><b>Panel administratora</b></a> || ";
		}
		echo " <a href='wylogowanie.php'><b>Wyloguj</b></a></div>";
	}

?>
<!DOCTYPE html>
<html>
<head>
<title>Wydziałowa tablica ogłoszeń</title>
<meta charset="utf-8">
<link rel="stylesheet" href="styles/layout.css" type="text/css">
<!--[if lt IE 9]><script src="scripts/html5shiv.js"></script><![endif]-->
</head>
<body>
<div class="wrapper row1">
  <header id="header" class="clear">
    <div id="hgroup">
      <h1><a href="index.php">Tablica ogłoszeń</a></h1>
      <h2>Wydziału Fizyki, Astronomii i Informatyki Stosowanej<br>Uniwersytetu Jagiellońskiego	</h2>
    </div>
    <nav>
      <ul>
        <li><a href="index.php" <? if (($_SERVER["SCRIPT_URL"]=='/index.php') || ($_SERVER["SCRIPT_URL"]=='/')) { echo " class='active' "; } ?> >Strona startowa</a></li>
		<?
		//GDY NIEZALOGOWANE
		if (empty($nick))
		{
			echo '<li class="last"><a href="logowanie.php"';
			if ($_SERVER["SCRIPT_URL"]=='/logowanie.php') { echo " class='active' "; } 
			echo '>Logowanie</a></li>';
		}
		else //GDY ZALOGOWANE
		{
			//echo '<li><a href="katalog.php">Katalog ogłoszeń</a></li>';
			echo '<li><a href="dodaj.php" ';
			if ($_SERVER["SCRIPT_URL"]=='/dodaj.php') { echo " class='active' "; } 
			echo '>Dodaj ogłoszenie</a></li>';
			echo '<li><a href="ogloszenia.php"';
			if ($_SERVER["SCRIPT_URL"]=='/ogloszenia.php') { echo " class='active' "; } 
			
			echo '>Twoje ogłoszenia</a></li>';
			//echo '<li class="last"><a href="wylogowanie.php">Wyloguj</a></li>';
		}
        ?>
      </ul>
    </nav>
  </header>
  
</div>