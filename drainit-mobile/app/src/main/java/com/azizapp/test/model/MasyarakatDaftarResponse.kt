package com.azizapp.test.model


import com.google.gson.annotations.SerializedName

data class MasyarakatDaftarResponse(
    @SerializedName("access_token")
    var accessToken: String?,
    @SerializedName("message")
    var message: String?,
    @SerializedName("user")
    var masyarakatDaftar: MasyarakatDaftar?,
    @SerializedName("status_code")
    var status_code: String?
)