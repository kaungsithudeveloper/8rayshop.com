<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Infos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.youtube.com/iframe_api"></script>
    <style>
        /* Optional: CSS for video containers */
        .video-container {
            position: relative;
            width: 100%;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Product Infos</h1>

    @foreach ($productInfos as $info)
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $info->productInfo->short_descp }}</h5>
                <p class="card-text">{{ $info->productInfo->long_descp }}</p>
                <div class="video-container">
                    <iframe id="youtube-player" src="{{ $info->productInfo->url }}" title="YouTube video" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    @endforeach

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    var player;

    function onYouTubeIframeAPIReady() {
        player = new YT.Player('youtube-player', {
            events: {
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerStateChange(event) {
        // Pause the player when it's playing (1) and the page is scrolled out of view
        if (event.data == YT.PlayerState.PLAYING) {
            // Check if the player is in view
            if (!isElementInViewport(document.getElementById('youtube-player'))) {
                player.pauseVideo();
            }
        }
    }

    // Check if an element is in the viewport
    function isElementInViewport(el) {
        var rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    // Event listener for scrolling
    window.addEventListener('scroll', function() {
        // Check player state and position on scroll
        if (player && player.getPlayerState() === YT.PlayerState.PLAYING) {
            if (!isElementInViewport(document.getElementById('youtube-player'))) {
                player.pauseVideo();
            }
        }
    });

</script>
</body>
</html>
