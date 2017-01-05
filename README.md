# SmileEzUICronBundle

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/f1ab4025-bcd6-43e9-8857-5029ea2247a4/mini.png)](https://insight.sensiolabs.com/projects/f1ab4025-bcd6-43e9-8857-5029ea2247a4)

eZ Platform Cron Scheduler Bundle

> This bundle is currently in dev

## Description

This bundle offer a command that you should use as a cronjob :

```cmd
* * * * * cd <your_project_root> && php app/console smileez:crons:run
```

This command will list all commands extending "CronAbstract" class and defined as service tagged with "smile.cron".

You can define specific cron expression for each command as cron and prioritize them.

You will have UI to enable/disable, chage expression and cron arguments

## Documentation

[Documentation](Resources/doc/README.md)

