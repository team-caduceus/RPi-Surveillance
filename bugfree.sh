
case "$1" in

  remove)
        sudo killall raspimjpeg
        sudo apt-get remove -y apache2 php5 libapache2-mod-php5 gpac motion
        sudo apt-get autoremove -y

        sudo rm -r /var/www/*
        sudo rm /usr/local/bin/raspimjpeg
        sudo rm /etc/raspimjpeg
        sudo cp -r etc/rc_local_std/rc.local /etc/
        sudo chmod 755 /etc/rc.local

        echo "Removed everything"
        ;;

  autostart_yes)
        sudo cp -r etc/rc_local_run/rc.local /etc/
        sudo chmod 755 /etc/rc.local
        echo "Changed autostart"
        ;;

  autostart_no)
        sudo cp -r  etc/rc_local_std/rc.local /etc/
        sudo chmod 755 /etc/rc.local
        echo "Changed autostart"
        ;;

  install)
        sudo killall raspimjpeg
        git pull origin master
        sudo apt-get install -y apache2 php5 libapache2-mod-php5 gpac motion

        sudo cp -r www/* /var/www/
        sudo mkdir -p /var/www/media
        sudo chown -R www-data:www-data /var/www
        sudo mknod /var/www/FIFO p
        sudo chmod 666 /var/www/FIFO
        sudo cp -r etc/apache2/sites-available/default /etc/apache2/sites-available/
        sudo chmod 644 /etc/apache2/sites-available/default
        sudo cp etc/apache2/conf.d/other-vhosts-access-log /etc/apache2/conf.d/other-vhosts-access-log
        sudo chmod 644 /etc/apache2/conf.d/other-vhosts-access-log

        sudo cp -r bin/raspimjpeg /opt/vc/bin/
        sudo chmod 755 /opt/vc/bin/raspimjpeg
        sudo ln -s /opt/vc/bin/raspimjpeg /usr/bin/raspimjpeg

        sudo cp -r /etc/raspimjpeg /etc/raspimjpeg.bak
        sudo cp -r etc/raspimjpeg/raspimjpeg /etc/
        sudo chmod 644 /etc/raspimjpeg

        sudo cp -r etc/rc_local_run/rc.local /etc/
        sudo chmod 755 /etc/rc.local

        sudo cp -r etc/motion/motion.conf /etc/motion/
        sudo chmod 640 /etc/motion/motion.conf

        echo "Installer finished"
        ;;

  start)
        shopt -s nullglob

        video=-1
        for f in /var/www/media/video_*.mp4; do
          video=`echo $f | cut -d '_' -f2 | cut -d '.' -f1`
        done
        video=`echo $video | sed 's/^0*//'`
        video=`expr $video + 1`

        image=-1
        for f in /var/www/media/image_*.jpg; do
          image=`echo $f | cut -d '_' -f2 | cut -d '.' -f1`
        done
        image=`echo $image | sed 's/^0*//'`
        image=`expr $image + 1`

        shopt -u nullglob

        sudo mkdir -p /dev/shm/mjpeg
        sudo raspimjpeg -ic $image -vc $video > /dev/null &
        echo "Started"
        ;;

  stop)
        sudo killall raspimjpeg
        echo "Stopped"
        ;;


  *)
        echo "No option selected"
        ;;

esac


