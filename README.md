
# ExampleSMS Firması Api

Bu proje ExampleSMS firması için Restful api.

## Authentication

Bu projede Authentication işlemleri için Laravel Passport kullanılmıştır.(https://laravel.com/docs/10.x/passport)

## Proje Çalıştırma Aşamaları

1.Adım

```bash
  composer install
```

2.Adım: .env.example dosyasını kopyalayıp .env dosyasını oluşturunuz ve database ile bağlantı için gerekli değişiklikleri yapınız.

```bash
cp .env.example .env
```

3.Adım: Yeni bir application key oluşturunuz.

```bash
php artisan key:generate
```

4.Adım

```bash
php artisan passport:install
```

5.Adım

```bash
php artisan migrate
```

6.Adım : projeyi çalıştırınız.

```bash
php artisan serve
```

Projeye artık buradan erişebilirsiniz :  http://localhost:8000

## API ENDPOINTS


API endpointlarının dökümantasyonunu Swagger ile oluşturulmuştur.
görüntülemek için bu linki ziyaret edebilirsiniz : http://127.0.0.1:8000/api/documentation

## Tests

Testleri çalıştırmak için : 

```bash
  php artisan test
```

  
