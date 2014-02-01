php app/console generate:bundle --namespace=Tspycher/Bundle/ThirtiethBirthdayBundle --format=annotation --dir=src --bundle-name=TspycherThirtiethBirthdayBundle

/usr/bin/php app/console doctrine:generate:entity --entity=TspycherThirtiethBirthdayBundle:People --format=annotation --fields="name:string(255) numberOfSeats:int email:string(255)" --with-repository
