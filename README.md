# Contont
- [Route List](https://github.com/khh-ini/gis_api/blob/master/README.md#route-list)
- [API Register](https://github.com/khh-ini/gis_api/blob/master/README.md#api-register)
- [API Login](https://github.com/khh-ini/gis_api/blob/master/README.md#api-login)
- [API Admin](https://github.com/khh-ini/gis_api/blob/master/README.md#api-admin)
- [API Masyarakat](https://github.com/khh-ini/gis_api/blob/master/README.md#api-masyarakat)
- [API Petugas](https://github.com/khh-ini/gis_api/blob/master/README.md#api-petugas)
- [API Drainase](https://github.com/khh-ini/gis_api/blob/master/README.md#api-drainase)
- [API Titik Banjir](https://github.com/khh-ini/gis_api/blob/master/README.md#api-titik-banjir)
- [API Titik Tersumbat](https://github.com/khh-ini/gis_api/blob/master/README.md#api-titi-tersumbat)
- [API Pengaduan](https://github.com/khh-ini/gis_api/blob/master/README.md#api-pengaduan)

# Route List
```
+--------+----------+-----------------------------------------+-----------------------------------+---------------------------------------------------------------------------+-------------------------+
| Domain | Method   | URI                                     | Name                              | Action                                                                    | Middleware              |
+--------+----------+-----------------------------------------+-----------------------------------+---------------------------------------------------------------------------+-------------------------+
|        | GET|HEAD | /                                       |                                   | Closure                                                                   | web                     |
|        | GET|HEAD | api/admin                               | get.admin                         | App\Http\Controllers\AdminController@index                                | api,auth:api-admin      |
|        | PUT      | api/admin                               | update.admin                      | App\Http\Controllers\AdminController@update                               | api,auth:api-admin      |
|        | GET|HEAD | api/admin/profile                       | get_loged_in_user.admin           | App\Http\Controllers\AdminController@profile                              | api,auth:api-admin      |
|        | GET|HEAD | api/admin/{id}                          | get_by_id.admin                   | App\Http\Controllers\AdminController@show                                 | api,auth:api-admin      |
|        | DELETE   | api/admin/{id}                          | delete.admin                      | App\Http\Controllers\AdminController@delete                               | api,auth:api-admin      |
|        | POST     | api/drainase                            | create.drainase                   | App\Http\Controllers\DrainaseController@create                            | api,auth:api-admin      |
|        | GET|HEAD | api/drainase                            | get.drainase                      | App\Http\Controllers\DrainaseController@index                             | api                     |
|        | GET|HEAD | api/drainase/{id}                       | get_by_id.drainase                | App\Http\Controllers\DrainaseController@show                              | api                     |
|        | DELETE   | api/drainase/{i}                        | delete.drainase                   | App\Http\Controllers\DrainaseController@delete                            | api,auth:api-admin      |
|        | PUT      | api/drainase/{i}                        | update.drainase                   | App\Http\Controllers\DrainaseController@update                            | api,auth:api-admin      |
|        | POST     | api/login/admin                         | login.admin                       | App\Http\Controllers\AdminController@login                                | api                     |
|        | POST     | api/login/masyarakat                    | login.masyarakat                  | App\Http\Controllers\MasyarakatController@login                           | api                     |
|        | POST     | api/login/petugas                       | login.petugas                     | App\Http\Controllers\PetugasController@login                              | api                     |
|        | GET|HEAD | api/masyarakat                          | get.masyarakat                    | App\Http\Controllers\MasyarakatController@index                           | api,auth:api-admin      |
|        | PUT      | api/masyarakat                          | update.masyarakat                 | App\Http\Controllers\MasyarakatController@update                          | api,auth:api-masyarakat |
|        | GET|HEAD | api/masyarakat/profile                  | get_loged_in_user.masyarakat      | App\Http\Controllers\MasyarakatController@profile                         | api,auth:api-masyarakat |
|        | DELETE   | api/masyarakat/{id}                     | delete.masyarakat                 | App\Http\Controllers\MasyarakatController@delete                          | api,auth:api-admin      |
|        | GET|HEAD | api/masyarakat/{id}                     | get_by_id.masyarakat              | App\Http\Controllers\MasyarakatController@show                            | api,auth:api-admin      |
|        | GET|HEAD | api/pengaduan                           | get.pengaduan                     | App\Http\Controllers\PengaduanController@index                            | api                     |
|        | POST     | api/pengaduan                           | create.pengaduan                  | App\Http\Controllers\PengaduanController@create                           | api,auth:api-masyarakat |
|        | DELETE   | api/pengaduan/{id}                      | delete.pengaduan                  | App\Http\Controllers\PengaduanController@delete                           | api,auth:api-admin      |
|        | GET|HEAD | api/pengaduan/{id}                      | get_by_id.pengaduan               | App\Http\Controllers\PengaduanController@index                            | api                     |
|        | GET|HEAD | api/petugas                             | get.petugas                       | App\Http\Controllers\PetugasController@index                              | api,auth:api-admin      |
|        | PUT      | api/petugas                             | update.petugas                    | App\Http\Controllers\PetugasController@update                             | api,auth:api-petugas    |
|        | GET|HEAD | api/petugas/profile                     | get_loged_in_user.petugas         | App\Http\Controllers\PetugasController@profile                            | api,auth:api-petugas    |
|        | DELETE   | api/petugas/{id}                        | delete.petugas                    | App\Http\Controllers\PetugasController@delete                             | api,auth:api-admin      |
|        | GET|HEAD | api/petugas/{id}                        | get_by_id.petugas                 | App\Http\Controllers\PetugasController@show                               | api,auth:api-admin      |
|        | POST     | api/register/admin                      | register.admin                    | App\Http\Controllers\AdminController@register                             | api,auth:api-admin      |
|        | POST     | api/register/masyarakat                 | register.masyarakat               | App\Http\Controllers\MasyarakatController@register                        | api                     |
|        | POST     | api/register/petugas                    | register.petugas                  | App\Http\Controllers\PetugasController@register                           | api,auth:api-admin      |
|        | GET|HEAD | api/titik_banjir                        | get.titk_banjir                   | App\Http\Controllers\TitikBanjirController@index                          | api                     |
|        | POST     | api/titik_banjir                        | create.titik_bajir                | App\Http\Controllers\TitikBanjirController@create                         | api,auth:api-admin      |
|        | GET|HEAD | api/titik_banjir/{id}                   | get_by_id.titik_banjir            | App\Http\Controllers\TitikBanjirController@show                           | api                     |
|        | PUT      | api/titik_banjir/{id}                   | update.titik_bajir                | App\Http\Controllers\TitikBanjirController@update                         | api,auth:api-admin      |
|        | DELETE   | api/titik_banjir/{id}                   | delete.titik_banjir               | App\Http\Controllers\TitikBanjirController@delete                         | api,auth:api-admin      |
|        | GET|HEAD | api/titik_tersumbat                     | get.titik_tersumbat               | App\Http\Controllers\TitikTersumbatController@index                       | api                     |
|        | POST     | api/titik_tersumbat                     | create.titik_tersumbat            | App\Http\Controllers\TitikTersumbatController@create                      | api,auth:api-admin      |
|        | DELETE   | api/titik_tersumbat/{id}                | delete.titik_tersumbat            | App\Http\Controllers\TitikTersumbatController@delete                      | api,auth:api-admin      |
|        | GET|HEAD | api/titik_tersumbat/{id}                | get_by_id.titik_tersumbat         | App\Http\Controllers\TitikTersumbatController@show                        | api                     |
|        | PUT      | api/titik_tersumbat/{id}                | update.titik_tersumbat            | App\Http\Controllers\TitikTersumbatController@update                      | api,auth:api-admin      |
|        | PUT      | api/update_pengaduan/admin/{id}         | update_pengaduan.admin            | App\Http\Controllers\PengaduanController@updateAdmin                      | api,auth:api-admin      |
|        | PUT      | api/update_pengaduan/masyarakat/{id}    | feedback_pengaduan.masyarakat     | App\Http\Controllers\PengaduanController@feedbackMasyarakat               | api,auth:api-masyarakat |
|        | PUT      | api/update_pengaduan/petugas/{id}       | update_pengaduan.petugas          | App\Http\Controllers\PengaduanController@updatePetugas                    | api,auth:api-petugas    |
|        | DELETE   | oauth/authorize                         | passport.authorizations.deny      | Laravel\Passport\Http\Controllers\DenyAuthorizationController@deny        | web,auth                |
|        | GET|HEAD | oauth/authorize                         | passport.authorizations.authorize | Laravel\Passport\Http\Controllers\AuthorizationController@authorize       | web,auth                |
|        | POST     | oauth/authorize                         | passport.authorizations.approve   | Laravel\Passport\Http\Controllers\ApproveAuthorizationController@approve  | web,auth                |
|        | POST     | oauth/clients                           | passport.clients.store            | Laravel\Passport\Http\Controllers\ClientController@store                  | web,auth                |
|        | GET|HEAD | oauth/clients                           | passport.clients.index            | Laravel\Passport\Http\Controllers\ClientController@forUser                | web,auth                |
|        | DELETE   | oauth/clients/{client_id}               | passport.clients.destroy          | Laravel\Passport\Http\Controllers\ClientController@destroy                | web,auth                |
|        | PUT      | oauth/clients/{client_id}               | passport.clients.update           | Laravel\Passport\Http\Controllers\ClientController@update                 | web,auth                |
|        | GET|HEAD | oauth/personal-access-tokens            | passport.personal.tokens.index    | Laravel\Passport\Http\Controllers\PersonalAccessTokenController@forUser   | web,auth                |
|        | POST     | oauth/personal-access-tokens            | passport.personal.tokens.store    | Laravel\Passport\Http\Controllers\PersonalAccessTokenController@store     | web,auth                |
|        | DELETE   | oauth/personal-access-tokens/{token_id} | passport.personal.tokens.destroy  | Laravel\Passport\Http\Controllers\PersonalAccessTokenController@destroy   | web,auth                |
|        | GET|HEAD | oauth/scopes                            | passport.scopes.index             | Laravel\Passport\Http\Controllers\ScopeController@all                     | web,auth                |
|        | POST     | oauth/token                             | passport.token                    | Laravel\Passport\Http\Controllers\AccessTokenController@issueToken        | throttle                |
|        | POST     | oauth/token/refresh                     | passport.token.refresh            | Laravel\Passport\Http\Controllers\TransientTokenController@refresh        | web,auth                |
|        | GET|HEAD | oauth/tokens                            | passport.tokens.index             | Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController@forUser | web,auth                |
|        | DELETE   | oauth/tokens/{token_id}                 | passport.tokens.destroy           | Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController@destroy | web,auth                |
+--------+----------+-----------------------------------------+-----------------------------------+---------------------------------------------------------------------------+-------------------------+
```

# Api Register
## End point
- `api/register/admin` -> Register akun admin
  - Request `POST`
  - membutuhkan creadential admin tambahkan Authorization pada request header
  
request header :
```
{
  ...
  "Authoriztion" : "Bearer [ACCESS_TOKEN]"
  ...
 }
```

request data :
```
{
  "email" : "[USER_EMAIL]",
  "password" : "[PASSWORD_USER]",
  "password_confirmation" : "[PASSWORD_USER]",
  "nama": "[nama_user]",
  "no_hp": "[no_hp]",
}
```

response :
```
{
  "message": "account created successfully!",
  "user": {
    "id": "[user_id]",
    "email": "[user_email]",
    "email_verified_at": null,
    "nama": "[nama_user]",
    "no_hp": "[no_hp]",
    "created_at": "2020-12-17 09:39:52",
    "updated_at": "2020-12-17 09:39:52"
  },
  "access_token": "[ACCESS_TOKEN]"
}
```

- `api/register/masyarakat` -> Register akun masyarakat
  - Request `POST`
  - membutuhkan creadential admin tambahkan Authorization pada request header
  
request header :
```
{
  ...
  "Authoriztion" : "Bearer [ACCESS_TOKEN]"
  ...
 }
```
request data :
```
{
  "email" : "[USER_EMAIL]",
  "password" : "[PASSWORD_USER]",
  "password_confirmation" : "[PASSWORD_USER]",
  "nama": "[nama_user]",
  "no_hp": "[no_hp]",
  "foto": "[foto_user]",
  "alamat": "[alamat_user]"
}
```

response :
```
{
  "message": "account created successfully!",
  "user": {
    "id": "[user_id]",
    "email": "[user_email]",
    "email_verified_at": null,
    "nama": "[nama_user]",
    "no_hp": "[no_hp]",
    "foto": "[foto_user]",
    "alamat": "[alamat_user]",
    "created_at": "2020-12-17 09:39:52",
    "updated_at": "2020-12-17 09:39:52"
  },
  "access_token": "[ACCESS_TOKEN]"
}
```

- `api/register/petugas` -> Register akun petugas
  - request `POST`
  
request data :
```
{
  "email" : "[USER_EMAIL]",
  "password" : "[PASSWORD_USER]",
  "password_confirmation" : "[PASSWORD_USER]",
  "nama": "[nama_user]",
  "no_hp": "[no_hp]",
  "foto": "[foto_user]",
  "posisi_petugas": "[posisi_petugas]",
  "tempat_lahir": "[tempat_lahir_petugas]",
}
```

response :
```
{
  "message": "log in successfully!",
  "user": {
    "id": "[user_id]",
    "email": "[user_email]",
    "email_verified_at": null,
    "nama": "[nama_user]",
    "no_hp": "[no_hp]",
    "foto": "[foto_user]",
    "posisi_petugas": "[posisi_petugas]",
    "tempat_lahir": "[tempat_lahir_petugas]",
    "tgl_lahir": "[tanggal_lahir_petugas]",
    "created_at": "2020-12-17 09:39:52",
    "updated_at": "2020-12-17 09:39:52"
  },
  "access_token": "[ACCESS_TOKEN]"
}
```

# Api Login
## End point
- `api/login/admin` -> Login dengan credentials admin
  - request `POST` 
  
request data :
``` 
{
  "email" : "[USER_EMAIL]",
  "password" : "[PASSWORD_USER]"
}
```

response :
```
{
  "message": "log in successfully!",
  "user": {
    "id": "[user_id]",
    "email": "[user_email]",
    "email_verified_at": null,
    "nama": "[nama_user]",
    "no_hp": "[no_hp]",
    "created_at": "2020-12-17 09:39:52",
    "updated_at": "2020-12-17 09:39:52"
  },
  "access_token": "[ACCESS_TOKEN]"
}
```

- `api/login/masyarakat` -> Login dengan credentials masyarakat
  - request `POST`
 
request data :
```
{
  "email" : "[USER_EMAIL]",
  "password" : "[PASSWORD_USER]"
}
```

response :
```
{
  "message": "log in successfully!",
  "user": {
    "id": "[user_id]",
    "email": "[user_email]",
    "email_verified_at": null,
    "nama": "[nama_user]",
    "no_hp": "[no_hp]",
    "foto": "[foto_user]",
    "alamat": "[alamat_user]",
    "created_at": "2020-12-17 09:39:52",
    "updated_at": "2020-12-17 09:39:52"
  },
  "access_token": "[ACCESS_TOKEN]"
}
```

- `api/login/petugas` -> Login dengan credentials petugas
  - request `POST`
  
request data :
```
{
  "email" : "[USER_EMAIL]",
  "password" : "[PASSWORD_USER]"
}
```

response :
```
{
  "message": "log in successfully!",
  "user": {
    "id": "[user_id]",
    "email": "[user_email]",
    "email_verified_at": null,
    "nama": "[nama_user]",
    "no_hp": "[no_hp]",
    "foto": "[foto_user]",
    "posisi_petugas": "[posisi_petugas]",
    "tempat_lahir": "[tempat_lahir_petugas]",
    "tgl_lahir": "[tanggal_lahir_petugas]",
    "created_at": "2020-12-17 09:39:52",
    "updated_at": "2020-12-17 09:39:52"
  },
  "access_token": "[ACCESS_TOKEN]"
}
```
# Api Admin
Api Admin Membuthkan credential admin, tambahjkan Authorization pada requrest Header untuk mengakses API Admin

request header :
```
{
  ...
  "Authoriztion" : "Bearer [ACCESS_TOKEN]"
  ...
 }
```

## End Point
- `/api/admin/` 
  - request `GET` Mengembalikan list data admin

response :
```
[
  {
    "id": "[ID_USER]",
    "email": "[EMAIL_USER]",
    "email_verified_at": null,
    "nama": "[NAMA_USER]",
    "no_hp": "[NO_HP_USER]",
    "created_at": "2020-12-17 09:39:52",
    "updated_at": "2020-12-17 09:39:52"
  },
  ....
]
```

- `/api/admin/{id}`
  - Request `GET` Mengembalikan data admin berdasarkan id

response : 
```
{
  "id": "[ID_USER]",
  "email": "[EMAIL_USER]",
  "email_verified_at": null,
  "nama": "[NAMA_USER]",
  "no_hp": "[NO_HP_USER]",
  "created_at": "2020-12-17 09:39:52",
  "updated_at": "2020-12-17 09:39:52"
},
```

- `/api/admin/profile`
  - Request `GET` Mengembalikan data admin yang login

response : 
```
{
  "id": "[ID_USER]",
  "email": "[EMAIL_USER]",
  "email_verified_at": null,
  "nama": "[NAMA_USER]",
  "no_hp": "[NO_HP_USER]",
  "created_at": "2020-12-17 09:39:52",
  "updated_at": "2020-12-17 09:39:52"
},
```

- `/api/admin/`
  - Request `PUT` Mengupdate data admin yang terlogin pada sistem
 
request data: 
```
{
  "email" : "[USER_EMAIL]",
  "password" : "[PASSWORD_USER]",
  "password_confirmation" : "[PASSWORD_USER]",
  "nama": "[nama_user]",
  "no_hp": "[no_hp]",
}
```

response :
```
{
  "message": "data updated successfully!",
  "user": {
    "id": "[user_id]",
    "email": "[user_email]",
    "email_verified_at": null,
    "nama": "[nama_user]",
    "no_hp": "[no_hp]",
    "created_at": "2020-12-17 09:39:52",
    "updated_at": "2020-12-17 09:39:52"
  },
}
```
- `/api/admin/{id}`
  - Request `DELETE` Menghapus data admin berdasarkan id
  - membutuhkan credential admin

response : 
```
null,204
```

# API Petugas
## End point
- `/api/petugas/
  - request `GET` Mengembalikan list data petugas
  - membutuhkan credentials admin

request header :
```
{
  ...
  "Authoriztion" : "Bearer [ACCESS_TOKEN]"
  ...
 }
```

response :
```
[
  {
    "id": "[user_id]",
    "email": "[user_email]",
    "email_verified_at": null,
    "nama": "[nama_user]",
    "no_hp": "[no_hp]",
    "foto": "[foto_user]",
    "posisi_petugas": "[posisi_petugas]",
    "tempat_lahir": "[tempat_lahir_petugas]",
    "tgl_lahir": "[tanggal_lahir_petugas]",
    "created_at": "2020-12-17 09:39:52",
    "updated_at": "2020-12-17 09:39:52"
  },
  ....
]
```

- `/api/petugas/{id}`
  - Request `GET` Mengembalikan data petugas berdasarkan id
  - membutuhkan credential admin

request header :
```
{
  ...
  "Authoriztion" : "Bearer [ACCESS_TOKEN]"
  ...
 }
```

response : 
```
{
  "id": "[user_id]",
  "email": "[user_email]",
  "email_verified_at": null,
  "nama": "[nama_user]",
  "no_hp": "[no_hp]",
  "foto": "[foto_user]",
  "posisi_petugas": "[posisi_petugas]",
  "tempat_lahir": "[tempat_lahir_petugas]",
  "tgl_lahir": "[tanggal_lahir_petugas]",
  "created_at": "2020-12-17 09:39:52",
  "updated_at": "2020-12-17 09:39:52"
},
```

- `/api/petugas/profile`
  - Request `GET` Mengembalikan data petugas yang login
  - membutuhkan credential petugas

request header :
```
{
  ...
  "Authoriztion" : "Bearer [ACCESS_TOKEN]"
  ...
 }
```

response : 
```
{
  "id": "[user_id]",
  "email": "[user_email]",
  "email_verified_at": null,
  "nama": "[nama_user]",
  "no_hp": "[no_hp]",
  "foto": "[foto_user]",
  "posisi_petugas": "[posisi_petugas]",
  "tempat_lahir": "[tempat_lahir_petugas]",
  "tgl_lahir": "[tanggal_lahir_petugas]",
  "created_at": "2020-12-17 09:39:52",
  "updated_at": "2020-12-17 09:39:52"
},
```

- `/api/petugas/`
  - Request `PUT` Mengupdate data petugas yang terlogin pada sistem
  - membutuhkan credential petugas
  
request header :
```
{
  ...
  "Authoriztion" : "Bearer [ACCESS_TOKEN]"
  ...
 }
```
 
request data: 
```
{
  "email" : "[USER_EMAIL]",
  "password" : "[PASSWORD_USER]",
  "password_confirmation" : "[PASSWORD_USER]",
  "nama": "[nama_user]",
  "no_hp": "[no_hp]",
  "foto": "[foto_user]",
  "posisi_petugas": "[posisi_petugas]",
  "tempat_lahir": "[tempat_lahir_petugas]",
  "tgl_lahir": "[tanggal_lahir_petugas]",
}
```

response :
```
{
  "message": "data updated successfully!",
  "user": {
    "id": "[user_id]",
    "email": "[user_email]",
    "email_verified_at": null,
    "nama": "[nama_user]",
    "no_hp": "[no_hp]",
    "foto": "[foto_user]",
    "posisi_petugas": "[posisi_petugas]",
    "tempat_lahir": "[tempat_lahir_petugas]",
    "tgl_lahir": "[tanggal_lahir_petugas]",
    "created_at": "2020-12-17 09:39:52",
    "updated_at": "2020-12-17 09:39:52"
  },
}
```
- `/api/admin/{id}`
  - Request `DELETE` Menghapus data petugas berdasarkan id
  - membutuhkan credential admin
  
request header :
```
{
  ...
  "Authoriztion" : "Bearer [ACCESS_TOKEN]"
  ...
 }
```

response : 
```
null,204
```

# API Masyarakat
## End point
- `/api/masyarakat/
  - request `GET` Mengembalikan list data masyarakat
  - membutuhkan credentials admin

request header :
```
{
  ...
  "Authoriztion" : "Bearer [ACCESS_TOKEN]"
  ...
 }
```

response :
```
[
  {
    "id": "[ID_USER]",
    "email": "[EMAIL_USER]",
    "email_verified_at": null,
    "nama": "[NAMA_USER]",
    "no_hp": "[NO_HP_USER]",
    "foto": "[foto_user]",
    "alamat": "[alamat_user]",
    "created_at": "2020-12-17 09:39:52",
    "updated_at": "2020-12-17 09:39:52"
  },
  ....
]
```

- `/api/masyarakat/{id}`
  - Request `GET` Mengembalikan data masyarakat berdasarkan id
  - membutuhkan credential admin

request header :
```
{
  ...
  "Authoriztion" : "Bearer [ACCESS_TOKEN]"
  ...
 }
```

response : 
```
{
  "id": "[ID_USER]",
  "email": "[EMAIL_USER]",
  "email_verified_at": null,
  "nama": "[NAMA_USER]",
  "no_hp": "[NO_HP_USER]",
  "foto": "[foto_user]",
  "alamat": "[alamat_user]",
  "created_at": "2020-12-17 09:39:52",
  "updated_at": "2020-12-17 09:39:52"
},
```

- `/api/masyarakat/profile`
  - Request `GET` Mengembalikan data masyarakat yang login
  - membutuhkan credential masyarakat

request header :
```
{
  ...
  "Authoriztion" : "Bearer [ACCESS_TOKEN]"
  ...
 }
```

response : 
```
{
  "id": "[ID_USER]",
  "email": "[EMAIL_USER]",
  "email_verified_at": null,
  "nama": "[NAMA_USER]",
  "no_hp": "[NO_HP_USER]",
  "foto": "[foto_user]",
  "alamat": "[alamat_user]",
  "created_at": "2020-12-17 09:39:52",
  "updated_at": "2020-12-17 09:39:52"
},
```

- `/api/petugas/`
  - Request `PUT` Mengupdate data masyarakat yang terlogin pada sistem
  - membutuhkan credential msayarakat
  
request header :
```
{
  ...
  "Authoriztion" : "Bearer [ACCESS_TOKEN]"
  ...
 }
```
 
request data: 
```
{
  "email" : "[USER_EMAIL]",
  "password" : "[PASSWORD_USER]",
  "password_confirmation" : "[PASSWORD_USER]",
  "nama": "[nama_user]",
  "no_hp": "[no_hp]",
  "foto": "[foto_user]",
  "alamat": "[alamat_user]",
}
```

response :
```
{
  "message": "data updated successfully!",
  "user": {
    "id": "[user_id]",
    "email": "[user_email]",
    "email_verified_at": null,
    "nama": "[nama_user]",
    "no_hp": "[no_hp]",
    "foto": "[foto_user]",
    "alamat": "[alamat_user]",
    "created_at": "2020-12-17 09:39:52",
    "updated_at": "2020-12-17 09:39:52"
  },
}
```
- `/api/admin/{id}`
  - Request `DELETE` Menghapus data masyarakat berdasarkan id
  - membutuhkan credential admin
  
request header :
```
{
  ...
  "Authoriztion" : "Bearer [ACCESS_TOKEN]"
  ...
 }
```

response : 
```
null,204
```

# API Drainase


# API Titik Banjir


# API Titik Tersumbat


# API Pengaduan

