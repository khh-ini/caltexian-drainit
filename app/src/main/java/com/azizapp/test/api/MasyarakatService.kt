package com.azizapp.test.api

import com.azizapp.test.model.*
import retrofit2.Response
import retrofit2.http.*

//define service class


interface MasyarakatService {

    @POST("api/login/masyarakat")
    suspend fun loginMasyarakat(
        @Body masyarakat: Masyarakat
    ): Response<MasyarakatLoginResponse>

    @GET("api/masyarakat/profile")
    suspend fun profileMasyarakat(
        @Header("Authorization") token: String
    ): Response<ProfileMasyarakat>

    @POST("api/register/masyarakat")
    suspend fun daftarMasyarakat(
        @Header("Accept") accept: String,
        @Body masyarakatDaftar: MasyarakatDaftar
    ): Response<MasyarakatDaftarResponse>

    @Multipart
    @POST("api/pengaduan")
    suspend fun pengaduanMasyarakat(
        @Header("Authorization") token: String,
        @Header("Accept") accept: String,
        @Part ("nama_jalan") nama_jalan: String,
        @Part image: String?,
        @Part ("tipe_pengaduan") tipe_pengaduan: String,
        @Part ("deskripsi_pengaduan") deskripsi_pengaduan: String,
        @Part ("geometry") geometry: String
    ): Response<DataPengaduanMasyarakat>

    @POST("api/masyarakat")
    suspend fun editPassword(
        @Header("Authorization") token: String,
        @Body editMasyarakatRequest: EditMasyarakatRequest
    ): Response<EditMasyarakatResponse>

    @GET("api/pengaduan_by_masyarakat")
    suspend fun riwayatMasyarakat(
        @Header("Authorization") token: String
    ):Response<PengaduanResponse>
}