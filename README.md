# yii2-easy-admin
<img src="logo.png?raw=true" alt="yii2-easy-admin" width="120" height="120"/>
Build a full-featured administrative interface in 10 minutes.

## screenshots (click to view detail) 
<p float="left">
  <img src="screenshots/dashboard.png?raw=true" alt="dashboard.png" width="180" height="90"/>
  <img src="screenshots/menus.png?raw=true" alt="menus.png" width="180" height="90"/>
  <img src="screenshots/post-edit-2.png?raw=true" alt="post-edit-2.png" width="180" height="90"/>
  <img src="screenshots/post-edit-1.png?raw=true" alt="post-edit-1.png" width="180" height="90"/>
  <img src="screenshots/media.png?raw=true" alt="media.png" width="180" height="90"/>
  <img src="screenshots/nav-menu.png?raw=true" alt="nav-menu.png" width="180" height="90"/>
  <img src="screenshots/role-edit.png?raw=true" alt="role-edit.png" width="180" height="90"/>
</p>

## Getting Started

This project has been tested in Ubuntu only, so it's recommended to deploy in Linux.

### Prerequisites

This project depends on PHP 7.0+, composer, Yii 2, MySQL and Redis.

```
sudo apt-get install php    
...
```

### Installing

Clone the project

```
git clone https://github.com/hgkmail/yii2-easy-admin.git
```

Use composer to install dependencies

```
composer install
```

According to your local environment, modify "app/config/web.php", "app/config/db.php" and "app/config/redis.php". Then make migrations to MySQL and run app.

```
cd app
php yii migrate
php yii serve
```

Open http://localhost:8080/index.php, then you will see the dashboard page.

## Running the tests

TBD

## Deployment

You can also deploy this project with docker.

```
cd app
sudo docker-compose up -f docker-compose.apache.yml
```

## Built With

* [Yii 2](https://github.com/yiisoft/yii2) - The web framework used
* [Composer](https://github.com/composer/composer) - Dependency Management
* [AdminLTE](https://github.com/almasaeed2010/AdminLTE) - UI Theme

## Contributing

Just fork and modify the project, submitting pull requests is welcome.

## Versioning

TBD

## Authors

* **Guokai Huang** - *Initial work* - [Guokai Huang](https://github.com/hgkmail)

TBD

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Inspiration
[laravel-admin](https://github.com/z-song/laravel-admin)
