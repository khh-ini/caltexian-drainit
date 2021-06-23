package com.azizapp.test.model.vote


import com.google.gson.annotations.SerializedName

data class Vote(
    @SerializedName("id_pengaduan")
    val idPengaduan: String,
    @SerializedName("vote")
    val vote: Boolean
)