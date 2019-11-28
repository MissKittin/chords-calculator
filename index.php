<?php

	/* TWORZENIE TRÓJDŹWIĘKÓW I WIĘCEJ v2_optimized2 *//* UWAGA!!! DZIAŁA bardzo MASZYNOWO *//* nudziło mie sie */
	/* Copyleft, MissKittin@GitHub 17.02.2016 */

	// Benchmark === START ===
	function getmicrotime() // nie moje
	{ 
		list($usec, $sec) = explode(' ', microtime()); 
		return ((float)$usec + (float)$sec); 
	}
	$benchmark_start = getmicrotime();

	// Tablice (dla note())
	$sharp = array( // krzyżyki
		'1' => 'c',
			'2' => 'cis',
		'3' => 'd',
			'4' => 'dis',
		'5' => 'e',
		'6' => 'f',
			'7' => 'fis',
		'8' => 'g',
			'9' => 'gis',
		'10' => 'a',
			'11' => 'ais',
		'12' => 'h',
	);
	$flat = array( // bemole
		'1' => 'c',
		'2' => 'des',
			'3' => 'd',
		'4' => 'es',
			'5' => 'e',
		'6' => 'f',
		'7' => 'ges',
			'8' => 'g',
		'9' => 'as',
			'10' => 'a',
		'11' => 'b',
			'12' => 'h',
	);

	// Funkcje pomocnicze
	function note($n,$key) // obcinanie oktaw: note(pozycja, "sharp || flat")
	{
		global $sharp, $flat; // Tablice są używane
		while($n > 12) $n-=12; // Obcinaj jeżeli większe niż 12
		return(($key == 'sharp')? $sharp[$n] : $flat[$n]); // skrócone (if($key == 'sharp') return $sharp[$n]; else return $flat[$n];)
	}

	// Funkcje podstawowe
	function major($i,$key) // 1 3 5
	{
		return note($i,$key) . ' '
			. note($i+4,$key) . ' '
			. note($i+4+3,$key);
	}
	function minor($i,$key) // 1 3> 5
	{
		return note($i,$key) . ' '
			. note($i+3,$key) . ' '
			. note($i+3+4,$key);
	}
	function inc($i,$key) // 1 3 5<
	{
		return note($i,$key) . ' '
			. note($i+4,$key) . ' '
			. note($i+4+4,$key);
	}
	function dec($i,$key) // 1 3> 5>
	{
		return note($i,$key) . ' '
			. note($i+3,$key) . ' '
			. note($i+3+3,$key);
	}
	function d7($i,$key,$mode) // Dźwięk, tablica, tryb septymy
	{
		if($mode == 'major') // 1 3 5 7>
			return note($i,$key) . ' '
				. note($i+3,$key) . ' '
				. note($i+3+4,$key) . ' '
				. note($i+3+4+7,$key);
		else // 1 3> 5 7>
			return note($i,$key) . ' '
				. note($i+3,$key) . ' '
				. note($i+3+4,$key) . ' '
				. note($i+3+4+3,$key);			
	}
	function d9($i,$key,$mode,$ninth) // Dźwięk, tablica, tryb tercji, tryb nony
	{
		if($mode == 'major')
		{
			if($ninth == 'major') // 1 3 5 7 9
				return note($i,$key) . ' '
					. note($i+4,$key) . ' '
					. note($i+4+3,$key) . ' '
					. note($i+4+3+3,$key) . ' '
					. note($i+4+3+3+4,$key);
			else // 1 3 5 7 9>
				return note($i,$key) . ' '
					. note($i+4,$key) . ' '
					. note($i+4+3,$key) . ' '
					. note($i+4+3+3,$key) . ' '
					. note($i+4+3+3+3,$key);
		}
		else // 1 3> 5 7 9
			return note($i,$key) . ' '
				. note($i+3,$key) . ' '
				. note($i+3+4,$key) . ' '
				. note($i+3+4+3,$key) . ' '
				. note($i+3+4+3+4,$key);
	}
	function special34d9($i,$key) // 1 3> 4 6> 8 10> 12
	{
		return note($i,$key) . ' '
			. note($i+3,$key) . ' '
			. note($i+3+2,$key) . ' '
			. note($i+3+2+3,$key) . ' '
			. note($i+3+2+3+4,$key) . ' '
			. note($i+3+2+3+4+3,$key) . ' '
			. note($i+3+2+3+4+3+4,$key);
	}
	function pt($i,$key,$mode) // Dźwięk, tablica, tryb pentatoniki
	{
		if($mode == '1') // 1 2 4 5 6
			return note($i,$key) . ' '
				. note($i+2,$key) . ' '
				. note($i+2+3,$key) . ' '
				. note($i+2+3+2,$key) . ' '
				. note($i+2+3+2+2,$key);
		else // 1 2 3 5 6
			return note($i,$key) . ' '
				. note($i+2,$key) . ' '
				. note($i+2+2,$key) . ' '
				. note($i+2+2+3,$key) . ' '
				. note($i+2+2+3+2,$key);
	}
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<title>Obliczanie dźwięków</title>
		<meta charset="utf-8">
		<style type="text/css">
			body {
				background-color: #FFFFFF;
			}
			table {
				text-align: center;
				margin: 0px auto;
			}
			td {
				color: #FFFFFF;
				background-color: #0020C0;
				border: 1px solid #0020C0;
				font-weight: bold;
				white-space: nowrap;
			}
			sup {
				vertical-align: super;
				font-size: smaller;
			}
			#footer a, #footer a:hover, #footer a:visited {
				font-size: 5pt;
				text-align: left;
				/* Po co ktoś ma to widzieć */
				text-decoration: none;
				color: #FFFFFF;
			}
			.center {
				text-align: center;
			}
		</style>
	</head>
	<body>
		<div class="center"><!-- header -->
			<h1>Obliczanie dźwięków</h1>
		</div>
		<div><!-- Tabele -->
			<div><!-- Krzyżyki -->
				<div class="center">
					<h1>#</h1>
				</div>
				<table>
					<!-- + o < > D7+ D7o D9+ D9>+ D9> o oT12 5T1 5T2 -->
					<tr>
						<th>&#9834;</th>
						<th>+</th>
						<th><sup>o</sup></th>
						<th>&lt;</th>
						<th>&gt;</th>
						<th>D<sup>7</sup> +</th>
						<th>D<sup>7 o</sup></th>
						<th>D<sup>9</sup> +</th>
						<th>D<sup>9></sup> +</th>
						<th>D<sup>9> o</sup></th>
						<th><sup>o</sup>T<sup>12</sup></th>
						<th><sup>5</sup>T 1</th>
						<th><sup>5</sup>T 2</th>
					</tr>
					<?php
						// main - zmienne
						$end="\n"; // pic na wode

						// main 1: krzyżyki
						for($i=1;$i<13;$i++)
							echo '<tr><th>' . ucfirst($sharp[$i]) /* Pierwsza litera zamieniana na wielką */ . '</th><td>'
								. major($i,'sharp') . '</td><td>'
								. minor($i,'sharp') . '</td><td>'
								. inc($i,'sharp') . '</td><td>'
								. dec($i,'sharp') . '</td><td>'
								. d7($i,'sharp','major') . '</td><td>'
								. d7($i,'sharp','minor') . '</td><td>'
								. d9($i,'sharp','major','minor') . '</td><td>'
								. d9($i,'sharp','major','major') . '</td><td>'
								. d9($i,'sharp','minor','major') . '</td><td>'
								. special34d9($i,'sharp') . '</td><td>'
								. pt($i,'sharp',1) . '</td><td>'
								. pt($i,'sharp',2) .'</td></tr>' 
								. $end . (($i == 11)? '			' : '');
					?>
				</table>
			</div>
			<div><!-- Bemole -->
				<div class="center">
					<h1>&#9837;</h1>
				</div>
				<table>
					<!-- + o < > D7+ D7o D9+ D9>+ D9> o oT12 5T1 5T2 -->
					<tr>
						<th>&#9834;</th>
						<th>+</th>
						<th><sup>o</sup></th>
						<th>&lt;</th>
						<th>&gt;</th>
						<th>D<sup>7</sup> +</th>
						<th>D<sup>7 o</sup></th>
						<th>D<sup>9</sup> +</th>
						<th>D<sup>9></sup> +</th>
						<th>D<sup>9> o</sup></th>
						<th><sup>o</sup>T<sup>12</sup></th>
						<th><sup>5</sup>T 1</th>
						<th><sup>5</sup>T 2</th>
					</tr>
					<?php
						// main 2: bemole
						for($i=1;$i<13;$i++)
							echo '<tr><th>' . ucfirst($flat[$i]) /* Pierwsza litera zamieniana na wielką */ . '</th><td>'
								. major($i,'flat') . '</td><td>'
								. minor($i,'flat') . '</td><td>'
								. inc($i,'flat') . '</td><td>'
								. dec($i,'sharp') . '</td><td>'
								. d7($i,'flat','major') . '</td><td>'
								. d7($i,'flat','minor') . '</td><td>'
								. d9($i,'flat','major','minor') . '</td><td>'
								. d9($i,'flat','major','major') . '</td><td>'
								. d9($i,'flat','minor','major') . '</td><td>'
								. special34d9($i,'flat') . '</td><td>'
								. pt($i,'flat',1) . '</td><td>'
								. pt($i,'flat',2) . '</td></tr>'
								. $end . (($i == 11)? '			' : '');
					?>
				</table>
			</div>
		</div>
		<?php
			// Benchmark === END ===
			//$benchmark_end = getmicrotime();
			echo '<!-- Czas wykonywania: ' . ($benchmark_start - getmicrotime()) . ' -->' . "\n";
			echo '<!-- Copyleft, MissKittin@GitHub 17.02.2016 -->' . "\n";
		?>
	</body>
</html>
