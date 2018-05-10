<?
	include('includes/gora.php');
?>
<!-- content -->
<div class="wrapper row2">
  <div id="container" class="clear">
	
		<?
			$login = $_POST['username'];
			
			if (!$login OR empty($login))
			{
				
			}
			else //dane z formularza niepuste
			{
				
				$istnick = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `uzytkownicy` WHERE `email` = '$login'")); // sprawdzenie czy istnieje uzytkownik o takim nicku i hasle
					if ($istnick[0] == 0)
					{
						echo '<center><h3><span style="color: red; "><b>Logowanie nieudane. Podałeś niepoprawne dane. Spróbuj ponownie.</b></span></h3></center>';
					} 
					else
					{
					$_SESSION['email'] = $login;
				
					echo '<div class="alert-message success"><i><img src="images/icon-success.png"> </i><p><span>Zostałeś poprawnie zalogowany!</span><br>Zostaniesz przekierowany do strony głównej.</p></div><meta http-equiv="Refresh" content="4; url=../index.php">';
					
					//echo '<center><h3><span style="color: green; "><b>Zostałeś poprawnie zalogowany! Zostaniesz przekierowany do strony głównej.</b></span></h3></center><meta http-equiv="Refresh" content="3; url=../index.php">';
					$check=true;
					}
			}
			
		/*
		<label for="username">Wprowadź swój identyfikator z systemu USOS:</label>
		<input type="text" id="username" name="username" required>
		*/
		?>
		<?
		if ($check==true)
		{
			
		}
		else
		{
		?>
		<div id="panel">
		<form method="POST" action="logowanie.php">
		<label for="username">Wybierz role w systemie:</label>
		<div id="lower">
		<select id="username" name="username">
		<option value="admin.wfais@uj.edu.pl">Administrator</option>
		<option value="dziekanat.fais@uj.edu.pl">Dziekanat Fizyki</option>
		<option value="karol.polak@uj.edu.pl">Prowadzący1</option>
		<option value="andrzej.nowak@student.uj.edu.pl">Student1</option>
		<option value="jan.kowalski@student.uj.edu.pl">Student2</option>
		
		</select>
		<br>
		<center><input type="submit" value="Zaloguj"></center>
		
		</div>
		</form>
		<?
		}
		?>
	</div>
	
	
  </div>
</div>
<?
	include('includes/dol.php');
?>