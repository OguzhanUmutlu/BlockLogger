# BlockLogger
v0.4.0 - Ore hack(Xray-X-ray) anticheat system. This plugin logs ores or if you want you can add or remove other blocks.

## Description

You can get notification messages when someone breaks blocks what you want.

## Permissions

They can edit permissions is config.yml file.

## Support

[![Discord](https://img.shields.io/discord/752548549161386074?style=for-the-badge)](https://discord.gg/Dzy7FkH)

## Default Config

```
# Which block they will be logged
logger: [56]

# true = Enable /blocklogger command
# false = Disable /blocklogger command
can-change-with-command: true

# Which permission will player need for command
# false for disable
commandpermission: "blocklogger.command"

# Which permission will player need for logger notifications
# false for disable
staffpermission: "blocklogger.staff"

# Logging to console?
console-logger: true

# What will be replaced for color
lang-color: "&"

# What will plugin send?
# {player} - Will be replaced to player's name
# {block} - Will be replaced to block's id or name
# {command} - If some command typed it will be replaced to command
lang-message: "&d{player} mined {block}"
lang-perm: "&cYou don't have permission to use this command"
lang-usage: "&cUsage: /{command} (blockid)"
lang-number: "&cInvalid number"
lang-success: "&aSuccessfully added the block that id is {block} to the logger list."
lang-success1: "&aSuccessfully removed the block that id is {block} from the logger list."

# Wanna execute some command
execute-command: true

# Execute command author 
# Options: "console" / "player"
# Note: if you type nothing like that: "hi" or "" or null it will be player
execute-command-author: "player"

# Command to execute 
execute-commands: ["me You can edit this message in plugin_data/BlockLogger/config.yml"]
```
