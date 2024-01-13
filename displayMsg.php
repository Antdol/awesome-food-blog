<?php
if (isset($_SESSION["display"]))
{
    unset($_SESSION["msg"]);
    unset($_SESSION["display"]);
}
if (isset($_SESSION["msg"]) && !isset($_SESSION["display"]))
{
    $_SESSION["display"] = true;
}
