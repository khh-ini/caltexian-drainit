package com.azizapp.test.model


import android.annotation.SuppressLint
import com.google.gson.annotations.SerializedName
import kotlinx.android.parcel.Parcelize
import android.os.Parcelable

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