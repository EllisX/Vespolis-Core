<?php

namespace Vespoli\Core;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\level\Position;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as TF;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\event\player\PlayerDeathEvent;

class Main extends PluginBase implements Listener{
    
    public $fts = "§7[§2Vespoli§7] ";
    
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer();
        $name = $player->getName();
        $event->setJoinMessage("§0• §7[§b+§7]§f " . $name);
        $world = $this->getServer()->getLevelByName("world");
        $x = 0;
        $y = 66;
        $z = 0;
        $pos = new Position($x, $y, $z, $world);
        $player->teleport($pos);
        $player->setGamemode(1);
    }
    public function onQuit(PlayerQuitEvent $event) {
        $player = $event->getPlayer();
        $name = $player->getName();
        $event->setQuitMessage("§0• §7[§b-§7]§f " . $name);
    }
    public function onDeath(PlayerDeathEvent $event) {
        $player = $event->getPlayer();
        $name = $player->getName();
        $event->setDeathMessage("§0• §7[§4X§7]§f " . $name);
    }
    public function onRespawn(PlayerRespawnEvent $event) {
        $world = $this->getServer()->getLevelByName("world");
        $x = 0;
        $y = 66;
        $z = 0;
        $pos = new Position($x, $y, $z, $world);
        $event->setRespawnPosition($pos);
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool
    {
        if($cmd->getName() == "gmc") {
            if($sender instanceof Player) {
                if($sender->hasPermission("vespolicore.gmc.use")) {
                    $sender->setGamemode(1);
                    $sender->sendMessage($this->fts . TF::GREEN . "Your gamemode has been set to creative!");
                } else {
                    $sender->sendMessage($this->fts . TF::RED . "An error has occurred.");    
                }
            }
        }
        if($cmd->getName() == "gms") {
            if($sender instanceof Player) {
                if($sender->hasPermission("vespolicore.gms.use")) {
                    $sender->setGamemode(0);
                    $sender->sendMessage($this->fts . TF::GREEN . "Your gamemode has been set to Survival!");
                } else {
                    $sender->sendMessage($this->fts . TF::RED . "An error has occurred.");
                }
            }
        }
        if($cmd->getName() == "gma") {
            if($sender instanceof Player) {
                if($sender->hasPermission("vespolicore.gma.use")) {
                    $sender->setGamemode(2);
                    $sender->sendMessage($this->fts . TF::GREEN . "Your gamemode has been set to Adventure!");
                } else {
                    $sender->sendMessage($this->fts . TF::RED . "An error has occurred.");
                }
            }
        }
        if($cmd->getName() == "gmspc") {
            if($sender instanceof Player) {
                if($sender->hasPermission("vespolicore.gmspc.use")) {
                    $sender->setGamemode(3);
                    $sender->sendMessage($this->fts . TF::GREEN . "Your gamemode has been set to Spectator!");
                } else {
                    $sender->sendMessage($this->fts . TF::RED . "An error has occurred.");
                }
            }
        }
        if($cmd->getName() == "day") {
            if($sender instanceof Player) {
                if($sender->hasPermission("vespolicore.day.use")) {
                    $sender->getLevel()->setTime(6000);
                    $sender->sendMessage($this->fts . TF::GREEN . "Set the time to Day (6000) in your world!");
                } else {
                    $sender->sendMessage($this->fts . TF::RED . "An error has occurred.");
                }
            }
        }
        if($cmd->getName() == "night") {
            if($sender instanceof Player) {
                if($sender->hasPermission("vespolicore.night.use")) {
                    $sender->getLevel()->setTime(16000);
                    $sender->sendMessage($this->fts . TF::GREEN . "Set the time to Night (16000) in your world!");
                } else {
                    $sender->sendMessage($this->fts . TF::RED . "An error has occurred.");
                }
            }
        }
        if($cmd->getName() == "hub") {
            if($sender instanceof Player) {
                $world = $this->getServer()->getLevelByName("world");
                $x = 0;
                $y = 66;
                $z = 0;
                $pos = new Position($x, $y, $z, $world);
                $sender->teleport($pos);
                $sender->sendMessage($this->fts . TF::GOLD . "Teleported to Hub");
                $sender->setGamemode(0);
            } else {
                $sender->sendMessage($this->fts . TF::RED . "An error has occurred.");
            }
        }
        if($cmd->getName() == "rules") {
            if($sender instanceof Player) {
                $sender->sendMessage("§6§o§lServer Rules§r");
                $sender->sendMessage("§f- §eNo Advertising");
                $sender->sendMessage("§f- §eNo NSFW");
                $sender->sendMessage("§f- §eNo cursing. (Censoring words is allowed.)");
                $sender->sendMessage("§f- §eNo asking for OP/Ranks/Perms");
                $sender->sendMessage("§f- §eUse Common Sense. Failure to do so will not exempt you from punishment.");
            }
        }
    return true;
    }
}

