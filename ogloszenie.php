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
		<?
		$numer = stripslashes(htmlentities(htmlspecialchars(strip_tags($_GET['id']))));
		
		$queryPoczatek= "SELECT *, DATE_FORMAT(data,'%d.%m.%Y %H:%m') AS data FROM ogloszenia WHERE idOgloszenie={$numer} ORDER BY `data`  DESC";
		$resultPoczatek= mysql_query($queryPoczatek);
		
		echo "<ul>";
		while($row=mysql_fetch_array($resultPoczatek)) //pobieranie z bazy
		{
		
			$idOgloszenie=$row["idOgloszenie"];
			$autor=$row["autor"];
			$data=$row["data"];
			$tytul=$row["tytul"];
			$tresc=$row["tresc"];
			$kategoria=$row["kategoria"];
			$zdjecie=$row["zdjecie"];
			$check = mysql_fetch_array(mysql_query("SELECT * FROM uzytkownicy WHERE id='{$autor}' LIMIT 1"));
			$kategoria = mysql_fetch_array(mysql_query("SELECT * FROM kategorie WHERE idKategoria='{$kategoria}' LIMIT 1"));

			echo "
			<div style='text-align: right;'><b>Dodał:</b> {$check[imie]} {$check[nazwisko]} || <b>Kategoria:</b> {$kategoria[nazwa]} || <b>Dnia:</b> {$data}</div>
			<li>
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
                  </figcaption>
              </figure>
            </article>
          </li>";
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