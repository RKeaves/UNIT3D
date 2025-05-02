# Updating UNIT3D  

Update UNIT3D to the latest version by reviewing the release notes and following the steps below:

## 1. Create Backup  

UNIT3D offers built-in backups. Refer to the Backups documentation for usage.

> [!IMPORTANT]   
> Ensure there is a complete backup before proceeding.

## 2. Enter Maintenance Mode  

```sh
cd /var/www/html
php artisan down
```

## 3. Update UNIT3D  

> **Note:** Before running the update, review the new release’s minimum requirements to ensure the environment meets them.

1. **Proceed to update:**  
- The updater will fetch the latest commits from the upstream repository and stage them for installation.
    
   ```sh
   cd /var/www/html
   php artisan git:update
   ```
- There will be a prompt to confirm each step; choose **yes** to overwrite with the new version. 

    ````sh
        Start the update process (yes/no) [yes]:
        > yes
    ````

2. **Accept upstream files**  

- When prompted for each changed file, type yes to overwrite the local copy or press enter to accept the default answer shown in brackets.  

    ````sh
        Update config/unit3d.php (yes/no) [yes]:
        > yes

        git checkout origin/master -- config/unit3d.php
        [============================] (Done!)
    ````

3. **Run new migrations**  
   
    ````sh
        Run new migrations (php artisan migrate) (yes/no) [yes]:
        > yes
    ````

4. **Install new packages**  
   
    ````sh
        Install new packages (composer install) (yes/no) [yes]:
        > yes
    ````    

5. **Compile assets**  
   
    ````sh
        Compile assets (bun run build) (yes/no) [yes]:
        > yes        
    ````    

## 4. Resume Site Functionality  

After the update completes, run each of the following:

1. **Clear all caches**  

   ```sh
   sudo php artisan set:all_cache
   ```

2. **Restart PHP-FPM**  

   ```sh
   sudo systemctl restart php8.4-fpm
   ```

3. **Restart Laravel queues**  
   
   ```sh
   sudo php artisan queue:restart
   ```
   
4. **Bring the site live**

    ```sh
    sudo php artisan up
    ```

## Troubleshooting Clean-up  

Migration-related failures can occur during the update. It is important to review the error being described and make changes accordingly to clear any issues with the data at hand. 

The below list of commands to finish a complete update process:

- Finish any migrations not completed:  

  ```sh
  sudo php artisan migrate
  ```

- Reinstall dependencies:  

  ```sh
  composer install --prefer-dist --no-dev -o
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

  ```sh
  sudo bun install && sudo bun run build
  ```

- Restart services:  
  ```sh
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
