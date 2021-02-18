package com.azizapp.test.model


import com.google.gson.annotations.SerializedName

data class MasyarakatPengaduanResponse(
    @SerializedName("data")
    var `data`: DataPengaduan?,
    @SerializedName("message")
    var message: String?
)