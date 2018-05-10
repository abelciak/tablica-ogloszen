<?
	include('includes/gora.php');
?>
<!-- content -->
<div class="wrapper row2">
  <div id="container" class="clear">
	
				<?php
				if ((empty($nick)) OR (empty($user[id])) OR !isset($user[id])) {

				echo "<b>Musisz być zalogowany by dodać ogłoszenie!</b>";
				}
				else
				{

				$akcja = $_GET['akcja'];
				if ($akcja == wykonaj)
				{
					$tytul=htmlspecialchars(strip_tags(mysql_real_escape_string($_POST["tytul"])));
					$tresc=htmlspecialchars(strip_tags(mysql_real_escape_string($_POST["tresc"])));
					//$tresc=mysql_real_escape_string(nl2br(htmlspecialchars(strip_tags(stripslashes(trim($_POST["tresc"]))))));	
					$kategoria=htmlspecialchars(strip_tags(mysql_real_escape_string($_POST["kategoria"])));
					$przypiete=htmlspecialchars(strip_tags(mysql_real_escape_string($_POST["przypiete"])));
					$obrazek=htmlspecialchars(strip_tags(mysql_real_escape_string($_POST["obrazek"])));
					$autor=$user[id];
					$data=date('Y-m-d H:i:s');

					$query="INSERT INTO ogloszenia(autor, data, tytul, tresc, zdjecie, kategoria, przypiete) 
					VALUES('{$autor}','{$data}','{$tytul}','{$tresc}','{$obrazek}','{$kategoria}','{$przypiete}')";

					mysql_query($query) or die(mysql_error()."Błąd!");

						//echo "<br><center><font color=green><b>Ogłoszenie zostało dodane prawidłowo.</b></font></center>";
						echo '<div class="alert-message success"><i><img src="images/icon-success.png"> </i><p><span>Ogłoszenie zostało dodane prawidłowo.</span><br>Twoje ogłoszenie jest już widoczne na stronie głównej.</p></div>';
					
				}	

				?>
				<center>
				<script TYPE="text/javascript" LANGUAGE="JavaScript">
								function check() {
								var tytul2=  document.formularz.tytul.value;
								var tresc2=  document.getElementById("tresc").value;
								if (tytul2=='' || tresc2=='' | tresc2==' ') {
								alert('Musisz wypełnić wszystkie pola!');
								} else {
								document.formularz.submit();
								}
								}
								</script> 

				<form method="post" action="dodaj.php?akcja=wykonaj" name="formularz"> 
				 <table><center>
				<tr><td>Tytuł:</td> <td><input type="text" name="tytul" required style="width:300px; display:block;" ></td></tr>
				<tr><td>Kategoria:</td> <td><select name="kategoria" style="width:300px; display:block;">
					<?
					$queryKat= "SELECT * FROM kategorie WHERE uprawnienia='{$user[uprawnienia]}' ORDER BY `nazwa`  ASC";
					$resultKat= mysql_query($queryKat);
					while($row=mysql_fetch_array($resultKat))
					{
						echo "<option value='{$row[idKategoria]}'>{$row[nazwa]}</option>";
					}
										
					?>
					
					</select></td></tr>
				<tr><td>Treść: </td> <td><textarea type="text" required style="width:300px; display:block;" rows="5" name="tresc" id="tresc"> </textarea></td></tr>
				<tr><td>Obrazek:</td> <td><select name="obrazek" style="width:300px; display:block;">
					<?
					$queryObr= "SELECT * FROM obrazki ORDER BY `nazwa`  ASC";
					$resultObr= mysql_query($queryObr);
					while($rows=mysql_fetch_array($resultObr))
					{
						echo "<option value='{$rows[sciezka]}'>{$rows[nazwa]}</option>";
					}
										
					?>
					
					</select></td></tr>
				<?
				if ($user[uprawnienia]=='4' || $user[uprawnienia]=='5' || $user[uprawnienia]=='9')
				{
					?>
					<tr><td>Przypięte:</td> <td><select name="przypiete" style="width:300px; display:block;">
						<option value="0">Nie</option>
						<option value="1">Tak</option>
						</select></td></tr>	
					<?
				}
				?>		</center></table>
				<input type="button" value="Dodaj ogłoszenie!" onClick="check()">    <input type="reset" value="Wyczyść"/> </form>			
				</center>					
								
				<?
				}
				?>	
	
  </div>
</div>
<?
	include('includes/dol.php');
?>