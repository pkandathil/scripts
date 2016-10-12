#!/bin/bash
adduser $1 --disabled-password
echo "$1 ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers
passwd -d $1
sudo adduser $1 sudo
mkdir /home/$1/.ssh
cd /home/$1/
touch .ssh/authorized_keys
chown -R $1:$1 .ssh
chmod -R 700 .ssh

