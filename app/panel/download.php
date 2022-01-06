<?php
  /**
   * Download
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: download.php, v1.00 2019-03-08 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once ("init.php");
	  
  if(!Filter::$id or !$row = Db::run()->first(Project::fTable, "*", array("id" => Filter::$id))) : Message::invalid("ID" . Filter::$id); return; endif;
  
  header("Content-Type: {$row->mime}");
  header("Content-Disposition: attachment; filename=\"{$row->caption}\"");
  header("Content-Length: " . $row->fsize);
  readfile(UPLOADS . "/files/" . $row->name);
  exit;