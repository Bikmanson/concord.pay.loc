<?php

add_shortcode('highlight', function($attr, $content){
    return "<span>$content</span>";
});

add_shortcode('small', function($attr, $content){
    return "<p><small>$content</small></p>";
});

//add_shortcode('quote', function($attr, $content){
//    return "
//    <div class=\"b-quote b-article__content-block\">$content</div>
//    ";
//});

