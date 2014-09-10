<!-- The cassette player is build from file Managethesound.js -->
<div id="cassette-player">

    <!-- VU meter -->
    <div id="vu-meter">
        <div class="debug" style="position: relative; z-index: 2"></div>
        <div class="bar left">
            <div class="led vu-20 green"></div>
            <div class="led vu-40 green"></div>
            <div class="led vu-60 green"></div>
            <div class="led vu-80 red"></div>
            <div class="led vu-100 red"></div>
        </div>
        <div class="bar right">
            <div class="led vu-20 green"></div>
            <div class="led vu-40 green"></div>
            <div class="led vu-60 green"></div>
            <div class="led vu-80 red"></div>
            <div class="led vu-100 red"></div>
        </div>
    </div>

    <!-- counter -->
    <div id="counter">
        <?php for ($i = 1; $i <= 3; $i++) { ?>
            <div class="unit" id="unit-<?php echo $i; ?>">
                <?php for ($j = 0; $j <= 9; $j++) { ?>
                    <div class="number number-<?php echo $j; ?>"><?php echo $j; ?></div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <!-- Deck door -->
    <div id="deck">
        <div id="top-depth"></div>
        <div id="dark-on-deck-open"></div>
    </div>
    <div id="deck-door-shadow"></div>

    <!-- K7 -->
    <div id="cassette">
        <div class="front">
            <img src="<?= theme_path ?>/img/cassette/cassette-front-1.png" alt="" class="mask-me">
        </div>

        <div class="cran left"></div>
        <div class="cran right"></div>
        <div class="tape left"></div>
        <div class="tape right"></div>

        <div class="cassette-cover mask-me">
            <img src="http://micromix.localhost/upload/jaws-roy-scheider.jpg" alt="" class=""/>
        </div>
        <svg>
            <!-- THE mask -->
            <mask id="mask" maskContentUnits="objectBoundingBox">
                <!-- using an img, but this img is black/transparent so we filter it to make it white -->
                <image xlink:href="<?= theme_path ?>/img/cassette/mask.png" width="1" height="1" preserveAspectRatio="none" filter="url(#filter)"/>
            </mask>

            <!-- the filter to make the image white -->
            <filter id="filter">
                <feFlood flood-color="white" />
                <feComposite in2="SourceAlpha" operator="in" />
            </filter>
        </svg>

    </div>

    <!-- Controls -->
    <div class="control" id="control-pause">pause</div>
    <div class="control" id="control-play">play</div>
    <div class="control" id="control-rewind">rewind</div>
    <div class="control" id="control-forward">fast forward</div>
    <div class="control" id="control-prev">prev</div>
    <div class="control" id="control-next">next</div>

    <!-- Controls when pushed (default : hidden) -->
    <div class="control-pushed" id="control-pause-pushed"></div>
    <div class="control-pushed" id="control-play-pushed"></div>
    <div class="control-pushed" id="control-rewind-pushed"></div>
    <div class="control-pushed" id="control-forward-pushed"></div>
    <div class="control-pushed" id="control-prev-pushed"></div>
    <div class="control-pushed" id="control-next-pushed"></div>

    <!-- Information screen -->
    <div id="infos">
        <a id="infos-text"><!-- text from javascript --></a>
    </div>
</div>























