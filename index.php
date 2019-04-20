<?php 
	$conf = json_decode(file_get_contents("config.json"), true); 

	$apiKey = "";
	$location = "";

	$apiUrl = "http://api.openweathermap.org/data/2.5/weather?q=$location&appid=$apiKey";
	$weatherResponse = json_decode(file_get_contents($apiUrl), true);
	$kelvinToCelsius = 273.15;

	$temp = floor(($weatherResponse["main"]["temp"] - $kelvinToCelsius)*100)/100;
	$weather = $weatherResponse["weather"][0]["main"];
?>
<html>
    <head>
        <title>New Tab</title>
        <link rel="stylesheet" type="text/css" href="styles.css"/>
        <link rel="shortcut icon" href="favicon.ico"/>
    </head>
	<body>
		<div id="time"></div>
		<?php if($weatherResponse !== NULL): ?>
			<div class="weather-holder <?=$weather?>">
				<?=$temp?>° - <?=$weather?>
			</div>
		<?php endif; ?>
        <div class="links-container">
            <?php foreach($conf as $category => $links) : ?>
                <div class="category">
                    <div class="category-title"><?=$category?></div>
					<?php foreach($links as $link): ?>
                        <div class="link" title="<?=htmlentities($link[1])?>" href="<?=htmlentities($link[1])?>">
                            <?=str_replace(" ", "&nbsp;", htmlentities($link[0]))?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
		</div>
        <script src="focus.js" type="text/javascript"></script>
    </body>
</html>
