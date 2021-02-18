package com.azizapp.test.model


import com.google.gson.annotations.SerializedName

data class DataPengaduan(
    @SerializedName("created_at")
    var createdAt: String?,
    @SerializedName("deskripsi_pengaduan")
    var deskripsiPengaduan: String?,
    @SerializedName("foto")
    var foto: String?,
    @SerializedName("geometry")
    var geometry: Geometry?,
    @SerializedName("id")
    var id: String?,
    @SerializedName("id_masyarakat")
    var idMasyarakat: String?,
    @SerializedName("nama_jalan")
    var namaJalan: String?,
    @SerializedName("status_pengaduan")
    var statusPengaduan: String?,
    @SerializedName("tipe_pengaduan")
    var tipePengaduan: String?,
    @SerializedName("updated_at")
    var updatedAt: String?
)