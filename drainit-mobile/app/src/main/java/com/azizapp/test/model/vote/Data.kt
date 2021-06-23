package com.azizapp.test.model.vote


import com.google.gson.annotations.SerializedName

data class Data(
    @SerializedName("created_at")
    val createdAt: String,
    @SerializedName("id")
    val id: String,
    @SerializedName("id_pengaduan")
    val idPengaduan: String,
    @SerializedName("id_voter")
    val idVoter: String,
    @SerializedName("updated_at")
    val updatedAt: String,
    @SerializedName("vote")
    val vote: Boolean
)