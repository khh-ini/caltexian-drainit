package com.azizapp.test.model


import android.annotation.SuppressLint
import android.os.Parcelable
import com.google.gson.annotations.SerializedName
import kotlinx.android.parcel.Parcelize

@SuppressLint("ParcelCreator")
@Parcelize
data class TitikBanjir(
    @SerializedName("id")
    val id: String,
    @SerializedName("nama_jalan")
    val namaJalan: String,
    @SerializedName("kondisi_kerusakan")
    val kondisiKerusakan: String,
    @SerializedName("foto")
    val foto: String,
    @SerializedName("keterangan")
    val keterangan: String,
    @SerializedName("geometry")
    val geometry: String
) : Parcelable