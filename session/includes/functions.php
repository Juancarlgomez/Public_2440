<?php
function isGranted()
{
    if(isset($_SESSION['granted'])) return true;
    return false;
}
function dbCredentials()
{
    if ($_SERVER['SERVER_NAME'] == 'localhost') {
        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '1550');
        define('DB', 'insecure');
    } else {
        define('HOST', 'remote-host');
        define('USER', 'user');
        define('PASS', 'password');
        define('DB', ' database');
    }
}

function slectForm()
{
    echo "<div class='main'>
    <form action='.' method='post'>
    <label for='open'>Open:</label>
    <select id='open' name='open'>
    <option value='fbi'>FBI</option>
    <option value='spies'>Spies</option>
    </select>
    <input type='submit' value='Submit'>
    </form>
    </div>";
    return include'nav.php';
}
function openFbi()
{
    define('FILE_PATH', './includes/fbi.txt');
    if (file_exists(FILE_PATH)) {
        $fileFBI = fopen(FILE_PATH, "r");
        $content = fread($fileFBI, filesize(FILE_PATH));
        $words = explode('||>><<||', $content);
        echo "<h2>FBI Secret list</h2><div class='main'><table> <tbody> <tr> <th>Agent</th> <th>Code Name</th> </tr>";
        foreach ($words as $word) {
            echo "<tr>";
            $names = explode(',', $word);
            foreach ($names as $name) {
                echo "<td>$name</td>";
            }
            echo "</tr>";
        }
        echo "</tbody> </table> </div>";
        fclose($fileFBI);
    } else {
        echo "File not found.";
    }
}

function openSpies()
{
    define('FILE_PATH', './includes/spies.txt');
    if (file_exists(FILE_PATH)) {
        $fileSpies = fopen(FILE_PATH, "r");
        $content = fread($fileSpies, filesize(FILE_PATH));
        $words = explode('||>><<||', $content);
        echo "<h2>Spies Secret list</h2><div class='main'><table> <tbody> <tr> <th>Agent</th> <th>Code Name</th> </tr>";
        foreach ($words as $word) {
            echo "<tr>";
            $names = explode(',', $word);
            foreach ($names as $name) {
                echo "<td>$name</td>";
            }
            echo "</tr>";
        }
        echo "</tbody> </table></div>";
        fclose($fileSpies);
    } else {
        echo "File not found.";
    }
}