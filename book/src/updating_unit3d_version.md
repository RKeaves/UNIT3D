# Updating UNIT3D

Update UNIT3D and its dependencies following the steps below.

## 1. Create Backup

UNIT3D offers built-in backups. Refer to the Backups documentation for usage.

> [!IMPORTANT]   
> Ensure you have a complete backup before proceeding.

## 2. Enter Maintenance Mode

```bash
cd /var/www/html
php artisan down
```

## 3. Update UNIT3D

> **Note:** Before running the actual update, make sure your environment meets the new release’s minimum requirements.

1. **Fetch and apply updates**  
   ```bash
   cd /var/www/html
   php artisan git:update
   ```

2. **Review and resolve conflicts**  

   UNIT3D fetches the new code and prompts for action on file conflicts. It is suggested to accept the updated files. After the update, review `~/tempBackup/updateLogs.txt` for conflicts. Any modifications will need to be re-implemented with the new code.     

    ````bash
        Update config/unit3d.php (yes/no) [yes]:
        > yes

        git checkout origin/master -- config/unit3d.php
        [============================] (Done!)

        Update resources/sass/components/_quick_search.scss (yes/no) [yes]:
        > yes
    ````

3. **Run new migrations**  
   ```bash
   php artisan migrate
   ```


## 4. Resume Site Functionality

On a successful update process; clear the cache, restart the PHP-FPM service, restart the Laravel queues, and finally bring the site live. 

```sh
sudo php artisan set:all_cache && \
sudo systemctl restart php8.4-fpm && \
sudo php artisan queue:restart && \
sudo php artisan up
```
> [!TIP]   
> If running external Unit3d-Announce, restart the supervisor services.  

```sh
sudo supervisorctl reread && \
sudo supervisorctl update && \
sudo supervisorctl reload 
```
---


## Troubleshooting Clean-up

Migration-related failures can occur during the update. It is important to review the error being described and make changes accordingly to clear any issues with the data at hand. 

The below list of commands to finish a complete update process:

Finish any migrations not completed:  
`sudo php artisan migrate`

Reinstall dependencies:  
`sudo -u www-data composer install --prefer-dist --no-dev -o`  

Clear caches:  
```sh
sudo php artisan cache:clear  && \
sudo php artisan queue:clear  && \
sudo php artisan auto:email-blacklist-update && \
sudo php artisan auto:cache_random_media && \
sudo php artisan set:all_cache  
```
Rebuild static assets:  
`bun install && bun run build`  

Restart the PHP-FPM service:  
`sudo systemctl restart php8.4-fpm`

Restart the Laravel queues:  
`sudo php artisan queue:restart`  

Bring the site live:  
`sudo php artisan up`

> [!TIP]   
> If running external Unit3d-Announce, restart the supervisor services.  

```sh
sudo supervisorctl reread && \
sudo supervisorctl update && \
sudo supervisorctl reload
```
