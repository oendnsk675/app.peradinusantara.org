# 📦 Peradi App — Dockerized PHP + MariaDB

Aplikasi web berbasis PHP dengan database MariaDB, dikemas menggunakan Docker Compose.

---

## 📋 Requirements

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

---

## 🚀 Cara Menjalankan Aplikasi

### 1. Clone repository

```bash
git clone https://github.com/oendnsk675/app.peradinusantara.org.git
cd app.peradinusantara.org
```

### 2. Build Image

```bash
make build
```

### 3. Jalankan Container

```bash
make up
```

### 4. Import database

#### 4.1 Copy file dump ke container

```bash
docker cp ~/Downloads/perh4452_peradi.sql appperadinusantaraorg-db-1:/dump.sql
```

#### 4.2 Masuk ke container database

```bash
docker exec -it appperadinusantaraorg-db-1 bash
```

#### 4.3 Import file SQL ke database

```bash
mysql -u root -p peradi < /dump.sql
```
