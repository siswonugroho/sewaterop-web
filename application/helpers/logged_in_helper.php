<?php

function isLoggedIn()
{
  if (isset($_SESSION['username'])) return true;
  else return false;
}

function startSession()
{
  if (!session_id()) {
    session_start();
  }
}
