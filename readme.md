# PHP Experimenting

### 1. Getting started

#### 1.1. Installation

First, you need to clone repository:

```
git@github.com:LukSky24/php_experimenting.git
```

Then, you need to set correct environment variables in `.env` file. Copy that file into `.env.local` or create new one and adjust variables.

Next, you need to install dependencies:

```
# for backend
composer install
```

Next, you need to create docker volume for database:

```
docker volume create phpexpdb
```

After that you can start docker containers:

```
docker-compose up -d
```

When containers are up and running, you can execute following command, to get into the php container shell:

```
docker-compose exec app bash
```

In container shell you need to execute few symfony commands, to get complete project:

```
# create database schema
php bin/console do:sc:up --force

# load fixtures
php bin/console do:fi:lo --append

# clear cache
php bin/console ca:cl
```

Project will be accessible at `http://localhost:8080`, unless you change docker configuration.

#### 1.2. Starting and shutting down containers

To start containers you need to execute:

```
docker-compose up -d
```

To shut down containers you need to execute:

```
docker-compose down -v
```
