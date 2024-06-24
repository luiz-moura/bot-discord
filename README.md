# bot-discord-chatai

![bot-discord](https://github.com/luiz-moura/bot-discord/assets/57726726/c29fbab2-018e-42e0-8f80-3869b91edc49)

> A simple discord bot integration with CHATGPT
 - Keeps context of conversations per user
 - Command to reset conversation context

## Technologies

- [PHP-DI](https://php-di.org/)
- [Doctrine ORM](https://www.doctrine-project.org/)
- [DiscordPHP](https://github.com/discord-php/DiscordPHP)
- [OpenAI PHP](https://github.com/openai-php/client)
- [SQLite](https://www.sqlite.org/)

## Install

### 1. Install and start

1.1 First time, up containers and install dependencies and create .env

```bash
  make
```

1.2 Only start

```bash
  make up
```

### 2. Set Discord token
https://discord.com/developers/applications

Set the value in the environment variable `DISCORD_TOKEN` in .env

### 3. Set ChatGpt API key
https://beta.openai.com/account/api-keys

Set the value in the environment variable `CHATGPT_TOKEN` in .env

### 4. Invite the bot to your server
https://discord.com/oauth2/authorize?client_id=YOUR_CLIENT_ID_HERE&permissions=1024&scope=bot

## Author

* Github: [@luiz-moura](https://github.com/luiz-moura)
* LinkedIn: [@luiz-moura](https://linkedin.com/in/luiz-moura)

## Show your support

Give a ⭐️ if this project helped you!
