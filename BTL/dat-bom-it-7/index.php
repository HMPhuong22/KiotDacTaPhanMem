
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>

    
    <title>Bomb It 7</title>
	<link rel='canonical' href='http://choinhanh.vn/game-chien-thuat/dat-bom-it-7'/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 

    <link rel="stylesheet" href="assets/css/app.css" type="text/css"/>

</head>
<body>

<div id="loader">Loading ...</div>
<div id="content"></div>
<div id="dummy" style="position:fixed;right:0;bottom:0"></div>
<div id="orientation"></div>

<script type="text/javascript">

    
    var gameName = "bomb-it-7.min.js";
    

    //This all here is for cache busting;
    function addScript(src, buster, callback) {
        var s = document.createElement('script');
        s.setAttribute('src', src + '?v=' + buster);
        if (typeof callback === 'function') {
            s.onload = callback;
        }
        document.body.appendChild(s);
    }

    addScript('version.js', Date.now(), function () {
        addScript(gameName, version, function () {
            /**
             * Here we create the game
             */
            var g = Game.App.getInstance(); g.start()

        })
    })
</script>


</body>
</html>