<?php
/*
  Template Name: Logout
*/
session_start();

session_destroy();

print "<meta http-equiv=\"refresh\" content=\"0;URL='/'\">";
