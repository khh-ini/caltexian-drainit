package com.azizapp.test

import com.google.gson.annotations.SerializedName

data class MasyarakatPostResponse(
    @SerializedName("id")
    val id: String?,
    val nama: String?,
    val foto: String?,
    val noHp: String?,
    val alamat: String?,
    val email: String?,
    val createdAt: String?,
    val updatedApp: String?){

}