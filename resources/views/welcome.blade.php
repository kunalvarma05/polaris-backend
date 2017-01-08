<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=yes">
    <meta itemprop="name" content="simpl.info: simplest possible examples of HTML, CSS and JavaScript">
    <meta name="mobile-web-app-capable" content="yes">
    <meta id="theme-color" name="theme-color" content="#fff">

    <base target="_blank">

    <title>Polaris</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        container {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            height: 100%;
            width: 100%;
        }
        div.hide {
            display: none;
        }
        canvas {
            position: fixed;
            top: 0;
            display: none;
            height: 100%;
            width: 100%;
        }
        #output {
            display: none;
        }
    </style>

</head>

<body>

<div id="container">

    <video id="video" muted autoplay></video>
    <canvas id="canvas"></canvas>
    <div class="select hide">
        <label for="audioSource">Audio source: </label><select id="audioSource"></select>
    </div>
    <ul id="output"></ul>

    <div class="select">
        <label for="videoSource">Video source: </label><select id="videoSource"></select>
        <button id="button">Start</button>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="./js/popcorn.js"></script>
    <script src="./js/app.js"></script>
</div>
</body>
</html>