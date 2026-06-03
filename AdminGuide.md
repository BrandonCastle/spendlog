# Admin Guide

## Starting and stopping services

    sudo systemctl start apache2
    sudo systemctl stop apache2
    sudo systemctl restart apache2

    sudo systemctl start mariadb
    sudo systemctl stop mariadb
    sudo systemctl restart mariadb

## Checking service status

    sudo systemctl status apache2
    sudo systemctl status mariadb

## Database access

    sudo mysql -u root -p spendlog

## Changing the DB password

Update /var/www/html/spendlog/config/db.php with the new credentials.

## Logs

    sudo tail -f /var/log/apache2/error.log
    sudo tail -f /var/log/apache2/access.log

## Backup the database

    mysqldump -u root -p spendlog > spendlog_backup.sql

## Restore the database

    mysql -u root -p spendlog < spendlog_backup.sql
