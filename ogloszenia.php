<?
	include('includes/gora.php');
?>
<!-- content -->
<div class="wrapper row2">
  <div id="container" class="clear">
    <!-- content body -->

    <!-- main content -->
    <div id="content">
      <section id="services" class="last clear">
	  <h2>Twoje ogłoszenia</h2>
		<?
		$akcja=$_GET['akcja'];
		
		$resultOgl = mysql_query("SELECT count(*) FROM ogloszenia WHERE autor='{$user[id]}'");
		$checkOgl=mysql_result($resultOgl, 0);	
		
		if ($checkOgl==0)
		{
			//echo "<center><font color='blue'><b>Brak dodanych ogłoszeń!</b></font></center>";
			echo "<div class='alert-message info'><i><img src='images/icon-info.png'></i><p><span>Brak dodanych ogłoszeń</span><br>Jeśli chcesz dodać ogłoszenie, kliknij 'Dodaj ogłoszenie' w górnym menu.</p></div>";
		}
		
		if ($akcja=='usun')
		{
			$numer=$_REQUEST['id'];
			$info = mysql_fetch_array(mysql_query("SELECT * FROM ogloszenia WHERE idOgloszenie='{$numer}' LIMIT 1"));
			
			if ($info[autor]==$user[id])
			{
				$queryUSUN= "DELETE FROM ogloszenia WHERE idOgloszenie = {$numer}";
				$resultUSUN= mysql_query($queryUSUN);
				//echo "<center><font color=green><b>Ogłoszenie zostało usunięte!</b></font></center><br>";
				echo '<div class="alert-message success"><i><img src="images/icon-success.png"> </i><p><span>Ogłoszenie zostało usunięte. </span><br>Twoje ogłoszenie nie jest już dostępne w naszym serwisie.</p></div>';
			}
		}
		else if ($akcja=='edytuj')
		{
			$numer=$_REQUEST['id'];
			$info = mysql_fetch_array(mysql_query("SELECT * FROM ogloszenia WHERE idOgloszenie='{$numer}' LIMIT 1"));
			
			if ($info[autor]==$user[id])
			{
				$stan = $_GET['stan'];
				if ($stan=='edycja')
				{
					
					$queryEDYT=mysql_query("UPDATE ogloszenia SET tytul='{$_POST['tytul']}'WHERE idOgloszenie={$numer}");
					$queryEDYT2=mysql_query("UPDATE ogloszenia SET tresc='{$_POST['tresc']}'WHERE idOgloszenie={$numer}");
					$queryEDYT3=mysql_query("UPDATE ogloszenia SET kategoria='{$_POST['kategoria']}'WHERE idOgloszenie={$numer}");
					$queryEDYT4=mysql_query("UPDATE ogloszenia SET zdjecie='{$_POST['obrazek']}'WHERE idOgloszenie={$numer}");
					$queryEDYT5=mysql_query("UPDATE ogloszenia SET przypiete='{$_POST['przypiete']}'WHERE idOgloszenie={$numer}");
					//echo "<center><font color='green'><b>Ogłoszenie zostało zaktualizowane!</b></font></center>";
					echo '<div class="alert-message success"><i><img src="images/icon-success.png"> </i><p><span>Ogłoszenie zostało zaktualizowane.</span><br>Zaktualizowane ogłoszenie jest dostępne na stronie głównej.</p></div>';
				}
				else
				{
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

				<form method="post" action="ogloszenia.php?akcja=edytuj&id=<?=$numer?>&stan=edycja" name="formularz"> 
				 <table><center>
				<tr><td>Tytuł:</td> <td><input type="text" name="tytul" value="<?php echo $info[tytul] ?>" required style="width:300px; display:block;" ></td></tr>
				<tr><td>Kategoria:</td> <td><select name="kategoria" style="width:300px; display:block;">
					<?
					$queryKat= "SELECT * FROM kategorie WHERE uprawnienia='{$user[uprawnienia]}' ORDER BY `nazwa`  ASC";
					$resultKat= mysql_query($queryKat);
					while($row=mysql_fetch_array($resultKat))
					{
						echo "<option value='{$row[idKategoria]}' ";
						if ($row[idKategoria]==$info[kategoria])
						{
							echo "selected='selected'";
						}
						echo " >{$row[nazwa]}</option>";
					}
										
					?>
					
					</select></td></tr>
				<tr><td>Treść: </td> <td><textarea type="text" required value="<?php echo $info[tresc] ?>" style="width:300px; display:block;" rows="5" name="tresc" id="tresc"><?php echo $info[tresc] ?></textarea></td></tr>
				<tr><td>Obrazek:</td> <td><select name="obrazek" style="width:300px; display:block;">
					<?
					$queryObr= "SELECT * FROM obrazki ORDER BY `nazwa`  ASC";
					$resultObr= mysql_query($queryObr);
					while($rows=mysql_fetch_array($resultObr))
					{
						echo "<option value='{$rows[sciezka]}' ";
						if ($rows[sciezka]==$info[zdjecie])
						{
							echo "selected='selected'";
						}
						
						echo " >{$rows[nazwa]}</option>";
					}
										
					?>
					</select></td></tr>
					
				<?
				if ($user[uprawnienia]=='4' || $user[uprawnienia]=='5' || $user[uprawnienia]=='9')
				{
					?>
					<tr><td>Przypięte:</td> <td><select name="przypiete" style="width:300px; display:block;">
						<option value="0"  <? if ($info[przypiete]=='0') { echo "selected='selected'"; }  ?>    >Nie</option>
						<option value="1" <? if ($info[przypiete]=='1') { echo "selected='selected'"; } ?> >Tak</option>
						</select></td></tr>	
					<?
				}
				?>		
						</center></table>
				<input type="button" value="Edytuj ogłoszenie!" onClick="check()"> </form>			
				</center>	
			<?
				}
			}
		}
		
		$queryPoczatek= "SELECT * FROM ogloszenia WHERE autor={$user[id]} ORDER BY `data`  DESC";
		$resultPoczatek= mysql_query($queryPoczatek);
		
		echo "<ul>";
		$licznik=1;
		$licznikB=2;
		while($row=mysql_fetch_array($resultPoczatek)) //pobieranie z bazy
		{
		
			$idOgloszenie=$row["idOgloszenie"];
			$autor=$row["autor"];
			$data=$row["data"];
			$tytul=$row["tytul"];
			$tresc=$row["tresc"];
			$kategoria=$row["kategora"];
			$zdjecie=$row["zdjecie"];
			
			echo "
			<hr><li>
            <article class='clear'>
              <figure>";
			  
			if ($zdjecie=="0")
			{
				echo "<img src='images/brak.gif' alt=''>";
			}
			else
			{
				echo "<img src='{$zdjecie}' alt=''>";
			}
			echo "<figcaption>
                  <a href='ogloszenie.php?id={$idOgloszenie}'><h2>{$tytul}</h2></a>
                  <p>{$tresc}</p>
                  <footer class='more'><a href='ogloszenia.php?akcja=edytuj&id={$idOgloszenie}'>Edytuj</a> || ";
				  ?>
					<a id="jakiesid<?=$licznik; ?>" onclick="document.getElementById('jakiesid<?=$licznikB; ?>').style.display='block';document.getElementById('jakiesid<?=$licznik; ?>');">Usuń</a>
				<?	
				  echo " || <a href='ogloszenie.php?id={$idOgloszenie}'>Pokaż ogłoszenie &raquo;</a></footer>";
				?>
				<div  id="jakiesid<?=$licznikB; ?>" style="display:none; text-align: right;">
				<font color='blue'><b>Jesteś pewień, że chcesz usunąć ogłoszenie?</b></font><br><a href='ogloszenia.php?akcja=usun&id=<?=$idOgloszenie;?>'><font color='red'><b>TAK</b></font></a>   &nbsp;&nbsp;&nbsp;&nbsp;
				<a onclick="document.getElementById('jakiesid<?=$licznik; ?>');document.getElementById('jakiesid<?=$licznikB; ?>').style.display='none';">
				<font color='green'><b>NIE</b></font>
				</a></b></font>
				<?
				 echo " <div id='pokaz' style='display: none'>test test</div>
                </figcaption>
              </figure>
            </article>
          </li>";
		  $licznik=$licznik+2;
		$licznikB=$licznik+1;
		}
		echo "</ul>";
		
		?>
      </section>
    </div>

    <!-- / content body -->
  </div>
</div>
<?
	include('includes/dol.php');
?>