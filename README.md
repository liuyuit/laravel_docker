<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).



## Install
> https://learnku.com/laravel/wikis/25560

为避免 docker 数据目录占用系统盘空间，需要修改 docker 数据目录至数据盘。
`vim /etc/docker/daemon.json ` 
```
{
  "data-root": "/www/docker"
}
```
```
systemctl restart docker
```
```
cp .env.example .env
vim .env

cp docker-compose.example.yml docker-compose.yml
vim docker-compose.yml

[root@VM-8-4-centos material]# mkdir -p service/log/php
[root@VM-8-4-centos material]# mkdir -p service/log/nginx
[root@VM-8-4-centos material]# cp -R service/config.example service/config

docker-compose up -d --build
docker exec -it php_container_id /bin/bash
root@16c0c82b70e2:/var/www# chmod -R a+w storage/
root@16c0c82b70e2:/var/www# chmod -R a+w bootstrap/cache/
php artisan storage:link
php artisan key:generates
php artisan migrate --seed
chmod -R 0755 storage
sudo chown -R www-data:www-data storage
```
or
```javascript
sudo chmod -R 0777 storage
```


关闭Git检出时的换行符转换
```bash 
git config --global core.autocrlf input
```


## commands

#### docker

show ips

```
docker inspect -f '{{.Name}} - {{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' $(docker ps -aq)
```

```
 docker exec -it material_php /bin/bash
  docker exec -it material_redis /bin/bash
  docker exec -it dbde4ea9eacc  redis-cli
  
  docker-compose restart

```

#### debug

- 因为 项目使用的 docker network 别名连接的 数据库、redids。所以涉及到 数据库的 artisan 命令都需要进入容器使用

  ```
  liuyu@usercomputerdeMacBook-Air material % docker exec -it material_php /bin/bash
  root@a47deda4c162:/var/www# 
  
  root@a47deda4c162:/var/www# php artisan migrate
  Migration table created successfully.
  ```

-  MacOs中的Docker涉及到文件写入会非常慢。所以加上 cached 文件标识

  ```
  php:
        volumes:
          - ./:/var/www:cached
  ```

- 

## require
> https://github.com/w7corp/easywechat
> https://www.easywechat.com/docs/5.x/installation
