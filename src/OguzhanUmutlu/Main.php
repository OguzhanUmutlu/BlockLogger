<?php

namespace blackfighty;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\{Player, Server};
use pocketmine\utils\Config;
use pocketmine\item\Item;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\block\Block;
use pocketmine\permission\Permission;

class Main extends PluginBase implements Listener{
	
	public function onEnable(){
		$this->getLogger()->info("Plugin enabled. by blackfighty");
		
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		@mkdir($this->getDataFolder());

		if(!file_exists($this->getDataFolder()."config.yml")){

			$this->saveResource('config.yml');
		}
		$config = new Config($this->getDataFolder().'config.yml', Config::YAML);
		$this->config = $config;
		#$this->getServer()->getPluginManager()->addPermission(Permission $perm);
		
	}
	
	public function blokkirma(BlockBreakEvent $e) {
	  $b = $e->getBlock()->getName();
	  $bid = $e->getBlock()->getId();
	  $cnf = $this->config;
	  foreach($cnf->get("logger") as $b) {
	  if($bid == $b) {
	    foreach($this->getServer()->getOnlinePlayers() as $sa) {
	      if($sa->hasPermission($cnf->get("staffpermission"))) {
	        $yazi = str_replace("{block}", $e->getBlock()->getName(), $cnf->get("lang-message"));
	        $yazi = str_replace($cnf->get("lang-color"), "§", $yazi);
	        $yazi = str_replace("{player}", $e->getPlayer()->getName(), $yazi);
	        $sa->sendMessage($yazi);
	      }
	    }
	    if($cnf->get("console-logger") == true) {
	      $yazi = str_replace("{block}", $b, $cnf->get("lang-message"));
	      $yazi = str_replace($cnf->get("lang-color"), "§", $yazi);
	      $yazi = str_replace("{player}", $e->getPlayer()->getName(), $yazi);
	      $this->getLogger()->info($yazi);
	    }
	    if($cnf->get("execute-command") == true) {
	      if($cnf->get("execute-command-author") == "console") {
	        foreach($cnf->get("execute-commands") as $c) {
	          $this->getServer()->dispatchCommand(new ConsoleCommandSender(), $c);
	        }
	      } else {
	        foreach($cnf->get("execute-commands") as $c) {
	          $this->getServer()->dispatchCommand($e->getPlayer(), $c);
	        }
	      }
	    }
	  }
	}
}
	
	public function onCommand(CommandSender $oyuncu, Command $komut, string $label, array $args) : bool {
	  $cnfg = $this->getConfig();
		$o = $oyuncu->getName();
		$kmt = $komut->getName();
		if($kmt == "blocklogger" || $kmt == "bl") {
		  if(($oyuncu instanceof Player) && !$oyuncu->hasPermission($cnfg->get("commandpermission"))) {
		    $yazi = str_replace("{command}", $kmt, $cnfg->get("lang-perm"));
		    $yazi = str_replace("{player}", $o, $yazi);
		    $yazi = str_replace($cnfg->get("lang-color"), "§", $yazi);
		    $oyuncu->sendMessage($yazi);
		  } else {
		  $args = $args && $args[0] ? $args : null;
		  if($args == null || $args[0] == null) {
		    $yazi = str_replace("{command}", $kmt, $cnfg->get("lang-number"));
		    $yazi = str_replace("{player}", $o, $yazi);
		    $yazi = str_replace($cnfg->get("lang-color"), "§", $yazi);
		    $oyuncu->sendMessage($yazi);
		  } else if($args[0]) {
		    if(is_numeric($args[0])) {
		      $blokk = $args[0];
		      
		      $a = $cnfg->get("logger");
		      $sonuc = false;
		      foreach($a as $b) {
		        if($b == $args[0]) {
		          $sonuc = true;
		        }
		      }
		      if($sonuc == true) {
		        $yeni = array();
		        foreach($a as $b) {
		          if($b != $args[0]) {
		            array_push($yeni, number_format($b));
		          }
		        }
		        $cnfg->set("logger", $yeni);
		        $cnfg->save();
		        $cnfg->reload();
		        $yazi = str_replace("{command}", $kmt, $cnfg->get("lang-success1"));
		        $yazi = str_replace("{player}", $o, $yazi);
		        $yazi = str_replace("{block}", $blokk, $yazi);
		        $yazi = str_replace($cnfg->get("lang-color"), "§", $yazi);
		        $oyuncu->sendMessage($yazi);
		      } else {
		        $a = $cnfg->get("logger");
		        array_push($a, number_format($args[0]));
		        $cnfg->set("logger", $a);
		        $cnfg->save();
		        $cnfg->reload();
		        $yazi = str_replace("{command}", $kmt, $cnfg->get("lang-success"));
		        $yazi = str_replace("{player}", $o, $yazi);
		        $yazi = str_replace("{block}", $blokk, $yazi);
		        $yazi = str_replace($cnfg->get("lang-color"), "§", $yazi);
		        $oyuncu->sendMessage($yazi);
		      }
		    } else {
		      $yazi = str_replace("{command}", $kmt, $cnfg->get("lang-number"));
		      $yazi1 = str_replace("{player}", $o, $yazi);
		      $yazi2 = str_replace("{block}", $blokk, $yazi1);
		      $yazi3 = str_replace($cnfg->get("lang-color"), "§", $yazi2);
		      $oyuncu->sendMessage($yazi4);
		    }
		  }
		}
	}
		return true;
	}
}
# Bunu okuyan tosun
// Okuyana kosun
// Baris Ozel Harekat BÖH
// Oguzhan Umutlu ~ blackfighty