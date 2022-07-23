## Installing project
1. Creating networks:
```
docker network create check24-common
```
2. Running containers:
```
docker-compose up -d
```
3. Installing packages:
```
bin/composer i
```
4. Run migrations:
```
bin/migrate
```
5. Run phpstan (we should add it to git commit hook and to pipelines):
```
bin/phpstan
```

Tests information is [here](tests/README.md)
