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

Tests information is [here](tests/README.md)
