## Install

```

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed

npm i
npm run build

php artisan optimize:clear

```

---

## Admin

Go to `/admin`

Default Admin:

`superadmin@capulet.com`
`password`

---


## API

```
POST {{url}}/api/book

- name (Required)
- start_at
- end_at
- address
- notes

```

Note: Only `name` is allowed. The rest are pending.

### Sample Response

For Existing Values

```
{
    "type": "old",
    "property": {
        "id": 108,
        "uuid": "#UCJ-Z81",
        "name": "123 vahn #UCJ-Z81",
    },
    "booking": {
        "start_at": null,
        "ends_at": null,
        "property_id": 108,
        "id": 15
    }
}

```

For New Values

```
{
    "type": "new",
    "property": {
        "name": "413 Earl #N39-0ZX",
        "uuid": "#N39-0ZX",
        "id": 109
    },
    "booking": {
        "start_at": null,
        "ends_at": null,
        "property_id": 109,
        "id": 16
    },
    "uuid": "#N39-0ZX"
}

Note: New properties will have `uuid` in the response body. 

```