# Import CSV large file upload
1. Create appropriate migration for this csv
2. Import this csv batch/chunk wise with queue from a html view
3. Show imported data in a normal table
3. Add a branch wise filtering option in table
3. Add a gender wise filtering option in table
4. Show data in table with  total_customer_count,
total_male_customer_count, total_female_customer_count

## For Laravel 11, the minimum PHP version required is PHP 8.2.

```bash
git clone https://github.com/ruhulamin63/Import-csv-using-batch-chunk-with-queue.git
```

```bash
cp .env.example .env
```

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your-db-name
DB_USERNAME=root
DB_PASSWORD=
```

```bash
composer update
```
### .env
```bash
QUEUE_CONNECTION=database
```
### Generate Migration:
```bash
php artisan queue:table

php artisan queue:batches-table
```

```bash
php artisan migrate:fresh --seed
```

### start queue process
```bash
php artisan queue:work --timeout=0
```

### Find duplicate emails(Optional)
#### .env
```bash
CACHE_DRIVER=file
```

### Optional
```bash
npm install && npm run dev
```

### Public Access Route
```bash
http://127.0.0.1:8000
```

#### ======== Enjoy coding ============

*** Copyright@reserved by Ruhul Amin ***