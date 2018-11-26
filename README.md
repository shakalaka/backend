```
mv .env.example .env
```

# docker
```
docker-compose build
docker-compose up
```

# non-docker
```
php -S localhost:8080 -t public
```
в конфигурации *.env* необходимо указать хост, на котором висит memcached
```
MEMCACHED_HOST=127.0.0.1
```
требования:
- memcached
- php7.2
