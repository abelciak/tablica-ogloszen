<?
	include('includes/gora.php');
?>
<!-- content -->
<div class="wrapper row2">
  <div id="container" class="clear">
    <!-- content body -->

    <!-- main content -->
    <div id="content">
	<h2>Przypięte ogłoszenia</h2>
      <section id="services" class="last clear">
		<?
		$queryPoczatek= "SELECT * FROM ogloszenia WHERE przypiete='1' ORDER BY `data`  DESC";
		$resultPoczatek= mysql_query($queryPoczatek);
		
		
		echo "<ul>";
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
                  <footer class='more'><a href='ogloszenie.php?id={$idOgloszenie}'>Pokaż ogłoszenie &raquo;</a></footer>
                </figcaption>
              </figure>
            </article>
          </li>";
		}
		echo "</ul>";
		?>
      </section>
	  
	
	 <?
	 if (empty($user))
	 {
		 //echo "<center><font color='blue'><b>Zaloguj się, żeby uzyskać dostęp do wydziałowych ogłoszeń. <a href='logowanie.php'>Kliknij tutaj</a></b></font></center>";
		 echo "<div class='alert-message info'><i><img src='images/icon-info.png'></i><p><span>Zaloguj się, żeby uzyskać dostęp do wydziałowych ogłoszeń.</span><br>Będąc zalogowanym posiadasz możliwość przeglądania ogłoszeń.</p></div>";
	 }
	 else
	 {
		 $wybierz = $_POST['wybor'];
		  if (!(empty($wybierz))) 
		  {
			unset($_SESSION['wybor']);
			$N = count($wybierz);

			for($i=0; $i < $N; $i++)
			{
			  $_SESSION['wybor'][$i]=$wybierz[$i];
			}
		  }

		 $licz=0;
	 echo "<h2>Pozostałe ogłoszenia:</h2>";
					echo "<form id='formularz' method='post' action='{$_SERVER['PHP_SELF']}' method='get'>";
					$queryKat= "SELECT * FROM kategorie ORDER BY `nazwa`  ASC";
					$resultKat= mysql_query($queryKat);
					while($row=mysql_fetch_array($resultKat))
					{
						// onchange=\"document.getElementById('formName').submit()\"
						if (empty($_SESSION['wybor']))
						{
							$check=true;
						}
						echo "<input name='wybor[]' value='{$row[idKategoria]}' type='checkbox' ";
							
							for ($j=0; $j<count($_SESSION['wybor']); $j++)
							{
								if ($check==true)
								{
									$_SESSION['wybor'][]=$row[idKategoria];
								
								}
								if ($_SESSION['wybor'][$j]==$row[idKategoria])
								{
									echo "checked";
								}
							}
							if ($check===true) { echo "checked";	}
						echo " >{$row[nazwa]} ";
					}
					echo "<button type='submit' style='float:right;' form='formularz' value='zastosuj'>zastosuj</button></form>";				
					?>
	
      <section id="services" class="last clear">
		<?
		$queryPoczatek="";
		for ($k=0; $k<count($_SESSION['wybor']); $k++)
		{
			if ($k>0) { $queryPoczatek=$queryPoczatek." UNION "; }
			$queryPoczatek=$queryPoczatek." SELECT * FROM ogloszenia WHERE kategoria='{$_SESSION['wybor'][$k]}' AND przypiete='0' ";
		} 
		if ($check==true)
		{
			$queryPoczatek="SELECT * FROM ogloszenia WHERE przypiete='0'";
		}
		$queryPoczatek=$queryPoczatek." ORDER BY `data`  DESC";
		$resultPoczatek=mysql_query($queryPoczatek);
		
		echo "<ul>";
		$checklicz=0;
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
                  <footer class='more'><a href='ogloszenie.php?id={$idOgloszenie}'>Pokaż ogłoszenie &raquo;</a></footer>
                </figcaption>
              </figure>
            </article>
          </li>";
		  $checklicz++;
		}
		echo "</ul>";
		if ($checklicz==0) { 
		//echo "<br><center><h4><font color='red'>Brak ogłoszeń w wybranej kategorii.</font></h4></center>"; 
		echo "<div class='alert-message info'><i><img src='images/icon-info.png'></i><p><span>Brak ogłoszeń w wybranej kategorii</span><br>Spróbuj wybrać inną kategorie ogłoszeń.</p></div>";
		};
		?>
      </section>
	  <? } ?>
    </div>

    <!-- / content body -->
  </div>
</div>
<?
	include('includes/dol.php');
?>