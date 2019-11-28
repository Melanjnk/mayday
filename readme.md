# Mayday 
quote api [Fast as _sun speed_] 
###### based on Symfony 4.3

### Docker:
```
#install all nessesary containers for run app and run
docker-compose up -d 

# use to rebuild all containers 
docker-compose down

# ps (list of all running containers)
docker-compose ps
```
* usefull commands: 
```
# composer
## run bash into composer container
docker-compose run composer bash

docker-compose run composer install
```

## Fast Start:

```bash
$ docker-compose exec php composer install
$ docker-compose exec php bin/console doctrine:migrations:migrate
```

Add mayday.highskills.local to your hosts

* Unix sudo nano /etc/hosts
* Win c:\windows\system32\drivers\etc\hosts
* Mac sudo vi /etc/hosts

```console
127.0.0.1 mayday.highskills.local
```