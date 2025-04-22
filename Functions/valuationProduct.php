<?php

function productStars($popularidad)
{
    $maxStars = 5;
    $numStars = round(($popularidad / 100) * $maxStars);
    $stars = '';

    for ($i = 0; $i < $maxStars; $i++) {
        if ($i < $numStars) {
            $stars .= "<i class='bi bi-star-fill text-warning'></i>";
        } else {
            $stars .= "<i class='bi bi-star text-secondary'></i>";
        }
    }

    return $stars;
}
