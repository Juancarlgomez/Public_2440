<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <title>Robot Builder</title>
</head>
<body class="container">
<?php

class robot
{
    private $model;
    private $color;
    private $os;
    private $size;
    private $laws;

    public function __construct($model, $color, $os, $size, $laws)
    {
        $this->setModel($model);
        $this->setColor($color);
        $this->setOs($os);
        $this->setSize($size);
        $this->setLaws($laws);

    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setOs($os)
    {
        $this->os = $os;
    }

    public function getOs()
    {
        return $this->os;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setLaws($laws)
    {
        if (is_array($laws)) {
            $this->laws = $laws;
        } else {
            $this->laws = array($laws);
        }
    }

    public function getLaws()
    {
        $stringArray = implode(", ", $this->laws);
        if ($stringArray == "first law, second law, third law") {
            return "the First, Second, and Third Law";
        } elseif ($stringArray == "first law, second law") {
            return "the First and Second Law";
        } elseif ($stringArray == "") {
            return "No Laws";
        }
        return $stringArray;
    }


    public function __toString()
    {
        return "<h2 class='header'>Your <u> " . $this->getSize() . "</u> sized <u> " . $this->getColor() . " " . $this->getModel() . "</u> robot running <u>" . $this->getOs() . "</u>. Programed with <u>" . $this->getlaws() . "</u> will be built shortly. Thank you.</h2>";

    }
}

class image
{
    private $image;

    public function __construct($image)
    {
        $this->setImage($image);
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function __toString()
    {
        return "<img src='img/" . $this->getImage() . "' alt='Robot Image'>";
    }
}

$robotImages = array(
    "Sonny" => "sonny.jpg",
    "Rosey" => "rosey.webp",
    "SICO" => "sico.jpg",
    "Data" => "data.jpg",
    "Gort" => "gort.png",
    "Wall-E" => "walle.webp",
    "Optimus Prime" => "optimus_prime.webp",
    "Hal 9000" => "hal-9000.jpg",
    "Twiki" => "twiki.jpg",
    "Bender" => "bender.webp",
    "Johnny 5" => "johnny_5.webp"
);

if (isset($_POST['model']) && isset($_POST['color']) && isset($_POST['os'])) {
    $laws = isset($_POST['laws']) ? $_POST['laws'] : array();
    $robot = new robot($_POST['model'], $_POST['color'], $_POST['os'], $_POST['size'], $laws);
    $image = new image($robotImages[$_POST['model']]);

    echo " $robot";
    echo "<button onclick='button()' class='dropbtn'>Robot Laws</button>
    <div id='dropdown' class='dropdown-content'>
   <p><b>First Law:</b> A robot may not injure a human being or, through inaction, allow a human being to come to harm.</p>
    <p><b>Second Law:</b> A robot must obey the orders given it by human beings except where such orders would conflict with the First Law.</p>
    <p><b>Third Law:</b> A robot must protect its own existence as long as such protection does not conflict with the First or Second Laws.</p>
   </div>";
    echo "$image";
    echo "<pre class='code'>";
    var_dump($robot);
    var_dump($image);
    echo "</pre>";
} else {

    ?>
    <h1>Build-A-Robot</h1>
    <form action="." method="post">
        <h2>
            <div class="rows">
                <label class="columns"> Model:
                    <select name="model">
                        <option value="Sonny">Sonny</option>
                        <option value="Rosey">Rosey</option>
                        <option value="SICO">SICO</option>
                        <option value="Data">Data</option>
                        <option value="Gort">Gort</option>
                        <option value="Wall-E">Wall-E</option>
                        <option value="Optimus Prime">Optimus Prime</option>
                        <option value="Hal 9000">Hal 9000</option>
                        <option value="Twiki">Twiki</option>
                        <option value="Bender">Bender</option>
                        <option value="Johnny 5">Johnny 5</option>
                    </select>
                </label>
                <label class="columns"> Color:
                    <select name="color">
                        <option value="Shiny">Shiny</option>
                        <option value="Chrome">Chrome</option>
                        <option value="Silver">Silver</option>
                        <option value="Brass">Brass</option>
                        <option value="Gold">Gold</option>
                    </select>
                </label>
                <label class="columns"> OS:
                    <select name="os">
                        <option value="Linux">Linux</option>
                        <option value="Unix">Unix</option>
                        <option value="SPARC">SPARC</option>
                        <option value="Binary">Binary</option>
                        <option value="DOS">DOS</option>
                        <option value="Tiny Hamsters">Tiny Hamsters</option>
                    </select>
                </label>
        </h2>
        <div class="columns">
            <h2> Size: </h2>
        </div>
        <div class="rows">
            <div class="columns">
                <label for="giant">Giant</label>
                <input id="giant" type="radio" name="size" value="giant">
            </div>
            <div class="columns">
                <label for="normal">Normal</label>
                <input id="normal" type="radio" name="size" value="normal">
            </div>
            <div class="columns">
                <label for="nano">Nano</label>
                <input id="nano" type="radio" name="size" value="nano">
            </div>
        </div>
        <div class="columns">
            <h2>Laws: </h2>
        </div>
        <div class="rows">
            <div class="columns">
                <div class="tooltip">
                    <label for="first">First Law</label>
                    <span class="tooltiptext">A robot may not injure a human being or, through inaction, allow a human being to come to harm.</span>
                    <input id="first" type="checkbox" name="laws[]" value="first law">
                </div>
            </div>
            <div class="columns">
                <div class="tooltip">
                    <label for="second">Second Law</label>
                    <span class="tooltiptext">A robot must obey the orders given it by human beings except where such orders would conflict with the First Law.</span>
                    <input id="second" type="checkbox" name="laws[]" value="second law">
                </div>
            </div>
            <div class="columns">
                <div class="tooltip">
                    <label for="third">Third Law</label>
                    <span class="tooltiptext">A robot must protect its own existence as long as such protection does not conflict with the First or Second Laws.</span>
                    <input id="third" type="checkbox" name="laws[]" value="third law">
                </div>
            </div>
        </div>
        <div class="columns">
            <button type="submit" id="btn">Build Robot</button>
        </div>
    </form>
    <?php
}
?>
</body>
<footer>
    <!--ToS-->
    <p>By clicking the "Build Robot" button, you agree to the risk of owning a robot. We at Build-A-Robot take no
        responsibility for the actions committed by the robots</p>
</footer>
</html>
