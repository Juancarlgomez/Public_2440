<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Juan 10 Music albums</title>
</head>
<body>

<?php

$albums = array(

    // array("Album Name", "Artist", "YouTube Music Links")
    array("The End of the World", "Eptic", "https://music.youtube.com/playlist?list=OLAK5uy_mQ4tFQQ6adBrgvpvrvvdc5l23dXNbaZ6Q"),
    array("Lost Souls EP", "Knife Party", "https://music.youtube.com/playlist?list=OLAK5uy_nSmvXABD2dy4PdqmeeOwOH0ArNcIWdf5A"),
    array("Worlds", "Porter Robinson", "https://music.youtube.com/playlist?list=OLAK5uy_mOH9z9t_4xhSSiajaXGDrpW0n4x0YVgPw"),
    array(" Bear Grillz & Friends", " Bear Grillz", "https://music.youtube.com/playlist?list=OLAK5uy_mGtKfJzsBvv_-zgox6aCpIwcuMU_Gme7M"),
    array("We Are Barely Alive", "Barely Alive", "https://music.youtube.com/playlist?list=OLAK5uy_m9nE0n0OJTjAOaGosczyWGRsGAF2MwSG0"),
    array("10 Years of Seven Lions", "Seven Lions", "https://music.youtube.com/playlist?list=OLAK5uy_mgnJw_itxUIWw4rOo9dGrYk88r1N7bKoA"),
    array("ANimal Vegetable Mineral Pt. 1", "Doctor P", "https://music.youtube.com/playlist?list=OLAK5uy_k94FYXBbNbtsGbE9TgBezE_Iwq86tBe9Y"),
    array("Twitch", "LAXX", "https://music.youtube.com/playlist?list=OLAK5uy_k8rsYa48nSIW40QrgYu15YOL3AK3joROQ"),
    array("Onyx", "Excision", "https://music.youtube.com/playlist?list=OLAK5uy_mPrRCc3ym5tyDHNt8CaAc8bMmpxQzkyzc"),
    array("OCCULT CLASSIC", "Kill The Noise", "https://music.youtube.com/playlist?list=OLAK5uy_kEVSK4pRke8rFKgq0LzN1Fi45qHuXi0ro"),
);

//Creates a div named music and a table with a header
echo "<div class='music'>";
echo "<table>";
echo "<tbody>";
echo "<tr>";
echo "<th class= 'table_header' colspan='2'> Juan's Ten EDM Albums </th>";
echo "</tr>";

//Shuffles the array order
shuffle($albums);

// Loop through the array and display the contents in a table.
foreach ($albums as $album) {
    echo "<tr>";
    echo "<td class= 'first_column'>";
    echo "<a href='" . $album[2] . "'target= '_blank'>" . $album[0] . "</a> <td>" . $album[1] . "</td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";
echo "</div>";

?>
</body>
</html>