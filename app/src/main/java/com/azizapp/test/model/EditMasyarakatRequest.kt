package com.azizapp.test.model


import com.google.gson.annotations.SerializedName

data class EditMasyarakatRequest(
    @SerializedName("_method")
    var method: String?,
    @SerializedName("nama")
    var nama: String?,
    @SerializedName("password")
    var password: String?,
    @SerializedName("password_confirmation")
    var passwordConfirmation: String?,
    @SerializedName("email")
    var email: String?,
    @SerializedName("no_hp")
    var noHp: String?,
    @SerializedName("alamat")
    var alamat: String?,
    @SerializedName("foto")
    var foto: Any?
)