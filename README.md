# Content
- [Route List](https://github.com/khh-ini/gis_api/blob/master/README.md#route-list)
- [API Register](https://github.com/khh-ini/gis_api/blob/master/README.md#api-register)
- [API Login](https://github.com/khh-ini/gis_api/blob/master/README.md#api-login)
- [API Admin](https://github.com/khh-ini/gis_api/blob/master/README.md#api-admin)
- [API Masyarakat](https://github.com/khh-ini/gis_api/blob/master/README.md#api-masyarakat)
- [API Petugas](https://github.com/khh-ini/gis_api/blob/master/README.md#api-petugas)
- [API Drainase](https://github.com/khh-ini/gis_api/blob/master/README.md#api-drainase)
- [API Titik Banjir](https://github.com/khh-ini/gis_api/blob/master/README.md#api-titik-banjir)
- [API Titik Tersumbat](https://github.com/khh-ini/gis_api/blob/master/README.md#api-titik-tersumbat)
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
- Register akun admin
  - Request : `POST`
  - End point : `api/register/admin`
  - Creadential `admin`
  
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

- Register akun masyarakat
  - Request : `POST`
  - End point : `api/register/masyarakat`
  
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

- Register akun petugas
  - Request : `POST`
  - End point : `api/register/petugas`
  - Creadential : `admin`
  
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
- Login dengan credentials admin
  - Request : `POST`
  - End point : `api/login/admin`
  
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

- Login dengan credentials masyarakat
  - Request : `POST`
  - End point : `api/login/masyarakat`
 
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

- Login dengan credentials petugas
  - Request : `POST`
  - End point : `api/login/petugas`
  
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

## End Point
- Mengembalikan list data admin
  - Request : `GET` 
  - End point : `/api/admin/`
  - Credential : `admin`

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
    "created_at": "2020-12-17 09:39:52",
    "updated_at": "2020-12-17 09:39:52"
  },
  ....
]
```

- Mengembalikan data admin berdasarkan id
  - Request : `GET`
  - End point : `/api/admin/{id}`
  - Credential : `admin`

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
  "created_at": "2020-12-17 09:39:52",
  "updated_at": "2020-12-17 09:39:52"
},
```

- Mengembalikan data admin yang login
  - Request : `GET` 
  - End point : `/api/admin/profile`
  - Credential : `admin`

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
  "created_at": "2020-12-17 09:39:52",
  "updated_at": "2020-12-17 09:39:52"
},
```

- Mengupdate data admin yang terlogin pada sistem
  - Request : `PUT` 
  - End point : `/api/admin/`
  - Credential : `admin`
 
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
- Menghapus data admin berdasarkan id
  - Request : `DELETE` 
  - End point : `/api/admin/{id}`
  - Credential : `admin`

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

# API Petugas
## End point
- Mengembalikan list data petugas
  - Request : `GET` 
  - End point : `/api/petugas/`
  - Credentials : `admin`

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

- Mengembalikan data petugas berdasarkan id
  - Request : `GET` 
  - End point : `/api/petugas/{id}`
  - Credential : `admin`

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

- Mengembalikan data petugas yang login
  - Request : `GET` 
  - End point : `/api/petugas/profile`
  - Credential : `petugas`

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

- Mengupdate data petugas yang terlogin pada sistem
  - Request : `PUT` 
  - End point : `/api/petugas/`
  - Credential `petugas`
  
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
- Menghapus data petugas berdasarkan id
  - Request : `DELETE` 
  - End point : `/api/petugas/{id}`
  - Credential : `admin`
  
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
- Mengembalikan list data masyarakat
  - Request : `GET` 
  - End point : `/api/masyarakat/
  - Credentials : `admin`

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

- Mengembalikan data masyarakat berdasarkan id
  - Request : `GET` 
  - End Point : `/api/masyarakat/{id}`
  - Credential `admin`

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

- Mengembalikan data masyarakat yang login
  - Request : `GET` 
  - End point :  `/api/masyarakat/profile`
  - Credential : `masyarakat`

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

- Mengupdate data masyarakat yang terlogin pada sistem
  - endpoint : `/api/masyarakat/`
  - Request : `PUT` 
  - Credential : `masyarakat`
  
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
-  Menghapus data masyarakat berdasarkan id 
  - Request : `DELETE`
  - End point : `/api/masyarakat/{id}`
  - Credential : `admin`
  
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
## End point :
- Mengembalikan list data drainase
  - Request : `GET`
  - End point : `/api/drainase/`

response : 
```
[
  {
    "id": "a350781a-13dd-4fc8-b63e-5341386a77bb",
    "nama_jalan": "jalan pesisir",
    "lebar": 17,
    "panjang": 12,
    "kedalaman": 0.3,
    "bahan": "beton",
    "kondisi": "Not Good",
    "akhir_pembuangan": "sungai",
    "arah_alir": "selatan",
    "foto": "<img src=update Gambar\/>",
    "tipe_drainase": "parit",
    "geometry": "{\"type\": \"Point\", \"coordinates\": [30, 10]}"
  },
  ...
]
```
  - note : `output geometry dalam format geojson`

- Mengembalikan list data drainase
  - Request : `GET`
  - End point : `/api/drainase/{id}`

response : 
```
{
  "id": "a350781a-13dd-4fc8-b63e-5341386a77bb",
  "id_admin": "b152057a-5a28-41ed-9f7b-bad7c5bef110",
  "nama_jalan": "jalan pesisir",
  "lebar": 17,
  "panjang": 12,
  "kedalaman": 0.3,
  "bahan": "beton",
  "kondisi": "Not Good",
  "akhir_pembuangan": "sungai",
  "arah_alir": "selatan",
  "foto": "<img src=update Gambar\/>",
  "tipe_drainase": "parit",
  "geometry": "{\"type\": \"Point\", \"coordinates\": [30, 10]}"
}
```
  - note : `output geometry dalam format geojson`

- Menambahkan data drainase
  - Request : `POST`
  - End point : `/api/drainase/`
  - Credential : `admin`

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
  "nama_jalan": "[NAMA_JALAN]",
  "lebar": "[LEBAR]",
  "panjang": "[NAMA_USER]",
  "kedalaman": "[NO_HP_USER]",
  "bahan": "[BAHAN]",
  "kondisi" : "[KONDISI]",
  "akhir_pembuangan": "[AKHIR_PEMBUANGAN]",
  "arah_alir": "[ARAH_ALIR]",
  "foto": "[FOTO]",
  "tipe_drainase" : "[TIPE_DRAINASE]",
  "geometry" : "[GEOMETRY]"
}
```
  - note : `input geometry dalam format geojson`
respose : 
```
{
  "message": "Data Added Successfully!",
  "data": {
    "nama_jalan": "jalan pesisir",
    "lebar": "17",
    "panjang": "12",
    "kedalaman": "0.3",
    "bahan": "beton",
    "kondisi": "Not Good",
    "akhir_pembuangan": "sungai",
    "arah_alir": "selatan",
    "foto": "<img src=update Gambar\/>",
    "tipe_drainase": "parit",
    "geometry": {
      "type": "Point",
      "coordinates": [
        30,
        10
      ]
    },
    "id_admin": "b152057a-5a28-41ed-9f7b-bad7c5bef110",
    "id": "a350781a-13dd-4fc8-b63e-5341386a77bb",
    "updated_at": "2020-12-22 12:38:36",
    "created_at": "2020-12-22 12:38:36"
  }
}
```
- Mengupdate data drainase
  - Request : `PUT`
  - End point : `/api/drianase/{id}`
  - Crendential : `admin`

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
  "nama_jalan": "[NAMA_JALAN]",
  "lebar": "[LEBAR]",
  "panjang": "[NAMA_USER]",
  "kedalaman": "[NO_HP_USER]",
  "bahan": "[BAHAN]",
  "kondisi" : "[KONDISI]",
  "akhir_pembuangan": "[AKHIR_PEMBUANGAN]",
  "arah_alir": "[ARAH_ALIR]",
  "foto": "[FOTO]",
  "tipe_drainase" : "[TIPE_DRAINASE]",
  "geometry" : "[GEOMETRY]"
}
```
  - note : `input geometry dalam format geojson`
respose : 
```
{
  "message": "Data Updated Successfully!",
  "data": {
    "nama_jalan": "jalan pesisir",
    "lebar": "17",
    "panjang": "12",
    "kedalaman": "0.3",
    "bahan": "beton",
    "kondisi": "Not Good",
    "akhir_pembuangan": "sungai",
    "arah_alir": "selatan",
    "foto": "<img src=update Gambar\/>",
    "tipe_drainase": "parit",
    "geometry": {
      "type": "Point",
      "coordinates": [
        30,
        10
      ]
    },
    "id_admin": "b152057a-5a28-41ed-9f7b-bad7c5bef110",
    "id": "a350781a-13dd-4fc8-b63e-5341386a77bb",
    "updated_at": "2020-12-22 12:38:36",
    "created_at": "2020-12-22 12:38:36"
  }
}
```

- Menghapus data draianase
  - Request : `DELETE`
  - End point : `/api/drainase/{id}`
  - Credential : `admin`
 
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

# API Titik Banjir
## End point 

- Mendapatkan data titik banjir 
  - Request : `GET`
  - End poitn : `/api/titik_banjir/`

response : 
```
[
  {
    "id": "e2119f32-bd89-484a-aaa8-8b8893237546",
    "nama_jalan": "Jln. Pesisir",
    "kondisi_kerusakan": "Udh mendingan lah",
    "foto": "<img src=#\/>",
    "keterangan": "banjir setinggi 1m",
    "geometry": "{\"type\": \"Point\", \"coordinates\": [30, 10]}"
  },
  ...
]
```
- Mendapatkan data titik banjir berdasarkan id
  - Request : `GET`
  - End poitn : `/api/titik_banjir/{id}`

response : 
```
{
  "id": "e2119f32-bd89-484a-aaa8-8b8893237546",
  "nama_jalan": "Jln. Pesisir",
  "kondisi_kerusakan": "Udh mendingan lah",
  "foto": "<img src=#\/>",
  "keterangan": "banjir setinggi 1m",
  "geometry": "{\"type\": \"Point\", \"coordinates\": [30, 10]}"
}
```

- Menambahkan data titik banjir
  - Request : `POST`
  - End poitn : `/api/titik_banjir/`
  - Credential : `admin`

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
  "id": "e2119f32-bd89-484a-aaa8-8b8893237546",
  "nama_jalan": "Jln. Pesisir",
  "kondisi_kerusakan": "Udh mendingan lah",
  "foto": "<img src=#\/>",
  "keterangan": "banjir setinggi 1m",
  "geometry": "{\"type\": \"Point\", \"coordinates\": [30, 10]}"
}
```

response : 
```
{
  "message": "Data Added Successfully!",
  "data": {
    "nama_jalan": "Jln. Pesisir",
    "geometry": {
      "type": "Point",
      "coordinates": [
        30,
        10
      ]
    },
    "foto": "<img src=#\/>",
    "kondisi_kerusakan": "Udh mendingan lah",
    "keterangan": "banjir setinggi 1m" 
    "id_admin": "b152057a-5a28-41ed-9f7b-bad7c5bef110",
    "id": "e2119f32-bd89-484a-aaa8-8b8893237546",
    "updated_at": "2020-12-22 12:44:35",
    "created_at": "2020-12-22 12:44:35"
  }
}
```


- Menambahkan data titik banjir
  - Request : `PUT`
  - End poitn : `/api/titik_banjir/{id}`
  - Credential : `admin`
  
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
  "id": "e2119f32-bd89-484a-aaa8-8b8893237546",
  "nama_jalan": "Jln. Pesisir",
  "kondisi_kerusakan": "Udh mendingan lah",
  "foto": "<img src=#\/>",
  "keterangan": "banjir setinggi 1m",
  "geometry": "{\"type\": \"Point\", \"coordinates\": [30, 10]}"
}
```

response : 
```
{
  "message": "Data Added Successfully!",
  "data": {
    "nama_jalan": "Jln. Pesisir",
    "geometry": {
      "type": "Point",
      "coordinates": [
        30,
        10
      ]
    },
    "foto": "<img src=#\/>",
    "kondisi_kerusakan": "Udh mendingan lah",
    "keterangan": "banjir setinggi 1m" 
    "id_admin": "b152057a-5a28-41ed-9f7b-bad7c5bef110",
    "id": "e2119f32-bd89-484a-aaa8-8b8893237546",
    "updated_at": "2020-12-22 12:44:35",
    "created_at": "2020-12-22 12:44:35"
  }
}
```

- Menghapus data draianase
  - Request : `DELETE`
  - End point : `/api/titik_banjir/{id}`
  - Credential : `admin`
 
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


# API Titik Tersumbat


# API Pengaduan

