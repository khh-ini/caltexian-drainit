package com.azizapp.test.model

import android.os.Parcel
import android.os.Parcelable
import com.google.gson.annotations.SerializedName


data class Pengaduan(
    @SerializedName("deskripsi_pengaduan")
    var deskripsiPengaduan: String? = null,
    @SerializedName("feedback_masyarakat")
    var feedbackMasyarakat: String? = null,
    @SerializedName("foto")
    var foto: String? = null,
    @SerializedName("geometry")
    var geometry: String? = null,
    @SerializedName("id")
    var id: String? = null,
    @SerializedName("id_admin")
    var idAdmin: Any? = null,
    @SerializedName("id_masyarakat")
    var idMasyarakat: String? = null,
    @SerializedName("id_petugas")
    var idPetugas: Any? = null,
    @SerializedName("laporan_petugas")
    var laporanPetugas: String? = null,
    @SerializedName("nama_jalan")
    var namaJalan: String? = null,
    @SerializedName("status_pengaduan")
    var statusPengaduan: String? = null,
    @SerializedName("tipe_pengaduan")
    var tipePengaduan: String? = null
) : Parcelable {
    constructor(parcel: Parcel) : this(
        parcel.readString(),
        TODO("feedbackMasyarakat"),
        parcel.readString(),
        parcel.readString(),
        parcel.readString(),
        TODO("idAdmin"),
        parcel.readString(),
        TODO("idPetugas"),
        TODO("laporanPetugas"),
        parcel.readString(),
        parcel.readString(),
        parcel.readString()
    ) {
    }

    override fun writeToParcel(parcel: Parcel, flags: Int) {
        parcel.writeString(deskripsiPengaduan)
        parcel.writeString(foto)
        parcel.writeString(geometry)
        parcel.writeString(id)
        parcel.writeString(idMasyarakat)
        parcel.writeString(namaJalan)
        parcel.writeString(statusPengaduan)
        parcel.writeString(tipePengaduan)
    }

    override fun describeContents(): Int {
        return 0
    }

    companion object CREATOR : Parcelable.Creator<Pengaduan> {
        override fun createFromParcel(parcel: Parcel): Pengaduan {
            return Pengaduan(parcel)
        }

        override fun newArray(size: Int): Array<Pengaduan?> {
            return arrayOfNulls(size)
        }
    }

}