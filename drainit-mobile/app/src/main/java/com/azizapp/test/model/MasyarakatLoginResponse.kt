package com.azizapp.test.model


import com.google.gson.annotations.SerializedName

//class Model from json body
data class MasyarakatLoginResponse(
    @SerializedName("access_token")
    var accessToken: String?,
    @SerializedName("message")
    var message: String?,
    @SerializedName("status_code")
    var statusCode: Int?,
    @SerializedName("user")
    var masyarakat: Masyarakat?
)