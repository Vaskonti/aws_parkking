#!/bin/bash
# Ensuring permissions
[ `whoami` = root ] || exec sudo su -c $0 root

# Disabling restarting of services after updates
sudo apt remove needrestart -y &&

# Installing CodeDeploy agent
sudo apt update && sudo apt upgrade -y &&
sudo apt install ruby-full wget -y &&
cd /home/ubuntu &&
sudo wget https://aws-codedeploy-us-east-1.s3.us-east-1.amazonaws.com/latest/install &&
sudo chmod +x ./install &&
sudo ./install auto &&
sudo service codedeploy-agent start &&
echo "ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAACAQDRPiHIqAi6CK7kKzOp3CSvveHrf7uGcp9fWkfPXd4ja5zR552L9TpOjmwS4KS5HjhV8swjDAH6O2lkUW4fBOFTW6T4bgBIjaSNFoI2FrO8unaPb79JlnY9SfH0i6Eg0o3FqvfKOuRTssebdkXlJhxFZ6Bx8WHjHP4W9lETy69h0Kz+JrjyOtGIRDpvOA0IPabo1yUCO2z51sOJT1QFVZnqUMk3J2YL+7yEsRSPkwgde1oKaW4pTznkWv/ZEG1kE7Jx7o5stFUwZFsu5Oug40rEx29pXrgE08WvFElaF2HtAN+dFTO93R0JhNv11+r3oHMjNIrw4I7/4PLHwcSD3RYQKo3t8djSjsRt3SZmxZNQOL7YUUR/jfxKWkAq0lRyAE/k4iqIGafmPhH3+KjoMMdYuF4RnifDWJ+dUmVokid4HgJ5tlzkvxlVcd1ZEonf/xwJ5/z1PlyaMDjkPWqGcIFFFBtIuKSMcZKIZ57KNaE7szYBoHCKItwQGMdu9FmjkwY3TMWgANcIuucFMH5YjocqLNLNCimjGdAf+ZUoYUQ1wT0mz1oR9CXitU7Kc+ciBMRkw1+QfQMc3zHLmSKNzVYNMhPYd2GrSGd7KjAsI2fFjDTREKtHlq5JZkHGu7lFEEKUjGMtuDHWTGWA6FZz+Cgf6UPqcCUrE73x3HbcLdca3w== vasilhristov@Vasils-MacBook-Pro.local" >> /home/ubuntu/.ssh/authorized_keys &&

# Cloning project
sudo mkdir /var/www ||
sudo mkdir /var/www/mdp_project &&
sudo git clone https://github.com/VasilHristovDev/mdp_project /var/www/mdp_project &&

# Installing dependencies
sudo apt update && sudo apt upgrade -y &&
sudo apt install software-properties-common -y &&
sudo add-apt-repository ppa:ondrej/php -y &&
sudo apt update && sudo apt upgrade -y &&
sudo apt install php8.2-fpm php8.2-common php8.2-mysql php8.2-xml php8.2-xmlrpc php8.2-curl php8.2-gd php8.2-imagick php8.2-cli php8.2-dev php8.2-imap php8.2-mbstring php8.2-opcache php8.2-soap php8.2-zip php8.2-redis php8.2-intl php8.2-mongodb composer nginx -y &&

# Installing AWS CLI
sudo apt install unzip &&
sudo curl "https://awscli.amazonaws.com/awscli-exe-linux-x86_64.zip" -o "awscliv2.zip" &&
sudo unzip -u awscliv2.zip &&
sudo ./aws/install &&

# Project setup
cd /var/www/mdp_project &&
sudo aws s3 cp s3://environment-laravel/env/.env . &&
sudo wget https://truststore.pki.rds.amazonaws.com/global/global-bundle.pem &&
printf "\n" | sudo composer install &&
sudo php artisan key:generate &&
sudo php artisan migrate ||
sudo chmod 777 -R /var/www/mdp_project/storage &&

# Nginx setup
sudo cp /var/www/mdp_project/terraform/modules/asg/nginx.conf /etc/nginx/sites-available/mdp_project &&
cd /etc/nginx/sites-enabled &&
sudo ln -s /etc/nginx/sites-available/mdp_project &&
sudo rm /etc/nginx/sites-available/default &&
sudo rm /etc/nginx/sites-enabled/default &&
sudo systemctl start nginx &&
sudo systemctl restart nginx
