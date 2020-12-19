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
