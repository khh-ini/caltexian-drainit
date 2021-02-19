package com.azizapp.test.api

import com.azizapp.test.model.*
import retrofit2.Response
import retrofit2.http.Body
import retrofit2.http.GET
import retrofit2.http.Header
import retrofit2.http.POST

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


    @POST("/api/pengaduan")
    suspend fun pengaduanMasyarakat(
        @Header("Authorization") token: String,
        @Header("Accept") accept: String,
        @Body dataPengaduan: DataPengaduanMasyarakat
    ): Response<DataPengaduanMasyarakat>

    @POST("/api/masyarakat/")
    suspend fun editPassword(
        @Header("Authorization") token: String,
        @Body method: String,
        @Body masyarakatDaftar: MasyarakatDaftar
    ): Response<MasyarakatDaftarResponse>
}