# Updating UNIT3D  

Update UNIT3D to the latest version by reviewing the release notes and following the steps below:

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

> **Note:** Before running the update, ensure your environment meets the new release’s minimum requirements.

1. **Proceed to update:**  
- The updater will fetch the latest commits from the upstream repository and stage them for installation.
    
   ```bash
   cd /var/www/html
   php artisan git:update
   ```
- You may be prompted to confirm each step; choose **yes** to overwrite with the new version.  

    ````bash
        Start the update process (yes/no) [yes]:
        > yes
    ````

2. **Accept upstream files**  

- When prompted for each changed file, type yes to overwrite your local copy.  

    ````bash
        Update config/unit3d.php (yes/no) [yes]:
        > yes

        git checkout origin/master -- config/unit3d.php
        [============================] (Done!)
    ````

3. **Run new migrations**  
   
    ````bash
        Run new migrations (php artisan migrate) (yes/no) [yes]:
        > yes
    ````

4. **Install new packages**  
   
    ````bash
        Install new packages (composer install) (yes/no) [yes]:
        > yes
    ````    

5. **Compile assets**  
   
    ````bash
        Compile assets (bun run build) (yes/no) [yes]:
        > yes        
    ````    

## 4. Resume Site Functionality  

After the update completes, run each of the following:

1. **Clear all caches**  

   ```bash
   sudo php artisan set:all_cache
   ```

2. **Restart PHP-FPM**  

   ```bash
   sudo systemctl restart php8.4-fpm
   ```

3. **Restart Laravel queues**  
   
   ```bash
   sudo php artisan queue:restart
   ```
   
## Troubleshooting Clean-up  

Migration-related failures can occur during the update. It is important to review the error being described and make changes accordingly to clear any issues with the data at hand. 

The below list of commands to finish a complete update process:

- Finish any migrations not completed:  

  ```bash
  sudo php artisan migrate
  ```

- Reinstall dependencies:  

  ```bash
  sudo -u www-data composer install --prefer-dist --no-dev -o
  ```
- Clear caches:  

  ```sh
  sudo php artisan cache:clear  && \
  sudo php artisan queue:clear  && \
  sudo php artisan auto:email-blacklist-update && \
  sudo php artisan auto:cache_random_media && \
  sudo php artisan set:all_cache
  ```

- Rebuild static assets:  

  ```bash
  bun install && bun run build
  ```

- Restart services:  
  ```bash
  sudo systemctl restart php8.4-fpm
  sudo php artisan queue:restart
  sudo php artisan up
  ```
  
- If running external Unit3d-Announce, restart the supervisor services.  

  ```sh
  sudo supervisorctl reread && \
  sudo supervisorctl update && \
  sudo supervisorctl reload
  ```
