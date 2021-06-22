package com.azizapp.test.model.pengaduanvote


import com.google.gson.annotations.SerializedName

data class PengaduanWithVoteItem(
    @SerializedName("created_at")
    val createdAt: String,
    @SerializedName("deskripsi_pengaduan")
    val deskripsiPengaduan: String,
    @SerializedName("downvote")
    val downvote: Int,
    @SerializedName("feedback_masyarakat")
    val feedbackMasyarakat: Any,
    @SerializedName("foto")
    val foto: String,
    @SerializedName("geometry")
    val geometry: String,
    @SerializedName("id")
    val id: String,
    @SerializedName("id_admin")
    val idAdmin: String,
    @SerializedName("id_masyarakat")
    val idMasyarakat: String,
    @SerializedName("id_petugas")
    val idPetugas: String,
    @SerializedName("laporan_petugas")
    val laporanPetugas: String,
    @SerializedName("nama_admin")
    val namaAdmin: String,
    @SerializedName("nama_jalan")
    val namaJalan: String,
    @SerializedName("nama_pelapor")
    val namaPelapor: String,
    @SerializedName("nama_petugas")
    val namaPetugas: String,
    @SerializedName("status_pengaduan")
    val statusPengaduan: String,
    @SerializedName("tipe_pengaduan")
    val tipePengaduan: String,
    @SerializedName("updated_at")
    val updatedAt: String,
    @SerializedName("upvote")
    val upvote: Int,
    @SerializedName("vote")
    val vote: Int?
)