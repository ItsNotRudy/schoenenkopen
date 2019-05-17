# Azure PHP + MySQL Demo - SchoenenKopen
![azure](https://img.shields.io/badge/platform-azure-%2300A4EF.svg)

## Software
- Azure MySQL 5.7
- Azure Load Balancer
- Azure Storage Account V2 (Files)
- Azure Virtual Machine (Ubuntu 18.04 LTS)
- Nginx 1.14.0
- PHP 7.2.17
- jQuery 3.4.1
- Angular.js 1.4.3
- Bootstrap 4.3.1

## Documentation

### Database
Stores data and image path in MySQL Server for Azure. URL can also be used for object/blob storage. Configuration example is included in `config.example.php`
```
+-----------+---------------+--------------------------+--------------+---------------+
| schoen_id | schoen_naam   | schoen_url               | schoen_prijs | schoen_desc   |
+-----------+---------------+--------------------------+--------------+---------------+
|         1 | Flyknit Racer | images/flyknit-racer.jpg | 89.99        | Dope schoenen |
|         2 | Air Jordan    | images/air-jordan.jpg    | 119.99       | Dope schoenen |
+-----------+---------------+--------------------------+--------------+---------------+
```


## Frontend
Website is designed in Bootstrap, data from MySQL is rendered using Angular.js. Routing to frontend through Azure Load Balancer. See `index.html` for examples.

### Backend
Site is served via Nginx and PHP 7.2, installed on two Ubuntu 18.04 virtual machines.

```
server {
        listen 80;
        root /var/www/schoenenkopen;
        index index.php index.html index.htm index.nginx-debian.html;
        server_name schoenenkopen.truetest.nl;

        location / {
                try_files $uri $uri/ =404;
        }

        location ~ \.php$ {
                include snippets/fastcgi-php.conf;
                fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
        }

        location ~ /\.ht {
                deny all;
        }
}
```
 
### Static content
SMB3 mount on the Ubuntu VMs. Used to store static files, in this case, images of sneakers. `/etc/fstab` entry:

```
//smb-share /mnt/point cifs nofail,vers=3.0,credentials=/etc/smbcredentials/file.cred,dir_mode=0777,file_mode=0777,serverino
```
#### Azure Load Balancer
Balances traffic between two Ubuntu 18.04 LTS virtual machines.

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.